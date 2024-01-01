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
        Schema::create('baocao', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('MaBaoCao')->unsigned();
            $table->bigInteger('MaNV')->unsigned();
            $table->timestamp('ThoiGianLap')->nullable();
            $table->string('GiaiDoanBaoCao');
            $table->integer('TongDoanhThu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baocao');
    }
};
