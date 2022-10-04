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
                                <span class="bg-dark text-light shadow-sm p-2">
                                    <i class="mr-3 fa-solid fa-database"></i>
                                    {{ $admins->total() }}
                                </span>
                            </h3>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-3 offset-1">

                            <form action="{{ route('admin#list') }}" method="GET">
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
                    <span>SearchKey : {{ request('Key') }}</span>
                    @if (count($admins) != 0)
                        <div class="table-responsive table-responsive-data2  ">
                            <table class="table table-data2 ">
                                <thead>
                                    <tr class="text-center">
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                        <tr class="tr-shadow table-bordered ">
                                            <td class="col-2">
                                                @if ($admin->image == null)
                                                    @if ($admin->gender == 'male')
                                                        <img src="{{ asset('img/default-user-image-png-transparent-png.png') }}"
                                                            class="img-fluid shadow-sm" alt="">
                                                    @else
                                                        <img src="{{ asset('img/default-avatar-female.jpg') }}"
                                                            class="img-fluid shadow-sm" alt="">
                                                    @endif
                                                @endif
                                                <img src="{{ asset('storage/' . $admin->image) }}"
                                                    class="img-fluid shadow-sm rounded-circle" alt="">
                                            </td>

                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->phone }}</td>
                                            <td>{{ $admin->gender }}</td>
                                            <td>{{ $admin->address }}</td>
                                            <td>
                                                <input type="hidden" value="{{ $admin->id }}" class="adminId">
                                                <select name="status" id=""
                                                    class="form-control roleChange  border">
                                                    <option value="admin"
                                                        @if ($admin->role == 'admin') selected @endif>
                                                        Admin
                                                    </option>
                                                    <option value="user"
                                                        @if ($admin->role == 'user') selected @endif>
                                                        User</option>

                                                </select>
                                            </td>
                                            <td>
                                                <div class="table-data-feature">
                                                    {{-- <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button> --}}
                                                    @if (Auth::user()->id == $admin->id)
                                                    @else
                                                        <a href="{{ route('admin#roleChangePage', $admin->id) }}"
                                                            class="">
                                                            <button class="item" data-toggle="tooltip"
                                                                data-placement="top" title="Delete">
                                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                                            </button>
                                                        </a>
                                                        <a href="" class="">
                                                            <button class="item" data-toggle="tooltip"
                                                                data-placement="top" title="Delete">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                        </a>
                                                    @endif
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
                        {{ $admins->links() }}
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('.roleChange').change(function() {
                $currentRole = $(this).val();
                $parentNode = $(this).parents("tr");
                $adminId = $parentNode.find('.adminId').val();
                $data = {
                    'adminId': $adminId,
                    'currentRole': $currentRole
                };
                console.log($adminId, $currentRole);
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/admin/ajax/change',
                    data: $data,
                    dataType: 'json'
                });
            })
        })
    </script>
@endsection
