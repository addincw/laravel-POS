<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Supplier;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index(){
      $Supplier = new Supplier;
      $data = $Supplier->all();
      return view('suplier.index', compact('data'));
    }

    public function create(Request $request){
      $Supplier = new Supplier;

      if ($request->isMethod('post')) {
        //buat id_Supplier
        $numberInId = collect(DB::select("SELECT MAX(cast((substring(ID_SUPLIER,4)) AS unsigned)) as ID_SUPLIER FROM suplier"))->first();
        $id_Supplier = "SUP".($numberInId->ID_SUPLIER+1);

        //insert data dari form
        $Supplier->id_suplier = $id_Supplier;
        $Supplier->nama_suplier = $request['nama_supplier'];
        $Supplier->alamat_suplier = $request['alamat_supplier'];
        $Supplier->telpon_suplier = $request['telpon_supplier'];
        $Supplier->keterangan = $request['keterangan'];
        $Supplier->jenis_suply = $request['jenis_supply'];
        $Supplier->save();

        if (isset($request['isAjax'])) {
          $result['status'] = 'success';
          $result['id'] = $id_Supplier;
          $result['nama'] = $request->nama_supplier;
          return json_encode($result);
        }else {
          return redirect()->route('supplier');
        }

      }

      return view('suplier.create');
    }

    public function update(Request $request, $id){
        $Supplier = new Supplier;

        if ($request->isMethod('post')) {
          //insert data dari form
          $data = $Supplier->find($id);

          $data->nama_suplier = $request['nama_supplier'];
          $data->alamat_suplier = $request['alamat_supplier'];
          $data->telpon_suplier = $request['telpon_supplier'];
          $data->keterangan = $request['keterangan'];
          $data->jenis_suply = $request['jenis_supply'];
          $data->save();

          return redirect()->route('supplier');
        }

      // $data = $Supplier->find($id);
      return view('suplier.update', compact('data'));
    }

}
