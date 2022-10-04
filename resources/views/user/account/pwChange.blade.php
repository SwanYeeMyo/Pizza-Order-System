@extends('user.layouts.master')
@section('content')
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4"></div>
    <div class="col-md-3 offset-1">
        @if (session('notMatch'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('notmatch') }}</strong>
            <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        @if (session('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <span class="text-success">update password success</span>
            <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
    </div>
</div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="mt-3 p-lg-3 shadow-sm">
               <div class="my-1">
                <a href="{{ route('user#home') }}">
                    <span class="btn ">
                        <i class="fa-solid fa-arrow-left"></i>
                    </span>
                </a>
               </div>
                <form action="{{ route('user#pwChange') }}" method="POST">
                    @csrf
                    <div class="form-group">

                        <label for="">Old Password</label>
                        <input type="password" name="oldPassword"  class="form-control @error('oldPassword') is-invalid @enderror">
                        @error('oldPassword')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">New Password</label>
                        <input type="password" name="newPassword"  class="form-control @error('newPassword')
                        is-invalid
                    @enderror">
                        @error('newPassword')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Confirm Password</label>
                        <input type="password" name="confirmPassword" class="form-control @error('confirmPassword')
                            is-invalid
                        @enderror">
                        @error('confirmPassword')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <button class="btn btn-block btn-outline-dark">
                        <i class="fa fa-key" aria-hidden="true"></i> Update
                    </button>
                </form>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
@endsection
