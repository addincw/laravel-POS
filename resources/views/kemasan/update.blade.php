@extends('templates/index')
@section('judul')
<i class="fa fa-pencil"></i>
Form Edit Kemasan
@endsection

@section('keterangan-halaman')
Form edit kemasan digunakan untuk mengedit data kemasan.
<b>Isi form dengan lengkap.</b>
@endsection

@section('content')
<div class="form">
        <form role="form" action="{{ url('/kemasan/update', $data->ID_KEMASAN) }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-body">
                <div class="form-group">
                  <label>Id Kemasan (id tidak dapat diedit)</label>
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-phone"></i>
                    </span>
                    <input type="text" class="form-control" name="id_kemasan" value="{{ $data->ID_KEMASAN }}" readonly>
                  </div>
                </div>
                <div class="form-group">
                    <label>Keterangan Kemasan</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="keterangan_kemasan" value="{{ $data->KETERANGAN_KEMASAN }}" required>
                   </div>
                </div>
                <div class="form-group">
                  <label>Kemasan untuk Beras</label>
                  <div class="input-group">
                    <span class="input-group-addon">
                      Kg
                    </span>
                    <input type="number" class="form-control" name="berat_kemasan" value="{{ $data->BERAT_KEMASAN }}">
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
