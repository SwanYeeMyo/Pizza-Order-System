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
                                            @if (Auth::user()->image == null)
                                                <img src="{{ asset('img/default-user-image-png-transparent-png.png') }}"
                                                    alt="CoolAdmin" class="img-fluid">
                                            @else
                                                <div class="my-3">
                                                    <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                        alt="CoolAdmin">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-5 offset-1">
                                            <h3 class="my-3"><i class="fa-solid fa-user mx-2"></i><span
                                                    class="badge text-bg-dark text-light mx-3">
                                                    {{ Auth::user()->name }}</span></h3>

                                            <h4 class="my-3"><i class="fa-solid fa-envelope mx-2"></i>
                                                {{ Auth::user()->email }}</h4>

                                            <h4 class="my-3"><i class="fa-solid fa-square-phone mx-2"></i>
                                                {{ Auth::user()->phone }}</h4>

                                            <h4 class="my-3"><i class="fa fa-user mx-2" aria-hidden="true"></i>
                                                {{ Auth::user()->gender }}</h4>

                                            <h4 class="my-3"><i class="fa-solid fa-address-card mx-2"></i>
                                                {{ Auth::user()->address }}</h4>


                                            <h4 class="my-3"><i class="fa-solid fa-user-lock mx-2"></i><span
                                                    class="badge text-bg-success text-light mx-3">
                                                    {{ Auth::user()->role }}</span></h4>

                                            <h4 class="my-3"><i class="fa-solid fa-calendar-check mx-2"></i>
                                                {{ Auth::user()->created_at->format('j-F-Y') }}</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 offset-8 mt-3">
                                            <a href="{{ route('admin#edit', Auth::user()->id) }}">
                                                <button class="btn btn-outline-dark me-2">
                                                    <i class="fa fa-edit" aria-hidden="true"></i>Edit profile
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
@endsection
