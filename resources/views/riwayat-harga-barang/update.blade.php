@extends('templates/index')
@section('judul-page')
Form Barang
@endsection

@section('judul')
<i class="fa fa-pencil"></i>
Form Barang
@endsection
@section('small-judul')
Edit
@endsection

@section('keterangan-halaman')
Isi form dengan lengkap.
@endsection

@section('content')
<?php $action = $pathLink.'update'; ?>
<div class="form">
  @include($pathView.'_form')
</div>
@endsection
