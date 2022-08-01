@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Reports</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <form action="{{ route('payment-report-generate') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <h5 class="card-text mb-3 text-center">
                                Payment report for project
                            </h5>
                            <div class="mb-3">
                                <label for="project" class="form-label">Project</label>

                                <select name="project" id="project" class="form-control">
                                    <option value="">--Select Project--</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <label for="from_date" class="form-label">From</label>
                                    <input type="date" class="form-control" name="from_date" id="from_date">
                                </div>
                                <div class="col-lg-6">
                                    <label for="to_date" class="form-label">To</label>
                                    <input type="date" class="form-control" name="to_date" id="to_date">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary text-center mt-3 mb-2">Generate Report</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
