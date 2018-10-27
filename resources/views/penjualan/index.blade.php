@extends('templates/index')

@section('css')
<link href="{{ url('style/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('style/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ url('style/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('style/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('style/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<style>
.updateBayar{
  cursor: pointer;
}
</style>
@endsection

@section('judul')
Riwayat Penjualan
@endsection

@section('keterangan-halaman')
Halaman ini menampilkan daftar penjualan yang telah tersimpan dalam aplikasi.
klik button view di baris data yang diinginkan, untuk melihat detail penjualan.
@endsection

@section('content')
<div class="table-toolbar">
  <div class="row">
    <div class="col-md-6">
      <div class="btn-group">
        <a href="{{ url('/penjualan/create') }}">
          <button id="sample_editable_1_new" class="btn sbold green"> Penjualan Baru
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
      <table role="grid" class="ajax-table table table-striped table-bordered table-hover table-checkable order-column">
        <thead>
          <tr role="row" class="heading">
            <th> Konsumen </th>
            <th> Tanggal Penjualan </th>
            <th> Jenis Transaksi </th>
            <th> Status </th>
            <th> Total </th>
            <th> Actions </th>
          </tr>
          <tr role="row" class="filter">
            <td colspan="1" rowspan="1" style="padding:10px">
              <input class="form-control form-filter input-sm" type="text" name="konsumen">
            </td>
            <td colspan="1" rowspan="1">
              <div class="input-group date date-picker margin-bottom-5">
                <input type="text" class="form-control form-filter input-sm" readonly placeholder="dari" name="tgl_awal" value="">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-sm default">
                    <i class="fa fa-calendar"></i>
                  </button>
                </span>
              </div>
              <div class="input-group date date-picker margin-bottom-5">
                <input type="text" class="form-control form-filter input-sm" readonly placeholder="sampai" name="tgl_akhir" value="">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-sm default">
                    <i class="fa fa-calendar"></i>
                  </button>
                </span>
              </div>
            </td>
            <td colspan="1" rowspan="1">
              <select class="form-control form-filter input-sm" name="jenis_bayar" data-placeholder="Pilih..">
                <option value=""></option>
                <option value="0">Tinggal Nota</option>
                <option value="1">Langsung Bayar</option>
              </select>
            </td>
            <td colspan="1" rowspan="1">
              <select class="form-control form-filter input-sm" name="status_bayar" data-placeholder="Pilih..">
                <option value=""></option>
                <option value="0">Lunas</option>
                <option value="1">Belum Lunas</option>
              </select>
            </td>
            <td colspan="1" rowspan="1">
              <div class="input-group date date-picker margin-bottom-5">
                <input type="text" class="form-control form-filter input-sm" readonly placeholder="dari" name="total_awal" value="">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-sm default">
                    <i class="fa fa-money"></i>
                  </button>
                </span>
              </div>
              <div class="input-group date date-picker margin-bottom-5">
                <input type="text" class="form-control form-filter input-sm" readonly placeholder="sampai" name="total_akhir" value="">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-sm default">
                    <i class="fa fa-money"></i>
                  </button>
                </span>
              </div>
            </td>
            <td rowspan="1" colspan="1">
              <div class="margin-bottom-5">
                <button class="btn btn-sm btn-success filter-submit margin-bottom">
                  <i class="fa fa-search"></i> Search</button>
                </div>
                <button class="btn btn-sm btn-default filter-cancel">
                  <i class="fa fa-times"></i> Reset</button>
            </td>
          </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
          <th colspan="4"> Grand Total </th>
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
              <form action="{{ url('/penjualan') }}" method="post">
                <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
                <input class="id_pembayaran form-control" type="hidden" name="id_pembayaran">

                <div class="alert alert-danger">
                  <div class="sisa_cicilan"> </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Tanggal Bayar</label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </span>
                        <input class="date form-control" type="text" name="tgl_pembayaran">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Jenis Bayar</label>
                      <select class="jenis_bayar  form-control" name="jenis_bayar" data-placeholder="pilih jenis bayar" style="width:100%">
                        <option value=""></option>
                        <option value="0">Cicilan</option>
                        <option value="1">Langsung Lunas</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="nominal" style="display:none">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Nominal</label>
                        <div class="input-group">
                          <span class="input-group-addon">
                            Rp.
                          </span>
                          <input class="form-control" type="number" name="nominal">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                <button type="submit" class="btn green"><i class="fa fa-check"></i> Simpan</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      @endsection
      @section('script')
      <script src="{{ url('style/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
      <script src="{{ url('style/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>
      <script src="{{ url('style/global/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
      <script src="{{ url('style/global/scripts/datatable.js') }}" type="text/javascript"></script>
      <script src="{{ url('style/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
      <script src="{{ url('style/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
      <script src="{{ url('style/pages/scripts/table-datatables-managed.min.js') }}" type="text/javascript"></script>
      <script src="{{ url('style/pages/scripts/ui-modals.min.js') }}" type="text/javascript"></script>
      <script src="{{ url('style/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
      <script type="text/javascript">
      function detail(id_pembayaran){
        $(".id_pembayaran").val(id_pembayaran);
        $.get("{{ url('/penjualan/cekcicilan') }}", {id_pembayaran:id_pembayaran}, function(data,status,xhr){
          var detail_cicilan = JSON.parse(data);
          $(".sisa_cicilan").text(detail_cicilan.keterangan);
          if(detail_cicilan.status == 0){
            $("option[value='1']").attr('disabled', true);
          }
          // alert(data);
        });
      };

      $( document ).ready(function() {

        $('select').select2();

        $('.date').datepicker({
          format: 'yyyy-mm-dd',
        });

        $('.jenis_bayar').change(function(){
          var value = $(this).val();
          if (value == 0) {
            $(".nominal").show(1000);
          }else {
            $(".nominal").hide(1000);
          }
        });

        table = $(".ajax-table").DataTable({
          "responsive":true,
          "processing": true,
          "serverSide": true,
          "ajax": {
            "url" : "{{url('/penjualan/getDataPenjualan')}}",
            "data": function ( d ) {
              d.konsumen = $('input[name="konsumen"]').val();
              d.tgl_awal = $('input[name="tgl_awal"]').val();
              d.tgl_akhir = $('input[name="tgl_akhir"]').val();
              d.jenis_bayar = $('input[name="jenis_bayar"]').val();
              d.status_bayar = $('input[name="status_bayar"]').val();
              d.total_awal = $('input[name="total_awal"]').val();
              d.total_akhir = $('input[name="total_akhir"]').val();
            },
            "dataSrc": function( json ){
              var return_data = new Array();
              for(var i=0;i< json.data.length; i++){
                return_data.push({
                  "KONSUMEN" : json.data[i].KONSUMEN,
                  "TGL_PEMBELIAN" : json.data[i].TGL_PEMBELIAN,
                  "STATUS_PEMBELIAN" : json.data[i].STATUS_PEMBELIAN,
                  "STATUS_PEMBAYARAN" : json.data[i].STATUS_PEMBAYARAN,
                  "TOTAL_PEMBELIAN" : json.data[i].TOTAL_PEMBELIAN,
                  "ACTION" : json.data[i].ACTION
                })
              }

              $('.summary').html(json.summary);
              return return_data;
            }
          },
          "columns": [
            { "responsivePriority": 1, "data": "KONSUMEN" },
            { "data": "TGL_PEMBELIAN" },
            { "data": "STATUS_PEMBELIAN" },
            { "data": "STATUS_PEMBAYARAN" },
            { "responsivePriority": 1, "data": "TOTAL_PEMBELIAN" },
            { "responsivePriority": 1, "data": "ACTION" }
          ],
          "order": [[1,'desc']],
          "ordering":false
        });

        $(".filter-submit").on("click", function(){
          // alert($('input[name="konsumen"]').val());
          table.ajax.reload(null, false);
        });
      });
      </script>
      @endsection
