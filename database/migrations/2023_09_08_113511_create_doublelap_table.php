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
        Schema::create('doublelap', function (Blueprint $table) {
            $table->id();
            $table->foreignId('racer_id')->constrained('racers');
            $table->foreignId('race_id')->constrained('races');
            $table->decimal('firstlap' , 4, 2);
            $table->decimal('secondlap', 4, 2);
            $table->decimal('averagelap', 4, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doublelap');
    }
};
