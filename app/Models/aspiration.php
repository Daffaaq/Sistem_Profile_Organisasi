<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\category_aspiration;

class aspiration extends Model
{
    use HasFactory;

    protected $fillable = [
        'tittle_aspirations',
        'description_aspirations',
        'created_date',
        'created_time',
        'status',
        'category_aspirations_id',
    ];

    public function categoryAspiration()
    {
        return $this->belongsTo(category_aspiration::class, 'category_aspirations_id');
    }
}
