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
        $table->string('brand');
        $table->string('model');
        $table->decimal('price_per_day', 8, 2);
        $table->string('image_url')->nullable();
        $table->boolean('is_available')->default(true);
        
        // We make all these nullable() so they are optional and won't cause crashes!
        $table->string('name')->nullable();
        $table->string('category')->nullable();
        $table->string('type')->nullable();
        $table->text('description')->nullable();
        $table->integer('discount')->default(0);
        $table->json('features')->nullable();
        $table->integer('seats')->default(4);
        $table->string('transmission')->nullable();
        $table->string('fuel_type')->nullable();
        $table->string('milrage')->nullable(); // Kept your exact spelling from the file
        
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
