<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns|max:255',
            'honeypot' => 'present|max:0', // Honeypot field: harus ada (present) tapi harus kosong (max:0)
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Alamat email tidak valid atau terdeteksi spam.',
            ], 422);
        }

        // Cek jika email sudah terdaftar
        $subscriber = NewsletterSubscriber::where('email', $request->email)->first();

        if ($subscriber) {
            if (!$subscriber->is_active) {
                $subscriber->update([
                    'is_active' => true,
                    'subscribed_at' => now(),
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => 'Terima kasih! Anda sudah terdaftar untuk newsletter kami.',
            ]);
        }

        NewsletterSubscriber::create([
            'email' => $request->email,
            'is_active' => true,
            'subscribed_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih! Pendaftaran newsletter berhasil.',
        ]);
    }
}
