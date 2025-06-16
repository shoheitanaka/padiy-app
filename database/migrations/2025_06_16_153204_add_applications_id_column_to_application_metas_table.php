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
        Schema::table('application_metas', function (Blueprint $table) {
            $table->foreignId('application_id')
                ->constrained('applications')
                ->onDelete('cascade')
                ->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('application_metas', function (Blueprint $table) {
            $table->dropForeign(['application_id']);
            $table->dropColumn('application_id');
            $table->unsignedBigInteger('application_id')->after('id'); // Revert to unsignedBigInteger without foreign key
        });
    }
};
