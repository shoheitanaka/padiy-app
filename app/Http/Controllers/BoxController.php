<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dcblogdev\Box\Facades\Box;

class BoxController extends Controller
{
    public function index(){
//        Box::getAccessToken();
        $message = 'TEST2';
        return view('box.index', compact( 'message' ));
    }
}
