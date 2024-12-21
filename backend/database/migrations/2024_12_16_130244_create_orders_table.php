<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // migration file
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');
            $table->foreignId('schedule_id')->constrained()->onDelete('cascade'); // Menambahkan relasi ke schedule
            $table->json('seats');
            $table->decimal('total_price', 10, 2);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('user_email');
            $table->timestamps();
        });
    }

};
