@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Members</h1>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <form action="{{ route('add-member') }}" method="post">
                        <div class="card-body">
                            <h4 class="card-text mb-3">Create New Member</h4>
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
                                <label for="name" class="form-label">Member Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" id="address">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="text" class="form-control" name="email" id="email">
                            </div>

                            <div class="mb-3">
                                <label for="telephone" class="form-label">Telephone Number</label>
                                <div class="col-lg-5">
                                    <input type="text" class="form-control" name="telephone" id="telephone">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="whatsapp_number" class="form-label">Whatsapp Number</label>
                                <div class="col-lg-5">
                                    <input type="text" class="form-control" name="whatsapp_number" id="whatsapp_number">
                                </div>
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
                        <table class="table table-bordered table-striped table-hover" id="members-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Telephone</th>
                                    <th>Whatsapp</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($members as $member)
                                    <tr>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->address }}</td>
                                        <td>{{ $member->email }}</td>
                                        <td>{{ $member->telephone }}</td>
                                        <td>{{ $member->whatsapp_number }}</td>
                                        <td>
                                            <a href="{{ route('edit-member', $member->id) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('delete-member', $member->id) }}" method="post"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you need to delete this member?\n\nPlease note that all the associated values too will be deleted.')">
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
            $('#members-table').DataTable();
        });
    </script>
@endsection
