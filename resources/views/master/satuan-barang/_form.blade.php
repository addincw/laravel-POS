<form role="form" action="{{ url($action) }}" method="post">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="field">
    <div class="form-body">
      <div class="form-group">
        <label>Nama Satuan Barang</label>
        <div class="input-group">
          <span class="input-group-addon">
            <i class="fa fa-user"></i>
          </span>
          @if(!empty($data))
          <input type="hidden" class="form-control" name="id_satuan_barang" value="{{\encrypt($data->ID_SATUAN_BARANG)}}">
          <input type="text" class="form-control" name="nama_satuan_barang" placeholder="Nama Satuan Barang" value="{{$data->NAMA_SATUAN_BARANG}}" required>
          @else
          <input type="text" class="form-control" name="nama_satuan_barang" placeholder="Nama Satuan Barang" required>
          @endif

        </div>
      </div>
    </div>
  </div>

  <div class="form-actions">
    <button type="submit" class="btn blue" name="submit" value="1">Submit</button>
    <button type="button" class="btn default">Cancel</button>
  </div>
</form>
