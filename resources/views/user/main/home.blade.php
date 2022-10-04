@extends('user.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                        by Categories</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="bg-dark text-light p-3 d-flex align-items-center justify-content-between mb-3">
                            <label class="" for="price-all">Categories</label>
                            <span class="badge border font-weight-normal">{{ count($categories) }}</span>
                        </div>
                        @foreach ($categories as $c)
                            <a href="{{ route('user#Filter', $c->id) }}">
                                <div class="text-center d-flex align-items-center justify-content-between mb-3">
                                    <label class="fs-5 text-dark" for="price-all">{{ $c->name }}</label>
                                </div>
                            </a>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->
                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">

                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{ route('user#cart') }}">
                                    <button type="button"
                                        class="btn btn-outline-dark btn-sm 0
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             position-relative">
                                        <i class=" mx-1 fa-solid fa-cart-shopping"></i> Carts
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($carts) }}
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    </button>
                                </a>
                                <a href="{{ route('user#order') }}">
                                    <button type="button"
                                        class="btn btn-outline-dark btn-sm 0
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             position-relative">
                                        <i class=" mx-1 fa-solid fa-cart-shopping"></i> Carts
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($orders) }}
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    </button>
                                </a>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>

                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sorting" id="sortingOption" class="form-control">
                                        <option value="" class="form-control">Choose</option>
                                        <option value="asc" class="form-control">Ascending</option>
                                        <option value="desc" class="form-control">Descending</option>
                                    </select>

                                </div>

                                {{-- <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    @if (session('successSent'))
                        <div class="row">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="shadow">
                                    <div class="alert alert-light alert-dismissible fade show text-center" role="alert">
                                        <span class="text-success "> <i
                                                class="fa-solid fa-circle-check mx-3"></i>{{ session('successSent') }}</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <span class="row" id="dataList">
                        @if (count($pizzas) != 0)
                            @foreach ($pizzas as $p)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/' . $p->image) }}"
                                                alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href="#"><i
                                                        class="fa fa-shopping-cart"></i></a>

                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('user#pizzaDetail', $p->id) }}"><i
                                                        class="fa fa-search"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">{{ $p->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $p->price }}</h5>
                                                <h6 class="text-muted ml-2"><del>25000</del></h6>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <span class="d-block text-center">No Product Found</span>
                        @endif

                    </span>








                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('#sortingOption').change(function() {
                $eventOption = $('#sortingOption').val();
                console.log($eventOption);
                if ($eventOption == 'asc') {
                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/user/ajax/pizzaList',
                        data: {
                            'status': 'asc'
                        },
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            $list = '';
                            for ($i = 0; $i < data.length; $i++) {
                                $list += `
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/${data[$i].image}') }}"
                                    alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-shopping-cart"></i></a>

                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate"
                                    href="">${data[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${data[$i].price}</h5>
                                    <h6 class="text-muted ml-2"><del>25000</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                </div>
                            </div>
                        </div>

                    </div>
                       `;
                            }
                            $('#dataList').html($list)
                        }
                    })
                } else if ($eventOption == 'desc') {
                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/user/ajax/pizzaList',
                        data: {
                            'status': 'desc'
                        },
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            $list = '';
                            for ($i = 0; $i < data.length; $i++) {
                                $list += `
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/${data[$i].image}') }}"
                                    alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-shopping-cart"></i></a>

                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate"
                                    href="">${data[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${data[$i].price}</h5>
                                    <h6 class="text-muted ml-2"><del>25000</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                       `;
                            }
                            $('#dataList').html($list)
                        }
                    })
                }

            })
        });
    </script>
@endsection
