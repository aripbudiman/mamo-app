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
        Schema::create('monitoring', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->date('tanggal');
            $table->enum('ditemui',['bisa','tidak bisa']);
            $table->string('pola_bayar');
            $table->string('majelis');
            $table->string('anggota');
            $table->text('kondisi');
            $table->text('hasil')->nullable();
            $table->decimal('nominal',15,0)->default(0);
            $table->text('dokumentasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring');
    }
};
