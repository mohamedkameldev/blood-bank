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
        Schema::create('favourites', function (Blueprint $table) {
            $table->foreignId('client_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['client_id', 'post_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_post');
    }
};
