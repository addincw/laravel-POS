<?php
//belum!! record jurnal

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\Master\Barang;
use App\Kemasan;
use App\Pengadaan;
use App\DetailPengadaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class PengadaanController extends Controller
{
  private $pathView = 'pengadaan.';
  private $pathLink = 'pengadaan/';

  public function index(){
    $params['pathLink'] = $this->pathLink;
    return view($this->pathView.'index', $params);
  }

  public function update(Request $request){
    $id_pengadaan = $request->id_pengadaan;
    $tgl_pelunasan = $request->tgl_pelunasan;
    DB::beginTransaction();
    $pengadaan = DB::table('pengadaan')->where('ID_PENGADAAN', $id_pengadaan)->first();
    try {
      DB::table('pengadaan')->where('ID_PENGADAAN', $id_pengadaan)
      ->update([
        'TGL_PELUNASAN' => $tgl_pelunasan,
      ]);

      DB::table('jurnal')->insert([
        'ID_AKUN' => 8,
        'ID_TRANSAKSI' => $id_pengadaan,
        // 'DESKRIPSI' => 'hutang',
        'JUMLAH_PERUBAHAN' => $pengadaan->TOTAL_PENGADAAN,
        'JENIS_TRANSAKSI' => 0,
        'created_at' => $tgl_pelunasan
        // 'SALDO' =>,
      ]);

      DB::table('jurnal')->insert([
        'ID_AKUN' => 7,
        'ID_TRANSAKSI' => $id_pengadaan,
        // 'DESKRIPSI' => 'kas',
        'JUMLAH_PERUBAHAN' => $pengadaan->TOTAL_PENGADAAN,
        'JENIS_TRANSAKSI' => 1,
        'created_at' => $tgl_pelunasan
        // 'SALDO' =>,
      ]);

      DB::commit();
      \Session::flash('status-berhasil', 'pengadaan '.$id_pengadaan.' telah lunas.');
    } catch (\Exception $e) {
      DB::rollback();
      \Session::flash('status-gagal', 'tidak dapat menyimpan, terjadi kesalahan.');
    }

    return redirect()->intended('pengadaan');
  }

  public function getDataPengadaan(Request $request){
    $datatable = array();
    // dd($datatable);
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
      $orderBy = 'TGL_PENGADAAN';
      break;
      case 2:
      $orderBy = 'STATUS_PENGADAAN';
      break;
      case 3:
      $orderBy = 'STATUS_PEMBAYARAN';
      break;
      case 4:
      $orderBy = 'TOTAL_PENGADAAN';
      break;
    }


    //querynya kurang, harusnya dilihat dari pembayarannya juga
    $pengadaan = DB::table('pengadaan')
    ->leftJoin('suplier', 'suplier.ID_SUPLIER', '=', 'pengadaan.ID_SUPLIER')
    ->whereRaw("lower(NAMA_SUPLIER) LIKE lower('%$search%') or lower(ID_PENGADAAN) LIKE lower('%$search%') or lower(JENIS_SUPLY) LIKE lower('%$search%')")
    ->orderBy("$orderBy", $orderDir)
    ->get();

    $data = [];

    $summary = 0;
    foreach ($pengadaan as $datas){
      $action = "<div class='btn-group'><a href=".url('/pengadaan/nota', $datas->ID_PENGADAAN)."><button class='btn dark btn-xs btn-outline btn-circle' type='button'><i class='fa fa-share'></i> View</button></a></div>";

      if ($datas->STATUS_PENGADAAN == 0) {
        $status = '<span class="label label-sm label-warning">Tinggal Nota</span>';
      }else {
        $status = '<span class="label label-sm label-info">Langsung Bayar</span>';
      }

      if (!is_null($datas->TGL_PELUNASAN)) {
        $statusBayar = '<span class="label label-sm label-success"><i class="fa fa-check"></i> Lunas<span>';
      }else {
        $statusBayar = '<a class="updateBayar label label-sm label-danger" data-toggle="modal" href="#small" onClick="update(\''.$datas->ID_PENGADAAN.'\');">
        <i class="fa fa-close"></i> Belum Bayar
        </a>';
      }

      // $jenis_pengadaan = '<strong>'.$datas->JENIS_SUPLY.'</strong></br><span style="font-size:10px">'.$datas->ID_PENGADAAN.'</span>';
      $jenis_pengadaan = '<span style="font-size:10px">'.$datas->ID_PENGADAAN.'</span>';

      array_push($data, array(
        "PENGADAAN" => $jenis_pengadaan,
        "SUPLIER" => $datas->NAMA_SUPLIER,
        "TGL_PENGADAAN" => $datas->TGL_PENGADAAN,
        "STATUS_PENGADAAN" => $status,
        "STATUS_PELUNASAN" => $statusBayar,
        "TOTAL_PENGADAAN" => number_format($datas->TOTAL_PENGADAAN,0,'','.'),
        "ACTION" => $action,
      )
    );

    $summary = $summary + $datas->TOTAL_PENGADAAN;
  }

  // dd($pengadaan);
  $total = count($pengadaan);
  $datatable["data"] = $data;
  $datatable["recordsTotal"] = $total;
  $datatable["recordsFiltered"] = $total;
  $datatable["summary"] = number_format($summary,0,'','.');

  echo json_encode($datatable);
}

public function create(){
  $params['pathLink'] = $this->pathLink;
  $params['pathView'] = $this->pathView;
  return view($this->pathLink.'create', $params);
}

public function nota($id){
  $pengadaan = DB::table('pengadaan')
  ->leftJoin('suplier', 'suplier.ID_SUPLIER', '=', 'pengadaan.ID_SUPLIER')
  ->where('pengadaan.ID_PENGADAAN', $id)
  ->first();

  $detail_pengadaan = DB::table('detail_pengadaan')
  ->leftJoin('barang', 'barang.ID_BARANG', '=', 'detail_pengadaan.ID_BARANG')
  // ->leftJoin('kemasan', 'kemasan.ID_KEMASAN', '=', 'detail_pengadaan.ID_BARANG')
  ->where('ID_PENGADAAN', $id)
  ->get();

  return view($this->pathLink.'nota_pengadaan', compact('pengadaan', 'detail_pengadaan'));
}

public function addCart(Request $request){
  $listPengadaanBeras = app('pengadaanBeras');
  $barang = Barang::find($request->barang);
  $listPengadaanBeras->add(array(
    'id' => $barang['ID_BARANG'],
    'name' => $barang['NAMA_BARANG'],
    'price' => $request->harga_pengadaan, // harga_pengadaan/satuan
    'quantity' => $request->jumlah,
  ));
}

public function addCartKemasan(Request $request){
  $kemasan = Kemasan::find($request->kemasan);

  \Cart::add(array(
    'id' => $kemasan['ID_KEMASAN'],
    'name' => $kemasan['KETERANGAN_KEMASAN'],
    'price' => $request->harga_pengadaan, // harga_pengadaan/kg
    'quantity' => $request->jumlah,
    'attributes' => array(
      'beban_harga' => $request->beban_harga
    ),
  ));
}

public function storeJurnal($id_pengadaan, $nominal, $jenis_pengadaan, $jenis_bayar, $tgl_pengadaan){
    //kas -, persediaan + ;
    DB::table('jurnal')->insert([
      'ID_AKUN' => $jenis_bayar == 1 ? 7 : 8,
      'ID_TRANSAKSI' => $id_pengadaan,
      // 'DESKRIPSI' => 'kas / hutang',
      'JUMLAH_PERUBAHAN' => $nominal,
      'JENIS_TRANSAKSI' => 1,
      'created_at' => $tgl_pengadaan
      // 'SALDO' =>,
    ]);

    DB::table('jurnal')->insert([
      'ID_AKUN' => $jenis_pengadaan == 'beras' ? 3 : 6,
      'ID_TRANSAKSI' => $id_pengadaan,
      // 'DESKRIPSI' => 'Persedian beras/kemasan',
      'JUMLAH_PERUBAHAN' => $nominal,
      'JENIS_TRANSAKSI' => 0,
      'created_at' => $tgl_pengadaan
      // 'SALDO' =>,
    ]);
}

public function storeCart(Request $request){
  //simpan keranjang ke pengadaan, detail_pengadaan. hapus keranjang
  $listPengadaanBeras = app('pengadaanBeras');
  $cart = $listPengadaanBeras->getContent();
  if ($listPengadaanBeras->isEmpty()) {
    \Session::flash('status-gagal', 'tidak dapat menyimpan, keranjang kosong.');
    return redirect()->intended('pengadaan/create');
  }else {

    try {
      // buat id_pengadaan
      $numberInId = collect(DB::select("SELECT MAX(cast((substring(ID_PENGADAAN,12)) AS unsigned)) as ID_PENGADAAN FROM pengadaan"))->first();
      $id_pengadaan = "PG".date('dmY').'N'.($numberInId->ID_PENGADAAN+1);
      // $id_admin = Auth::User()->id;
      $id_admin = 0;

      //hitung total kilo
      // $total_kilo = 0;
      // foreach ($cart as $value) {
      //   $total_kilo = $total_kilo + $value->quantity;
      // }

      DB::beginTransaction();
      date_default_timezone_set('Asia/Jakarta');

      //insert pengadaan
      if ($request->pembayaran == 1) {
        DB::table('pengadaan')->insert([
          'ID_PENGADAAN' => $id_pengadaan,
          'ID_ADMIN' => $id_admin,
          'ID_SUPLIER' => $request->suplier,
          'TGL_PENGADAAN' => $request->tgl_pengadaan,
          'TGL_PELUNASAN' => $request->tgl_pengadaan,
          // 'JUMLAH_TOTAL' => $total_kilo, //jika beras dalam kilo, jika kemasan jumlah kemasan
          'TOTAL_PENGADAAN' => $listPengadaanBeras->getTotal(),
          'STATUS_PENGADAAN' => $request->pembayaran, //0 = tinggal nota, 1 = langsung bayar
        ]);
      }else {
        DB::table('pengadaan')->insert([
          'ID_PENGADAAN' => $id_pengadaan,
          'ID_ADMIN' => $id_admin,
          'ID_SUPLIER' => $request->suplier,
          'TGL_PENGADAAN' => $request->tgl_pengadaan,
          // 'JUMLAH_TOTAL' => $total_kilo,
          'TOTAL_PENGADAAN' => $listPengadaanBeras->getTotal(),
          'STATUS_PENGADAAN' => $request->pembayaran,
        ]);
      }

      $nominal = 0;
      $statusUpdate = array();
      foreach ($cart as $value) {
        $nominal += ($value->price*$value->quantity);
        DB::table('detail_pengadaan')->insert([
          'ID_PENGADAAN' => $id_pengadaan,
          'ID_BARANG' => $value->id,
          'JUMLAH' => $value->quantity, //kalau kemasan jumlah kemasan
          'HARGA_PENGADAAN' => $value->price, //kalau kemasan harga/kemasan
          'TOTAL_HARGA' => $value->price*$value->quantity,
          'KETERANGAN' => '',
        ]);

        $stokBarang = Barang::find($value->id);
        $stok = $stokBarang->STOK_BARANG + ($value->quantity);
        $updateStokBarang = DB::table('barang')
        ->where('ID_BARANG', $stokBarang->ID_BERAS)
        ->update([
          // 'HARGA_AGEN' => $value->attributes->harga_agen,
          // 'HARGA_ECER' => $value->attributes->harga_ecer,
          'STOK_BARANG' => $stok,
      ]);

        DB::table('stok_barang')->insert([
          'ID_BARANG' => $value->id,
          'STOK_TERKINI' => $stok,
          'PERUBAHAN_STOK' => $value->quantity,
          // 'HARGA_AGEN' => $value->attributes->harga_agen,
          // 'HARGA_ECER' => $value->attributes->harga_ecer,
          'JENIS_PERUBAHAN' => 1, //0 = berkurang, 1 = bertambah
          'TGL_PERUBAHAN' => $request->tgl_pengadaan
        ]);

      } //tutup foreach detail_pengadaan

      if (count($statusUpdate) > 0) {
        DB::rollback();
        \Session::flash('status-gagal', $statusUpdate);
        return redirect()->intended('pengadaan/create');
      }

      $this->storeJurnal($id_pengadaan, $nominal, 'barang', $request->pembayaran, $request->tgl_pengadaan);
      $listPengadaanBeras->clear();
      DB::commit();
      \Session::flash('status-berhasil', 'data berhasil tersimpan.');
      \Session::flash('link', '/pengadaan/nota/'.$id_pengadaan);
      return redirect()->route('pengadaan');
    }

    catch(\Exception $e) {
      DB::rollback();
      dd($e);
      \Session::flash('status-gagal', 'Terjadi kesalahan saat menyimpan data.');
      return redirect()->route('pengadaan');
      // ->with('status-gagal', 'Terjadi kesalahan saat menyimpan data.');
    }


  }

}

public function storeCartKemasan(Request $request){
  //simpan keranjang ke pengadaan, detail_pengadaan. hapus keranjang
  $cart = \Cart::getContent();
  if (\Cart::isEmpty()) {
    \Session::flash('status-gagal', 'tidak dapat menyimpan, keranjang kosong.');
    return redirect()->intended('pengadaan/create');
  }else {

    try {
      // buat id_pengadaan
      $numberInId = collect(DB::select("SELECT MAX(cast((substring(ID_PENGADAAN,12)) AS unsigned)) as ID_PENGADAAN FROM pengadaan"))->first();
      $id_pengadaan = "PG".date('dmY').'N'.($numberInId->ID_PENGADAAN+1);
      // $id_admin = Auth::User()->id;
      $id_admin = 0;

      //hitung total kilo
      $total_kemasan = 0;
      foreach ($cart as $value) {
        $total_kemasan = $total_kemasan + $value->quantity;
      }

      DB::beginTransaction();
      date_default_timezone_set('Asia/Jakarta');
      //insert pengadaan
      if ($request->pembayaran == 1) {
        DB::table('pengadaan')->insert([
          'ID_PENGADAAN' => $id_pengadaan,
          'ID_ADMIN' => $id_admin,
          'ID_SUPLIER' => $request->suplier,
          'TGL_PENGADAAN' => $request->tgl_pengadaan,
          'TGL_PELUNASAN' => $request->tgl_pengadaan,
          'JUMLAH_TOTAL' => $total_kemasan, //jika beras dalam kilo, jika kemasan jumlah kemasan
          'TOTAL_PENGADAAN' => \Cart::getTotal(),
          'STATUS_PENGADAAN' => $request->pembayaran, //0 = tinggal nota, 1 = langsung bayar
        ]);
      }else {
        DB::table('pengadaan')->insert([
          'ID_PENGADAAN' => $id_pengadaan,
          'ID_ADMIN' => $id_admin,
          'ID_SUPLIER' => $request->suplier,
          'TGL_PENGADAAN' => $request->tgl_pengadaan,
          'JUMLAH_TOTAL' => $total_kemasan,
          'TOTAL_PENGADAAN' => \Cart::getTotal(),
          'STATUS_PENGADAAN' => $request->pembayaran,
        ]);
      }

      $statusUpdate = array();
      $nominal = 0;
      foreach ($cart as $value) {
        $nominal += ($value->price*$value->quantity);
        DB::table('detail_pengadaan')->insert([
          'ID_PENGADAAN' => $id_pengadaan,
          'ID_BARANG' => $value->id,
          'JUMLAH' => $value->quantity, //kalau kemasan jumlah kemasan
          'HARGA_PENGADAAN' => $value->price, //kalau kemasan harga/kemasan
          'TOTAL_HARGA' => $value->price*$value->quantity,
          'KETERANGAN' => '',
        ]);

        $stokKemasan = Kemasan::find($value->id);
        // dd($value->quantity);
        $stok = $stokKemasan->STOK_KEMASAN + ($value->quantity);
        $updateStokKemasan = DB::table('kemasan')
        ->where('ID_KEMASAN', $stokKemasan->ID_KEMASAN)
        ->update([
          'BEBAN_HARGA' => $value->attributes->beban_harga,
          'STOK_KEMASAN' => $stok,
        ]);

      } //tutup foreach detail_pengadaan

      if (count($statusUpdate) > 0) {
        DB::rollback();
        \Session::flash('status-gagal', $statusUpdate);
        return redirect()->intended('pengadaan/create');
      }

      $this->storeJurnal($id_pengadaan, $nominal, 'kemasan', $request->pembayaran, $request->tgl_pengadaan);
      \Cart::clear();
      DB::commit();
      \Session::flash('status-berhasil', 'data berhasil tersimpan.');
      \Session::flash('link', '/pengadaan/nota/'.$id_pengadaan);
      return redirect()->route('pengadaan');
    }

    catch(Exception $e) {
      DB::rollback();
      \Session::flash('status-gagal', 'Terjadi kesalahan saat menyimpan data.');
      return redirect()->route('pengadaan');
      // ->with('status-gagal', 'Terjadi kesalahan saat menyimpan data.');
    }


  }

}

public function removeCart(Request $request){
  $listPengadaanBeras = app('pengadaanBeras');
  $listPengadaanBeras->remove($request->idChart);
}

public function removeCartKemasan(Request $request){
  \Cart::remove($request->idChart);
}

public function getCart(){
  $listPengadaanBeras = app('pengadaanBeras');
  $cart = $listPengadaanBeras->getContent();
  $cart = $cart->toArray();
  sort($cart);

  $total_cart = $listPengadaanBeras->getTotal();

  return view($this->pathView.'cart', compact('cart', 'total_cart'));
}

public function getCartKemasan(){
  $cart = \Cart::getContent();
  $cart = $cart->toArray();
  sort($cart);

  $total_cart = \Cart::getTotal();

  return view('pengadaan.cartKemasan', compact('cart', 'total_cart'));
}

}
