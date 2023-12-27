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
        Schema::create('phieunhap', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('MaNV')->unsigned();
            $table->bigInteger('MaSp')->unsigned();
            $table->bigInteger('MaPhieu')->unsigned();
            $table->timestamp('Ngaylap')->nullable();
            $table->integer('Dongia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phieunhap');
    }
};
