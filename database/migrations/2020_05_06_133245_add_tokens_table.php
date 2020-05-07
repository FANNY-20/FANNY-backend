<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTokensTable extends Migration
{
    public function up(): void
    {
        Schema::create('tokens', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value')->unique();
            $table->string('random_value');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tokens');
    }
}
