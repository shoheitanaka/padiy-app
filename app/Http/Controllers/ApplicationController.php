<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
class ApplicationController extends Controller
{
    public function index( Request $request ){
        $application_id = $request->input('application_id');
        $site_name = $request->input('site_name');
        $paidy_status = $request->input('paidy_status');
        $set_status = $request->input('set_status');
        $created_from = $request->input('created_from');
        $created_until = $request->input('created_until');
        $updated_from = $request->input('updated_from');
        $updated_until = $request->input('updated_until');

        $query = Application::query();
        $query->select(
            'applications.*',
            'sites.site_name',
            'sites.site_url',
            'applications.updated_at as application_updated_at'
        );
        $query->leftjoin('sites', function ($query) use ($request) {
            $query->on('applications.site_id', '=', 'sites.id');
            });
        if(!empty($application_id)) {
            $query->where('application_id', 'LIKE', "%{$application_id}%");
        }
        if(!empty($site_name)) {
            $query->where('site_name', 'LIKE', "%{$site_name}%");
        }
        if($paidy_status == 'null') {
            $query->where('paidy_status', '=', null);
        }elseif(!empty($paidy_status)){
            $query->where('paidy_status', 'LIKE', $paidy_status);
        }
        if(!empty($set_status)) {
            $query->where('set_status', 'LIKE', $set_status);
        }
        if (isset($created_from) && isset($created_until)) {
            $query->whereBetween('applications.created_at', [$created_from, $created_until]);
        }
        if (isset($updated_from) && isset($updated_until)) {
            $query->whereBetween('applications.updated_at', [$updated_from, $updated_until]);
        }
        $applications = $query->get();
        return view('application.index', compact('applications', 'application_id', 'site_name', 'paidy_status', 'set_status', 'created_from', 'created_until', 'updated_from', 'updated_until'));
    }
}
