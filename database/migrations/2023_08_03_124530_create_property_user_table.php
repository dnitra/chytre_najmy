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
        Schema::create('property_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("property_id")->index();
            $table->unsignedBigInteger("user_id")->index();
            $table->unsignedBigInteger("role_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_user');
    }
};
