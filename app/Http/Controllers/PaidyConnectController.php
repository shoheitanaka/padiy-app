<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\File;
use Illuminate\Http\Request;

class PaidyConnectController extends Controller
{
    public function paidy_sftp_upload() {
        $file = file_get_contents( storage_path('box_data/woocommerce_merchant_list.xlsx') );
        if(Storage::disk('sftp')->put('woocommerce/woocommerce_merchant_list.xlsx', $file)){
            Log::debug('The file was successfully transferred to Paidy\'s server.');
            return true;
        }else{
            Log::error('File transfer to Paidy\'s server failed.');
            return false;
        }
    }

    public function index(){
        if($this->paidy_sftp_upload()){
            $result_msg = 'アップロードに成功しました。';
        }else{
            $result_msg = 'アップロードに失敗しました。';
        }
        return view('sftp-upload.index', compact( 'result_msg' ));
    }
}
