@extends('admin.layout.master');
@section('title', 'Order List')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="row">

                        <div class="col-md-4 ">

                            <div class="my-3">
                                <a href="{{ route('admin#order') }}">
                                    <button class="btn btn-dark ">
                                        <i class="fa fa-backward" aria-hidden="true"></i>
                                        <h6 class="text-light">back</h6>
                                    </button>
                                </a>
                            </div>
                            <div class="card border-0 shadow">
                                <div class="card-header text-center">
                                    <i class="fa fa-address-book" aria-hidden="true"></i>
                                    <span>Order Info</span>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row   ">
                                        <div class="col">
                                            <i class="fa fa-user mx-1" aria-hidden="true"></i>Customer
                                        </div>
                                        <div class="col">
                                            {{ $ordersList[0]->user_name }} </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col"><i class="fa fa-barcode mx-1" aria-hidden="true"></i>
                                            OrderCode
                                        </div>
                                        <div class="col">
                                            {{ $ordersList[0]->order_code }}</div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col"><i class="fa fa-calendar mx-1" aria-hidden="true"></i>
                                            OrderDate
                                        </div>
                                        <div class="col">{{ $ordersList[0]->created_at->format('F-j-Y') }}
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col"><i class="fa fa-money mx-1" aria-hidden="true"></i>
                                            Amount
                                        </div>
                                        <div class="col">{{ $order->total_price }} Kyats
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>


                    <div class="table-responsive table-responsive-data2  ">
                        <table class="table table-data2 ">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Product Image</th>
                                    <th>Prdouct Name</th>
                                    <th>Order Date</th>
                                    <th>Qty</th>
                                    <th>Amout</th>
                                </tr>
                            </thead>

                            <tbody id="dataList">
                                @foreach ($ordersList as $order)
                                    <tr class="tr-shadow table-bordered ">
                                        <td class="col-1"></td>
                                        <td>{{ $order->user_id }}</td>
                                        <td class="col-2">
                                            <img class="img-thumbnails"
                                                src="{{ asset('storage/' . $order->product_image) }}" alt="">
                                        </td>
                                        <td>{{ $order->product_name }}</td>
                                        <td>{{ $order->created_at->format('F-j-Y') }}</td>
                                        <td>{{ $order->qty }}</td>
                                        <td>{{ $order->total }}</td>




                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptSource')
@endsection
