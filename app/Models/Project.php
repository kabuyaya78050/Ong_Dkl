<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'image',
        'goal_amount',
        'collected_amount',
        'status',
    ];

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }
}