<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category_file;

class file extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'category_files_id',
        'file_date_created',
        'file_time_created',
    ];
    public function categoryFile()
    {
        return $this->belongsTo(Category_file::class, 'category_files_id');
    }
}
