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
        Schema::create('olx_apartments', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('url');
            $table->string('type');
            $table->integer('rooms')->nullable();
            $table->integer('floor')->nullable();
            $table->integer('etajnost')->nullable();
            $table->integer('price');
            $table->integer('views')->default(0);
            $table->text('description')->nullable();
            $table->integer('status')->default(0);
            $table->text('comment')->nullable();
            $table->string('location');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('olx_apartments');
    }
};
