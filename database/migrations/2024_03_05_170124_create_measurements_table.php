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
        Schema::create('measurement', function (Blueprint $table) {
            $table->id('dataId')->autoIncrement();
            $table->float('value');
            $table->string('sensorNum');
            $table->foreign('sensorNum')->references('serialNum')->on('sensor')->onDelete('cascade');
            $table->timestamp('time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('measurement');
    }
};
