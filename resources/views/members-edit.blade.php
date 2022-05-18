@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Members</h1>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <form action="{{ route('update-member', $member->id) }}" method="post">
                        <div class="card-body">
                            <h4 class="card-text mb-3">Edit Member Details</h4>
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Member Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ $member->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" id="address"
                                    value="{{ $member->address }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="text" class="form-control" name="email" id="email"
                                    value="{{ $member->email }}">
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="telephone" class="form-label">Telephone Number</label>
                                    <input type="text" class="form-control" name="telephone" id="telephone"
                                        value="{{ $member->telephone }}">
                                </div>
                                <div class="col-lg-4 mx-5">
                                    <label for="whatsapp_number" class="form-label">Whatsapp Number</label>
                                    <input type="text" class="form-control" name="whatsapp_number" id="whatsapp_number"
                                        value="{{ $member->whatsapp_number }}">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary col-4" type="submit">Update Member</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
