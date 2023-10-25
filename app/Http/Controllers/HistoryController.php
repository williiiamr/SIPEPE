<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function history(){
        $namabulan = ['', "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "October", "November", "December"];
        $nik = Auth::guard('karyawan')->user()->nik;
        
        $histori = DB::table('presensi')
            ->where('nik', $nik)
            ->orderBy('tgl_presensi')
            ->get();
        return view('presensi.history', compact('histori', 'namabulan'));
    }

    public function gethistori(Request $request){
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $nik = Auth::guard('karyawan')->user()->nik;

        $history = DB::table('presensi')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->where('nik', $nik)
            ->orderBy('tgl_presensi')
            ->get();

        return view('presensi.gethistory', compact('history'));
    }   
}
