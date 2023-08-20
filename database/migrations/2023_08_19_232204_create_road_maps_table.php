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
        Schema::create('road_maps', function (Blueprint $table) {
            $table->id();
            $table->string('kecamatan',100);
            $table->string('desa',100);
            $table->string('majelis',100);
            $table->string('latitude',80)->nullable();
            $table->string('longitude',80)->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('road_maps');
    }
};
