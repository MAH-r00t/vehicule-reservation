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
        
            Schema::create('reservations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('vehicule_id')->constrained()->onDelete('cascade');
                $table->date('start_date');                     // startDate
                $table->date('end_date');                       // endDate
    
    // Extras Checklist
                $table->boolean('insurance')->default(false);   // extras.insurance
                $table->boolean('gps')->default(false);         // extras.gps
                $table->boolean('child_seat')->default(false);   // extras.childSeat
    
                $table->decimal('total_price', 10, 2);          // Calculated value stored securely
                $table->string('status')->default('pending');   // pending, confirmed, cancelled
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
