<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMeetsTable extends Migration
{
    public function up(): void
    {
        Schema::create('meets', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('geolocation_from');
            $table->string('geolocation_to');
            $table->timestamps();

            $table->unique(['geolocation_from', 'geolocation_to']);

            $table->foreign('geolocation_from')
                ->references('uuid')
                ->on('geolocations')
                ->onDelete('cascade');

            $table->foreign('geolocation_to')
                ->references('uuid')
                ->on('geolocations')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meets');
    }
}
