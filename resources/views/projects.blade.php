@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Projects</h1>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <form action="{{ route('add-project') }}" method="post">
                        <div class="card-body">
                            <h4 class="card-text mb-3">Create New Project</h4>
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
                                <label for="name" class="form-label">Project Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Project Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="" selected>--Select status--</option>
                                    {{-- <option value="pending">Pending</option>
                                        <option value="ongoing">Ongoing</option>
                                        <option value="complete">Complete</option>
                                        <option value="onhold">Onhold</option> --}}
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="total" class="form-label">Total Amount</label>
                                <div class="col-lg-5">
                                    <input type="text" class="form-control" name="amount" id="amount">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="date" name="start_date">
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="date" name="end_date">
                            </div>



                            <div class="mb-3">
                                <label for="client_id" class="form-label">Client</label>
                                <select class="form-control" id="client_id" name="client_id">
                                    <option value="" selected>--Select client--</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="group_members" class="form-label">Group Members</label>
                                @foreach ($members as $member)
                                    <div class="form-check mx-5 my-2">
                                        <input class="form-check-input" type="checkbox" value="{{ $member->id }}"
                                            name="members[]" id="member_{{ $member->id }}">
                                        <label class="form-check-label" for="member_{{ $member->id }}">
                                            {{ $member->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary col-4" type="submit">Create</button>
                </div>
                </form>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover" id="projects-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Project Name</th>
                                    <th>Amount</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Client</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>{{ $project->id }}</td>
                                        <td>{{ $project->name }}</td>
                                        <td>{{ $project->amount }}</td>
                                        <td>{{ $project->start_date }}</td>
                                        <td>{{ $project->end_date }}</td>
                                        <td>{{ $project->client->name }}</td>
                                        <td>
                                            <a href="{{ route('edit-project', $project->id) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('delete-project', $project->id) }}" method="post" 
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you need to delete this project?\n\nPlease note that all the associated values too will be deleted.')">
                                                @csrf
                                                @method('Delete')
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
                $('#projects-table').DataTable();
            });
        </script>
    @endsection
