<?php

use App\Models\Owner;
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
        Schema::create('owner_pickups', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Owner::class)->constrained()->onDelete('cascade');
            $table->unsignedInteger("amount");
            $table->string("note");
            $table->date("date");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owner_pickups');
    }
};
