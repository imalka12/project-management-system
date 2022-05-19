@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Project Payments</h1>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                @foreach ($projects as $project)
                    <div class="card mb-5 shadow-lg">
                        <div class="card-header">
                            {{ $project->name }}
                        </div>
                        <div class="card-body">
                            <p>
                                Total Amount: {{ $project->amount }} <br>
                                @foreach ($project->payments as $payment)
                                    Payments: {{ $payment->amount }} <br>
                                @endforeach
                            </p>
                            <p>Total paid: {{ $project->payments()->sum('amount') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
