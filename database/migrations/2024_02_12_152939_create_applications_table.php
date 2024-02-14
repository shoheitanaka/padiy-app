<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string( 'application_id' )->unique();
            $table->string( 'email', 60 );
            $table->string( 'phone', 13 );
            $table->string( 'ceo', 40 );
            $table->string( 'ceo_kana', 40 );
            $table->date( 'ceo_birthday' );
            $table->boolean( 'gmv_flag' );
            $table->boolean( 'average_flag' );
            $table->boolean( 'survey01' );
            $table->boolean( 'survey02' );
            $table->boolean( 'survey03' );
            $table->boolean( 'survey04' );
            $table->boolean( 'survey05' );
            $table->boolean( 'survey06' );
            $table->boolean( 'survey07' );
            $table->boolean( 'survey08' );
            $table->boolean( 'survey09' );
            $table->integer( 'set_status' )->default(0);
            $table->string( 'paidy_status', 10 )->nullable()->default( null );
            $table->string( 'trade_name_kana' )->nullable()->default( null );
            $table->boolean( 'organization_flag' )->default( false );
            $table->string( 'corporate_number' )->nullable()->default( null );
            $table->string( 'zip', 7 )->nullable()->default( null );
            $table->string( 'address' )->nullable()->default( null );
            $table->string( 'product' )->nullable()->default( null );
            $table->string( 'product_other' )->nullable()->default( null );
            $table->string( 'law_url' )->nullable()->default( null );
            $table->string( 'pp_url' )->nullable()->default( null );
            $table->string( 'public_live_key' )->nullable()->default( null );
            $table->string( 'secret_live_key' )->nullable()->default( null );
            $table->string( 'public_test_key' )->nullable()->default( null );
            $table->string( 'secret_test_key' )->nullable()->default( null );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
