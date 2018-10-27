@extends('templates/index')
@section('judul')
<i class="fa fa-plus"></i>
Form tambah supplier
@endsection

@section('keterangan-halaman')
Form tambah supplier digunakan untuk menambah data supplier.
<code>Isi form dengan lengkap.</code>
@endsection

@section('content')
<div class="form">
        <form role="form" action="{{ url('/supplier/create') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-body">
              <div class="field">
                <div class="form-group">
                  <label>Nama Supplier</label>
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-user"></i>
                    </span>
                    <input type="text" class="form-control" name="nama_supplier" placeholder="Nama Supplier" required>
                  </div>
                </div>
                <div class="form-group">
                  <label>Telpon Supplier</label>
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-phone"></i>
                    </span>
                    <input type="text" class="form-control" name="telpon_supplier" placeholder="Telpon Supplier">
                  </div>
                </div>
                <div class="form-group">
                  <label>
                    Alamat Supplier
                    <i class="fa fa-map-marker"></i>
                  </label>
                  <textarea class="form-control" name="alamat_supplier" rows="3"></textarea>
                </div>
                <div class="form-group">
                  <label>
                    Keterangan
                    <i class="fa fa-comment-o"></i>
                  </label>
                  <textarea class="form-control" name="keterangan" rows="3"></textarea>
                </div>
                <div class="form-group">
                  <label>
                    Jenis Supply
                  </label>
                  <select class="form-control" name="jenis_supply">
                    <option value="beras">beras</option>
                    <option value="kemasan">kemasan</option>
                  </select>
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
