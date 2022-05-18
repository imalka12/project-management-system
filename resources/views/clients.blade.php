@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Clients</h1>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <form action="{{ route('add-client') }}" method="POST">
                        <div class="card-body">
                            <h4 class="card-text mb-3">Create New Client</h4>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @csrf
                            <div class="mb-3">
                                <label for="clientname" class="form-label">Client Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="companyname" class="form-label">Company Name</label>
                                <input type="text" class="form-control" name="company" id="company">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Company Address</label>
                                <input type="text" class="form-control" name="address" id="address">
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label for="telephone" class="form-label">Telephone</label>
                                <input type="text" class="form-control" name="telephone" id="telephone">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="text" class="form-control" name="email" id="email">
                            </div>
                            <hr class="bg-primary" style="height:4px;">
                            <div class="mb-3">
                                <label for="contact_person" class="form-label">Contact Person Name</label>
                                <input type="text" class="form-control" name="contact_person" id="contact_person">
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label for="contact_person_telephone" class="form-label">Telephone Number</label>
                                <input type="text" class="form-control" name="contact_person_telephone"
                                    id="contact_person_telephone">
                            </div>
                            <div class="mb-3">
                                <label for="contact_person_email" class="form-label">Email Address</label>
                                <input type="text" class="form-control" name="contact_person_email"
                                    id="contact_person_email">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary col-4" type="submit">Create</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover" id="clients-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Telephone</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <td>{{ $client->id }}</td>
                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->address }}</td>
                                        <td>{{ $client->telephone }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>
                                            <a href="{{ route('edit-client' , $client->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('delete-client', $client->id) }}" method="post"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you need to delete this client?\n\nPlease note that all the associated values too will be deleted.')">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#clients-table').DataTable();
        });
    </script>
@endsection
