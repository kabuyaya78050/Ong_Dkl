<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Project;
use App\Services\LabyrintheService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Throwable;

class DonationController extends Controller
{
    /**
     * Afficher le formulaire de don.
     */
    public function create()
    {
        $projects = Project::query()
            ->where('status', 'active')
            ->latest()
            ->get();

        return view('donations.create', [
            'projects' => $projects,
        ]);
    }

    /**
     * Initialiser un paiement Mobile Money.
     */
    public function store(
        Request $request,
        LabyrintheService $labyrinthe
    ) {
        $validated = $request->validate([
            'project_id' => [
                'nullable',
                'exists:projects,id',
            ],

            'donor_name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'max:30',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:1',
            ],

            'payment_method' => [
                'required',
                'in:mpesa,airtel_money,orange_money,africell',
            ],

            'message' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        // Normalisation du numéro RDC.
        $phone = $this->normalizePhone(
            $validated['phone']
        );

        if ($phone === null) {
            return back()
                ->withErrors([
                    'phone' => 'Veuillez saisir un numéro Mobile Money congolais valide.',
                ])
                ->withInput();
        }

        // Référence unique ONG DKL.
        $reference = 'DKL-' . strtoupper(
            Str::random(12)
        );

        // Création du don en attente.
        $donation = Donation::create([
            'project_id' => $validated['project_id'] ?? null,
            'donor_name' => $validated['donor_name'],
            'email' => $validated['email'] ?? null,
            'phone' => $phone,
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
            'transaction_reference' => $reference,
            'message' => $validated['message'] ?? null,
        ]);

        try {
            $response = $labyrinthe->initiatePayment(
                phone: $phone,
                amount: $validated['amount'],
                reference: $reference,
                callback: route('donations.callback'),
            );

            // Enregistrer les références Labyrinthe.
            $donation->update([
                'order_number' => $response['orderNumber'] ?? null,
                'labyrinthe_reference' => $response['reference'] ?? null,
            ]);

        } catch (Throwable $exception) {

            // Le paiement n'a pas pu être initialisé.
            $donation->update([
                'status' => 'cancelled',
            ]);

            return back()
                ->withErrors([
                    'payment' => 'Impossible d\'initialiser le paiement. Veuillez réessayer.',
                ])
                ->withInput();
        }

        return redirect()->route(
            'donations.pending',
            $donation
        );
    }

    /**
     * Afficher la page de paiement en attente.
     */
    public function pending(Donation $donation)
    {
        return view(
            'donations.pending',
            compact('donation')
        );
    }

    /**
     * Callback reçu par Labyrinthe.
     */
    public function callback(Request $request)
    {
        $orderNumber = $request->input('orderNumber');
        $reference = $request->input('reference');

        $statusCode = $request->input(
            'results.status.code'
        );

        if (! $orderNumber && ! $reference) {
            return response()->json([
                'received' => true,
            ]);
        }

        $donation = Donation::query()
            ->where('order_number', $orderNumber)
            ->orWhere('labyrinthe_reference', $reference)
            ->first();

        if (! $donation) {
            return response()->json([
                'received' => true,
            ]);
        }

        // Paiement réussi.
        if ((string) $statusCode === '2') {

            if ($donation->status !== 'confirmed') {

                DB::transaction(function () use (
                    $donation,
                    $reference
                ) {
                    $donation->update([
                        'status' => 'confirmed',
                        'labyrinthe_reference' => $reference,
                    ]);

                    if ($donation->project_id) {
                        $donation->project()->increment(
                            'collected_amount',
                            $donation->amount
                        );
                    }
                });
            }
        }

        // Paiement échoué.
        elseif ((string) $statusCode === '3') {

            if ($donation->status === 'pending') {
                $donation->update([
                    'status' => 'cancelled',
                    'labyrinthe_reference' => $reference,
                ]);
            }
        }

        return response()->json([
            'received' => true,
        ]);
    }

    /**
     * Afficher la page de succès.
     */
    public function success(Donation $donation)
    {
        return view(
            'donations.success',
            compact('donation')
        );
    }

    /**
     * Normaliser un numéro Mobile Money RDC.
     */
    private function normalizePhone(string $phone): ?string
    {
        $phone = preg_replace(
            '/[\s\-\(\)]/',
            '',
            trim($phone)
        );

        if ($phone === null) {
            return null;
        }

        // +243812345678 → 0812345678
        if (str_starts_with($phone, '+243')) {
            $phone = '0' . substr($phone, 4);
        }

        // 243812345678 → 0812345678
        elseif (str_starts_with($phone, '243')) {
            $phone = '0' . substr($phone, 3);
        }

        if (! preg_match('/^0\d{9}$/', $phone)) {
            return null;
        }

        return $phone;
    }
}