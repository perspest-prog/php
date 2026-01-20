<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Thing extends Model
{
    use HasFactory;

    protected $table = 'things';    
    protected $fillable = ['name', 'description', 'wrnt', 'amount', 'master_id'];
    protected $casts = ['description' => 'array'];

    public function master(): BelongsTo
    {
        return $this->belongsTo(User::class, 'master_id');
    }

    public function usage(): HasOne
    {
        return $this->hasOne(Usage::class);
    }
}