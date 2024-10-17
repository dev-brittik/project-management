<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addon_hook extends Model
{
    use HasFactory;

    public function addon()
    {
        return $this->belongsTo(Addon::class);
    }
}