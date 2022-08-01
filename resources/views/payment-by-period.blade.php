@extends('layouts.report')

@section('contents')
<h4 class="card-text mb-2">
    Payment Report
</h4>
<h5 class="card-text mb-3">
    Project: {{ $project->name }}
</h5>
<h5 class="card-text mb-3">
    Client: {{ $project->client->name }}
</h5>

<table class="table table-bordered table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>Payment Date</th>
            <th>Payment Type</th>
            <th>Payment Method</th>
            <th>Paid Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payments as $payment)
            @if (empty($payment))
                <tr>
                    <td colspan="5">There are no payments records for this project</td>
                </tr>
            @endif
            <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                <td>{{ $payment->type }}</td>
                <td>{{ $payment->payment_method }}</td>
                <td>{{ $payment->amount }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
