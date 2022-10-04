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
                        <div class="col-lg-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2 mb-3">Account Profile</h3>
                                    </div>
                                    <form action="{{ route('product#update') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4 offset-2 ">
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="">
                                                <div class="form-group my-2">
                                                    <input type="hidden" value="{{ $product->id }}" name="pizzaId">
                                                    <input type="file" class="form-control" name="productImage">
                                                </div>
                                                <button class="btn btn-dark btn-block" type="submit">
                                                    Update
                                                </button>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Name</label>
                                                    <input type="text"
                                                        class="form-control @error('productName') is-invalid @enderror"
                                                        name="productName" value="{{ $product->name }}">
                                                    @error('productName')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <textarea name="productDescription" class="form-control @error('productDescription') is-invalid @enderror"
                                                        id="" cols="40" rows="20">
                                                        {{ $product->description }}
                                                    </textarea>
                                                    @error('productDescription')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Category</label>
                                                    <select class="form-control" name="category">
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Price</label>
                                                    <input type="text"
                                                        class="form-control @error('productPrice') is-invalid @enderror"
                                                        name="productPrice" value="{{ $product->price }}">
                                                    @error('productPrice')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Waiting_time</label>
                                                    <input type="text"
                                                        class="form-control @error('productTime') is-invalid @enderror"
                                                        name="productTime" value="{{ $product->waiting_time }}">
                                                    @error('productTime')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                    </form>
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
