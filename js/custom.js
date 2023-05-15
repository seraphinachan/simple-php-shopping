$(document).ready(function () {

  $('.increment-btn').click(function (e) {
    e.preventDefault();

    var qty = $(this).closest('.product_data').find('.input-qty').val();
    // alert(qty);
    var value = parseInt(qty, 10);
    value = isNaN(value) ? 0 : value;
    if(value < 100)
    {
      value++;
      $('.input-qty').val(value);
      $(this).closest('.product_data').find('.input-qty').val(value);
    }
     $('#tqty').text('총 수량 : ' + value + ' 개');
  });

  $('.decrement-btn').click(function (e) {
    e.preventDefault();

    var qty = $(this).closest('.product_data').find('.input-qty').val();
    // alert(qty);
    var value = parseInt(qty, 10);
    value = isNaN(value) ? 0 : value;
    if(value > 1)
    {
      value--;
      $('.input-qty').val(value);
      $(this).closest('.product_data').find('.input-qty').val(value);
    }
    $('#tqty').text('총 수량 : ' + value + ' 개');
  });

});
