@extends('templates/index')

@section('css')
<link href="{{ url('style/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('style/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
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
                <button id="sample_editable_1_new" class="btn sbold green"> Add New
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
<table class="data-table table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
    <thead>
        <tr>
            <th>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                    <span></span>
                </label>
            </th>
            <th> Nomor Penjualan </th>
            <th> Konsumen </th>
            <th> Tanggal Penjualan </th>
            <th> Status </th>
            <th> Total </th>
            <th> Actions </th>
        </tr>
    </thead>
    <tbody>
      @php
        $total = 0;
      @endphp
      @foreach($penjualan as $data)
      <tr class="odd gradeX">
          <td>
              <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                  <input type="checkbox" class="checkboxes" value="1" />
                  <span></span>
              </label>
          </td>
          <td> {{ $data->ID_PEMBELIAN }} </td>
          <td> {{ $data->NAMA_KONSUMEN }} </td>
          <td> {{ $data->TGL_PEMBELIAN }} </td>
          <td>
            @if($data->STATUS_PEMBELIAN == 0)
              <span class="label label-sm label-danger">Belum Lunas</span>
            @else
              <span class="label label-sm label-success">Lunas</span>
            @endif
          </td>
          <td> Rp. {{ number_format($data->TOTAL_PEMBELIAN,0,'','.') }} </td>
          @php
          $total += $data->TOTAL_PEMBELIAN;
          @endphp
          <td>
              <div class="btn-group">
                <a href="{{ url('/penjualan/nota', $data->ID_PEMBELIAN) }}">
                  <button class="btn dark btn-xs btn-outline btn-circle" type="button">
                    <i class="fa fa-share"></i> View
                  </button>
                </a>
              </div>
          </td>
      </tr>
      @endforeach
    </tbody>
    <!-- <tr>
      <td colspan="5"><b>Grand Total</b></td>
      <td colspan="2"><b>Rp. {{ number_format($total,0,'','.') }}</b></td>
    </tr> -->
</table>
@endsection
@section('script')
<script src="{{ url('style/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ url('style/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ url('style/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ url('style/pages/scripts/table-datatables-managed.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
  $('.data-table').dataTable({
    "responsive":true,
  });
</script>
@endsection
