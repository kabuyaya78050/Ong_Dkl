<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class LabyrintheService
{
    /**
     * Initialise un paiement Mobile Money.
     */
    public function initiatePayment(
        string $phone,
        float|int $amount,
        string $reference,
        string $callback
    ): array {
        $url = config('services.labyrinthe.url');
        $token = config('services.labyrinthe.token');

        if (empty($token)) {
            throw new RuntimeException(
                'Le token Labyrinthe n’est pas configuré.'
            );
        }

        $response = Http::timeout(30)
            ->asJson()
            ->acceptJson()
            ->post($url . '/mobile', [
                'token' => $token,
                'phone' => $phone,
                'amount' => $amount,
                'currency' => 'CDF',
                'country' => 'CD',
                'reference' => $reference,
                'callback' => $callback,
            ]);

        if ($response->failed()) {
            throw new RuntimeException(
                $response->json('message')
                    ?? 'Impossible d’initier le paiement Labyrinthe.'
            );
        }

        $data = $response->json();

        if (!($data['success'] ?? false)) {
            throw new RuntimeException(
                $data['message']
                    ?? 'Labyrinthe a refusé la demande de paiement.'
            );
        }

        return $data;
    }
}