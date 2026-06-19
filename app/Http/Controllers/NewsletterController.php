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
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Alamat email tidak valid.',
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
