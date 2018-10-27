@extends('templates.index')

@section('css')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{ url('style/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('style/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('style/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
@endsection

@section('judul-page')
Form Penjualan
@endsection

@section('judul')
Form Penjualan
@endsection

@section('keterangan-halaman')
<ul>
  <li> Halaman ini digunakan untuk menyimpan data pembelian konsumen. isi form dengan lengkap agar penyimpanan data berjalan dengan lancar. </li>
  <li> isi form dengan lengkap > klik tambah ke keranjang > detail barang di tampilkan di keranjang > klik proses (data penjualan akan disimpan). </li>
</ul>
  @endsection

  @section('content')
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

  <div class="row">
    <div class="col-md-6">
      <b>Form</b>

      <div class="form">
        <form id="form-konten" action="{{ url('/penjualan/storeCart') }}" method="post">
          <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Tanggal Pembelian</label>
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </span>
                    <input required type="text" class="date-picker form-control" name="tgl_pembelian" placeholder="tanggal pembelian" data-provide="datepicker">
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Pilih Konsumen</label>
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-user"></i>
                    </span>
                    <input id="idkonsumen" class="form-control pilihan" type="hidden" name="konsumen" data-toggle="modal" data-target="#basic" required>
                    <input id="konsumen" class="form-control pilihan" type="text" name="nama_konsumen" data-toggle="modal" data-target="#basic" required>
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
                    <select id="pembayaran" class="form-control select2" name="pembayaran" data-placeholder="pilih jenis pembayaran" equired>
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
                  <label>Harga/Satuan <span class="fa fa-refresh" style="cursor:pointer"></span></label>
                  <div class="input-group">
                    <span class="input-group-addon">
                      Rp.
                    </span>
                    <input id="harga" type="number" class="form-control" name="harga" placeholder="harga/Satuan" readonly>
                  </div>
                  <span id="keterangan" class="help-block font-green"></span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Jumlah</label>
                  <div class="input-group">
                    <span class="input-group-addon">
                      Satuan
                    </span>
                    <input id="jumlah" type="number" class="form-control" name="jumlah" placeholder="jumlah">
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="form-actions">
            <button id='keranjang' type="button" class="btn blue" name="submit" value="1">Tambah ke keranjang</button>
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

        <div class="portlet-body table-responsive" style="height:370px">
          <table class="table table-striped">
            <thead>
              <th>Barang</th>
              <th>Harga/Satuan</th>
              <th>Jumlah</th>
              <th>Total</th>
              <th>Action</th>
            </thead>

            <tbody class="isiTable">
            </tbody>
          </table>
        </div>
        <div style="background-color:white; padding:20px; border-top: 1px solid lightgrey; margin:0px 0.4px 0px 0.4px">
          <div class="row" style="font-size:18px">
            <b>
              <div class="col-md-7">
                Grand Total :
              </div>
              <div class="grandTotal col-md-5" style="padding-left:33px">
                0
              </div>
            </b>
          </div>
        </div>
        <button disabled type="submit" class="btn blue" style="width:100%">Proses <i class="fa fa-arrow-right"></i></button>
      </div>
    </form>
  </div>
  @endsection

  @section('script')
  <script src="{{ url('style/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
  <script src="{{ url('style/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('style/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
  <script src="{{ url('style/forms.js') }}" type="text/javascript"></script>
  <script type="text/javascript">
    setUrl("{{url('/penjualan')}}");
    getCart();

    $('.date-picker').datepicker({
          format: 'yyyy-mm-dd',
    });

    $('#keranjang').click(function(){
      // alert('test');
      var token = $('#token').val();
      var barang = $('#idbarang').val();
      var harga = $('#harga').val();
      var jumlah = $('#jumlah').val();

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': token
        }
      });

      $.ajax({
        type: "POST",
        url: "{{ url('/penjualan/addCart') }}",
        data: {
          barang : barang,
          harga : harga,
          jumlah : jumlah,
        },
        success: function(data){
          alert('berhasil ditambahkan kedalam keranjang');
          getCart();
        },
        error: function(jqXHR, textStatus, errorThrown){
          alert(textStatus+' : terjadi kesalahan server.');
        }
      });//tutup ajax
    }); //tutup action add
  </script>
  @endsection
