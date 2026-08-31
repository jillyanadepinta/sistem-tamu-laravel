<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    protected $fillable = [
        'nama', 'no_hp', 'asal', 'jenis_kunjungan', 'keperluan',
        'foto', 'tanggal', 'jam', 'nomor_antrean', 'status', 'dilihat',
    ];
}