<div class="form-body">
  <div class="form-group">
      <label>Konsumen</label>
      <div class="input-group">
          <span class="input-group-addon">
              <i class="fa fa-user"></i>
          </span>
          <select class="select2 form-control" name="id_konsumen" data-placeholder='Pilih Konsumen' required>
            <option value=""></option>
            @foreach($konsumen as $listKonsumen)
            <option @if((isset($data)) && ($data->ID_KONSUMEN == $listKonsumen->ID_KONSUMEN)) selected @endif value="{{$listKonsumen->ID_KONSUMEN}}">{{$listKonsumen->NAMA_KONSUMEN}}</option>
            @endforeach
          </select>
     </div>
  </div>
  <div class="form-group">
      <label>Beras</label>
      <div class="input-group">
          <span class="input-group-addon">
              <i class="fa fa-circle"></i>
          </span>
          <select class="select2 form-control" name="id_beras" data-placeholder='Pilih Beras' required>
            <option value=""></option>
            @foreach($beras as $listBeras)
            <option @if((isset($data)) && ($data->ID_BERAS == $listBeras->ID_BERAS)) selected @endif value="{{$listBeras->ID_BERAS}}">{{$listBeras->NAMA_BERAS}}</option>
            @endforeach
          </select>
     </div>
  </div>
  <div class="form-group">
      <label>Harga Khusus/Kg</label>
      <div class="input-group">
          <span class="input-group-addon">
              Rp.
          </span>
          <input type="number" class="form-control" name="harga_khusus" placeholder="Harga Khusus"  @if((isset($data))) value="{{$data->HARGA_KHUSUS}}" @endif required>
     </div>
  </div>
</div>
