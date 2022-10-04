@extends('admin.layout.master');
@section('title', 'Contact List')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="row">

                        <div class="col-md-4 ">

                            <div class="my-3">
                                <a href="{{ route('admin#order') }}">
                                    <button class="btn btn-dark ">
                                        <i class="fa fa-backward" aria-hidden="true"></i>
                                        <h6 class="text-light">back</h6>
                                    </button>
                                </a>
                            </div>


                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>


                    <div class="table-responsive table-responsive-data2  ">
                        <table class="table table-data2 ">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Send Date</th>

                                </tr>
                            </thead>

                            <tbody id="dataList">
                                @foreach ($contacts as $contact)
                                    <tr class="tr-shadow table-bordered ">
                                        <td>{{ $contact->id }}</td>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->message }}</td>
                                        <td>{{ $contact->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptSource')
@endsection
