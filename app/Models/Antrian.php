<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'barber_id',
        'layanan_id',
        'no_antrian',
        'status',
        'tanggal'
    ];

    public function userId()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function barber()
    {
        return $this->belongsTo(Barber::class, 'barber_id', 'id');
    }

    public function layananId()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'id');
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'antrian_id', 'id');
    }
}
