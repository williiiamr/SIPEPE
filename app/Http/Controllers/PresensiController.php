<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class PresensiController extends Controller
{
    public function create(){
        $hariini = date('Y-m-d');
        $nik = Auth::guard('karyawan')->user()->nik;
        $data = DB::table('presensi')->where('tgl_presensi', $hariini)->where('nik', $nik)->count();
        return view('presensi.presensi', compact('data'));
    }

    public function store(Request $request){
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_presensi = date('Y-m-d');
        $jam = date("H:i:s");
        $lokasi = $request->lokasi;
        // -6.223910949538835, 106.64876614782546
        //-6.224833003263079, 106.6498009576709
        // -6.397327086594367, 106.83687347311667
        //-6.397319890760971, 106.83686828415709
        // -5.401364963226844, 105.27754596278925
        $latitudekantor = -5.401364963226844; 
        $longitudekantor = 105.27754596278925;
        $location = explode(',', $lokasi);
        $latitude = $location[0];
        $longitude = $location[1];

        $jarak = $this->distance($latitudekantor, $longitudekantor, $latitude, $longitude);
        $radius = round($jarak['meters']);

        $cek = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->count();

        if($cek > 0){
            $ket = 'out';
        }else{
            $ket = 'in';
        }
        $image = $request->image;   
        $folderPath = 'public/uploads/absensi/' . $nik . '/';
        $formatName = $nik . "-" . $tgl_presensi . '-' . $ket;
        $image_parts = explode(';base64', $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;
        
        if($radius > 20){
            echo "Radius_Error|Anda Berada di Luar Radius";
        }else{
            if ($cek > 0){
                $data_pulang = [
                    'jam_out' => $jam,
                    'foto_out' => $fileName,
                    'location' => $lokasi 
                ];
                $update = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->update($data_pulang);
                if($update){
                    echo "Success|Sucess, Selamat Pulang";
                    Storage::put($file, $image_base64);
                }else{
                    echo "Error|Gagal absen";
                }
            }else{
            $data = [
                'nik' => $nik,
                'tgl_presensi' => $tgl_presensi,
                'jam_in' => $jam,
                'foto_in' => $fileName,
                'location' => $lokasi 
            ];
            $simpan = DB::table('presensi')->insert($data);
            if($simpan){
                echo "Success|Sucess, Selamat Masuk";
                Storage::put($file, $image_base64);
            }else{
                echo "Error|Gagal absen";
            }
        }
        }
    }

    function distance($lat1, $lon1, $lat2, $lon2){
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }

    public function editprofile(){
        $nik = Auth::guard('karyawan')->user()->nik;
        $datauser = DB::table('karyawan')->where('nik', $nik)->first();
        return view('presensi.editprofile', compact('datauser'));
    }

    public function updateprofile(Request $request){
        $nik = Auth::guard('karyawan')->user()->nik;
        $nama_lengkap = $request->nama_lengkap;
        $no_hp = $request->no_hp;
        $password = Hash::make($request->password);
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        if ($request->hasFile('foto')){
            $foto = $nik     . "." . $request->file('foto')->getClientOriginalExtension(); 
        }else{
            $foto = $karyawan->foto;
        }
        if (!empty($request->password)){
            $data = [
                'nama' => $nama_lengkap,
                'no_hp' => $no_hp,
                'password' => $password,
                'foto' => $foto
            ];
        } else {
            $data = [
                'nama' => $nama_lengkap,
                'no_hp' => $no_hp,
                'foto' => $foto
            ];
        }
        $update = DB::table('karyawan')->where('nik', $nik)->update($data);

        if($update){
            if($request->hasFile('foto')){
                $folderPath = 'public/uploads/karyawan/';
                $request->file('foto')->storeAs($folderPath, $foto);
            }
            return Redirect::back()->with(['success'=>'Data berhasil diupdate']);
        }else{
            return Redirect::back()->with(['error'=>'Data gagal diupdate']);
        }
    }

    public function monitoring(){
        return view('presensi.monitoring');
    }

    public function getpresensi(Request $request){
        $tanggal = $request->tanggal;
        $presensi = DB::table('presensi')
        ->select('presensi.*', 'nama', 'jabatan', 'no_hp')
        ->join('karyawan', 'presensi.nik', '=', 'karyawan.nik')
        ->where('tgl_presensi', $tanggal)
        ->get();

        return view('presensi.getpresensi', compact('presensi'));
    }

    public function laporan(){
        $namabulan = ['', "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "October", "November", "December"];
        $get_karyawan = DB::table('karyawan')
        ->select('karyawan.nik', 'karyawan.nama')
        ->get();

        return view('presensi.laporan', compact('namabulan', 'get_karyawan'));
    }

    public function cetak(Request $request){
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namabulan = ['', "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "October", "November", "December"];
        $presensi = DB::table('presensi')
        ->selectRaw('presensi.nik, nama,
        MAX(IF(DAY(tgl_presensi)=1, jam_in, "")) as tgl_1,
        MAX(IF(DAY(tgl_presensi)=2, jam_in, "")) as tgl_2,
        MAX(IF(DAY(tgl_presensi)=3, jam_in, "")) as tgl_3,
        MAX(IF(DAY(tgl_presensi)=4, jam_in, "")) as tgl_4,
        MAX(IF(DAY(tgl_presensi)=5, jam_in, "")) as tgl_5,
        MAX(IF(DAY(tgl_presensi)=6, jam_in, "")) as tgl_6,
        MAX(IF(DAY(tgl_presensi)=7, jam_in, "")) as tgl_7,
        MAX(IF(DAY(tgl_presensi)=8, jam_in, "")) as tgl_8,
        MAX(IF(DAY(tgl_presensi)=9, jam_in, "")) as tgl_9,
        MAX(IF(DAY(tgl_presensi)=10, jam_in, "")) as tgl_10,
        MAX(IF(DAY(tgl_presensi)=11, jam_in, "")) as tgl_11,
        MAX(IF(DAY(tgl_presensi)=12, jam_in, "")) as tgl_12,
        MAX(IF(DAY(tgl_presensi)=13, jam_in, "")) as tgl_13,
        MAX(IF(DAY(tgl_presensi)=14, jam_in, "")) as tgl_14,
        MAX(IF(DAY(tgl_presensi)=15, jam_in, "")) as tgl_15,
        MAX(IF(DAY(tgl_presensi)=16, jam_in, "")) as tgl_16,
        MAX(IF(DAY(tgl_presensi)=17, jam_in, "")) as tgl_17,
        MAX(IF(DAY(tgl_presensi)=18, jam_in, "")) as tgl_18,
        MAX(IF(DAY(tgl_presensi)=19, jam_in, "")) as tgl_19,
        MAX(IF(DAY(tgl_presensi)=20, jam_in, "")) as tgl_20,
        MAX(IF(DAY(tgl_presensi)=21, jam_in, "")) as tgl_21,
        MAX(IF(DAY(tgl_presensi)=22, jam_in, "")) as tgl_22,
        MAX(IF(DAY(tgl_presensi)=23, jam_in, "")) as tgl_23,
        MAX(IF(DAY(tgl_presensi)=24, jam_in, "")) as tgl_24,
        MAX(IF(DAY(tgl_presensi)=25, jam_in, "")) as tgl_25,
        MAX(IF(DAY(tgl_presensi)=26, jam_in, "")) as tgl_26,
        MAX(IF(DAY(tgl_presensi)=27, jam_in, "")) as tgl_27,
        MAX(IF(DAY(tgl_presensi)=28, jam_in, "")) as tgl_28,
        MAX(IF(DAY(tgl_presensi)=29, jam_in, "")) as tgl_29,
        MAX(IF(DAY(tgl_presensi)=30, jam_in, "")) as tgl_30,
        MAX(IF(DAY(tgl_presensi)=31, jam_in, "")) as tgl_31')
        ->join('karyawan', 'presensi.nik', '=', 'karyawan.nik')
        ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
        ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
        ->groupByRaw('presensi.nik, nama')
        ->get();

        return view('presensi.cetaklaporan', compact('bulan', 'tahun', 'namabulan', 'presensi'));
    }

}
