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
        Schema::create('sensor', function (Blueprint $table) {
            $table->string('serialNum');
            $table->primary('serialNum');

            $table->integer('aquariumId');
            $table->foreign('aquariumId')->references('id')->on('aquarium')->onDelete('cascade');

            $table->string('sensor_type');
            $table->string('senName');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor');
    }
};
