<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Master\Barang;

class RiwayatHargaBarangController extends Controller
{
    private $pathView = 'riwayat-harga-barang.';
    private $pathLink = 'setting-harga-barang/';
    public function index(){
      $barang = new Barang;
      $data = $barang->get();

      $params['data'] = $data;
      $params['pathLink'] = $this->pathLink;
      return view($this->pathView.'index', $params);
    }

    public function create(Request $request){
      $params['pathLink'] = $this->pathLink;
      $params['pathView'] = $this->pathView;
      $barang = new Barang;
      $params['satuan_barang'] = \App\Master\SatuanBarang::get();
      $params['merk_barang'] = \App\Master\Merk::get();
      $params['kategori_barang'] = \App\Master\Kategori::get();

      if ($request->isMethod('post')) {
        //insert data dari form
        $barang->id_barang = $request['id_barang'];
        $barang->nama_barang = $request['nama_barang'];
        $barang->id_kategori = $request['kategori_barang'];
        $barang->id_merk = $request['merk_barang'];
        $barang->id_satuan_barang = $request['satuan_barang'];
        $barang->save();

        if (isset($request['isAjax'])) {
          $result['status'] = 'success';
          $result['id'] = $request->id_barang;
          $result['nama'] = $request->nama_barang;
          return json_encode($result);
        }else {
          return redirect()->route('barang');
        }
      }

      return view($this->pathView.'create', $params);
    }

    public function update(Request $request, $id = NULL){
        $params['pathLink'] = $this->pathLink;
        $params['pathView'] = $this->pathView;
        $params['satuan_barang'] = \App\Master\SatuanBarang::get();
        $params['merk_barang'] = \App\Master\Merk::get();
        $params['kategori_barang'] = \App\Master\Kategori::get();

        $barang = new Barang;
        $id = !empty($id) ? $id : $request['id_barang'];
        $id_barang = \decrypt($id);
        $data = $barang->find($id_barang);

        if ($request->isMethod('post')) {
          //insert data dari form
          $data->nama_barang = $request['nama_barang'];
          $data->id_kategori = $request['kategori_barang'];
          $data->id_merk = $request['merk_barang'];
          $data->id_satuan_barang = $request['satuan_barang'];
          $data->save();

          return redirect()->route('barang');
        }

        $params['data'] = $data;
      return view($this->pathView.'update', $params);
    }

}
