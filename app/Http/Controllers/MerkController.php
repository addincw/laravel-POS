<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Master\Merk;

class MerkController extends Controller
{
    private $pathView = 'master.merk.';
    private $pathLink = 'master/merk/';

    public function index(){
      $merk = new Merk;
      $data = $merk->all();
      // dd($data);
      $params['data'] = $data;
      $params['pathLink'] = $this->pathLink;
      return view($this->pathView.'index', $params);
    }

    public function create(Request $request){
      $params['pathLink'] = $this->pathLink;
      $params['pathView'] = $this->pathView;
      $merk = new Merk;

      if ($request->isMethod('post')) {
        $nama_merk = $request['nama_merk'];
        //insert data dari form
        $merk->nama_merk = $nama_merk;
        $merk->save();

        if (isset($request['isAjax'])) {
          $result['status'] = 'success';
          $result['id'] = $merk->id_merk;
          $result['nama'] = $merk->nama_merk;
          return json_encode($result);
        }else {
          return redirect()->route('merk');
        }
      }

      return view($this->pathView.'create', $params);
    }

    public function update(Request $request, $id = NULL){
        $params['pathLink'] = $this->pathLink;
        $params['pathView'] = $this->pathView;

        $merk = new Merk;
        $id = !empty($id) ? $id : $request['id_merk'];
        // dd($id);
        $id_merk = \decrypt($id);
        // dd($id_merk);

        $data = $merk->find($id_merk);

        if ($request->isMethod('post')) {
          //insert data dari form
          $data->nama_merk = $request['nama_merk'];
          $data->save();

          return redirect()->route('merk');
        }

        $params['data'] = $data;
        // dd($params);
      return view($this->pathView.'update', $params);
    }

}
