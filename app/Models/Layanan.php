<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'barber_id',
        'nama_layanan',
        'deskripsi',
        'harga'
    ];

    public function barberId()
    {
        return $this->belongsTo(Barber::class, 'barber_id', 'id');
    }

    public function antrian()
    {
        return $this->hasOne(Antrian::class, 'layanan_id', 'id');
    }
}
