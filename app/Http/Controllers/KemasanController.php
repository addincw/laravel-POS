<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Kemasan;

class KemasanController extends Controller
{
    public function index(){
      $kemasan = new Kemasan;
      $data = $kemasan->all();
      return view('kemasan.index', compact('data'));
    }

    public function create(Request $request){
      $kemasan = new Kemasan;

      if ($request->isMethod('post')) {
        //insert data dari form
        $kemasan->id_kemasan = $request['id_kemasan'];
        $kemasan->keterangan_kemasan = $request['keterangan_kemasan'];
        $kemasan->berat_kemasan = $request['berat_kemasan'];
        //$kemasan->stok_kemasan = $request['stok_kemasan'];
        $kemasan->save();

        if (isset($request['isAjax'])) {
          $result['status'] = 'success';
          $result['id'] = $request->id_kemasan;
          $result['nama'] = $request->keterangan_kemasan;
          return json_encode($result);
        }else {
          return redirect()->route('kemasan');
        }
      }

      return view('kemasan.create');
    }

    public function update(Request $request, $id){
        $kemasan = new Kemasan;

        if ($request->isMethod('post')) {
          //insert data dari form
          $data = $kemasan->find($id);
          //$data->id_kemasan = $request['id_kemasan'];
          $data->keterangan_kemasan = $request['keterangan_kemasan'];
          $data->berat_kemasan = $request['berat_kemasan'];
          //$data->stok_kemasan = $request['stok_kemasan'];
          $data->save();

          return redirect()->route('kemasan');
        }

      $data = $kemasan->find($id);
      return view('kemasan.update', compact('data'));
    }

}
