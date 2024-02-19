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
        }else{
            $save_site_data = array(
                'site_name' => $request->site_name,
                'site_url' => $request->site_url,
                'trade_name' => $request->trade_name,
                'site_hash' => $request->site_hash
            );
            $this_site = Site::create($save_site_data);
            $site_id = $this_site->id;
        }

        $latest_app = Application::orderBy('created_at', 'DESC')->orderBy('id', 'DESC')->first();
        $set_num = substr($latest_app->application_id, 2);
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
        // Add to Excel file
        $file_url = storage_path('box_data').'/woocommerce_merchant_list.xlsx';
        $reader = IOFactory::createReader("Xlsx");
        $set_excel = $reader->load( $file_url );
        $sheet = $set_excel->getSheetByName('加盟店');
        $i = 1;
        $first = $sheet->getCell('A1')->getValue();
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
        $sheet->setCellValue('K'.$i-1, $request->gmv_flag);
        $sheet->setCellValue('L'.$i-1, $request->average_flag);
        $sheet->setCellValue('M'.$i-1, $request->survey01);
        $sheet->setCellValue('N'.$i-1, $request->survey02);
        $sheet->setCellValue('O'.$i-1, $request->survey03);
        $sheet->setCellValue('P'.$i-1, $request->survey04);
        $sheet->setCellValue('Q'.$i-1, $request->survey05);
        $sheet->setCellValue('R'.$i-1, $request->survey06);
        $sheet->setCellValue('S'.$i-1, $request->survey07);
        $sheet->setCellValue('T'.$i-1, $request->survey08);
        $sheet->setCellValue('U'.$i-1, $request->survey09);

        $writer = IOFactory::createWriter($set_excel, "Xlsx");;
        $writer->save($file_url);
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
    public function send_box( $request ){
        Box::get('users/me');
        $file_id = 1444816744470;
    }
}
