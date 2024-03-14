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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->text('notification_settings_text');
            $table->longText('about_app');

            $table->string('phone');
            $table->string('email');
            $table->string('fb_link');
            $table->string('tw_link');
            $table->string('insta_link');
            $table->string('youtube_link');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
