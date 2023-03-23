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
            $table->integer('metro')->default(0);
            $table->integer('repair')->default(0);
            $table->integer('service')->default(0);
            $table->integer('shops')->default(0);
            $table->integer('location_index')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('olx_apartments', function (Blueprint $table) {
            $table->dropColumn('metro');
            $table->dropColumn('repair');
            $table->dropColumn('service');
            $table->dropColumn('shops');
            $table->dropColumn('location_index');
        });
    }
};
