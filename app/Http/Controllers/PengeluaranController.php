<?php
//belum!! record jurnal

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengeluaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class PengeluaranController extends Controller
{
  public function index(){
    $pengeluaran = Pengeluaran::all();
    return view('pengeluaran.index', compact('pengeluaran'));
  }

  public function getDataPengeluaran(Request $request){
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
        $orderBy = 'NAMA_SUPPLIER';
        break;
        case 1:
        $orderBy = 'TGL_pengeluaran';
        break;
        case 2:
        $orderBy = 'STATUS_pengeluaran';
        break;
        case 3:
        $orderBy = 'STATUS_PEMBAYARAN';
        break;
        case 4:
        $orderBy = 'TOTAL_HARGA_pengeluaran';
        break;
      }


      //querynya kurang, harusnya dilihat dari pembayarannya juga
      $pengeluaran = DB::table('pengeluaran')
      ->leftJoin('suplier', 'suplier.ID_SUPPLIER', '=', 'pengeluaran_beras.ID_SUPLIER')
      ->whereRaw("lower(NAMA_SUPPLIER) LIKE lower('%$search%') or lower(ID_PENGELUARAN) LIKE lower('%$search%') or lower(JENIS_SUPPLY) LIKE lower('%$search%')")
      ->orderBy("$orderBy", $orderDir)
      ->get();

      $data = [];

      $summary = 0;
      foreach ($pengeluaran as $datas){
        $action = "<div class='btn-group'>
        <a href=".url('/pengeluaran/nota', $datas->ID_pengeluaran).">
        <button class='btn dark btn-xs btn-outline btn-circle' type='button'>
        <i class='fa fa-share'></i> View
        </button>
        </a>
        </div>";

        if ($datas->STATUS_pengeluaran == 0) {
          $status = '<span class="label label-sm label-warning">Tinggal Nota</span>';
        }else {
          $status = '<span class="label label-sm label-info">Langsung Bayar</span>';
        }

        if (!is_null($datas->TGL_PELUNASAN)) {
          $statusBayar = '<span class="label label-sm label-success"><i class="fa fa-check"></i> Lunas<span>';
        }else {
          $statusBayar = '<span class="updateBayar label label-sm label-danger" data-id="'.$datas->ID_pengeluaran.'">
          <i class="fa fa-close"></i> Belum Bayar
          </span>';
        }

        $pengeluaran = '<strong>'.$datas->JENIS_SUPPLY.'</strong></br><span style="font-size:10px">'.$datas->ID_pengeluaran.'</span>';

        array_push($data, array(
          "pengeluaran" => $pengeluaran,
          "SUPLIER" => $datas->NAMA_SUPPLIER,
          "TGL_pengeluaran" => $datas->TGL_pengeluaran,
          "STATUS_pengeluaran" => $status,
          "STATUS_PELUNASAN" => $statusBayar,
          "TOTAL_pengeluaran" => number_format($datas->TOTAL_HARGA_pengeluaran,0,'','.'),
          "ACTION" => $action,
        )
      );

      $summary = $summary + $datas->TOTAL_HARGA_pengeluaran;
    }

    $total = count($pengeluaran);

    $datatable["data"] = $data;
    $datatable["recordsTotal"] = $total;
    $datatable["recordsFiltered"] = $total;
    $datatable["summary"] = number_format($summary,0,'','.');

    echo json_encode($datatable);
  }

  public function create(){
    return view('pengeluaran.create');
  }

  public function store(Request $request){
    try {
      // buat id_pengeluaran
      $numberInId = collect(DB::select("SELECT MAX(cast((substring(ID_PENGELUARAN,12)) AS unsigned)) as ID_PENGELUARAN FROM pengeluaran"))->first();
      $id_pengeluaran = "PL".date('dmY').'N'.($numberInId->ID_PENGELUARAN+1);
      // $id_admin = Auth::User()->id;
      $id_admin = 0;

      DB::table('pengeluaran')->insert([
        'ID_PENGELUARAN' => $id_pengeluaran,
        'ID_ADMIN' => $id_admin,
        'TGL_PENGELUARAN' => $request->tgl_pengeluaran,
        'JUMLAH_PENGELUARAN' => $request->jumlah_pengeluaran,
        'KETERANGAN_PENGELUARAN' => $request->keterangan
      ]);

      //beban +, kas -
      DB::table('jurnal')->insert([
        'ID_AKUN' => 9,
        'ID_TRANSAKSI' => $id_pengeluaran,
        'created_at' => $request->tgl_pengeluaran,
        'DESKRIPSI' => $request->keterangan,
        'JUMLAH_PERUBAHAN' => $request->jumlah_pengeluaran,
        'JENIS_TRANSAKSI' => 0,
        // 'SALDO' =>,
      ]);

      DB::table('jurnal')->insert([
        'ID_AKUN' => 7,
        'ID_TRANSAKSI' => $id_pengeluaran,
        'created_at' => $request->tgl_pengeluaran,
        'DESKRIPSI' => $request->keterangan,
        'JUMLAH_PERUBAHAN' => $request->jumlah_pengeluaran,
        'JENIS_TRANSAKSI' => 1,
        // 'SALDO' =>,
      ]);
    } catch (Exception $e) {
      \Session::flash('status-gagal', 'gagal menyimpan data pengeluaran, isi lengkap form.');
      return redirect()->intended('pengeluaran/create');
    }

    \Session::flash('status-berhasil', 'data berhasil tersimpan.');
    // \Session::flash('link', '/pengeluaran/nota/'.$id_pengeluaran);
    return redirect()->route('pengeluaran');
  }

  public function nota($id){
    $pengeluaran = DB::table('pengeluaran_beras')
    ->leftJoin('suplier', 'suplier.ID_SUPPLIER', '=', 'pengeluaran_beras.ID_SUPLIER')
    ->where('pengeluaran_beras.ID_pengeluaran', $id)
    ->first();

    $detail_pengeluaran = DB::table('detail_pengeluaran')
    ->leftJoin('beras', 'beras.ID_BERAS', '=', 'detail_pengeluaran.ID_BERAS')
    ->where('ID_pengeluaran', $id)
    ->get();

    return view('pengeluaran.nota_pengeluaran', compact('pengeluaran', 'detail_pengeluaran'));
  }

}
