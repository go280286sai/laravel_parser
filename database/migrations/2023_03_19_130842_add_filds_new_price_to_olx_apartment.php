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
        Schema::table('olx_apartments', function (Blueprint $table) {
            $table->integer('area')->default(0);
            $table->integer('real_price')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('olx_aparments', function (Blueprint $table) {
            $table->dropColumn('area');
            $table->dropColumn('real_price');
        });
    }
};
