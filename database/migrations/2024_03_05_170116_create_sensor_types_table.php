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
        Schema::create('sensor_type', function (Blueprint $table) {
            $table->string('type');
            $table->primary('type');
            $table->string('unit');
        });

        Schema::table('sensor', function (Blueprint $table) {
            $table->foreign('sensor_type')->references('type')->on('sensor_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_type');
    }
};
