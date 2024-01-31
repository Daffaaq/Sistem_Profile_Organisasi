<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_profiles',
        'address_profiles',
        'phone_profiles',
        'email_profiles',
        'description_profiles',
        'logo_profiles',
    ];
}
