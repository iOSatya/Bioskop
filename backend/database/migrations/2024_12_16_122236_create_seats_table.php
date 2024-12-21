<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatsTable extends Migration
{
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();  // ID kursi
            $table->foreignId('schedule_id')->constrained('schedules')->onDelete('cascade'); // Foreign key ke tabel schedules
            $table->integer('seat_number'); // Nomor kursi
            $table->boolean('is_booked')->default(false); // Status kursi, default 'false' berarti tersedia
            $table->timestamps();  // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('seats');
    }
}
