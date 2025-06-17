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
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn([
                'survey01',
                'survey02',
                'survey03',
                'survey04',
                'survey05',
                'survey06',
                'survey07',
                'survey08',
                'survey09',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->boolean('survey01')->default(0);
            $table->boolean('survey02')->default(0);
            $table->boolean('survey03')->default(0);
            $table->boolean('survey04')->default(0);
            $table->boolean('survey05')->default(0);
            $table->boolean('survey06')->default(0);
            $table->boolean('survey07')->default(0);
            $table->boolean('survey08')->default(0);
            $table->boolean('survey09')->default(0);
        });
    }
};
