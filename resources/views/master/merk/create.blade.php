@extends('templates/index')
@section('judul-page')
Form Merk
@endsection

@section('judul')
<i class="fa fa-plus"></i>
Form Merk
@endsection
@section('small-judul')
Tambah
@endsection

@section('keterangan-halaman')
Isi form dengan lengkap.
@endsection

@section('content')
<?php $action = $pathLink.'create'; ?>
<div class="form">
  @include($pathView.'_form')
</div>
@endsection
