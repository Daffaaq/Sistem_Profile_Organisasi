<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category_aspiration extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_category_aspirations',
    ];
}
