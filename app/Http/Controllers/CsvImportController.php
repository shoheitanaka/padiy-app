<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CsvImportController extends Controller
{
    public function import(Request $request)
    {
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathName());
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $error_msgs = array();
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
        $error_msg = '';
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
            if(empty($error_msg))$result_msg = 'データベースに登録しました。';
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
