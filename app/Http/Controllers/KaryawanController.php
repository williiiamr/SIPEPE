<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class KaryawanController extends Controller
{
    public function index(){
        $karyawan = DB::table('karyawan')->orderBy('nama')->paginate(5);
        return view('karyawan.index',compact('karyawan'));
    }

    public function store(Request $request){
        $nik = $request->nik;
        $nama = $request->nama;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_telp;
        $password = Hash::make($request->password);
        $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension(); 
        try{
            $data = [
                'nik' => $nik,
                'nama' => $nama,
                'jabatan' => $jabatan,
                'no_hp' => $no_hp,
                'password' => $password,
                'foto' => $foto
            ];
            $simpan = DB::table('karyawan')->insert($data);
            if($simpan){
                if($request->hasFile('foto')){
                    $folderPath = 'public/uploads/karyawan/';
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }
        } catch (\Exception $e){
            dd($e);
        }
    }

    public function edit(Request $request){
        $nik = $request->nik;
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        return view('karyawan.edit', compact('karyawan'));
    }

    public function update($nik, Request $request){
        $nama = $request->nama;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_telp;
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();

        if ($request->hasFile('foto')) {
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $karyawan->foto;
        }

        $data = [
            'nama' => $nama,
            'jabatan' => $jabatan,
            'no_hp' => $no_hp,
            'foto' => $foto
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $update = DB::table('karyawan')->where('nik', $nik)->update($data);

        if ($update) {
            if ($request->hasFile('foto')) {
                $folderPath = 'public/uploads/karyawan/';
                $request->file('foto')->storeAs($folderPath, $foto);
            }
            return Redirect::back()->with(['success' => 'Data berhasil diupdate']);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal diupdate']);
        }

    }

    public function delete($nik){
        $delete = DB::table('karyawan')->where('nik', $nik)->delete();
        if($delete){
            return Redirect::back();
        }else{
            dd($delete);
        }
    }

    public function setting(){
        $datagps = DB::table('info')->where('id', 1)->first();
        return view('layouts.settings', compact('datagps'));
    }

    public function updateSetting(Request $request){
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $jam_masuk = $request->jam_masuk;
        $jam_keluar = $request->jam_keluar;
        $data = [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'jam_masuk' => $jam_masuk,
            'jam_keluar' => $jam_keluar
        ];

        $update = DB::table('info')->where('id', 1)->update($data);

        return Redirect::back();
    }
}
