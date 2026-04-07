<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rsvps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')
                  ->constrained('events')
                  ->cascadeOnDelete();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->enum('status', ['hadir', 'tidak_hadir', 'mungkin'])->default('hadir');
            $table->text('note')->nullable();
            $table->timestamps();

            $table->unique(['event_id', 'user_id']); // 1 user hanya bisa RSVP sekali per event
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rsvps');
    }
};