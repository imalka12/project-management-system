@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Select Project Members</h1>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <form action="" method="post">
                    <div class="card-body">
                        <h4 class="card-text mb-3">Select members for </h4>
                        @csrf
                        <div class="mb-3">
                            <label for="group_members" class="form-label">Group Members</label>
                            
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary col-4" type="submit">Create</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection