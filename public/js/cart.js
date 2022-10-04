$(document).ready(function(){
    $('.btn-plus').click(function(){
        $parentNode = $(this).parents("tr");
        $price = $parentNode.find('#pizzaPrice').text().replace("kyats","");

        $qty = Number($parentNode.find('#qty').val());
        $total = $price * $qty;
        // $qty = ($parentNode.find('#qty').val()) * (1) + 1;
        $parentNode.find('#total').html($total + ' kyats');

    //    total summary
    summaryCalculation();
    })
    $('.btn-minus').click(function(){
        $parentNode = $(this).parents("tr");
        $price = $parentNode.find('#pizzaPrice').text().replace("kyats","");
        $qty = Number($parentNode.find('#qty').val());
        $total = $price * $qty ;
        console.log($total);
        $parentNode.find('#total').html($total + " kyats")
        summaryCalculation();

    });

    function summaryCalculation(){
        $totalPrice = 0;
        $('#dataTable tr').each(function(index,row){
           $totalPrice +=  Number($(row).find('#total').text().replace("kyats",''));
        });
       $('#subTotal').html(`${$totalPrice} kyats`);
       $('#finalPrice').html(`${$totalPrice+3000} kyats`);
    }
});
