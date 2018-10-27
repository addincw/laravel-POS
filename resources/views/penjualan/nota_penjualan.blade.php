@extends('templates.index')
@section('css')
<link href="{{ url('style/pages/css/invoice-2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('judul')
Nota Penjualan
@endsection

@section('keterangan-halaman')
Klik button print, jika ingin mencetak nota.
@endsection

@section('content')
<div class="invoice-content-2">
  <div class="row invoice-head">
    <div class="col-md-7 col-xs-6">
      <div class="invoice-logo">
        <img src="../assets/pages/img/logos/logo5.jpg" class="img-responsive" alt="" />
        <h1 class="uppercase text-left">Nota Penjualan</h1>
      </div>
    </div>
    <div class="col-md-5 col-xs-6">
      <div class="company-address">
        <span class="bold uppercase">Point Of Sales</span>
        <br/> Point Of Sales.
        <br/> Waru, Sidoarjo.
        <br/>
        <span class="bold">T</span> 1800 123 456
        <br/>
        <span class="bold">E</span> support@keenthemes.com
        <br/>
        <span class="bold">W</span> www.keenthemes.com </div>
      </div>
    </div>
    <div class="row invoice-cust-add">
      <div class="col-xs-3">
        <h2 class="invoice-title uppercase">Konsumen</h2>
        <p class="invoice-desc">{{ $penjualan->NAMA_KONSUMEN }}</p>
      </div>
      <div class="col-xs-3">
        <h2 class="invoice-title uppercase">Tanggal Pembelian</h2>
        <p class="invoice-desc">{{ $penjualan->TGL_PEMBELIAN }}</p>
      </div>
      <div class="col-xs-3">
        <h2 class="invoice-title uppercase">Alamat</h2>
        <p class="invoice-desc inv-address">
          <span class="bold">A</span> {{ $penjualan->ALAMAT_KONSUMEN }}.
          <br>
          <span class="bold">T</span> {{ number_format($penjualan->TELPON_KONSUMEN, 0, '', ' ') }}.
        </p>
      </div>
      <div class="col-xs-3">
        <h2 class="invoice-title uppercase">Detail transaksi</h2>
        <p>
          <span class="invoice-desc">Nomor Penjualan</span> {{ $penjualan->ID_PEMBELIAN }}<br>
          <span class="invoice-desc">Nomor Pembayaran</span> {{ $penjualan->ID_PEMBAYARAN }}
        </p>
      </div>
    </div>
    <div class="row invoice-body">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th class="invoice-title uppercase">Barang</th>
              <th class="invoice-title uppercase text-center">Harga/Satuan</th>
              <th class="invoice-title uppercase text-center">Jumlah</th>
              <th class="invoice-title uppercase text-center">Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $detail_penjualan as $detail )
            <tr>
              <td>
                <h3>{{ $detail->NAMA_BARANG }}</h3>
              </td>
              <td class="text-center sbold">Rp. {{ number_format($detail->HARGA_BELI, 0, '', '.') }}</td>
              <td class="text-center sbold">{{ $detail->JUMLAH }}</td>
              <td class="text-center sbold">Rp. {{ number_format($detail->TOTAL_HARGA_BELI, 0, '', '.') }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="row invoice-subtotal">
      <div class="col-xs-3">
        <h2 class="invoice-title uppercase">Status</h2>
        <p class="invoice-desc">
          @if(is_null($penjualan->TGL_PEMBAYARAN)) Belum bayar @else Lunas @endif
          <br>
          {{ $penjualan->TGL_PEMBAYARAN }}
        </p>
      </div>
      <div class="col-xs-9">
        <h2 class="invoice-title uppercase">Total</h2>
        <p class="invoice-desc grand-total">Rp. {{ number_format($penjualan->TOTAL_PEMBELIAN, 0, '', '.') }}</p>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <a class="btn btn-lg green-haze hidden-print uppercase print-btn" onclick="javascript:window.print();">Print</a>
      </div>
    </div>
  </div>
  @endsection
