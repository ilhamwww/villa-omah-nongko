<?php

namespace App\Helpers;

class WhatsAppHelper
{
    /**
     * Build a WhatsApp click-to-chat URL using site settings.
     */
    public static function link(?string $message = null): string
    {
        $number = preg_replace('/\D+/', '', config('villa.identity.whatsapp_number', ''));
        $text = $message ?? config('villa.identity.whatsapp_default_message', '');

        return 'https://wa.me/' . $number . '?text=' . rawurlencode($text);
    }
}