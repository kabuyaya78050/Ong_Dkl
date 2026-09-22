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
        string $callback,
        string $paymentMethod
    ): array {
        $url = config('services.labyrinthe.url');
        $token = config('services.labyrinthe.token');

        if (empty($token)) {
            throw new RuntimeException(
                'Le token Labyrinthe n’est pas configuré.'
            );
        }

        $payload = [
            'token' => $token,
            'phone' => $phone,
            'amount' => $amount,
            'currency' => 'CDF',
            'country' => 'CD',
            'reference' => $reference,
            'payment_method' => $paymentMethod,
            'callback' => $callback,
        ];

        $response = Http::timeout(30)
            ->asJson()
            ->acceptJson()
            ->post($url . '/mobile', $payload);

        logger()->info('Labyrinthe payment request sent', [
            'reference' => $reference,
            'payment_method' => $paymentMethod,
            'status' => $response->status(),
        ]);

        if ($response->failed()) {
            logger()->warning('Labyrinthe payment rejected', [
                'reference' => $reference,
                'payment_method' => $paymentMethod,
                'status' => $response->status(),
                'message' => $response->json('message') ?? 'Labyrinthe a refusé la demande.',
            ]);

            throw new RuntimeException(
                $response->json('message')
                    ?? 'Impossible d’initier le paiement Labyrinthe.'
            );
        }

        $data = $response->json();

        if (!($data['success'] ?? false)) {
            logger()->warning('Labyrinthe payment unsuccessful', [
                'reference' => $reference,
                'payment_method' => $paymentMethod,
                'status' => $response->status(),
                'message' => $data['message'] ?? 'Labyrinthe a refusé la demande.',
            ]);

            throw new RuntimeException(
                $data['message']
                    ?? 'Labyrinthe a refusé la demande de paiement.'
            );
        }

        return $data;
    }
}