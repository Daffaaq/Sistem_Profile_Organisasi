<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\galery;
use App\Models\User;
use App\Models\article;

class image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'articles_id',
        'users_id',
        'galeries_id',
    ];

    public function article()
    {
        return $this->belongsTo(article::class, 'articles_id');
    }

    public function galery()
    {
        return $this->belongsTo(galery::class, 'galeries_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
