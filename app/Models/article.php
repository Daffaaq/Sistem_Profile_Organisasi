<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\category_article;

class article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'Descriptions',
        'created_date',
        'created_time',
        'category_articles_id',
    ];

    public function categoryArticle()
    {
        return $this->belongsTo(category_article::class, 'category_articles_id');
    }

}
