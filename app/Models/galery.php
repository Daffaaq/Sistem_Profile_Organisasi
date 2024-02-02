<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\category_galery;

class galery extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'created_date',
        'created_time',
        'image_path_galeries',
        'category_galeries_id',
    ];

    public function categoryGalery()
    {
        return $this->belongsTo(category_galery::class, 'category_galeries_id');
    }
}
