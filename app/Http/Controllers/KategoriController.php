<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Master\Kategori;

class KategoriController extends Controller
{
    private $pathView = 'master.kategori.';
    private $pathLink = 'master/kategori/';

    public function index(){
      $beras = new Kategori;
      $data = $beras->all();
      $params['data'] = $data;
      $params['pathLink'] = $this->pathLink;
      return view($this->pathView.'index', $params);
    }

    public function create(Request $request){
      $params['pathLink'] = $this->pathLink;
      $params['pathView'] = $this->pathView;
      $kategori = new Kategori;

      if ($request->isMethod('post')) {
        $nama_kategori = $request['nama_kategori'];
        //insert data dari form
        $kategori->nama_kategori = $nama_kategori;
        $kategori->save();

        if (isset($request['isAjax'])) {
          $result['status'] = 'success';
          $result['id'] = $kategori->id_kategori;
          $result['nama'] = $kategori->nama_kategori;
          return json_encode($result);
        }else {
          return redirect()->route('kategori');
        }
      }

      return view($this->pathView.'create', $params);
    }

    public function update(Request $request, $id = NULL){
        $params['pathLink'] = $this->pathLink;
        $params['pathView'] = $this->pathView;

        $kategori = new Kategori;
        $id = !empty($id) ? $id : $request['id_kategori'];
        // dd($id);
        $id_kategori = \decrypt($id);
        // dd($id_kategori);

        $data = $kategori->find($id_kategori);

        if ($request->isMethod('post')) {
          //insert data dari form
          $data->nama_kategori = $request['nama_kategori'];
          $data->save();

          return redirect()->route('kategori');
        }

        $params['data'] = $data;
        // dd($params);
      return view($this->pathView.'update', $params);
    }

}
