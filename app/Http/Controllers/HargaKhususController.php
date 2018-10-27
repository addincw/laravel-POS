<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class HargaKhususController extends Controller
{
    public function index(){
      $hargaKhusus = DB::table('harga_khusus')
      ->join('konsumen', 'konsumen.ID_KONSUMEN', '=', 'harga_khusus.ID_KONSUMEN')
      ->join('beras', 'beras.ID_BERAS', '=', 'harga_khusus.ID_BERAS')
      ->get();
      return view('hargaKhusus.index', compact('hargaKhusus'));
    }

    public function create(Request $request){
      $konsumen = DB::table('konsumen')->get();
      $beras = DB::table('beras')->get();

      return view('hargaKhusus.create', compact('beras', 'konsumen'));
    }

    public function store(Request $request){
      try {
        $cek = DB::table('harga_khusus')->where([
          'ID_KONSUMEN' => $request->id_konsumen,
          'ID_BERAS' => $request->id_beras,
        ])->first();

        // $id_admin = Auth::User()->id;
        $id_admin = 0;
        date_default_timezone_set('Asia/Jakarta');

        if(empty($cek)){
          //insert harga_khusus
          DB::table('harga_khusus')->insert([
            'ID_KONSUMEN' => $request->id_konsumen,
            'ID_BERAS' => $request->id_beras,
            'ID_ADMIN' => $id_admin,
            'TGL_BERLAKU' => date('Y-m-d H:i:s'),
            'HARGA_KHUSUS' => $request->harga_khusus,
            'STATUS_BERLAKU' => 1, //1 = aktif, 0 = tidak aktif
          ]);
        }else {
          DB::table('harga_khusus')->where([
            'ID_KONSUMEN' => $request->id_konsumen,
            'ID_BERAS' => $request->id_beras,
          ])->update([
            'ID_KONSUMEN' => $request->id_konsumen,
            'ID_BERAS' => $request->id_beras,
            'HARGA_KHUSUS' => $request->harga_khusus,
            'STATUS_BERLAKU' => $request->status_berlaku, //1 = aktif, 0 = tidak aktif
          ]);
        }

      } catch (\Exception $e) {
        return $e;
        \Session::flash('status-gagal', 'tidak dapat menyimpan, keranjang kosong.');
        return redirect()->intended('hargaKhusus/create');
      }

      \Session::flash('status-berhasil', 'data telah tersimpan.');
      return redirect()->intended('hargaKhusus');
    }

    public function update(Request $request){
      $konsumen = DB::table('konsumen')->get();
      $beras = DB::table('beras')->get();
      $data = DB::table('harga_khusus')
      ->where('ID_KONSUMEN', $request->id_konsumen)
      ->where('ID_BERAS', $request->id_beras)
      ->first();

      return view('hargaKhusus.update', compact('data', 'beras', 'konsumen'));
    }

}
