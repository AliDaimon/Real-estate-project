<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Incident;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         
        // ...existing code...
        Schema::create('rdvs', function (Blueprint $table) {
            $table->id();
            $table->string('incident_id'); // Must match 'code' type in 'incidents'
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        
            $table->foreign('incident_id')->references('code')->on('incidents');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rdvs');
    }
};
