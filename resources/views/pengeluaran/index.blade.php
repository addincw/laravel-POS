@extends('templates/index')

@section('css')
<link href="{{ url('style/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('style/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<style>
  .updateBayar{
    cursor: pointer;
  }
</style>
@endsection

@section('judul')
Riwayat Pengeluaran
@endsection

@section('keterangan-halaman')
Halaman ini menampilkan daftar pengeluaran yang telah tersimpan dalam aplikasi.
klik button view di baris data yang diinginkan, untuk melihat detail pengeluaran.
@endsection

@section('content')
<div class="table-toolbar">
    <div class="row">
        <div class="col-md-6">
            <div class="btn-group">
              <a href="{{ url('/pengeluaran/create') }}">
                <button id="sample_editable_1_new" class="btn sbold green"> Pengeluaran Baru
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
<table class="data-table table table-striped table-bordered table-hover table-checkable order-column">
    <thead>
      <th> Pengeluaran </th>
      <th> Tanggal pengeluaran </th>
      <th> Nominal </th>
    </thead>
    <tbody>
      @foreach($pengeluaran as $data)
      <tr>
        <td>{{$data->KETERANGAN_PENGELUARAN}}</td>
        <td>{{$data->TGL_PENGELUARAN}}</td>
        <td>Rp. {{number_format($data->JUMLAH_PENGELUARAN,0,'','.')}}</td>
      </tr>
      @endforeach
    </tbody>
</table>
@endsection
@section('script')
<script src="{{ url('style/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ url('style/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ url('style/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ url('style/pages/scripts/table-datatables-managed.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
table = $(".data-table").DataTable({
  "responsive": true,
});
</script>
@endsection
