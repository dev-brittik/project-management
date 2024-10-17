<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    use HasFactory;

    public function userPreferences()
    {
        return $this->hasMany(UserAddonPreference::class, 'addon_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_addon_preference', 'addon_id', 'user_id');
    }
}