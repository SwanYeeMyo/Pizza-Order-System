@extends('admin.layout.master')
@section('title,', 'Create Category')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-3 offset-8">
                                <a href="{{ route('category#list') }}"><button
                                        class="btn bg-dark text-white my-3">List</button></a>
                            </div>
                        </div>

                        @if (session('success'))
                            <div class="row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div class="shadow">
                                        <div class="alert alert-light alert-dismissible fade show text-center"
                                            role="alert">
                                            <span class="text-success"> <i
                                                    class="fa-solid fa-check mx-3"></i>{{ session('success') }}</span>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-lg-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Detail Profile Page</h3>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col-3 offset-2">
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="">
                                        </div>
                                        <div class="col-6 offset-1  mt-3 ">

                                            <span class="btn btn-dark text-light my-1"><i
                                                    class="fa-solid fa-pizza-slice mx-1"></i>{{ $product->name }}</span>

                                            <span class="btn btn-dark text-light"><i
                                                    class="fa-solid fa-dollar-sign mx-1"></i>{{ $product->price }}</span>
                                            <span class="btn btn-dark text-light">
                                                <i
                                                    class="fa-solid fa-clock-rotate-left mx-1"></i>{{ $product->waiting_time }}</span>
                                            <span class="btn btn-dark text-light"><i
                                                    class="fa-solid fa-eye mx-1"></i>{{ $product->view_count }}</span>

                                            <span class="btn btn-dark text-light my-1"><i
                                                    class="fa-solid fa-pizza-slice mx-1"></i>{{ $product->category_name }}</span>

                                            <div class="mt-3">
                                                <p>{{ $product->description }}</p>

                                                <div class="mt-3 float-end">
                                                    <a href="{{ route('product#updatePage', $product->id) }}">
                                                        <button class="btn btn-outline-dark">
                                                            <i class="fa fa-edit " aria-hidden="true"></i>Edit proudct
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
