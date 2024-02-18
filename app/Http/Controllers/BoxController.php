<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dcblogdev\Box\Facades\Box;

class BoxController extends Controller
{
    public function index(){
        Box::getAccessToken();
        //example of getting the authenticated users details
        return Box::get('/users/me');
    }
}
