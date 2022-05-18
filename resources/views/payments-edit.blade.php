@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Payments</h1>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <form action="{{ route('update-payment' , $payment->id) }}" method="post">
                    <div class="card-body">
                        <h4 class="card-text mb-3">Edit Payment Details</h4>
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
                            <label for="project_id" class="form-label">Project</label>
                            <select name="project_id" id="project_id" class="form-control">
                                @foreach ($projects as $project)
                                <option value="$payment->project_id" {{ $payment->project_id == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="text" name="amount" id="amount" class="form-control" value="{{ $payment->amount }}">
                        </div>
                         <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select name="type" id="type" class="form-control">
                                @foreach ($payment_types as $type)
                                    <option value="{{ $type }}" {{ $type == $payment->type ? 'selected' : '' }} >{{ $type }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="mb-3">
                            <label for="payment" class="form-label">Payment Method</label>
                            <select name="payment_method" id="payment_method" class="form-control">
                                @foreach ($payment_methods as $method)
                                    <option value="{{ $method }}" {{  $method == $payment->payment_method ? 'selected' : '' }}>{{ $method }}</option>
                                @endforeach 
                            </select>
                        </div> 

                        <div class="mb-3">
                            <label for="received_date" class="form-label">Received Date</label>
                            <input type="date" name="received_date" id="received_date" class="form-control" value="{{ $payment->received_date }}">
                        </div>

                        <div class="mb-3">
                            <label for="remarks" class="form-label">Remarks</label>
                            <input type="text" name="remarks" id="remarks" class="form-control" value="{{ $payment->remarks }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update Payment</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection