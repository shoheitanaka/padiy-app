<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
class ApplicationController extends Controller
{
    public function index(){
        $applications = Application::all();
        return view('application.index', compact('applications'));
    }
}
