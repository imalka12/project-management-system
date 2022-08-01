@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-lg-6">
                <div class="card card-body">
                    <form action="{{ route('get.payments.by.date') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="date" class="form-control" aria-label="Recipient's username"
                                aria-describedby="button-addon2" name="received_date" id="received_date">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                        </div>

                    </form>
                </div>
            </div>
            @if (!empty($payment))
                <div class="col-lg-6">
                    <div class="card card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Type</th>
                                <td>{{ $payment->type }}</td>
                            </tr>
                            <tr>
                                <th>Amount</th>
                                <td>{{ $payment->amount }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            @endif
        </div>
        @if (empty($payments))
            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="card card-body bg-primary">
                        No records for selected date
                    </div>
                </div>
            </div>
        @else
            <div class="row mt-4">
                <div class="col-lg-6">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $payment->type }}</td>
                                    <td>
                                        <form action="{{ route('view.payment.details', $payment->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary">View</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
