@extends('admin.layout.master');
@section('title', 'Category List')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Products List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#creatPage') }}">
                                <button class="btn btn-outline-dark">
                                    <i class="zmdi zmdi-plus mx-1"></i>Add Product
                                </button>
                            </a>

                        </div>
                    </div>
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
                        <div class="col-md-4">
                            <h3 class="">
                                <span class="text-dark shadow-sm p-2">
                                    <i class="mr-3 fa-solid fa-database"></i>
                                    {{ $products->total() }}
                                </span>
                            </h3>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">

                            <form action="{{ route('product#list') }}" method="GET">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control-lg" placeholder="search"
                                        value="{{ request('Key') }}" aria-label="Recipient's username" name="Key"
                                        aria-describedby="button-addon2">
                                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i
                                            class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if (count($products) != 0)
                        <div class="table-responsive table-responsive-data2  ">
                            <table class="table table-data2 ">
                                <thead>
                                    <tr class="text-center">
                                        <th>Product</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>price</th>
                                        <th>Time</th>
                                        <th>View Count</th>
                                        <th>Created_Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr class="tr-shadow table-bordered ">
                                            <td class="col-2"><img src="{{ asset('storage/' . $product->image) }}"
                                                    class="img-fluid shadow-sm" alt=""></td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->category_name }}</td>
                                            <td>{{ Str::words($product->description, 10, '...') }}</td>
                                            <td class=""><button class="btn btn-dark disable">
                                                    {{ $product->price }} kyats</button></td>
                                            <td>{{ $product->waiting_time }} mins</td>
                                            <td>{{ $product->view_count }}</td>
                                            <td>{{ $product->created_at->format('j-F-Y') }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    {{-- <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button> --}}
                                                    <a href="{{ route('product#detail', $product->id) }}" class="">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                                        </button>
                                                    </a>
                                                    <a href="" class="">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center mt-5">
                            <span>SearchKey : {{ request('Key') }}</span>
                            <h5 class="text-danger"><i class="fa-solid fa-triangle-exclamation mx-1"></i>No data Found!</h5>
                        </div>
                    @endif

                    <div class="my-3">
                        {{ $products->links() }}
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection
