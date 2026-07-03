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
            Schema::create('vehicules', function (Blueprint $table) {
        $table->id();
        $table->string('name');                         // e.g., "Range Rover Sport"
        $table->string('category');                     // car, bike, etc.
        $table->string('type');                         // SUV, Luxury, Sport
        $table->string('image')->nullable();            // Path to vehicle photo
        $table->decimal('price', 8, 2);                 // Base price per day ($)
        $table->integer('discount')->default(0);        // Percentage off (e.g., 15)
        $table->text('description');                    
        $table->json('features')->nullable();           // Array of tags (e.g., ["GPS", "Autopilot"])
    
        // Specifications Block
        $table->integer('seats')->default(4);           
        $table->string('transmission');                 // Manual / Automatic
        $table->string('fuel_type');                    // Electric, Diesel, Petrol
        $table->string('mileage');                      // e.g., "Unlimited" or "200km/day"
        $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
};
