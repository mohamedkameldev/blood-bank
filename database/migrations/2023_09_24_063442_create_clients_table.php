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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->unique();

            $table->string('password');
            $table->string('api_token', 60)->unique()->nullable();
            $table->string('pin_code', 6)->nullable();
            $table->timestamp('email_verified_at')->nullable();

            $table->date('d_o_b');
            $table->date('last_donation_date');

            $table->foreignId('blood_type_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('city_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
