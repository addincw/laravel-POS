<form role="form" action="{{ url($action) }}" method="post">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="field">
    <div class="form-body">
      <div class="form-group">
        <label>Nama Merk</label>
        <div class="input-group">
          <span class="input-group-addon">
            <i class="fa fa-user"></i>
          </span>
          @if(!empty($data))
          <input type="hidden" class="form-control" name="id_merk" value="{{\encrypt($data->ID_MERK)}}">
          <input type="text" class="form-control" name="nama_merk" placeholder="Nama Merk" value="{{$data->NAMA_MERK}}" required>
          @else
          <input type="text" class="form-control" name="nama_merk" placeholder="Nama Merk" required>
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
