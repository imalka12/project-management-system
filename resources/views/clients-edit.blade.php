@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Client</h1>
</div>
<div class="container-fluid mx-3">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <form action="{{ route('update-client' , $client->id) }}" method="POST">
                    <div class="card-body">
                        <h4 class="card-text mb-3">Edit Client Details</h4>
                        @csrf
                        <div class="mb-3">
                            <label for="clientname" class="form-label">Client Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $client->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="companyname" class="form-label">Company Name</label>
                            <input type="text" class="form-control" name="company" id="company" value="{{ $client->company }}">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Company Address</label>
                            <input type="text" class="form-control" name="address" id="address" value="{{ $client->address }}">
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label for="telephone" class="form-label">Telephone</label>
                            <input type="text" class="form-control" name="telephone" id="telephone" value="{{ $client->telephone }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="text" class="form-control" name="email" id="email" value="{{ $client->email }}">
                        </div>
                        <hr class="bg-primary" style="height:4px;">
                        <div class="mb-3">
                            <label for="contact_person" class="form-label">Contact Person Name</label>
                            <input type="text" class="form-control" name="contact_person" id="contact_person" value="{{ $client->contact_person }}" >
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label for="contact_person_telephone" class="form-label">Telephone Number</label>
                            <input type="text" class="form-control" name="contact_person_telephone"
                                id="contact_person_telephone" value="{{ $client->contact_person_telephone }}">
                        </div>
                        <div class="mb-3">
                            <label for="contact_person_email" class="form-label">Email Address</label>
                            <input type="text" class="form-control" name="contact_person_email"
                                id="contact_person_email" value="{{ $client->contact_person_email }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary col-4" type="submit">Update Client</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection