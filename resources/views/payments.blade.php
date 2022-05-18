@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Payments</h1>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <form action="{{ route('add-payment') }}" method="post">
                        <div class="card-body">
                            <h4 class="card-text mb-3">Add payments</h4>
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
                                    <option value="" selected>Select Project</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}" name="project_id">Project
                                            ID: {{ $project->id }} - {{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="text" name="amount" id="amount" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="" selected>Select Type</option>
                                    @foreach ($payment_types as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                    {{-- <option value="advance_payment">Advance Payment</option>
                                    <option value="retention_payment">Retention Payment</option>
                                    <option value="installment_payment">Installment Payment</option> --}}
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="payment" class="form-label">Payment Method</label>
                                <select name="payment_method" id="payment_method" class="form-control">
                                    <option value="" selected>Select Method</option>
                                    @foreach ($payment_methods as $method)
                                        <option value="{{ $method }}">{{ $method }}</option>
                                    @endforeach
                                    {{-- <option value="cash">Cash</option>
                                    <option value="cheque">Cheque</option>
                                    <option value="bank_transfer">Bank Transfer</option> --}}
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="received_date" class="form-label">Received Date</label>
                                <input type="date" name="received_date" id="received_date" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="remarks" class="form-label">Remarks</label>
                                <input type="text" name="remarks" id="remarks" class="form-control">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Add Payment</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover" id="payments-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Project ID</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Method</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{ $payment->id }}</td>
                                        <td>{{ $payment->project_id }}</td>
                                        <td>{{ $payment->amount }}</td>
                                        <td>{{ $payment->type }}</td>
                                        <td>{{ $payment->payment_method }}</td>
                                        <td>{{ $payment->received_date }}</td>
                                        <td>
                                            <a href="{{ route('edit-payment', $payment->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('delete-payment', $payment->id) }}" method="post"
                                                onsubmit="return confirm('Are you sure you need to delete this payment record?\n\nPlease note that all the associated values too will be deleted.')">
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
            $('#payments-table').DataTable();
        });
    </script>
@endsection
