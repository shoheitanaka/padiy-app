<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Site;
use App\Http\Resources\ApplicationsResource;
use App\Http\Requests\ApplicationRequest;
use Dcblogdev\Box\Facades\Box;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Log;

class ApplicationController extends Controller
{
    public function index() {
        return Application::all();
    }

    public function show(Application $application)
    {
        return new ApplicationsResource($application);
    }

    public function create(Request $request)
    {
        $find_site = Site::where( 'site_url', $request->site_url )->first();
        if($find_site){
            $site_id = $find_site->id;
            Log::info('Check Site_id:'.$site_id);
        }else{
            $save_site_data = array(
                'site_name' => $request->site_name,
                'site_url' => $request->site_url,
                'trade_name' => $request->trade_name,
                'site_hash' => $request->site_hash
            );
            $this_site = Site::create($save_site_data);
            $site_id = $this_site->id;
            Log::info('Check Site_id:'.$site_id);
        }

        $latest_app = Application::orderBy('created_at', 'DESC')->orderBy('id', 'DESC')->first();
        if($latest_app){
            $set_num = substr($latest_app->application_id, 2);
        }else{
            $set_num = 1;
        }
        $set_num = substr($set_num, 0, -1);
        $set_num = (int)$set_num;
        if(is_numeric($set_num))$set_num++;
        $set_num = sprintf('%09d', $set_num);
        $application_id = 'WC'.$set_num.'1';
        $save_app_data = array(
            'application_id' => $application_id,
            'site_id' => $site_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'ceo' => $request->ceo,
            'ceo_kana' => $request->ceo_kana,
            'ceo_birthday' => $request->ceo_birthday,
            'gmv_flag' => $request->gmv_flag,
            'average_flag' => $request->average_flag,
            'survey01' => $request->survey01,
            'survey02' => $request->survey02,
            'survey03' => $request->survey03,
            'survey04' => $request->survey04,
            'survey05' => $request->survey05,
            'survey06' => $request->survey06,
            'survey07' => $request->survey07,
            'survey08' => $request->survey08,
            'survey09' => $request->survey09,
        );
        $application = Application::create( $save_app_data );
        Log::info('Create application.');
        // Add to Excel file
        /*
        $file_url = storage_path('box_data').'/woocommerce_merchant_list.xlsx';
        $gmv_flag = ($request->gmv_flag === 1) ? '1億円未満' : '1億円以上';
        $average_flag = ($request->average_flag === 1) ? '5万円未満' : '５万円以上';
        $survey01 = ($request->survey01 === 1) ? 'はい' : 'いいえ';
        $survey02 = ($request->survey02 === 1) ? 'はい' : 'いいえ';
        $survey03 = ($request->survey03 === 1) ? 'はい' : 'いいえ';
        $survey04 = ($request->survey04 === 1) ? 'はい' : 'いいえ';
        $survey05 = ($request->survey05 === 1) ? 'はい' : 'いいえ';
        $survey06 = ($request->survey06 === 1) ? 'はい' : 'いいえ';
        $survey07 = ($request->survey07 === 1) ? 'はい' : 'いいえ';
        $survey08 = ($request->survey08 === 1) ? 'はい' : 'いいえ';
        $survey09 = ($request->survey09 === 1) ? 'はい' : 'いいえ';
        $reader = IOFactory::createReader("Xlsx");
        $set_excel = $reader->load( $file_url );
        $sheet = $set_excel->getSheetByName('加盟店');
        $i = 1;
        $a_cell = $sheet->getCell('A'.$i)->getValue();
        while( !empty( $a_cell ) ){
            $a_cell = $sheet->getCell('A'.$i)->getValue();
            $i++;
        }
        $sheet->setCellValue('A'.$i-1, $application_id);
        $unitime = time();
        $sheet->setCellValue('B'.$i-1, date('Y/n/j H:i:s', $unitime));
        $sheet->setCellValue('C'.$i-1, $request->trade_name);
        $sheet->setCellValue('D'.$i-1, $request->site_name);
        $sheet->setCellValue('E'.$i-1, $request->site_url);
        $sheet->setCellValue('F'.$i-1, $request->email);
        $sheet->setCellValue('G'.$i-1, $request->phone);
        $sheet->setCellValue('H'.$i-1, $request->ceo);
        $sheet->setCellValue('I'.$i-1, $request->ceo_kana);
        $sheet->setCellValue('J'.$i-1, $request->ceo_birthday);
        $sheet->setCellValue('K'.$i-1, $gmv_flag);
        $sheet->setCellValue('L'.$i-1, $average_flag);
        $sheet->setCellValue('M'.$i-1, $survey01);
        $sheet->setCellValue('N'.$i-1, $survey02);
        $sheet->setCellValue('O'.$i-1, $survey03);
        $sheet->setCellValue('P'.$i-1, $survey04);
        $sheet->setCellValue('Q'.$i-1, $survey05);
        $sheet->setCellValue('R'.$i-1, $survey06);
        $sheet->setCellValue('S'.$i-1, $survey07);
        $sheet->setCellValue('T'.$i-1, $survey08);
        $sheet->setCellValue('U'.$i-1, $survey09);

        $writer = IOFactory::createWriter($set_excel, "Xlsx");;
        $writer->save($file_url);
        */
        // Add CSV file
        $file_url = storage_path('box_data').'/woocommerce_merchant_list.csv';
        $gmv_flag = ($request->gmv_flag == 1) ? '1億円未満' : '1億円以上';
        $average_flag = ($request->average_flag == 1) ? '5万円未満' : '５万円以上';
        $survey01 = ($request->survey01 == 1) ? 'はい' : 'いいえ';
        $survey02 = ($request->survey02 == 1) ? 'はい' : 'いいえ';
        $survey03 = ($request->survey03 == 1) ? 'はい' : 'いいえ';
        $survey04 = ($request->survey04 == 1) ? 'はい' : 'いいえ';
        $survey05 = ($request->survey05 == 1) ? 'はい' : 'いいえ';
        $survey06 = ($request->survey06 == 1) ? 'はい' : 'いいえ';
        $survey07 = ($request->survey07 == 1) ? 'はい' : 'いいえ';
        $survey08 = ($request->survey08 == 1) ? 'はい' : 'いいえ';
        $survey09 = ($request->survey09 == 1) ? 'はい' : 'いいえ';
        $unitime = time();
        $csv_data = array(
            $application_id,
            date('Y/n/j H:i:s', $unitime),
            $request->trade_name,
            $request->site_name,
            $request->site_url,
            $request->email,
            $request->phone,
            $request->ceo,
            $request->ceo_kana,
            $request->ceo_birthday,
            $gmv_flag,
            $average_flag,
            $survey01,
            $survey02,
            $survey03,
            $survey04,
            $survey05,
            $survey06,
            $survey07,
            $survey08,
            $survey09
        );
        if(file_exists($file_url)){
            $fp = fopen($file_url, 'a');
        }else{
            $fp = fopen($file_url, 'w');
            fwrite($fp, '\xEF\xBB\xBF');
            fputcsv($fp, array("登録番号","申込日時","商号/屋号","貴社のECサイト名","貴社のECサイトURL","Paidy登録用メールアドレス","ご担当窓口電話番号","代表者（姓名）","代表者カナ（セイメイ）","代表者生年月日（西暦）","年間流通総額","ご注文あたりの平均購入額","セキュリティアンケートQ1","セキュリティアンケートQ2","セキュリティアンケートQ3","セキュリティアンケートQ4","セキュリティアンケートQ5","セキュリティアンケートQ6","セキュリティアンケートQ7","セキュリティアンケートQ8","セキュリティアンケートQ9","法人/個人事業主","法人番号","商号/屋号（カナ）","登記簿住所・郵便番号","登記簿住所・住所","所在地・郵便番号","所在地・住所","商材","商材(その他の場合)","販売方法","特商法URL","プライバシーポリシーURL"));
        }
        fputcsv($fp, $csv_data);
        fclose($fp);

        return response()->json($application);
    }

    public function update(ApplicationRequest $request, Application $application)
    {
        $data = $request->validated();
        $application->update($data);
        return new ApplicationsResource($application);
    }

    public function destroy( Application $application)
    {
      $application->delete();
      return response("", 204);
    }
}
