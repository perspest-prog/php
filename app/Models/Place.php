<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Place extends Model
{
    use HasFactory;
    
    protected $table = 'places'; 
    protected $fillable = ['name', 'description', 'repair', 'work'];

    public function usages(): HasMany
    {
        return $this->hasMany(Usage::class, 'place_id');
    }
}
