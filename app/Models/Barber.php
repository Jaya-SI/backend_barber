<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    use HasFactory;

    protected $fillable = [
        'img_barber',
        'name',
        'user_id',
        'alamat',
        'kota',
        'latitude',
        'longitude',
    ];

    public function userId()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function layanan()
    {
        return $this->hasMany(Layanan::class, 'barber_id', 'id');
    }

    public function antrian()
    {
        return $this->hasOne(Antrian::class, 'barber_id', 'id');
    }

    public function getimgBarberAttribute($value)
    {
        return env('ASSET_URL') . "/" . $value;
    }
}
