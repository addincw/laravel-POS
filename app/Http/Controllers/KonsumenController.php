<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use App\Konsumen;

class KonsumenController extends Controller
{
    public function index(){
      $konsumen = new Konsumen;
      $data = $konsumen->all();
      return view('konsumen.index', compact('data'));
    }

    public function create(Request $request){
      $konsumen = new Konsumen;

      if ($request->isMethod('post')) {
        // dd($request);
        //buat id_konsumen
        $numberInId = collect(DB::select("SELECT MAX(cast((substring(ID_KONSUMEN,5)) AS unsigned)) as ID_KONSUMEN FROM konsumen"))->first();
        $id_konsumen = "KONS".($numberInId->ID_KONSUMEN+1);

        //insert data dari form
        $konsumen->id_konsumen = $id_konsumen;
        $konsumen->nama_konsumen = $request['nama_konsumen'];
        $konsumen->alamat_konsumen = $request['alamat_konsumen']?:'-';
        $konsumen->telpon_konsumen = $request['telpon_konsumen']?:0;
        $konsumen->save();

        if (isset($request['isAjax'])) {
          $result['status'] = 'success';
          $result['id'] = $id_konsumen;
          $result['nama'] = $request->nama_konsumen;
          return json_encode($result);
        }else {
          return redirect()->route('konsumen');
        }

      }

      return view('konsumen.create');
    }

    public function update(Request $request, $id){
        $konsumen = new Konsumen;

        if ($request->isMethod('post')) {
          //insert data dari form
          $data = $konsumen->find($id);
          $data->nama_konsumen = $request['nama_konsumen'];
          $data->alamat_konsumen = $request['alamat_konsumen'];
          $data->telpon_konsumen = $request['telpon_konsumen'];
          $data->save();

          return redirect()->route('konsumen');
        }

      $data = $konsumen->find($id);
      return view('konsumen.update', compact('data'));
    }

}
