@extends('templates/index')
@section('judul')
<i class="fa fa-plus"></i>
Form Tambah Kemasan
@endsection

@section('keterangan-halaman')
Form Tambah Kemasan digunakan untuk menambah data kemasan.
<b>Isi form dengan lengkap.</b>
@endsection

@section('content')
<div class="form">
        <form role="form" action="{{ url('/kemasan/create') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="field">
            <div class="form-body">
              <div class="form-group">
                <label>Id Kemasan (id harus unik dan tidak boleh sama dengan id kemasan yang lain)</label>
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </span>
                  <input type="text" class="form-control" name="id_kemasan" placeholder="Id Kemasan">
                </div>
              </div>
              <div class="form-group">
                <label>Keterangan Kemasan</label>
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </span>
                  <input type="text" class="form-control" name="keterangan_kemasan" placeholder="Keterangan Kemasan" required>
                </div>
              </div>
              <div class="form-group">
                <label>Kemasan Untuk Beras</label>
                <div class="input-group">
                  <span class="input-group-addon">
                    Kg
                  </span>
                  <input type="number" class="form-control" name="berat_kemasan" placeholder="Berat Kemasan">
                </div>
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
