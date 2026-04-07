<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');         // Lomba, Ujian, Upacara, Ekskul, Rapat, dll
            $table->string('color', 7);     // Kode warna hex, misal: #27AE60
            $table->string('icon')->nullable(); // Nama icon opsional
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_categories');
    }
};