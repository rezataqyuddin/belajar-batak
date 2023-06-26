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
        Schema::create('batak_chars', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->index('id');
            $table->string('char_name');
            $table->string('unicode');
            $table->string('image');
            $table->string('class');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batak_chars');
    }
};
