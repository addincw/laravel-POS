@extends('templates/index')

@section('css')
<link href="{{ url('style/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('style/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('judul-page')
Barang
@endsection

@section('judul')
Barang
@endsection

@section('keterangan-halaman')
<ul>
  <li>Halaman ini menampilkan daftar master barang yang telah tersimpan. </li>
  <li>Pastikan sebelum mengisi master barang, anda telah mengisi master satuan barang, kategori, dan merk.</li>
  <li>Data dapat diperbarui dengan mengklik button update di baris data yang diinginkan.</li>
</ul>
@endsection

@section('content')
<div class="table-toolbar">
    <div class="row">
        <div class="col-md-6">
            <div class="btn-group">
              <a href="{{ url($pathLink.'create') }}">
                <button id="sample_editable_1_new" class="btn sbold green"> Tambah Baru
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
            <th>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                    <span></span>
                </label>
            </th>
            <th> Nama Barang</th>
            <th> Kategori</th>
            <th> Merk </th>
            <th> Actions </th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $barang)
        <tr class="odd gradeX">
            <td>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="checkboxes" value="1" />
                    <span></span>
                </label>
            </td>
            <td> {{ $barang['NAMA_BARANG'] }} </td>
            <td> {{ $barang->Kategori->NAMA_KATEGORI }} </td>
            <td> {{ $barang->Merk->NAMA_MERK }} </td>
            <td>
                <div class="btn-group">
                  <a href="{{ url($pathLink.'update', encrypt($barang['ID_BARANG'])) }}">
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
