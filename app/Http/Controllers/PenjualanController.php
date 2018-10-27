<?php
//belum!! record jurnal

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Konsumen;
use App\Beras;
use App\Kemasan;
use App\Penjualan;
use App\DetailPenjualan;
use App\Pembayaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//use Darryldecode\Cart\Cart;
use Illuminate\Support\ServiceProvider;

class PenjualanController extends Controller
{
  // public function index(){
  //   $penjualan = DB::table('pembelian')
  //   ->leftJoin('konsumen', 'konsumen.ID_KONSUMEN', '=', 'pembelian.ID_KONSUMEN')
  //   ->get();
  //
  //   return view('penjualan.indexAlt', compact('penjualan'));
  // }

  public function index(Request $request){
    // dd($request);
    if(!empty($request->id_pembayaran) && !empty($request->tgl_pembayaran)){
      $this->update($request->id_pembayaran, $request->tgl_pembayaran, $request->jenis_bayar, $request->nominal);
      return redirect()->back();
    }

    return view('penjualan.index');
  }

  public function update($id_pembayaran, $tgl_pembayaran, $jenis_bayar, $nominal){
    $status_proses = 0; //1 = success
    DB::beginTransaction();
    $pembayaran = DB::table('pembayaran')->where('id_pembayaran', $id_pembayaran)->first();
    if ($jenis_bayar == 0) { //apabila nyicil, get id_pembelian, insert table cicilan_pembelian
      try {
        // $id_admin = Auth::User()->id;
        $id_admin = 0;

        //$sisa cicilan diambil dari tabel cicilan. where id_pembelian order by tgl cicilan first. sisa cicilan - nominal
        $cicilan_pembelian = DB::table('cicilan_pembelian')->where('id_pembelian', $pembayaran->ID_PEMBELIAN)->orderBy('ID_CICILAN', 'DESC')->first();
        // dd($cicilan_pembelian);
        if (!empty($cicilan_pembelian)) {
          $sisa_cicilan = $cicilan_pembelian->SISA_CICILAN - $nominal;
          DB::table('cicilan_pembelian')->insert([
            'ID_PEMBELIAN' => $pembayaran->ID_PEMBELIAN,
            'ID_ADMIN' => $id_admin,
            'TGL_CICILAN' => $tgl_pembayaran,
            'NOMINAL' => $nominal,
            'SISA_CICILAN' => $sisa_cicilan
          ]);

          if ($sisa_cicilan == 0) {
            DB::table('pembayaran')->where('ID_PEMBAYARAN', $id_pembayaran)
            ->update([
              'TGL_PEMBAYARAN' => $tgl_pembayaran
            ]);
            \Session::flash('status-berhasil', 'pembayaran '.$id_pembayaran.' telah lunas.');
          }else {
            \Session::flash('status-berhasil', 'pembayaran '.$id_pembayaran.' telah diupdate.');
          }

        }else {
          $sisa_cicilan = $pembayaran->TOTAL_PEMBAYARAN - $nominal;
          DB::table('cicilan_pembelian')->insert([
            'ID_PEMBELIAN' => $pembayaran->ID_PEMBELIAN,
            'ID_ADMIN' => $id_admin,
            'TGL_CICILAN' => $tgl_pembayaran,
            'NOMINAL' => $nominal,
            'SISA_CICILAN' => $sisa_cicilan
          ]);
          \Session::flash('status-berhasil', 'pembayaran '.$id_pembayaran.' telah di Update.');
        }

        $status_proses = 1;
      } catch (\Exception $e) {
          // return $e;
          \Session::flash('status-gagal', 'terjadi kesalahan saat memperbarui cicilan.');
      }

    }else {
      try {
        DB::table('pembayaran')->where('ID_PEMBAYARAN', $id_pembayaran)
        ->update([
          'TGL_PEMBAYARAN' => $tgl_pembayaran,
        ]);
        \Session::flash('status-berhasil', 'pembayaran '.$id_pembayaran.' telah lunas.');
        $status_proses = 1;
      } catch (\Exception $e) {
        \Session::flash('status-gagal', 'terjadi kesalahan saat memperbarui cicilan.');
        // return $e;
        // \Session::flash('status-gagal', 'tidak dapat menyimpan, terjadi kesalahan.');
      }
    }

    if ($status_proses == 1) {
      try {
        //kas +, piutang - ;
        DB::table('jurnal')->insert([
          'ID_AKUN' => 7,
          'ID_TRANSAKSI' => $pembayaran->ID_PEMBELIAN,
          // 'DESKRIPSI' => 'kas',
          'JUMLAH_PERUBAHAN' => $nominal,
          'JENIS_TRANSAKSI' => 0,
          // 'SALDO' =>,
        ]);

        DB::table('jurnal')->insert([
          'ID_AKUN' => 1,
          'ID_TRANSAKSI' => $pembayaran->ID_PEMBELIAN,
          // 'DESKRIPSI' => 'Piutang Penjualan',
          'JUMLAH_PERUBAHAN' => $nominal,
          'JENIS_TRANSAKSI' => 1,
          // 'SALDO' =>,
        ]);

        DB::commit();
      } catch (\Exception $e) {
        DB::rollback();
        // dd($e);
        \Session::flash('status-gagal', 'terjadi kesalahan saat memperbarui cicilan.');
      }

    }



  }

  public function getDataPenjualan(Request $request){
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

public function create(){
  return view('penjualan.create');
}

public function getSelection(Request $request){
  $data = explode("-",$request->data);
  $fetch = DB::table($data[0])->get();
  if (!empty($data[1])) {
    $where = "jenis_suply='{$data[1]}'";
    $fetch = DB::table($data[0])->whereRaw($where)->get();
  }
  $result = '<ul>';
  foreach ($fetch as $value) {
    $data[0] == 'kemasan' ? $nama = 'KETERANGAN_'.strtoupper($data[0]) : $nama = 'NAMA_'.strtoupper($data[0]);
    $id = 'ID_'.strtoupper($data[0]);
    $result .= '<li class="mt-list-item">
                    <div class="list-icon-container done">
                    </div>
                    <div class="list-item-content">
                        <h4 class="uppercase bold">
                          <a onClick="fillField(\''.$request->data.'\', \''.$value->$id.'\', \''.$value->$nama.'\');">'.$value->$nama.'</a>
                        </h4>
                        <p>'.$value->$id.'</p>
                    </div>
                </li><hr>';
    // $result = 'test';
  }

  if ($fetch->count() == 0) {
    $result .= '<li class="mt-list-item">
                    <div class="list-icon-container done">
                    </div>
                    <div class="list-item-content">
                        <h4 class="uppercase bold">
                            <a>Kosong!</a>
                        </h4>
                        <p>'.$data[0].' kosong.</p>
                    </div>
                </li>';
  }
  // dd($result);
  $result .= '</ul>';
  $result .= "<script type='text/javascript'>
  function fillField(field, id, nama){
    $('#formTambah, #basic').modal('hide');
    $('#id'+field).val(id);
    $('#'+field).val(nama);
    if (field == 'barang') {
      cekHarga(id, $('#idkonsumen').val());
    }
  }
  </script>";
  return $result;
}

public function nota($id){
  $penjualan = DB::table('pembayaran')
  ->leftJoin('pembelian', 'pembelian.ID_PEMBELIAN', '=', 'pembayaran.ID_PEMBELIAN')
  ->leftJoin('konsumen', 'konsumen.ID_KONSUMEN', '=', 'pembelian.ID_KONSUMEN')
  ->where('pembayaran.ID_PEMBELIAN', $id)
  ->first();

  $detail_penjualan = DB::table('detail_pembelian')
  // ->leftJoin('kemasan', 'kemasan.ID_KEMASAN', '=', 'detail_pembelian.ID_KEMASAN')
  ->leftJoin('barang', 'barang.ID_BARANG', '=', 'detail_pembelian.ID_BARANG')
  ->where('ID_PEMBELIAN', $id)
  ->get();

  return view('penjualan.nota_penjualan', compact('penjualan', 'detail_penjualan'));
}

public function addCart(Request $request){
  $beras = \App\Master\Barang::find($request->barang);

  $listPenjualan = app('penjualan');

  $listPenjualan->add(array(
    'id' => $beras['ID_BARANG'],
    'name' => $beras['NAMA_BARANG'],
    'price' => 10000,
    'quantity' => $request->jumlah,
    'attributes' => array(
      'id_beras' => $beras['ID_BARANG'],
      // 'id_kemasan' => $kemasan->ID_KEMASAN,
      'harga_perkilo' => $request->harga,
      // 'kemasan' => $kemasan->KETERANGAN_KEMASAN,
      // 'beban_harga' => $kemasan->BEBAN_HARGA,
      // 'berat_kemasan' => $kemasan->BERAT_KEMASAN
    ),
  ));
}

public function getTotal(){
  $listPenjualan = app('penjualan');
  $total_cart = $listPenjualan->getTotal();
  return number_format($total_cart,0,'','.');
}

public function storeCart(Request $request){
  //simpan keranjang ke penjualan, detail_penjualan. hapus keranjang
  $listPenjualan = app('penjualan');
  $cart = $listPenjualan->getContent();
  if ($listPenjualan->isEmpty()) {
    \Session::flash('status-gagal', 'tidak dapat menyimpan, keranjang kosong.');
    return redirect()->intended('penjualan/create');
  }else {

    try {
      // buat id_pembelian
      $numberInId = collect(DB::select("SELECT MAX(cast((substring(ID_PEMBELIAN,12)) AS unsigned)) as ID_PEMBELIAN FROM pembelian"))->first();
      $id_pembelian = "BL".date('dmY').'N'.($numberInId->ID_PEMBELIAN+1);
      // $id_admin = Auth::User()->id;
      $id_admin = 'test';

      //hitung total kilo
      $total_kilo = 0;
      foreach ($cart as $value) {
        $total_kilo = $total_kilo+($value->quantity*$value->attributes->berat_kemasan);
      }

      DB::beginTransaction();
      date_default_timezone_set('Asia/Jakarta');
      //insert pembelian. pembelian == penjualan
      DB::table('pembelian')->insert([
        'ID_PEMBELIAN' => $id_pembelian,
        'ID_KONSUMEN' => $request->konsumen,
        'ID_ADMIN' => $id_admin,
        'TGL_PEMBELIAN' => $request->tgl_pembelian,
        'STATUS_PEMBELIAN' => $request->pembayaran,
        'TOTAL_KILO' => $total_kilo,
        'TOTAL_PEMBELIAN' => $listPenjualan->getTotal(),
      ]);

      $statusUpdate = array();
      $hpp = 0;
      $hpp_kemasan = 0;

      foreach ($cart as $value) {
        DB::table('detail_pembelian')->insert([
          'ID_BERAS' => $value->attributes->id_beras,
          'ID_PEMBELIAN' => $id_pembelian,
          'ID_KEMASAN' => $value->attributes->id_kemasan,
          'JUMLAH_KILO' => $value->attributes->berat_kemasan*$value->quantity,
          'HARGA_BELI_PERKILO' => $value->attributes->harga_perkilo,
          'TOTAL_HARGA_BELI' => $value->price*$value->quantity,
          'KETERANGAN' => '',
        ]);

        //untuk hpp, yang dipakai harga pengadaan paling terbaru.
        $pengadaan = DB::table('detail_pengadaan')->where('ID_BARANG', $value->attributes->id_beras)->orderBy('ID_PENGADAAN', 'desc')->first();
        $hpp += $pengadaan->HARGA_PENGADAAN*$value->attributes->berat_kemasan*$value->quantity;

          $stokBeras = Beras::find($value->attributes->id_beras);
          if ($stokBeras->STOK_BERAS >= ($value->attributes->berat_kemasan*$value->quantity)) {
            try {
              $stok = $stokBeras->STOK_BERAS - ($value->attributes->berat_kemasan*$value->quantity);
              $updateStokBeras = DB::table('beras')
              ->where('ID_BERAS', $stokBeras->ID_BERAS)
              ->update(['STOK_BERAS' => $stok]);

              DB::table('stok_beras')->insert([
                'ID_BERAS' => $value->attributes->id_beras,
                'STOK_TERKINI' => $stok,
                'PERUBAHAN_STOK' => $value->attributes->berat_kemasan*$value->quantity,
                'JENIS_PERUBAHAN' => 0, //0 = berkurang, 1 = bertambah
                'TGL_PERUBAHAN' => $request->tgl_pembelian
              ]);
            } catch (\Exception $e) {
              DB::rollback();
              \Session::flash('status-gagal', 'terjadi kesalahan saat memperbarui stok.');
              return redirect()->intended('penjualan/create');
            }

          }else {
            $statusUpdate[] = 'jumlah beras '.$stokBeras->NAMA_BERAS.' yang diminta melebihi stok yang dimiliki.';
          }


          $stokKemasan = Kemasan::find($value->attributes->id_kemasan);
          if ($stokKemasan->STOK_KEMASAN > $value->quantity) {
            $kemasan = DB::table('detail_pengadaan')->where('ID_BARANG', $value->attributes->id_kemasan)->orderBy('ID_PENGADAAN', 'desc')->first();
            $hpp_kemasan += $kemasan->HARGA_PENGADAAN*$value->quantity;

            $stok = $stokKemasan->STOK_KEMASAN - $value->quantity;
            $updateStokKemasan = DB::table('kemasan')
            ->where('ID_KEMASAN', $stokKemasan->ID_KEMASAN)
            ->update(['STOK_KEMASAN' => $stok]);
          }else {
            $statusUpdate[] = 'jumlah kemasan '.$stokKemasan->KETERANGAN_KEMASAN.' yang diminta melebihi stok yang dimiliki.';
          }

        } //tutup foreach detail_pembelian

        if (count($statusUpdate) > 0) {
          DB::rollback();
          \Session::flash('status-gagal', $statusUpdate);
          return redirect()->intended('penjualan/create');
        }

        // buat id_pembayaran
        $getId = Pembayaran::max('id_pembayaran');
        $numberInId = substr($getId, 11);
        $id_pembayaran = "BR".date('dmY').'N'.($numberInId+1);

        if ($request->pembayaran == 1) {
          DB::table('pembayaran')->insert([
            'ID_PEMBAYARAN' => $id_pembayaran,
            'ID_PEMBELIAN' => $id_pembelian,
            'TGL_PEMBAYARAN' => $request->tgl_pembelian,
            'TOTAL_PEMBAYARAN' => $listPenjualan->getTotal(),
          ]);

          //kas +, pendapatan +
          DB::table('jurnal')->insert([
            'ID_AKUN' => 7,
            'ID_TRANSAKSI' => $id_pembelian,
            'created_at' => $request->tgl_pembelian,
            // 'DESKRIPSI' => 'Piutang Penjualan',
            'JUMLAH_PERUBAHAN' => $listPenjualan->getTotal(),
            'JENIS_TRANSAKSI' => 0,
            // 'SALDO' =>,
          ]);

          DB::table('jurnal')->insert([
            'ID_AKUN' => 2,
            'ID_TRANSAKSI' => $id_pembelian,
            'created_at' => $request->tgl_pembelian,
            // 'DESKRIPSI' => 'Pendapatan Penjualan',
            'JUMLAH_PERUBAHAN' => $listPenjualan->getTotal(),
            'JENIS_TRANSAKSI' => 1,
            // 'SALDO' =>,
          ]);

        }else {
          DB::table('pembayaran')->insert([
            'ID_PEMBAYARAN' => $id_pembayaran,
            'ID_PEMBELIAN' => $id_pembelian,
            'TOTAL_PEMBAYARAN' => $listPenjualan->getTotal(),
          ]);

          //piutang +, pendapatan + ; persediaan beras -, hpp -
          DB::table('jurnal')->insert([
            'ID_AKUN' => 1,
            'ID_TRANSAKSI' => $id_pembelian,
            'created_at' => $request->tgl_pembelian,
            // 'DESKRIPSI' => 'Piutang Penjualan',
            'JUMLAH_PERUBAHAN' => $listPenjualan->getTotal(),
            'JENIS_TRANSAKSI' => 0,
            // 'SALDO' =>,
          ]);

          DB::table('jurnal')->insert([
            'ID_AKUN' => 2,
            'ID_TRANSAKSI' => $id_pembelian,
            'created_at' => $request->tgl_pembelian,
            // 'DESKRIPSI' => 'Pendapatan Penjualan',
            'JUMLAH_PERUBAHAN' => $listPenjualan->getTotal(),
            'JENIS_TRANSAKSI' => 1,
            // 'SALDO' =>,
          ]);
        }

        DB::table('jurnal')->insert([
          'ID_AKUN' => 4,
          'ID_TRANSAKSI' => $id_pembelian,
          'created_at' => $request->tgl_pembelian,
          // 'DESKRIPSI' => 'Harga Pokok Penjualan',
          'JUMLAH_PERUBAHAN' => $hpp,
          'JENIS_TRANSAKSI' => 0,
          // 'SALDO' =>,
        ]);

        DB::table('jurnal')->insert([
          'ID_AKUN' => 3,
          'ID_TRANSAKSI' => $id_pembelian,
          'created_at' => $request->tgl_pembelian,
          // 'DESKRIPSI' => 'Persediaan Beras',
          'JUMLAH_PERUBAHAN' => $hpp,
          'JENIS_TRANSAKSI' => 1,
          // 'SALDO' =>,
        ]);

        //kemasan
        DB::table('jurnal')->insert([
          'ID_AKUN' => 5,
          'ID_TRANSAKSI' => $id_pembelian,
          'created_at' => $request->tgl_pembelian,
          // 'DESKRIPSI' => 'Harga Pokok Penjualan kemasan',
          'JUMLAH_PERUBAHAN' => $hpp_kemasan,
          'JENIS_TRANSAKSI' => 0,
          // 'SALDO' =>,
          ]);

        DB::table('jurnal')->insert([
        'ID_AKUN' => 6,
        'ID_TRANSAKSI' => $id_pembelian,
        'created_at' => $request->tgl_pembelian,
        // 'DESKRIPSI' => 'Persediaan Kemasan',
        'JUMLAH_PERUBAHAN' => $hpp_kemasan,
        'JENIS_TRANSAKSI' => 1,
        // 'SALDO' =>,
        ]);

        $listPenjualan->clear();
        DB::commit();
        \Session::flash('status-berhasil', 'data berhasil tersimpan.');
        \Session::flash('link', '/penjualan/nota/'.$id_pembelian);
        return redirect()->route('penjualan');
    }catch(\Exception $e) {
      DB::rollback();
      // dd($e);
      \Session::flash('status-gagal', 'Terjadi kesalahan saat menyimpan data.');
      return redirect()->route('penjualan');
    }


  }

}

public function removeCart(Request $request){
  $listPenjualan = app('penjualan');
  $listPenjualan->remove($request->idChart);
}

public function getCart(){
  $listPenjualan = app('penjualan');
  $cart = $listPenjualan->getContent();
  $cart = $cart->toArray();
  sort($cart);

  $total_cart = $listPenjualan->getTotal();

  return view('penjualan.cart', compact('cart', 'total_cart'));
}

public function cekHarga(Request $request){
  $harga_khusus = DB::table('harga_khusus')
  ->where('ID_KONSUMEN', $request->konsumen)
  ->where('ID_BERAS', $request->beras)
  ->first();

  if (empty($harga_khusus)) {
    $beras = \App\Master\Barang::find($request->beras);
    // dd($beras);
    if (empty($beras['HARGA_ECER'])) {
      return '{"harga":"'.$beras['HARGA_ECER'].'","status":"Belum pernah melakukan pengadaan"}';
    }
    return '{"harga":"'.$beras['HARGA_ECER'].'","status":"Harga ecer normal"}';
  }else {
    return '{"harga":"'.$harga_khusus->HARGA_KHUSUS.'","status":"Harga Khusus"}';
  }

}

public function cekCicilan(Request $request){
  $pembayaran = Pembayaran::find($request->id_pembayaran);
  $cicilan_pembelian = DB::table('cicilan_pembelian')
  ->where('ID_PEMBELIAN', $pembayaran->ID_PEMBELIAN)
  ->orderBy('ID_CICILAN', 'DESC')
  ->first();

  if (empty($cicilan_pembelian)) {//status = 0 berarti nyicil;
    $keterangan = 'Sisa cicilan Rp. '.number_format($pembayaran->TOTAL_PEMBAYARAN,0,'','.');
    return '{"status":1, "keterangan":"'.$keterangan.'"}';
  }else {
    $keterangan = 'Sisa cicilan Rp. '.number_format($cicilan_pembelian->SISA_CICILAN,0,'','.');
    return '{"status":0, "keterangan":"'.$keterangan.'"}';
  }

}

}
