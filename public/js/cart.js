$(document).ready(function(){
    //when + button click
    $(".btn-plus").click(function(){
        $parentNode = $(this).parents('tr');
        $price = Number($parentNode.find('#price').text().replace('kyats',''));
        $qty = Number($parentNode.find('#qty').val());
        $total = $price * $qty;
        $parentNode.find('#total').html($total+"kyats");

        summaryCalculation();

    })
    //when - button click
    $(".btn-minus").click(function(){
        $parentNode = $(this).parents('tr');
        $price = Number($parentNode.find('#price').text().replace('kyats',''));
        $qty = Number($parentNode.find('#qty').val());
        $total = $price * $qty;
        $parentNode.find('#total').html($total+"kyats");
        summaryCalculation();

    })
    //when cancle button click
    $('.btnRemove').click(function(){

        $parentNode = $(this).parents('tr');
        $orderID = $parentNode.find('#orderID').val();
        $parentNode.remove();
        summaryCalculation();

        $.ajax({
            type: 'get',
            url: '/user/ajax/clear/specificProduct',
            data: {'orderID': $orderID} ,
            dataType: 'json',
            success: function(res){
                console.log(res);
            }
        })



    })
    //calculate final price for order
    function summaryCalculation(){
        $totalPrice = 0;
        $('#dataTable tr').each(function(index, row){
            $totalPrice += Number($(row).find('#total').text().replace('kyats',''));

        })
        $('#subtotal').html(`${($totalPrice)} kyats`);
        $('#finalPrice').html(`${($totalPrice+10000)} kyats`)
    }

    $('#orderBtn').click(function(){
        $orderList = [];
        $random = Math.floor(Math.random()*100000000001)
        $('#dataTable tbody tr').each(function(index,row){
            $orderList.push({
                'user_id' : $(row).find('#userID').val(),
                'product_id' : $(row).find('#productID').val(),
                'qty' : $(row).find('#qty').val(),
                'total' : Number($(row).find('#total').text().replace('kyats','')),
                'order_code' : 'POS' + $random,
            })
        })
        $.ajax({
            type: 'get',
            url: 'http://localhost:8000/user/ajax/order',
            data: Object.assign({},$orderList),
            dataType: 'json',
            success: function(res){
                console.log(res)
                if(res.success == 'true'){
                    window.location.href = 'http://localhost:8000/user/home';
                }
            }
        })

    })
    //when clear button click
    $('#clearBtn').click(function(){

            $.ajax({
                type: 'get',
                url: 'http://localhost:8000/user/ajax/clear/cart',
                dataType: 'json',

            })

            console.log('click')
            $('#dataTable tbody tr').remove();
            $('#subtotal').html("0 kyats");
            $('#finalPrice').html("0 kyats");

        })
})
