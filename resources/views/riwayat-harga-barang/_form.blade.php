<form role="form" action="{{ url($action) }}" method="post">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="field">
    <div class="form-body">
      <div class="form-group">
        <label>Kode Barang</label>
        <div class="input-group">
          <span class="input-group-addon">
            <i class="fa fa-user"></i>
          </span>
          <input type="hidden" class="form-control" name="id_barang" placeholder="Kode Barang" required @if(!empty($data)) value="{{encrypt($data->ID_BARANG)}}" @endif>
          <input type="text" class="form-control" name="kode_barang" placeholder="Kode Barang" required @if(!empty($data)) value="{{$data->ID_BARANG}}" @endif readonly>
        </div>
      </div>
      <div class="form-group">
        <label>Nama Barang</label>
        <div class="input-group">
          <span class="input-group-addon">
            <i class="fa fa-user"></i>
          </span>
          <input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang" required @if(!empty($data)) value="{{$data->NAMA_BARANG}}" @endif>
        </div>
      </div>
      <div class="form-group">
        <label>Kategori Barang</label>
        <div class="input-group">
          <span class="input-group-addon">
            <i class="fa fa-user"></i>
          </span>
          <select class="form-control" name="kategori_barang" placeholder="Kategori Barang" required>
            <option value="">Pilih kategori barang</option>
            @foreach($kategori_barang as $kategori)
            <option value="{{$kategori->ID_KATEGORI}}" @if(!empty($data) && ($data->ID_KATEGORI == $kategori->ID_KATEGORI)) selected @endif>{{$kategori->NAMA_KATEGORI}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group">
        <label>Merk Barang</label>
        <div class="input-group">
          <span class="input-group-addon">
            <i class="fa fa-user"></i>
          </span>
          <select class="form-control" name="merk_barang" placeholder="Merk Barang" required>
            <option value="">Pilih merk barang</option>
            @foreach($merk_barang as $merk)
            <option value="{{$merk->ID_MERK}}" @if(!empty($data) && ($data->ID_MERK == $merk->ID_MERK)) selected @endif>{{$merk->NAMA_MERK}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group">
        <label>Satuan Barang</label>
        <div class="input-group">
          <span class="input-group-addon">
            <i class="fa fa-user"></i>
          </span>
          <select class="form-control" name="satuan_barang" placeholder="Satuan Barang" required>
            <option value="">Pilih satuan barang</option>
            @foreach($satuan_barang as $satuan)
            <option value="{{$satuan->ID_SATUAN_BARANG}}" @if(!empty($data) && ($data->ID_SATUAN_BARANG == $satuan->ID_SATUAN_BARANG)) selected @endif>{{$satuan->NAMA_SATUAN_BARANG}}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
  </div>

  <div class="form-actions">
    <button type="submit" class="btn blue" name="submit" value="1">Submit</button>
    <button type="button" class="btn default">Cancel</button>
  </form>
