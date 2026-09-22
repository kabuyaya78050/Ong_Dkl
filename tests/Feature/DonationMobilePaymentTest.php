<?php

namespace Tests\Feature;

use App\Models\Donation;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class DonationMobilePaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_afrimoney_is_accepted_by_mobile_payment_form(): void
    {
        Http::fake([
            'https://api.labyrinthe-rdc.com/api/V1/payment/*' => Http::response([
                'success' => true,
                'reference' => 'LAB-REF-123',
                'orderNumber' => 'ORDER-123',
            ]),
        ]);

        Project::create([
            'title' => 'Projet test',
            'slug' => 'projet-test',
            'short_description' => 'Description',
            'goal_amount' => 100000,
            'status' => 'active',
        ]);

        $response = $this->post(route('donations.store'), [
            'project_id' => 1,
            'donor_name' => 'Jean Dupont',
            'email' => 'jean@example.com',
            'phone' => '0812345678',
            'amount' => 5000,
            'payment_method' => 'afrimoney',
            'message' => 'Merci pour votre action',
        ]);

        Http::assertSent(function ($request) {
            $payload = $request->data();

            return $payload['payment_method'] === 'afrimoney'
                && $payload['phone'] === '0812345678'
                && $payload['amount'] === 5000;
        });

        $response->assertRedirect(route('donations.pending', ['donation' => 1]));
    }

    public function test_labyrinthe_callback_is_allowed_without_csrf_token(): void
    {
        Donation::create([
            'project_id' => null,
            'donor_name' => 'Jean Dupont',
            'email' => 'jean@example.com',
            'phone' => '0812345678',
            'amount' => 5000,
            'payment_method' => 'orange_money',
            'status' => 'pending',
            'transaction_reference' => 'DKL-ABC123',
            'order_number' => 'ORDER-123',
            'message' => 'Merci',
        ]);

        $response = $this->post(route('donations.callback'), [
            'orderNumber' => 'ORDER-123',
            'results' => [
                'status' => [
                    'code' => '2',
                ],
            ],
        ]);

        $response->assertOk();
    }
}
