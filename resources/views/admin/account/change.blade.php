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
                        <div class="col-lg-6 offset-3">
                            <div class="card">
                                <div class="card-body">
                                    @if (session('changeSuccess'))
                                        <div class="alert alert-outline-dark alert-dismissible fade show text-center"
                                            role="alert">
                                            <span class="text-success  ">{{ session('changeSuccess') }}</span>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if (session('notMatch'))
                                        <div class="alert alert-outline-dark alert-dismissible fade show text-center"
                                            role="alert">
                                            <span class="text-success  ">{{ session('notMatch') }}</span>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Change Your Password</h3>
                                    </div>
                                    <hr>
                                    <form action="{{ route('admin#changePassword') }}" method="post"
                                        novalidate="novalidate">
                                        @csrf
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                            <input id="cc-pament" name="oldPassword" type="password"
                                                class="form-control @if (session('notMatch')) is-invalid @endif  @error('oldPassword') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter old password">
                                            @error('oldPassword')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror


                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">New Password</label>
                                            <input id="cc-pament" name="newPassword" type="password"
                                                class="form-control @error('newPassword') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Enter New password">
                                            @error('newPassword')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                            <input id="cc-pament" name="confirmPassword" type="password"
                                                class="form-control @error('confirmPassword') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Confirm password">
                                            @error('confirmPassword')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div>
                                            <button id="payment-button" type="submit"
                                                class="btn btn-lg btn-outline-dark btn-block">
                                                <i class="fa-solid fa-key"></i>
                                                <span id="payment-button-amount">Change</span>
                                                {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}

                                            </button>
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
@endsection
