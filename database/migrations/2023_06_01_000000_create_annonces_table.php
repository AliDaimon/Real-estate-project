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

        // filepath: database/migrations/2023_06_01_000000_create_annonces_table.php
        Schema::create('annonces', function (Blueprint $table) {
            $table->bigIncrements('code'); // or $table->string('code')->unique();
            // ...other columns...
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonces');
    }
};
