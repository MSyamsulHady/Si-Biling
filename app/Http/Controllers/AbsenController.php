<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\KelasPelajaran;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function index()
    {
        $kelasPelajaran = KelasPelajaran::all();
        $absen = Absen::all();
        return view('backend.bk.absen', compact('absen', 'kelasPelajaran'));
    }

    public function kelasAbsen($id_kelas)
    {
        $absen = Absen::whereHas('kelasPelajaran', function ($query) use ($id_kelas) {
            $query->whereHas('kelas', function ($query) use ($id_kelas) {
                $query->where('id_kelas', $id_kelas);
            });
        })->get();

        return view('backend.bk.kelola_absen', compact('absen'));
    }













    // public function kelola_absen()
    // {

    //     $absens = Absen::all();
    //     // $this->validate($request, [
    //     //     'keterangan' => 'required',
    //     //     'tanggal_absen' => 'required',
    //     // ]);
    //     // try {

    //     //     $data = new Absen();
    //     //     $data->keterangan = $request->keterangan;
    //     //     $data->tanggal_absen = $request->tanggal_absen;
    //     //     $data->save();
    //     //     return redirect('dataguru')->with(['msg' => 'Data Berhasil Ditambah', 'type' => 'success']);
    //     // } catch (\Exception $e) {
    //     //     return redirect('dataguru')->with(['msg' => $e . 'Data Gagal Ditambah ', 'type' => 'error']);
    //     // }

    //     return view('backend.bk.kelola_absen', compact('absens'));
    // }
}
