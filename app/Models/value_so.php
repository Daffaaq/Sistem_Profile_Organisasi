<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\jabatan_so;

class value_so extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_value_so',
        'jabatan_so_id',
    ];
    // Relasi dengan JabatanSo
    public function jabatanSo()
    {
        return $this->belongsTo(jabatan_so::class, 'jabatan_so_id');
    }
}
