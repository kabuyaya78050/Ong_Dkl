<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    protected $fillable = [
        'project_id',
        'donor_name',
        'email',
        'phone',
        'amount',
        'payment_method',
        'status',
        'transaction_reference',
        'order_number',
        'labyrinthe_reference',
        'message',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    /**
     * Projet associé au don.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}