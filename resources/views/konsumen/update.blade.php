@extends('templates/index')
@section('judul')
<i class="fa fa-pencil"></i> 
Form Edit Konsumen
@endsection

@section('keterangan-halaman')
Form konsumen digunakan untuk menambah/mengedit data konsumen.
<code>Isi form dengan lengkap.</code>
@endsection

@section('content')
<div class="form">
        <form role="form" action="{{ url('/konsumen/update', $data->ID_KONSUMEN) }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-body">
                <div class="form-group">
                    <label>Nama Konsumen</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="nama_konsumen" value="{{ $data->NAMA_KONSUMEN }}" required>
                   </div>
                </div>
                <div class="form-group">
                    <label>Telpon Konsumen</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </span>
                        <input type="text" class="form-control" name="telpon_konsumen" value="{{ $data->TELPON_KONSUMEN }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>
                      Alamat Konsumen
                      <i class="fa fa-map-marker"></i>
                    </label>
                    <textarea class="form-control" name="alamat_konsumen" rows="3">{{ $data->ALAMAT_KONSUMEN }}</textarea>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn blue" name="submit" value="1">Submit</button>
                <button type="button" class="btn default">Cancel</button>
            </div>
        </form>
    </div>
@endsection
