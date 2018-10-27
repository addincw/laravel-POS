@extends('templates/index')
@section('judul')
<i class="fa fa-plus"></i>
Form Tambah Konsumen
@endsection

@section('keterangan-halaman')
Form tambah konsumen digunakan untuk menambah data konsumen.
<code>Isi form dengan lengkap.</code>
@endsection

@section('content')
<div class="form">
        <form role="form" action="{{ url('/konsumen/create') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="field">
            <div class="form-body">
              <div class="form-group">
                <label>Nama Konsumen</label>
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </span>
                  <input type="text" class="form-control" name="nama_konsumen" placeholder="Nama Konsumen" required>
                </div>
              </div>
              <div class="form-group">
                <label>Telpon Konsumen</label>
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </span>
                  <input type="text" class="form-control" name="telpon_konsumen" placeholder="Telpon Konsumen">
                </div>
              </div>
              <div class="form-group">
                <label>
                  Alamat Konsumen
                  <i class="fa fa-map-marker"></i>
                </label>
                <textarea class="form-control" name="alamat_konsumen" rows="3"></textarea>
              </div>
          </div>
          </div>
            <div class="form-actions">
                <button type="submit" class="btn blue" name="submit" value="1">Submit</button>
                <button type="button" class="btn default">Cancel</button>
            </div>
        </form>
    </div>
@endsection
