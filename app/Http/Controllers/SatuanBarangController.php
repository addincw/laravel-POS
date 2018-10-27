<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Master\SatuanBarang;

class SatuanBarangController extends Controller
{
    private $pathView = 'master.satuan-barang.';
    private $pathLink = 'master/satuan-barang/';

    public function index(){
      $satuan_barang = new SatuanBarang;
      $data = $satuan_barang->all();

      $params['data'] = $data;
      $params['pathLink'] = $this->pathLink;
      return view($this->pathView.'index', $params);
    }

    public function create(Request $request){
      $params['pathLink'] = $this->pathLink;
      $params['pathView'] = $this->pathView;
      $satuan_barang = new SatuanBarang;

      if ($request->isMethod('post')) {
        $nama_satuan_barang = $request['nama_satuan_barang'];
        //insert data dari form
        $satuan_barang->nama_satuan_barang = $nama_satuan_barang;
        $satuan_barang->save();

        if (isset($request['isAjax'])) {
          $result['status'] = 'success';
          $result['id'] = $satuan_barang->id_satuan_barang;
          $result['nama'] = $satuan_barang->nama_satuan_barang;
          return json_encode($result);
        }else {
          return redirect()->route('satuan-barang');
        }
      }

      return view($this->pathView.'create', $params);
    }

    public function update(Request $request, $id = NULL){
        $params['pathLink'] = $this->pathLink;
        $params['pathView'] = $this->pathView;

        $satuan_barang = new SatuanBarang;
        $id = !empty($id) ? $id : $request['id_satuan_barang'];

        $id_satuan_barang = \decrypt($id);
        // dd($id, $id_satuan_barang);

        $data = $satuan_barang->find($id_satuan_barang);

        if ($request->isMethod('post')) {
          //insert data dari form
          $data->nama_satuan_barang = $request['nama_satuan_barang'];
          $data->save();

          return redirect()->route('satuan-barang');
        }

        $params['data'] = $data;
        // dd($params);
      return view($this->pathView.'update', $params);
    }

}
