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
        Schema::create('triplelap', function (Blueprint $table) {
            $table->id();
            $table->foreignId('racer_id')->constrained('racers');
            $table->string('firstlap');
            $table->string('secondlap');
            $table->string('thirdlap');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('triplelap');
    }
};
