@if(count($cart) <= 0)
<tr>
  <td colspan="6" align="center">anda belum memilih...</td>
</tr>
@else
  @foreach($cart as $cart)
  <tr>
    <td>{{ $cart['name'] }}</td>
    <td>
      {{ number_format($cart['price'], 0, '', '.') }}
      <hr>
      <div style="font-size:10px">
      <strong>beban harga</strong> : <br>
      {{ number_format($cart['attributes']['beban_harga'], 0, '', '.') }}<br>
      </div>
    </td>
    <td>{{ $cart['quantity'] }} Kg</td>
    <td>{{ number_format(($cart['price']*$cart['quantity']), 0, '', '.') }}</td>
    <td>
      <button class="removeKemasan btn btn-xs btn-circle btn-danger" type="button" name="remove" data-id="{{ $cart['id'] }}"><i class="fa fa-close"></i> hapus</button>
    </td>
  </tr>
  @endforeach
  <tr>
    <td colspan="3"><b>Grand total</b></td>
    <td colspan="2"><b>{{ number_format($total_cart, 0, '', '.') }}</b></td>
  </tr>
@endif

<script type="text/javascript">
$('.removeKemasan').click(function(){
    var id = $(this).data('id');

    $.ajax({
      type: "GET",
      url: "{{ url('/pengadaan/removeCartKemasan') }}",
      data: {
        idChart : id,
      },
      success: function(){
        alert('berhasil dihapus');
        getCart();
      },
      error: function(jqXHR, textStatus, errorThrown){
        alert(textStatus);
      }
  });//tutup ajax
});

function getCart(){
  $('.isiTable').load("{{ url('/pengadaan/getCartKemasan') }}");
}
</script>
