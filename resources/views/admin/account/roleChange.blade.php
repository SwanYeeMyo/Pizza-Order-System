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
                                    <form action="{{ route('admin#roleChange', $user->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mt-5">
                                            <div class="col-md-4 offset-2 ">
                                                @if ($user->image == null)
                                                    @if ($user->gender == 'male')
                                                        <img src="{{ asset('img/default-user-image-png-transparent-png.png') }}"
                                                            class="img-thumbnail shadow-sm " style="width:300px !important"
                                                            alt="">
                                                    @else
                                                        <img src="{{ asset('img/default-avatar-female.jpg') }}"
                                                            class="img-thumbnail shadow-sm " style="width:300px !important"
                                                            alt="">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/' . $user->image) }}" alt="">
                                                @endif
                                                {{-- <div class="form-group my-2">
                                                    <input type="file" class="form-control" name="image" disabled>
                                                </div> --}}
                                                <button class="btn btn-outline-dark btn-block mt-2" type="submit">
                                                    <i class="fa fa-send mx-2
                                                    "
                                                        aria-hidden="true"></i>Update
                                                </button>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Name</label>
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        name="name" value="{{ $user->name }}" disabled>
                                                    @error('name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Gender</label>
                                                    <select name="role"
                                                        class="form-control @error('gender') is-invalid @enderror"
                                                        id="">

                                                        @if ($user->role == 'admin')
                                                            <option value="admin">
                                                                {{ $user->role }}
                                                            </option>

                                                            <option value="user">
                                                                User
                                                            </option>
                                                        @else
                                                            <option value="user">
                                                                {{ $user->role }}
                                                            </option>

                                                            <option value="admin">
                                                                Admin
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
                                                    <label for="">Email</label>
                                                    <input type="text"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" disabled value="{{ $user->email }}">
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
                                                        name="phone" disabled value="{{ $user->phone }}">
                                                    @error('phone')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>



                                                <div class="form-group">
                                                    <label for="">Gender</label>
                                                    <select name="gender" disabled
                                                        class="form-control @error('gender') is-invalid @enderror"
                                                        id="">

                                                        @if (Auth::user()->gender == 'female')
                                                            <option value="female">
                                                                {{ $user->gender }}
                                                            </option>

                                                            <option value="male">
                                                                male
                                                            </option>
                                                        @else
                                                            <option value="male">
                                                                {{ $user->gender }}
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
                                                    <textarea name="address" disabled class="form-control @error('address') is-invalid @enderror" id=""
                                                        cols="30" rows="10">
                                                        {{ $user->address }}
                                                    </textarea>
                                                    @error('address')
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
