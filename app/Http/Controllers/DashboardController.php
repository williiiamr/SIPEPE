<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $hari = date("Y-m-d");
        $bulanini = date('m') * 1;
        $tahunini = date('Y');
        $nik = Auth::guard('karyawan')->user()->nik;
        $presensihariini = DB::table('presensi')->where('nik', $nik)->where('tgl_presensi',$hari)->first();
        $cek = DB::table('presensi')
            ->where('nik', $nik)
            ->where('tgl_presensi', $hari)
            ->whereNotNull('jam_out')
            ->first();

        $rekap = DB::table('presensi')
            ->selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_in > "09:00",1,0)) as jmlterlambat')
            ->where('nik', $nik)
            ->whereRaw('MONTH(tgl_presensi)="' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahunini . '"')
            ->first();

        $rekapizin = DB::table('pengajuan_izin')
        ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin, SUM(IF(status="s",1,0)) as jmlsakit')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_izin)="' . $bulanini . '"')
        ->whereRaw('YEAR(tgl_izin)="' . $tahunini . '"')
        ->where('status_approved', 1)
        ->first();
        return view('dashboard.dashboard', compact('presensihariini', 'bulanini', 'tahunini', 'rekap', 'rekapizin', 'cek'));
    }

    public function admindashboard(){
        $hariini = date("Y-m-d");
        $rekap = DB::table('presensi')
            ->selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_in > "09:00",1,0)) as jmlterlambat')
            ->where('tgl_presensi', $hariini)
            ->first();
            
        $karyawan = DB::table('karyawan')
            ->selectRaw('COUNT(nik) as jmlkaryawan')
            ->first();

        return view('dashboard.dashboardAdmin', compact('rekap', 'karyawan'));
    }
}
