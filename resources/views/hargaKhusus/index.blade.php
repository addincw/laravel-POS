@extends('templates/index')

@section('css')
<link href="{{ url('style/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('style/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('judul')
Daftar Harga Khusus
@endsection

@section('keterangan-halaman')
Halaman ini menampilkan daftar beras yang telah tersimpan dalam aplikasi.
Data dapat diperbarui dengan mengklik button update di baris data yang diinginkan.
@endsection

@section('content')
<div class="table-toolbar">
  <div class="row">
    <div class="col-md-6">
      <div class="btn-group">
        <a href="{{ url('/hargaKhusus/create') }}">
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
      <table class="data-table table table-striped table-bordered table-hover table-checkable order-column">
        <thead>
          <tr>
            <th> Konsumen</th>
            <th> Beras </th>
            <th> Harga Khusus </th>
            <th> Status Berlaku </th>
            <th> Actions </th>
          </tr>
        </thead>
        <tbody>
          @foreach($hargaKhusus as $data)
          <tr class="odd gradeX">
            <td> {{ $data->NAMA_KONSUMEN }} </td>
            <td> {{ $data->NAMA_BERAS }} </td>
            <td> Rp. {{ number_format($data->HARGA_KHUSUS,0,',','.') }} </td>
            <td> @if($data->STATUS_BERLAKU == 0) Tidak Aktif @else Aktif @endif </td>
            <td>
              <div class="btn-group">
                <a href="{{ url('/hargaKhusus/update?').'id_konsumen='.$data->ID_KONSUMEN.'&id_beras='.$data->ID_BERAS }}">
                  <button class="btn btn-xs green" type="button"> edit
                    <i class="fa fa-pencil"></i>
                  </button>
                </a>
              </div>
            </td>
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
      $('.data-table').DataTable({
        "responsive":true,
      });
      </script>
      @endsection
