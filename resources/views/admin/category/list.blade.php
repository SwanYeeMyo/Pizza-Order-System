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
                                <h2 class="title-1">Catgory List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="btn btn-outline-dark">
                                    <i class="zmdi zmdi-plus mx-1"></i>add Category
                                </button>
                            </a>
                            <button class="btn btn-outline-dark" type="button">
                                CSV download
                            </button>
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
                                    <i class="mr-3 fa-solid fa-database"></i>{{ $categories->total() }}
                                </span>
                            </h3>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">

                            <form action="{{ route('category#list') }}" method="GET">
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

                    @if (count($categories) != 0)
                        <div class="table-responsive table-responsive-data2  ">
                            <table class="table table-data2 ">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr class="tr-shadow table-bordered ">
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->created_at->format('j-F-Y') }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    {{-- <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button> --}}
                                                    <a href="{{ route('category#edit', $category->id) }}" class="">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('category#delete', $category->id) }}" class="">
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
                        <div class="my-3">
                            {{ $categories->links() }}
                        </div>
                    @else
                        <h3 class="text-center text-muted my-3">There is no Categories Here</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection
