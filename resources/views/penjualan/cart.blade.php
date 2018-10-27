@if(count($cart) <= 0)
<tr>
  <td colspan="6" align="center">anda belum memilih barang</td>
</tr>
@else
  @foreach($cart as $cart)
  <tr>
    <td>{{ $cart['name'] }}</td>
    <td>{{ number_format($cart['price'], 0, '', '.') }}</td>
    <td>{{ $cart['quantity'] }}</td>
    <td>{{ number_format(($cart['price']*$cart['quantity']), 0, '', '.') }}</td>
    <td>
      <button class="remove btn btn-xs btn-circle btn-danger" type="button" name="remove" data-id="{{ $cart['id'] }}"><i class="fa fa-close"></i> hapus</button>
    </td>
  </tr>
  @endforeach
  <!-- <tr>
    <td colspan="4"><b>Grand total</b></td>
    <td><b>{{ number_format($total_cart, 0, '', '.') }}</b></td>
  </tr> -->
@endif

<script type="text/javascript">
$('.remove').click(function(){
    var id = $(this).data('id');

    $.ajax({
      type: "GET",
      url: "{{ url('/penjualan/removeCart') }}",
      data: {
        idChart : id,
      },
      success: function(data){
        alert('berhasil dihapus');
        getCart();
      },
      error: function(jqXHR, textStatus, errorThrown){
        alert(textStatus);
      }
  });//tutup ajax
});

function getCart(){
  $('.isiTable').load("{{ url('/penjualan/getCart') }}");
  $.ajax({
    type : "GET",
    url : "{{ url('/penjualan/getTotal') }}",
    success : function(data,status){
      $('.grandTotal').text(data);
    }
  });
}
</script>
