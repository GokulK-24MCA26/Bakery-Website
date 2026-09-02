<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactDetail extends Model
{
    protected $fillable = [
        'address_line1',
        'address_line2',
        'phone',
        'phone_raw',
        'whatsapp_url',
        'whatsapp_display',
        'email',
        'hours_weekday',
        'hours_sunday',
        'map_embed_url',
    ];

    /**
     * Singleton helper: always return the single settings row (create if missing).
     */
    public static function singleton(): self
    {
        return static::first() ?? static::create([
            'address_line1'    => 'GMS Web Studio Bakery,',
            'address_line2'    => 'Erode, Tamil Nadu',
            'phone'            => '+91 xxxxx xxxxx',
            'phone_raw'        => '+91xxxxxxxxxx',
            'whatsapp_url'     => 'https://wa.me/91xxxxxxxxxx',
            'whatsapp_display' => 'WhatsApp Us',
            'email'            => 'hello@gmsbakery.com',
            'hours_weekday'    => 'Mon – Sat: 7:00 AM – 9:00 PM',
            'hours_sunday'     => 'Sunday: 8:00 AM – 6:00 PM',
            'map_embed_url'    => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14203.386262377153!2d77.23258995790823!3d11.517177289343676!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba920d7acaa3fc1%3A0x280672077bfe9e9b!2sSathyamangalam%2C%20Tamil%20Nadu!5e1!3m2!1sen!2sin!4v1787817664696!5m2!1sen!2sin',
        ]);
    }
}
