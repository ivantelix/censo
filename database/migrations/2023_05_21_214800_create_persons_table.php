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
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname')->nullable();
            $table->string('dni')->unique();
            $table->string('phone')->nullable();
            $table->date('birthdate')->
            $table->string('email')->unique();
            $table->string('relationship');
            $table->boolean('reside_community');
            $table->integer('leader_family_id')->nullable();
            $table->foreignId('building_id')->constrained('buildings');
            $table->foreignId('apartment_id')->constrained('apartments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};
