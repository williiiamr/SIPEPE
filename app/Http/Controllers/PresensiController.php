<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Presensi;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Models\Pengajuanizin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

// use PDF;

// use Barryvdh\DomPDF\Facade as PDF;
// use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\Hash;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Config\Repository;

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
        // -5.401331034301522, 105.27755498418226
        $latitudekantor = -5.401331034301522; 
        $longitudekantor =  105.27755498418226;
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
                if($jam < "17:00"){
                    echo "Error|Belum Jam Pulang";
                }else{
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
        $namabulan = ['', "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $izin = new Pengajuanizin();

        $presensi = Presensi::select('presensi.nik', 'karyawan.nama')
            ->join('karyawan', 'presensi.nik', '=', 'karyawan.nik') // Join the 'karyawan' table
            ->whereYear('tgl_presensi', $tahun)
            ->whereMonth('tgl_presensi', $bulan)
            ->groupBy('presensi.nik', 'karyawan.nama')
            ->get();

        return view('presensi.cetaklaporan', compact('bulan', 'tahun', 'namabulan', 'presensi', "izin"));
    }

    public function izin()
    {
        $bulanini = date('m') * 1;
        $tahunini = date('Y');
        $nik = Auth::guard('karyawan')->user()->nik;
        $dataizin = DB::table('pengajuan_izin')
            ->where('nik',$nik)
            ->whereRaw('MONTH(tgl_izin)="' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_izin)="' . $tahunini . '"')
            ->get();
        return view('presensi.izin', compact('dataizin'));
    }

    public function buatizin()
    {
        
        return view('presensi.buatizin');
    }

    public function storeizin(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_izin = $request->tgl_izin;
        $status = $request->status;
        $keterangan = $request->keterangan;

        $data = [
            'nik' => $nik,
            'tgl_izin' => $tgl_izin,
            'status' => $status,
            'keterangan' => $keterangan,
        ];

        $simpan = DB::table('pengajuan_izin')->insert($data);

        if ($simpan) {
            return redirect('/presensi/izin')->with(['succes' => 'Data Berhasil Disimpan']);
        } else {
            return redirect('/presensi/izin')->with(['error' => 'Data Gagal Disimpan']);
        }
    }

    public function izinsakit(Request $request){
        $query = Pengajuanizin::query();
        $query->select('id','tgl_izin','pengajuan_izin.nik','nama','jabatan','status','status_approved','keterangan');
        $query->join('karyawan','pengajuan_izin.nik','=','karyawan.nik');
        if(!empty($request->dari) && !empty($request->sampai)){
            $query->whereBetween('tgl_izin',[$request->dari,$request->sampai]);
        }

        if(!empty($request->nik)){
            $query->where('pengajuan_izin.nik',$request->nik);
        }

        if(!empty($request->nama)){
            $query->where('nama','like', '%'. $request->nama .'%');
        }

        if($request->status_approved === '0' || $request->status_approved === '1' || $request->status_approved === '2'){
            $query->where('status_approved',$request->status_approved);
        }
        $query->orderBy('tgl_izin','desc');
        $izinsakit = $query->paginate(5);
        $izinsakit->appends($request->all());
        return view('presensi.izinsakit', compact('izinsakit'));
    }

    public function approveizinsakit(Request $request){
        $status_approved = $request->status_approved;
        $id_izinsakit_form = $request->id_izinsakit_form;
        $alasan = $request->alasan;
        $update = DB::table('pengajuan_izin')->where('id', $id_izinsakit_form)->update([
            'status_approved' => $status_approved,
            'alasan' => $alasan
        ]);
        if($update){
            return Redirect::back()->with(['succes' => 'Data Berhasil Di Update']);
        }else{
            return Redirect::back()->with(['succes' => 'Data Gagal Di Update']);
        }
    }

    public function batalkanizinsakit($id){
        $update = DB::table('pengajuan_izin')->where('id', $id)->update([
            'status_approved' => 0
        ]);
        if($update){
            return Redirect::back()->with(['succes' => 'Data Berhasil Di Update']);
        }else{
            return Redirect::back()->with(['succes' => 'Data Gagal Di Update']);
        }
    }

    public function cekpengajuanizin(Request $request){
        $tgl_izin = $request->tgl_izin;
        $nik = Auth::guard('karyawan')->user()->nik;

        $cek = DB::table('pengajuan_izin')->where('nik', $nik)->where('tgl_izin', $tgl_izin)->count();
        return $cek;
    }

    public function suratcuti($id, Repository $config, Filesystem $files, Factory $view)
    {
        // Ambil data Pengajuanizin berdasarkan ID
        $pengajuanizin = Pengajuanizin::find($id);
        $tgl_izin = Pengajuanizin::where('id', $id)->value('tgl_izin');
        $imagePath = public_path('assets/img/TTD PT Ressa Abadi.png');
        $imageData = base64_encode(file_get_contents($imagePath));
    
        if ($pengajuanizin) {
            $date = Carbon::parse(date('Y-m-d'))->format('j F Y');
        
            $nama = Auth::guard('karyawan')->user()->nama;
            $nik = Auth::guard('karyawan')->user()->nik;
            $jabatan = Auth::guard('karyawan')->user()->jabatan;
            $tgl_izin = Carbon::parse($tgl_izin)->format('j F Y');
        
            $data = [
                'date' => $date,
                'pengajuanizin' => $pengajuanizin,
                'nama' => $nama,
                'nik' => $nik,
                'jabatan' => $jabatan,
                'tgl_izin' => $tgl_izin,
                'imagePath' => $imagePath,
                'imageData' => $imageData
            ];
        
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('tempDir', 'assets/img/TTD PT Ressa Abadi.png');
            $dompdf = new Dompdf($options);
            $pdf = new PDF($dompdf, $config, $files, $view, 'A4', 'portrait'); // Gunakan instansi Dompdf, konfigurasi Laravel, Filesystem, dan View Factory sebagai argumen
            $pdf->loadView('presensi.suratcuti', $data);
            $pdf->render();
            return $pdf->download('suratcuti.pdf');
        } else {
            return "Izin tidak ditemukan."; // Tampilkan pesan jika izin tidak ditemukan
        }
    }

}