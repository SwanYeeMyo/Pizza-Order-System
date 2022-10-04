@extends('user.layouts.master')
@section('content')
<div class="row px-xl-5">
    <div class="col-md-3"></div>
    <div class="col-lg-6 table-responsive mb-5">
        <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
            <thead class="thead-dark">
                <tr>
                    <th>Date</th>
                    <th>User Name</th>
                    <th>Order ID</th>
                    <th>Total Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->created_at->format('F-j-Y')}}</td>
                            <td>{{ Auth::user()->name}}</td>
                            <td>{{ $order->id}}</td>
                            <td>{{ $order->total_price}}</td>
                            <td>
                                @if ($order->status == 0)
                                    <span class="text-warning rounded"><i class="mx-1 fa-solid fa-clock-rotate-left"></i> Pending</span>
                                    @elseif ( $order->status == 1)
                                    <span class="text-success rounded"><i class="mx-1 fa-solid fa-check"></i> Success</span>
                                    @elseif ( $order->status == 2)
                                    <span class="text-danger  rounded"><i class="mx-1 fa-solid fa-circle-exclamation"></i> Cancel</span>
                                @endif
                            </td>
                        </tr>
                @endforeach
                {{ $orders->links() }}

            </tbody>
        </table>
    </div>
    <div class="col-md-3"></div>

</div>
@endsection
