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
        
        Schema::create('incidents', function (Blueprint $table) {
            $table->string("code")->primary();
            $table->string("name");
         
            $table->string("surface");
            $table->string("adresse");
            $table->text("description");
            $table->float("prix");
            $table->string('date_de_publication')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            // Ajouter une valeur par défaut à la colonne
           
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};
