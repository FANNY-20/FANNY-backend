<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddGeolocationsTable extends Migration
{
    public function up(): void
    {
        Schema::create('geolocations', static function (Blueprint $table) {
            $table->string('uuid')->primary();
            $table->point('location');
            $table->timestamps();

            $table->index('updated_at');
            $table->rawIndex('(location::geometry)', 'location_index')
                ->algorithm('gist');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('geolocations');
    }
}
