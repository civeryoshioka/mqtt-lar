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
        Schema::create('sensor_pju', function (Blueprint $table) {
            $table->id();
            $table->float('voltage');
            $table->integer('lamp_state');
            $table->integer('counter');
            $table->integer('frequency');
            $table->float('power_factor');
            $table->dateTime('datetime');
            $table->float('brightness');
            $table->float('current');
            $table->float('energy');
            $table->integer('error_state');
            $table->integer('node_id');
            $table->float('power');
            $table->float('temperature');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_pju');
    }
};
