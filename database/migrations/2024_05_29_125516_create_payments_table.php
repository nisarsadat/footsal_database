<?php

// use App\Models\Booking;

use App\Models\Booking;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('booking_id');

            $table->foreignIdFor(\App\Models\Booking::class)->constrained()->onDelete('cascade');
            $table->unsignedBigInteger("payed");
            $table->date("date");
            $table->softDeletes();
            $table->timestamps();
            // $table->foreign('booking_id')->refer ences('id')->on('bookings')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
