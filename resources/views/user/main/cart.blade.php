<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <!-- Navbar End -->


    <!-- Breadcrumb Start -->

    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    @extends('user.layouts.master')
    @section('content')
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>User_name</th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($carts as $cart)
                            <tr>
                                {{-- <input type="hidden" id="pizzaPrice" value="{{ $cart->pizza_price }}" > --}}
                                <input type="hidden" class="orderId" value="{{ $cart->id }}">
                                <input type="hidden" class="productId" value="{{ $cart->product_id }}">
                                <input type="hidden" class="userId" value="{{ $cart->user_id }}">
                                <td class="align-middle">
                                    <img src="{{ asset('storage/' . $cart->image) }}" style="width: 100px" alt="">
                                </td>
                                <td class="align-middle"><img src="" alt="" style="width: 50px;">
                                    {{ $cart->pizza_name }}</td>
                                <td class="align-middle" id="pizzaPrice">{{ $cart->pizza_price }} kyats</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>

                                        <input type="text"
                                            class="form-control form-control-sm bg-secondary border-0 text-center"
                                            id="qty" value="{{ $cart->qty }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total">{{ $cart->qty * $cart->pizza_price }}kyats</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotal">{{ $total }} kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">3000</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice">{{ $total + 3000 }} kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderBtn">Proceed To
                            Checkout</button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clean">Clear
                            Cart</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scriptSource')
        <script src=" {{ asset('js/cart.js') }}"></script>
        <script>
            $('#orderBtn').click(function() {

                // $parentNode = $(this).parents("tr");
                // $price = $parentNode.find('#pizzaPrice').text().replace("kyats", "");
                // $qty = Number($parentNode.find('#qty').val());
                // $total = $price * $qty;
                // console.log($total);
                // $parentNode.find('#total').html($total + " kyats")
                $orderList = [];
                $random = Math.floor(Math.random() * 10001);
                $('#dataTable tbody tr').each(function(index, row) {
                    $orderList.push({
                        'user_id': $(row).find('.userId').val(),
                        'product_id': $(row).find('.productId').val(),
                        'qty': $(row).find('#qty').val(),
                        'total': $(row).find('#total').text().replace('kyats', '') * 1,
                        'order_code': 'POS' + $random,
                    });
                });

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/user/ajax/order',
                    data: Object.assign({}, $orderList),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'true') {
                            window.location.href = 'http://127.0.0.1:8000/user/homePage';
                        }
                    }
                })
                // $('#subTotal').html(`${$totalPrice} kyats`);
                // $('#finalPrice').html(`${$totalPrice+3000} kyats`);


            })
            $('#clean').click(function() {
                $('#dataTable tbody tr').remove();
                $('#finalPrice').html("3000 kyats");
                console.log("clean");

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/user/ajax/clear/cart',
                    data: 'data',
                    dataType: 'json',
                    success: function(response) {

                    }
                })

            });
            //remove btn
            $('.btnRemove').click(function() {

                $parentNode = $(this).parents("tr");
                $productId = $parentNode.find('.productId').val();
                $orderId = $parentNode.find('.orderId').val();
                console.log($productId);

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/user/ajax/remove',
                    data: {
                        'productId': $productId,
                        'orderId' : $orderId
                    },
                    dataType: 'json',
                    success: function(response) {

                    }
                })
                $parentNode.remove();
                $totalPrice = 0;
                $('#dataTable tr').each(function(index, row) {
                    $totalPrice += Number($(row).find('#total').text().replace("kyats", ''));
                });
                $('#subTotal').html(`${$totalPrice} kyats`);
                $('#finalPrice').html(`${$totalPrice+3000} kyats`);
            });
        </script>
    @endsection

    <!-- Cart End -->


    <!-- Footer Start -->

    <!-- Footer End -->


    <!-- Back to Top -->
