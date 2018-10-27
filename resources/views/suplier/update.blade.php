@extends('templates/index')
@section('judul')
<i class="fa fa-pencil"></i> 
Form Edit Supplier
@endsection

@section('keterangan-halaman')
Form edit supplier digunakan untuk mengedit data supplier.
<code>Isi form dengan lengkap.</code>
@endsection

@section('content')
<div class="form">
        <form role="form" action="{{ url('/supplier/update', $data->ID_SUPPLIER) }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-body">
                <div class="form-group">
                    <label>Nama Supplier</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="nama_supplier" value="{{ $data->NAMA_SUPPLIER }}" required>
                   </div>
                </div>
                <div class="form-group">
                    <label>Telpon Supplier</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </span>
                        <input type="text" class="form-control" name="telpon_supplier" value="{{ $data->TELPON_SUPPLIER }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>
                      Alamat Supplier
                      <i class="fa fa-map-marker"></i>
                    </label>
                    <textarea class="form-control" name="alamat_supplier" rows="3">{{ $data->ALAMAT_SUPPLIER }}</textarea>
                </div>
                <div class="form-group">
                    <label>
                      Keterangan
                      <i class="fa fa-comment-o"></i>
                      (isi bila diperlukan)
                    </label>
                    <textarea class="form-control" name="keterangan" rows="3">{{ $data->KETERANGAN }}</textarea>
                </div>
                <div class="form-group">
                    <label>
                      Jenis Supply
                    </label>
                    <select class="form-control" name="jenis_supply">
                      <option value="beras" @if($data->JENIS_SUPPLY == 'beras') selected @endif>beras</option>
                      <option value="kemasan" @if($data->JENIS_SUPPLY == 'kemasan') selected @endif>kemasan</option>
                    </select>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn blue" name="submit" value="1">Submit</button>
                <button type="button" class="btn default">Cancel</button>
            </div>
        </form>
    </div>
@endsection
