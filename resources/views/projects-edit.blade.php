@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Projects</h1>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <form action="" method="post">
                    <div class="card-body">
                        <h4 class="card-text mb-3">Edit Project Details</h4>
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Project Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $project->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Project Status</label>
                            <div class="col-lg-5">
                                <select name="status" id="status" class="form-control">
                                    {{-- <option value="pending" {{ $project->status == 'pending' ? 'selected' : ''}}>Pending</option>
                                    <option value="ongoing" {{ $project->status == 'ongoing' ? 'selected' : ''}}>Ongoing</option>
                                    <option value="complete" {{ $project->status == 'complete' ? 'selected' : ''}}>Complete</option>
                                    <option value="onhold" {{ $project->status == 'onhold' ? 'selected' : ''}}>Onhold</option> --}}
                                    @foreach ($statuses as $status)
                                    <option value="{{ $status }}" {{ $status == $project->status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="total" class="form-label">Total Amount</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" name="amount" id="amount" value="{{ $project->amount }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <label for="date" class="col-sm-2 form-label">Start Date</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="date" name="start_date" value="{{ $project->start_date }}">
                                </div>

                                <label for="date" class="col-sm-2 form-label">End Date</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="date" name="end_date" value="{{ $project->end_date }}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="client_id" class="form-label">Client</label>
                            <select class="form-control" id="client_id" name="client_id">
                                @foreach ($clients as $client)
                                    <option value="{{ $project->client->id }}">{{ $project->client->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- <div class="mb-3">
                            <label for="group_members" class="form-label">Group Members</label>
                            @foreach ($members as $member)
                                <div class="form-check mx-5 my-2">
                                    <input class="form-check-input" type="checkbox" value="{{ $member->id }}" name="members[]" id="member_{{ $member->id }}">
                                    <label class="form-check-label" for="member_{{ $member->id }}">
                                        {{ $member->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div> --}}
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary col-4" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection