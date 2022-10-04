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
                                    <form action="{{ route('admin#update', Auth::user()->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4 offset-2 ">
                                                @if (Auth::user()->image == null)
                                                    <img src="{{ asset('img/default-user-image-png-transparent-png.png') }}"
                                                        class="img-thumbnail shadow-sm " style="width:300px !important"
                                                        alt="">
                                                @else
                                                    <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="">
                                                @endif
                                                <div class="form-group my-2">
                                                    <input type="file" class="form-control" name="image">
                                                </div>
                                                <button class="btn btn-dark btn-block" type="submit">
                                                    Update
                                                </button>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Name</label>
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        name="name" value="{{ Auth::user()->name }}">
                                                    @error('name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="text"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" value="{{ Auth::user()->email }}">
                                                    @error('email')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Phone</label>
                                                    <input type="text"
                                                        class="form-control @error('phone') is-invalid @enderror"
                                                        name="phone" value="{{ Auth::user()->phone }}">
                                                    @error('phone')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Gender</label>
                                                    <select name="gender"
                                                        class="form-control @error('gender') is-invalid @enderror"
                                                        id="">

                                                        @if (Auth::user()->gender == 'female')
                                                            <option value="female">
                                                                {{ AUth::user()->gender }}
                                                            </option>

                                                            <option value="male">
                                                                male
                                                            </option>
                                                        @else
                                                            <option value="male">
                                                                {{ AUth::user()->gender }}
                                                            </option>

                                                            <option value="female">
                                                                female
                                                            </option>
                                                        @endif
                                                    </select>
                                                    @error('gender')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>


                                                <div class="form-group">
                                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="" cols="30"
                                                        rows="10">
                                                        {{ Auth::user()->address }}
                                                    </textarea>
                                                    @error('address')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Role</label>
                                                    <input type="text" class="form-control" name="name" disabled
                                                        value="{{ Auth::user()->role }}">
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
