@extends('templates/index')

@section('css')
<link href="{{ url('style/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('style/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ url('style/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
<style>
.updateBayar{
  cursor: pointer;
}
</style>
@endsection

@section('judul-page')
Pengadaan
@endsection

@section('judul')
Pengadaan
@endsection

@section('keterangan-halaman')
<ul>
  <li>Halaman ini menampilkan daftar pengadaan yang telah tersimpan dalam aplikasi.</li>
  <li>klik button view di baris data yang diinginkan, untuk melihat detail pengadaan.</li>
</ul>
@endsection

@section('content')
<div class="table-toolbar">
  <div class="row">
    <div class="col-md-6">
      <div class="btn-group">
        <a href="{{ url($pathLink.'create') }}">
          <button id="sample_editable_1_new" class="btn sbold green"> Pengadaan Baru
            <i class="fa fa-plus"></i>
          </button>
        </a>
      </div>
    </div>
    <div class="col-md-6">
      <div class="btn-group pull-right">
        <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
          <i class="fa fa-angle-down"></i>
        </button>
        <ul class="dropdown-menu pull-right">
          <li>
            <a href="javascript:;">
              <i class="fa fa-print"></i> Print </a>
            </li>
            <li>
              <a href="javascript:;">
                <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
              </li>
              <li>
                <a href="javascript:;">
                  <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <table class="ajax-table table table-striped table-bordered table-hover table-checkable order-column">
        <thead>
          <th> Pengadaan </th>
          <th> Suplier </th>
          <th> Tanggal Pengadaan </th>
          <th> Jenis Transaksi </th>
          <th> Status </th>
          <th> Total </th>
          <th> Actions </th>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
          <th colspan="5"> Grand Total </th>
          <th class="summary" colspan="2"></th>
        </tfoot>
      </table>

      <div class="modal fade bs-modal-sm" id="small" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h4 class="modal-title">Update Pelunasan</h4>
            </div>
            <div class="modal-body">
              <form method="post">
                <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
                <input class="id_pengadaan form-control" type="hidden" name="id_pengadaan">
                <div class="form-group">
                  <label>Tanggal Pelunasan</label>
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </span>
                    <input class="date form-control" type="date" name="tgl_pelunasan">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                <button type="submit" class="btn green"><i class="fa fa-check"></i> Lunas</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      @endsection
      @section('script')
      <script src="{{ url('style/global/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
      <script src="{{ url('style/global/scripts/datatable.js') }}" type="text/javascript"></script>
      <script src="{{ url('style/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
      <script src="{{ url('style/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
      <script src="{{ url('style/pages/scripts/table-datatables-managed.min.js') }}" type="text/javascript"></script>
      <script src="{{ url('style/pages/scripts/ui-modals.min.js') }}" type="text/javascript"></script>
      <script src="{{ url('style/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
      <script type="text/javascript">
      function update(id_pengadaan){
        $(".id_pengadaan").val(id_pengadaan);
        // $("#small").toggle();
      };

      $( document ).ready(function() {
        $('.date').datepicker({
          format: 'yyyy-mm-dd',
        });


        table = $(".ajax-table").DataTable({
          "responsive": true,
          "processing": true,
          "serverSide": true,
          "ajax": {
            "url" : "{{url($pathLink.'getDataPengadaan')}}",
            "dataSrc": function( json ){
              var return_data = new Array();
              for(var i=0;i< json.data.length; i++){
                return_data.push({
                  "PENGADAAN" : json.data[i].PENGADAAN,
                  "SUPLIER" : json.data[i].SUPLIER,
                  "TGL_PENGADAAN" : json.data[i].TGL_PENGADAAN,
                  "STATUS_PENGADAAN" : json.data[i].STATUS_PENGADAAN,
                  "STATUS_PELUNASAN" : json.data[i].STATUS_PELUNASAN,
                  "TOTAL_PENGADAAN" : json.data[i].TOTAL_PENGADAAN,
                  "ACTION" : json.data[i].ACTION
                })
              }

              $('.summary').html(json.summary);
              return return_data;
            }
          },
          "columns": [
            { "responsivePriority": 1, "data": "PENGADAAN" },
            { "data": "SUPLIER" },
            { "data": "TGL_PENGADAAN" },
            { "data": "STATUS_PENGADAAN" },
            { "data": "STATUS_PELUNASAN" },
            { "responsivePriority": 1, "data": "TOTAL_PENGADAAN" },
            { "responsivePriority": 1, "data": "ACTION" }
          ],
          "order": [[1,'desc']]
        });
      });
      </script>
      @endsection
