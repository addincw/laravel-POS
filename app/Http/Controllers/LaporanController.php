<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(){
      $jurnal = DB::table('jurnal')
      ->leftJoin('akun', 'akun.id_akun', '=', 'jurnal.id_akun')
      ->orderBy('id_jurnal', 'asc')
      ->get();

      // return view('laporan.index', compact('jurnal'));
      return view('laporan.general');
    }

    public function getDataLaporan(Request $request){
      $datatable = array();
      $datatable["draw"]=$request['draw'];
      $datatable["length"]=$request['length'];
      $datatable["start"]=$request['start'];

      $start=$datatable["start"];
      $length=$datatable["length"];
      $search=$request['search.value'];

      $orderColumn=$request['order.0.column'];
      $orderDir=$request['order.dir'];
      switch ($orderColumn) {

        case 0:
        $orderBy = 'NAMA_KONSUMEN';
        break;
        case 1:
        $orderBy = 'TGL_PEMBELIAN';
        break;
        case 2:
        $orderBy = 'STATUS_PEMBELIAN';
        break;
        case 3:
        $orderBy = 'STATUS_PEMBAYARAN';
        break;
        case 4:
        $orderBy = 'TOTAL_PEMBELIAN';
        break;
      }

      //querynya kurang, harusnya dilihat dari pembayarannya juga
      $penjualan = DB::table('pembelian')
      ->leftJoin('konsumen', 'konsumen.ID_KONSUMEN', '=', 'pembelian.ID_KONSUMEN')
      ->leftJoin('pembayaran', 'pembayaran.ID_PEMBELIAN', '=', 'pembelian.ID_PEMBELIAN')
      ->select('pembayaran.*', 'konsumen.*', 'pembelian.*', 'pembelian.ID_PEMBELIAN as idBeli')
      ->whereRaw("lower(NAMA_KONSUMEN) LIKE lower('%$search%')")
      ->orderBy("$orderBy", $orderDir)
      ->get();

      $data = [];

      $summary = 0;
      foreach ($penjualan as $datas){
        $action = "<div class='btn-group'>
                    <a target='_blank' href=".url('/penjualan/nota', $datas->idBeli).">
                      <button class='btn dark btn-xs btn-outline btn-circle' type='button'>
                        <i class='fa fa-share'></i> View
                      </button>
                    </a>
                  </div>";

        if ($datas->STATUS_PEMBELIAN == 0) {
          $status = '<span class="label label-sm label-warning">Tinggal Nota</span>';
        }else {
          $status = '<span class="label label-sm label-info">Langsung Bayar</span>';
        }

        if (!is_null($datas->TGL_PEMBAYARAN)) {
          $statusBayar = '<span class="label label-sm label-success"><i class="fa fa-check"></i> Lunas<span>';
        }else {
          $statusBayar = '<a class="updateBayar label label-sm label-danger" data-toggle="modal" href="#small" onClick="detail(\''.$datas->ID_PEMBAYARAN.'\');">
          <i class="fa fa-close"></i> Belum Lunas
          </a>';
        }

        $konsumen = '<strong>'.$datas->NAMA_KONSUMEN.'</strong></br><span style="font-size:10px">'.$datas->idBeli.'</span>';

        array_push($data, array(
          "KONSUMEN" => $konsumen,
          "TGL_PEMBELIAN" => $datas->TGL_PEMBELIAN,
          "STATUS_PEMBELIAN" => $status,
          "STATUS_PEMBAYARAN" => $statusBayar,
          "TOTAL_PEMBELIAN" => number_format($datas->TOTAL_PEMBELIAN,0,'','.'),
          "ACTION" => $action,
          )
        );

        $summary = $summary + $datas->TOTAL_PEMBELIAN;
      }

      $total = count($penjualan);
      $datatable["data"] = $data;
      $datatable["recordsTotal"] = $total;
      $datatable["recordsFiltered"] = $total;
      $datatable["summary"] = number_format($summary,0,'','.');

      echo json_encode($datatable);
  }



}
