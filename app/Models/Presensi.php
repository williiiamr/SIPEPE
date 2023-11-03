<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $table = 'presensi';
    protected $primaryKey = 'id';

    public function attendedOnDay($tahun, $bulan, $day, $nik) {
        return $this->whereDate('tgl_presensi', '=', "$tahun-$bulan-$day")
        ->where('nik', $nik)
        ->exists();
    }

}
