@extends('templates.index')

@section('css')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{ url('style/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('style/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('style/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
@endsection

@section('judul')
Form Pengeluaran
@endsection

@section('keterangan-halaman')
Halaman ini digunakan untuk menyimpan data pengeluaran. isi form dengan lengkap
agar penyimpanan data berjalan dengan lancar.<br>
<b>isi form dengan lengkap > klik Simpan (data pengeluaran akan disimpan).</b>
@endsection

@section('content')
<b>Form</b>

<div class="form">
  <form id="form-konten" action="{{ url('/pengeluaran/store') }}" method="post">
    <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Tanggal Pembayaran</label>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </span>
              <input required type="date" class="date-picker form-control" name="tgl_pengeluaran" placeholder="tanggal pengeluaran" data-provide="datepicker">
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Keterangan</label>
            <input required type="text" class="form-control" name="keterangan" placeholder="Keterangan Pengeluaran">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Jumlah Pengeluaran</label>
            <div class="input-group">
              <span class="input-group-addon">
                <!-- <i class="fa fa-user"></i> -->
                Rp.
              </span>
              <input required type="number" class="form-control" name="jumlah_pengeluaran" placeholder="Jumlah Pengeluaran">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="form-actions">
      <button type="submit" class="btn blue" name="simpan" value="1">Simpan <i class="icon-arrow-right"></i></button>
      <button type="button" class="btn default">Cancel</button>
    </div>
  </form>
  @endsection

  @section('script')
  <script src="{{ url('style/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
  <script src="{{ url('style/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>
  <script src="{{ url('style/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
  <!-- <script src="{{ url('style/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script> -->
  <script type="text/javascript">
  $(function(){
    $('.date-picker').datepicker({
          format: 'yyyy-mm-dd',
    });
    $(".select2").select2({
      placeholder : "pilih salah satu"
    });
  });
  </script>
  @endsection
