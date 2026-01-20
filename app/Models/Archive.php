<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    protected $table = 'archive'; 
    protected $fillable = [ 'name', 'description', 'master', 'wrnt', 'amount', 'is_restored' ];
}
