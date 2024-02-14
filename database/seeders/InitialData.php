<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class InitialData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Initial Users
        DB::table('users')->insert(['name'=>'Shohei', 'email' => 'shohei.t@artws.info', 'password' => Hash::make('KyoKaSa#123')]);
        DB::table('users')->insert(['name'=>'Paidy管理者', 'email' => 'tam@paidy.com', 'password' => Hash::make('Asdf!1234')]);
        // Initial Catalog
        DB::table('categories')->insert([ 'name' => '総合通販 - フリマ', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '総合通販 - モール', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'ファッション - 総合', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'ファッション - レディース', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'ファッション - メンズ', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'ファッション - キッズ', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'ファッション - アクセサリー', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'ファッション - 下着', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'ファッション - ブランド品', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'フード - 飲料', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'フード - 調味料', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'フード - ワイン・アルコール', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'フード - レストラン予約', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'フード - テイクアウト', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '美容・健康 - エステ', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '美容・健康 - 健康食品・サプリ', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '美容・健康 - 化粧品', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '美容・健康 - 医薬部外品', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '美容・健康 - 美容品', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '美容・健康 - クリニック・オンライン診療', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '美容・健康 - ヘアケア', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '美容・健康 - コンタクトレンズ', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '美容・健康 - アロマ', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '美容・健康 - フィットネス用品', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '美容・健康 - 美容院', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '美容・健康 - 健康グッズ', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '美容・健康 - 整体・接骨院', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '美容・健康 - マツエク', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '美容・健康 - ネイル', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '美容・健康 - 医薬品', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '美容・健康 - 美容医療', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '家電・インテリア・雑貨 - 家電・スマホ本体・PC/Game機本体', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '家電・インテリア・雑貨 - スマホ周辺機器', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '家電・インテリア・雑貨 - インテリア', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '家電・インテリア・雑貨 - ガーデニング', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '家電・インテリア・雑貨 - スポーツ', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '家電・インテリア・雑貨 - 手芸', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '家電・インテリア・雑貨 - 車用品', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '家電・インテリア・雑貨 - 雑貨', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '家電・インテリア・雑貨 - 防犯', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '家電・インテリア・雑貨 - 趣味', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '家電・インテリア・雑貨 - 文具', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => '家電・インテリア・雑貨 - 事務用品', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'トラベル・スポーツ - ホテル・旅館', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'トラベル・スポーツ - ツアー', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'トラベル・スポーツ - チケット', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'トラベル・スポーツ - アクティビティ・レジャー', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'トラベル・スポーツ - イベントグッズ', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'トラベル・スポーツ - スポーツ施設・フィットネスクラブ', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'トラベル・スポーツ - スポーツ大会予約', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'デジタルコンテンツ - ゲーム', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'デジタルコンテンツ - 書籍', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'デジタルコンテンツ - CD・DVD', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'デジタルコンテンツ - アニメ', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'デジタルコンテンツ - 音楽', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'デジタルコンテンツ - SNS', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'デジタルコンテンツ - 漫画', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'デジタルコンテンツ - 暗号関連（NFT、暗号取引所）', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'デジタルコンテンツ - 動画配信', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'デジタルコンテンツ - 新聞', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'デジタルコンテンツ - 画像・イラスト', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'その他サービス - 電子マネー', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'その他サービス - 写真', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'その他サービス - 印刷', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'その他サービス - ペット用品', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'その他サービス - クラウドファンディング', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'その他サービス - 教育', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'その他サービス - カルチャースクール・通信講座', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'その他サービス - カードゲーム', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'その他サービス - 中古品', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'その他サービス - CBD（カンナビジオール）', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'その他サービス - フラワーギフト', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'その他サービス - ホビー関連', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'その他サービス - ビザ代行', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'その他サービス - カーシェア', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'その他サービス - レンタカー', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'その他サービス - レンタルWifi', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'その他サービス - オンライン英会話', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'その他サービス - 宅配クリーニング', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'その他サービス - 収納サービス', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'その他サービス - スペースシェア', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'その他サービス - レンタルグッズ', 'delete_flag' => false ]);
        DB::table('categories')->insert([ 'name' => 'その他サービス - その他', 'delete_flag' => false ]);
    }
}
