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
        'message',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}