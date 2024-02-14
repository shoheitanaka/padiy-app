<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample Sites
        DB::table('sites')->insert(['site_name'=>'サイト1', 'site_url'=>'https://test1.com/', 'trade_name'=>'テスト販売サイト1', 'site_hash'=>'123456789asdqwe']);
        DB::table('sites')->insert(['site_name'=>'サイト2', 'site_url'=>'https://test2.com/', 'trade_name'=>'テスト販売サイト2', 'site_hash'=>'123456789asdqwe']);
        DB::table('sites')->insert(['site_name'=>'サイト3', 'site_url'=>'https://test3.com/', 'trade_name'=>'テスト販売サイト3', 'site_hash'=>'123456789asdqwe']);
        // Sample Applications
        DB::table('applications')->insert(['application_id'=>'WC0000000011', 'site_id'=>1, 'email'=>'site1@test.com', 'phone'=>'09012345678', 'ceo'=>'テスト太郎1', 'ceo_kana'=>'テストタロウ1', 'ceo_birthday'=>'1972-11-10', 'gmv_flag'=>false, 'average_flag'=>false, 'survey01'=>true, 'survey02'=>true, 'survey03'=>true, 'survey04'=>true, 'survey05'=>true, 'survey06'=>true, 'survey07'=>true, 'survey08'=>true, 'survey09'=>true, 'paidy_status'=>'rejected']);
        DB::table('applications')->insert(['application_id'=>'WC0000000021', 'site_id'=>2, 'email'=>'site2@test.com', 'phone'=>'09012345679', 'ceo'=>'テスト太郎2', 'ceo_kana'=>'テストタロウ2', 'ceo_birthday'=>'1972-11-11', 'gmv_flag'=>false, 'average_flag'=>false, 'survey01'=>true, 'survey02'=>true, 'survey03'=>true, 'survey04'=>true, 'survey05'=>true, 'survey06'=>true, 'survey07'=>true, 'survey08'=>true, 'survey09'=>true, 'trade_name_kana'=>'テストハンバイサイト2', 'organization_flag'=>true, 'corporate_number'=>'1234567890123', 'zip'=>'7281234', 'address'=>'兵庫県明石市住所詳細サンプルテキスト', 'product'=>'家電・インテリア・雑貨 - 雑貨', 'law_url'=>'https://test2.com/law', 'pp_url'=>'https://test2.com/pp']);
        DB::table('applications')->insert(['application_id'=>'WC0000000031', 'site_id'=>3, 'email'=>'site3@test.com', 'phone'=>'09012345677', 'ceo'=>'テスト太郎3', 'ceo_kana'=>'テストタロウ3', 'ceo_birthday'=>'1972-11-12', 'gmv_flag'=>false, 'average_flag'=>false, 'survey01'=>true, 'survey02'=>true, 'survey03'=>true, 'survey04'=>true, 'survey05'=>true, 'survey06'=>true, 'survey07'=>true, 'survey08'=>true, 'survey09'=>true]);
        DB::table('applications')->insert(['application_id'=>'WC0000000041', 'site_id'=>1, 'email'=>'site1@test.com', 'phone'=>'09012345678', 'ceo'=>'テスト太郎1', 'ceo_kana'=>'テストタロウ1', 'ceo_birthday'=>'1972-11-10', 'gmv_flag'=>false, 'average_flag'=>false, 'survey01'=>true, 'survey02'=>true, 'survey03'=>true, 'survey04'=>true, 'survey05'=>true, 'survey06'=>true, 'survey07'=>true, 'survey08'=>true, 'survey09'=>true]);
    }
}
