@extends('templates/index')

@section('css')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{ url('style/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('style/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
@endsection

@section('judul')
<i class="fa fa-pencil"></i>
Edit Harga Khusus
@endsection

@section('keterangan-halaman')
Form tambah beras digunakan untuk menambah data beras.
<code>Isi form dengan lengkap.</code>
@endsection

@section('content')
<div class="form">
        <form role="form" action="{{ url('/hargaKhusus/store') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @include('hargaKhusus._form')
            <div class="form-group">
                <label>Status Berlaku</label><br>
                <div class="row">
                  <div class="col-md-6">
                    <input type="radio" name="status_berlaku" @if((isset($data)) && ($data->STATUS_BERLAKU == 1)) checked @endif value="1">Aktif
                  </div>
                  <div class="col-md-6">
                    <input type="radio" name="status_berlaku" @if((isset($data)) && ($data->STATUS_BERLAKU == 0)) checked @endif value="0">Tidak Aktif
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

@section('script')
<script src="{{ url('style/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ url('style/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
  $('.select2').select2({});
</script>
@endsection
