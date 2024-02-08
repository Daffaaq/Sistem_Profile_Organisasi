<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'nickname_profiles',
        'name_profiles',
        'address_profiles',
        'phone_profiles',
        'email_profiles',
        'description_profiles',
        'logo_profiles',
        'twitter_url',
        'facebook_url',
        'instagram_url',
        'linkedin_url',
        'line_url',
        'tiktok_url',
        'youtube_url',
    ];
}
