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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('price', 10, 2);
            $table->string('location');
            $table->enum('type', ['شقة', 'منزل', 'فيلا','م            DROP TABLE properties;حل']);
            $table->enum('listing_type', ['إيجار', 'بيع']);
            $table->integer('rooms');
            $table->integer('bathrooms');
            $table->integer('size');
            $table->text('description');
            $table->string('contact_phone');
            $table->json('images');
            $table->enum('status', ['متاح', 'مؤجر', 'مباع'])->default('متاح');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
