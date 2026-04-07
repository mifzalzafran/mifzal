<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('category_id')
                  ->constrained('event_categories')
                  ->cascadeOnDelete();
            $table->foreignId('room_id')
                  ->nullable()
                  ->constrained('rooms')
                  ->nullOnDelete();
            $table->foreignId('requested_by')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->foreignId('approved_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->enum('status', [
                'draft',
                'pending',
                'approved_guru',
                'approved',
                'rejected',
                'selesai'
            ])->default('draft');
            $table->text('rejection_reason')->nullable();
            $table->string('target_audience')->nullable(); // kelas/jurusan yang dituju
            $table->text('report_notes')->nullable();      // laporan setelah selesai
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};