@extends('templates.index')

@section('css')
<link href="{{ url('style/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('style/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('style/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('judul-page')
Form Pengadaan
@endsection

@section('judul')
Form Pengadaan
@endsection

@section('keterangan-halaman')
<ul>
  <li> Halaman ini digunakan untuk menyimpan data pengadaan. isi form dengan lengkap agar penyimpanan data berjalan dengan lancar. </li>
  <li>isi form dengan lengkap > klik tambah ke keranjang > detail barang di tampilkan di keranjang > klik proses
    (data pengadaan akan disimpan).</li>
</ul>
@endsection

@section('header')
  <div class="portlet-title tabbable-line">
    <div class="caption">
      <i class="icon-bubbles font-dark hide"></i>
      <span class="caption-subject font-dark bold uppercase">Form</span>
    </div>
  </div>
@endsection

@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="form">
      <form id="form-konten" action="{{ url($pathLink.'storeCart') }}" method="post">
        <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="jenis_pengadaan" value="0"> <!-- 0 berarti beras -->
        <div class="form-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Tanggal Pengadaan</label>
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </span>
                  <input required type="text" class="date-picker form-control" name="tgl_pengadaan" placeholder="tanggal pengadaan" data-provide="datepicker">
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Pilih Suplier</label>
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </span>
                  <input id="idsuplier-beras" class="form-control pilihan" type="hidden" name="suplier" data-toggle="modal" data-target="#basic" required>
                  <input id="suplier-beras" class="form-control pilihan" type="text" name="nama_suplier" data-toggle="modal" data-target="#basic" required>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Jenis Pembayaran</label>
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-money"></i>
                  </span>
                  <select id="pembayaran" class="form-control select2" name="pembayaran" required>
                    <option></option>
                    <option value="0">Tinggal nota</option>
                    <option value="1">Langsung bayar</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Pilih Barang</label>
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-archive"></i>
                  </span>
                  <input id="idbarang" class="form-control pilihan" type="hidden" name="barang" data-toggle="modal" data-target="#basic">
                  <input id="barang" class="form-control pilihan" type="text" name="nama_barang" data-toggle="modal" data-target="#basic">
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Jumlah</label>
                <div class="input-group">
                  <input id="jumlah" type="number" class="form-control" name="jumlah" placeholder="jumlah">
                  <span class="input-group-addon">
                    Satuan
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Harga Pengadaan/Satuan</label>
                <div class="input-group">
                  <span class="input-group-addon">
                    Rp.
                  </span>
                  <input id="harga_pengadaan" type="number" class="form-control" name="harga_pengadaan" placeholder="harga pengadaan">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="form-actions">
          <button type="button" class="add btn blue" name="submit" value="1">Tambah ke keranjang</button>
          <button type="button" class="btn default">Cancel</button>
        </div>
      </div>
    </div>

    <div class="col-md-6 portlet box blue">
      <div class="portlet-title">
        <div class="caption"><b><i class="fa fa-shopping-cart"></i> Keranjang</b></div>
        <br>
        <br>
      </div>

      <div class="portlet-body table-responsive" style="height:455px">
        <table class="table table-striped">
          <thead>
            <th>Barang</th>
            <th>Harga Pengadaan/Satuan</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Action</th>
          </thead>

          <tbody class="isiTable">
          </tbody>
        </table>
      </div>
      <button type="submit" class="btn blue" style="width:100%">Proses <i class="fa fa-arrow-right"></i></button>
    </div>
  </form>
</div>
@endsection

<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Pilih <span class="titleModal"></span></h4>
            </div>
            <div class="modal-body" style="max-height:300px; overflow:scroll"><p class="isi"></p></div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                <button type="button" class="btn green formTambah" data-toggle='modal' data-target="#formTambah"><span class="fa fa-plus" style="margin-right:5px"></span>Tambah <span class="titleModal"></span></button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="formTambah" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Form Tambah <span class="titleModal"></span></h4>
            </div>
            <div class="modal-body">
              <form class="fieldFormTambah" method="post">
                <div class="field"></div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="isAjax" value="true">
              </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                <button type="button" class="btn green storeFormTambah"><span class="fa fa-save" style="margin-right:5px"></span>Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@section('script')
<script src="{{ url('style/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ url('style/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>
  <script src="{{ url('style/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ url('style/forms.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
  setUrl("{{url('/penjualan')}}");
  getCart();

  $('.date-picker').datepicker({
        format: 'yyyy-mm-dd',
  });

  $(".select2").select2({
    placeholder : "pilih salah satu"
  });

  $('.add').click(function(){
    var dataForm = $("#form-konten").serialize();

    $.ajax({
      type: "POST",
      url: "{{ url($pathLink.'addCart') }}",
      data: dataForm,
      success: function(data){
        alert('berhasil di tambahkan ke keranjang');
        getCart();
      },
      error: function(jqXHR, textStatus, errorThrown){
        alert(textStatus+' : terjadi kesalahan silahkan refresh halaman.');
      }
    });//tutup ajax

  }); //tutup action add

  function getCart(){
    $('.isiTable').load("{{ url($pathLink.'getCart') }}");
  }

});
</script>
@endsection
