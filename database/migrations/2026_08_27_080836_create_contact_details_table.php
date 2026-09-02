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
        Schema::create('contact_details', function (Blueprint $table) {
            $table->id();
            $table->string('address_line1')->default('GMS Web Studio Bakery,');
            $table->string('address_line2')->default('Erode, Tamil Nadu');
            $table->string('phone')->default('+91 xxxxx xxxxx');
            $table->string('phone_raw')->default('+91xxxxxxxxxx'); // for tel: link, digits only
            $table->string('whatsapp_url')->default('https://wa.me/91xxxxxxxxxx');
            $table->string('whatsapp_display')->default('WhatsApp Us');
            $table->string('email')->nullable()->default('hello@gmsbakery.com');
            $table->string('hours_weekday')->default('Mon – Sat: 7:00 AM – 9:00 PM');
            $table->string('hours_sunday')->default('Sunday: 8:00 AM – 6:00 PM');
            $table->text('map_embed_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_details');
    }
};
