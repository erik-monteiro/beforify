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
        Schema::create('patients_photos', function(Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('photo_before');
            $table->string('photo_after');
            $table->date('data_photo_before');
            $table->date('data_photo_after');
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients_photos');
    }
};
