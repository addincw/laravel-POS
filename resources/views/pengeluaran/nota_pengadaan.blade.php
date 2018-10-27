@extends('templates.index')
@section('css')
<link href="{{ url('style/pages/css/invoice-2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('judul')
Nota Pengadaan
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
        <h1 class="uppercase text-left">Nota Pengadaan</h1>
      </div>
    </div>
    <div class="col-md-5 col-xs-6">
      <div class="company-address">
        <span class="bold uppercase">Grosir Beras Delanggu</span>
        <br/> Pasar Wisata Juanda, Blok Q - 11.
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
        <h2 class="invoice-title uppercase">Suplier</h2>
        <p class="invoice-desc">{{ $pengadaan->NAMA_SUPPLIER }}</p>
      </div>
      <div class="col-xs-3">
        <h2 class="invoice-title uppercase">Tanggal Pengadaan</h2>
        <p class="invoice-desc">{{ $pengadaan->TGL_PENGADAAN }}</p>
      </div>
      <div class="col-xs-3">
        <h2 class="invoice-title uppercase">Alamat</h2>
        <p class="invoice-desc inv-address">
          <span class="bold">A</span> {{ $pengadaan->ALAMAT_SUPPLIER }}.
          <br>
          <span class="bold">T</span> {{ number_format($pengadaan->TELPON_SUPPLIER, 0, '', ' ') }}.
        </p>
      </div>
      <div class="col-xs-3">
        <h2 class="invoice-title uppercase">Detail traansaksi</h2>
        <p>
          <span class="invoice-desc">Nomor Pengadaan</span> {{ $pengadaan->ID_PENGADAAN }}<br>
        </p>
      </div>
    </div>
    <div class="row invoice-body">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th class="invoice-title uppercase">Beras</th>
              <th class="invoice-title uppercase text-center">Harga Pengadaan/Kg</th>
              <th class="invoice-title uppercase text-center">Jumlah</th>
              <th class="invoice-title uppercase text-center">Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $detail_pengadaan as $detail )
            <tr>
              <td>
                <h3>{{ $detail->NAMA_BERAS }}</h3>
                <p>
                  <strong>harga ecer :  </strong>Rp. {{ number_format($detail->HARGA_ECER, 0, '', '.') }}<br>
                  <strong>harga agen :  </strong>Rp. {{ number_format($detail->HARGA_AGEN, 0, '', '.') }}
                </p>
              </td>
              <td class="text-center sbold">Rp. {{ number_format($detail->HARGA_PENGADAAN_PERKILO, 0, '', '.') }}</td>
              <td class="text-center sbold">{{ $detail->JUMLAH_KILO }} Kg</td>
              <td class="text-center sbold">Rp. {{ number_format($detail->TOTAL_HARGA, 0, '', '.') }}</td>
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
          @if( ($pengadaan->STATUS_PENGADAAN == 0) && (is_null($pengadaan->TGL_PELUNASAN)) ) Belum bayar @else Lunas @endif
          <br>
          {{ $pengadaan->TGL_PELUNASAN }}
        </p>
      </div>
      <div class="col-xs-9">
        <h2 class="invoice-title uppercase">Total</h2>
        <p class="invoice-desc grand-total">Rp. {{ number_format($pengadaan->TOTAL_HARGA_PENGADAAN, 0, '', '.') }}</p>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <a class="btn btn-lg green-haze hidden-print uppercase print-btn" onclick="javascript:window.print();">Print</a>
      </div>
    </div>
  </div>
  @endsection
