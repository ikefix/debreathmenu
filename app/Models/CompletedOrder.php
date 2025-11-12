<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompletedOrder extends Model
{
    protected $fillable = ['items', 'total_price'];

    protected $casts = [
        'items' => 'array', // Automatically cast JSON to array
    ];
}
