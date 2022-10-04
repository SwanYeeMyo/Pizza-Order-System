@extends('admin.layout.master');
@section('title', 'Order List')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->

                    @if (session('success'))
                        <div class="row">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="shadow">
                                    <div class="alert alert-light alert-dismissible fade show text-center" role="alert">
                                        <span class="text-success  "> <i
                                                class="fa-solid fa-circle-check mx-3"></i>{{ session('success') }}</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row">

                        <div class="col-md-4 ">

                            <form action="{{ route('admin#changeStatus') }}" method="GET">
                                @csrf
                                <div class="d-flex">
                                    <b>Status:</b>
                                    <select name="orderStatus" class="form-control w-50 mx-3">
                                        <option value="">All
                                        </option>
                                        <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending
                                        </option>
                                        <option value="1" @if (request('orderStatus') == '1') selected @endif>Success
                                        </option>
                                        <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject
                                        </option>
                                    </select>
                                    <div class="d-flex mx-2 ">
                                        <button type="submit" class="btn btn-outline-dark">Search</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-3 offset-1 text-right">
                            <h3 class="d-bloc mb-3">
                                <span class="text-dark shadow-sm p-1">
                                    <i class="mr-3 fa-solid fa-database"></i>
                                    <small id="count">{{ $orders->total() }}</small>
                                </span>
                            </h3>
                            <form action="{{ route('admin#order') }}" method="">
                                <div class="d-flex mx-2 ">
                                    <input type="text" class="form-control" name="Key">
                                    <button class="btn btn-outline-dark">Search</button>
                                </div>

                            </form>
                        </div>
                    </div>

                    @if (count($orders) != 0)
                        <div class="table-responsive table-responsive-data2  ">
                            <table class="table table-data2 ">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>Order Date</th>
                                        <th>Order Code</th>
                                        <th>Amout</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody id="dataList">
                                    @foreach ($orders as $order)
                                        <tr class="tr-shadow table-bordered ">
                                            <input type="hidden" value="{{ $order->id }}" class="orderId">
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->user_name }}</td>
                                            <td>{{ $order->created_at->format('j-F-Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin#listInfo', $order->order_code) }}"
                                                    class="text-pirmary">
                                                    {{ $order->order_code }}
                                                </a>
                                            </td>
                                            <td class="amount">{{ $order->total_price }} Kyats</td>
                                            <td>
                                                <select name="status" id=""
                                                    class="form-control statusChange border">
                                                    <option value="0"
                                                        @if ($order->status == 0) selected @endif>Pending</option>
                                                    <option value="1"
                                                        @if ($order->status == 1) selected @endif>Accept</option>
                                                    <option value="2"
                                                        @if ($order->status == 2) selected @endif>Reject</option>

                                                </select>
                                            </td>
                                            <td>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="my-3">
                            {{ $orders->links() }}
                        </div>
                    @else
                        <a href="{{ route('admin#order') }}">
                            <button class="btn btn-dark text-light">Back</button>
                        </a>
                        @if (request('orderStatus'))
                            <h3 class="text-center text-muted my-3">There is no Order for
                                @if (request('orderStatus ') == 0)
                                    pending
                                @elseif (request('orderStatus ') == 1)
                                    Success
                                @elseif (request('orderStatus ') == 2)
                                    rejected
                                @endif
                            </h3>
                        @else
                            <h3 class="text-center text-muted my-3">There is no Order for {{ request('Key') }}</h3>
                        @endif

                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {

            $('.statusChange').change(function() {
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $orderId = $parentNode.find('.orderId').val();
                console.log($parentNode.find('.amount').html());

                $data = {
                    'status': $currentStatus,
                    'orderId': $orderId,
                };
                console.log($data);
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/orders/ajax/change/status',
                    data: $data,
                    dataType: 'json',

                });
            });
        });
    </script>
@endsection
