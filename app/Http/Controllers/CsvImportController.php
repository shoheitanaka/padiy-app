<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CsvImportController extends Controller
{
    public function import(Request $request)
    {
        // バリデーション
        $request->validate([
//            'file' => 'required|file|mimes:csv,xlsx,xls|max:2048', // 最大2MB
        ]);

        // ファイルのアップロードと処理
        return $this->processFile($request);
    }

    private function processFile(Request $request)
    {
        $file = $request->file('file');
       // 現在の日時を使ってファイル名を生成
        $timestamp = Carbon::now()->format('Y-m-d_H-i-s');
        $originalExtension = $file->getClientOriginalExtension();
        $filename = $timestamp . '.' . $originalExtension;

        // csvフォルダに保存
        $storedPath = $file->storeAs('csv', $filename);

        // 保存されたファイルのフルパスを取得
        $fullPath = Storage::path($storedPath);
        $spreadsheet = IOFactory::load($fullPath);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $error_msg = '';
        $error_msgs = array();
        if(empty($sheetData)){
            $error_msgs[0]['file'] = 'CSVファイルが空か、ヘッダーのみです。';
            return view('import-csv.show', compact( 'error_msgs' ));
        }
        foreach ($sheetData as $key => $row) {
            if ($row !== reset($sheetData)) {
                //Check application_id
                if( substr( $row[0], 0, 2 ) != 'WC'){
                    $error_msgs[$key]['id'] = '接頭辞が異なります。';
                }
                // Check status string
                $status_array = array('approved', 'rejected', 'canceled');
                if(!in_array($row[1], $status_array)){
                    $error_msgs[$key]['status'] = 'ステータスは approved,rejected,canceled でなければいけません。';
                }
                if( $row[1] == 'approved' ){
                    if(empty($row[2])){
                        $paidy_key[$key][] = 'public live key';
                    }
                    if(empty($row[3])){
                        $paidy_key[$key][] = 'public secret key';
                    }
                    if(empty($row[4])){
                        $paidy_key[$key][] = 'test live key';
                    }
                    if(empty($row[5])){
                        $paidy_key[$key][] = 'test secret key';
                    }
                }
                if((!empty($paidy_key[$key]))){
                    $error_msgs[$key]['key'] = '以下の key が抜けています。'.implode(', ', $paidy_key[$key]);
                }
            }
        }
        $result_msg = '';
        if( empty( $error_msgs ) ){
            foreach ($sheetData as $row) {
                if ($row !== reset($sheetData)) {
                    $result = DB::table('applications')->where('application_id', $row[0])->update([
                        'paidy_status' => $row[1],
                        'public_live_key' => $row[2],
                        'secret_live_key' => $row[3],
                        'public_test_key' => $row[4],
                        'secret_test_key' => $row[5],
                        'updated_at' => Carbon::now()
                    ]);
                    if( !$result ){
                        $error_msg .= 'データベースに登録が失敗しました。'."\n";
                    }
                }
            }

            if(empty($error_msg)){
                $result_msg = 'データベースに登録しました。';
                foreach ($sheetData as $row) {
                    if ($row !== reset($sheetData)) {
                        try {

                            // applicationsテーブルからsite_idを取得
                            $application = DB::table('applications')
                                ->where('application_id', $row[0])
                                ->select('site_id')
                                ->first();

                            if (!$application) {
                                $error_msg .= 'アプリケーションID: ' . $row[0] . ' が見つかりません。' . "\n";
                                continue;
                            }

                            // sitesテーブルからsite_urlとsite_hashを取得
                            $site = DB::table('sites')
                                ->where('id', $application->site_id)
                                ->select('site_url', 'site_hash')
                                ->first();

                            if (!$site) {
                                $error_msg .= 'サイトID: ' . $application->site_id . ' が見つかりません。' . "\n";
                                continue;
                            }
                            // site_hashを使って暗号化キーとIVを生成
                            $method = 'AES-256-CBC';
                            $key = substr(hash('sha256', $site->site_hash), 0, 32);
                            $iv = substr(hash('sha256', $site->site_hash . 'iv'), 0, 16);

                            // 各キーを暗号化
                            $encryptedPublicLiveKey = base64_encode(openssl_encrypt($row[2], $method, $key, 0, $iv));
                            $encryptedSecretLiveKey = base64_encode(openssl_encrypt($row[3], $method, $key, 0, $iv));
                            $encryptedPublicTestKey = base64_encode(openssl_encrypt($row[4], $method, $key, 0, $iv));
                            $encryptedSecretTestKey = base64_encode(openssl_encrypt($row[5], $method, $key, 0, $iv));

                            if( "/" === substr($site->site_url, -1)){
                                $site_url = $site->site_url;
                            }else{
                                $site_url = $site->site_url . '/';
                            }
                            $response = Http::post( $site_url.'wp-json/paidy-receiver/v1/receive/', [
                                'application_id' => $row[0],
                                'paidy_status' => $row[1],
                                'public_live_key' => $encryptedPublicLiveKey,
                                'secret_live_key' => $encryptedSecretLiveKey,
                                'public_test_key' => $encryptedPublicTestKey,
                                'secret_test_key' => $encryptedSecretTestKey,
                                'updated_at' => Carbon::now()->toDateTimeString()
                            ]);

                            if (!$response->successful()) {
                                $error_msg .= 'API送信エラー (ID: ' . $row[0] . '): ' . $response->status() . "\n";
                            }
                        } catch (\Exception $e) {
                            $error_msg .= 'API送信エラー (ID: ' . $row[0] . '): ' . $e->getMessage() . "\n";
                        }
                    }
                }
            } else {
                $result_msg = 'データベースに登録しましたが、API送信に失敗しました。';
            }
        }else{
            foreach($error_msgs as $key => $msgs){
                $error_msg .= $key.'行目に問題があります。'."\n";
                foreach($msgs as $msg){
                    $error_msg .= '--- '.$msg."\n";
                }
            }
        }
        return view('import-csv.show', compact( 'result_msg', 'error_msg' ));
    }

    public function show(){
        $result_msg = '';
        $error_msg = '';
        return view('import-csv.show', compact( 'result_msg', 'error_msg' ));
    }
}
