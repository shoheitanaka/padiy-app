<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Site;
use App\Http\Resources\ApplicationsResource;
use App\Http\Requests\ApplicationRequest;
use Dcblogdev\Box\Facades\Box;

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
