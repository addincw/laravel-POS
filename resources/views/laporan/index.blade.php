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
Jurnal Penjualan
@endsection

@section('content')
<div class="table-toolbar">
  <div class="row">
    <div class="col-md-6">
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
          <th> Tanggal Transaksi </th>
          <th> Akun </th>
          <th> Kode Transaksi </th>
          <th> Debit </th>
          <th> Kredit </th>
        </thead>
        <tbody>
          @foreach($jurnal as $data)
          <tr>
            <td>{{$data->created_at}}</td>
            <td>
              {{ $data->NAMA_AKUN }}
              <br>
              {{ $data->DESKRIPSI }}
            </td>
            <td>{{$data->ID_TRANSAKSI}}</td>
            <?php if ($data->JENIS_TRANSAKSI == 0){ ?>
              <td><?php echo number_format($data->JUMLAH_PERUBAHAN, 0, '.', ".") ?></td>
              <td></td>
            <?php } else { ?>
              <td></td>
              <td><?php echo number_format($data->JUMLAH_PERUBAHAN, 0, '.', '.') ?></td>
            <?php }?>
          </tr>
          @endforeach
        </tbody>
      </table>

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
      <script src="{{ url('style/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
      <script type="text/javascript">
        $('table').dataTable();
      </script>
      @endsection
