@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        Get Projects By Client
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="client" class="form-label" id="testId">Select Client</label>
                            <select name="clients" id="clientCombo" class="form-control">
                                <option value="">no data-</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="project" class="form-label">Projects</label>
                            <select name="projects" id="projects" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <table id="payments" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Method</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script>
        $(function() {
            clientCombo(function() {
                projectCombo($('#clientCombo').val(), function(){
                    paymentsTable($('#projects').val());
                });
            });
        });


        //callback method in clients
        $('#clientCombo').change(function() {
            projectCombo($('#clientCombo').val());
        });
        //callback method in projects
        $('#projects').change(function(){
            paymentsTable($('#projects').val());
        });   

        // function test(params) {
        //     $('#testId').html('test lable');
        // }

        function clientCombo(callBack) {
            var options = '';
            $.ajax({
                type: "GET",
                url: "/api/get/clients",
                data: null,
                cache: false,
                success: function(data) {
                    if (data.length == 0 || data == undefined) {
                        options = "<option>No Data</option>"
                    } else {
                        $.each(data, function(key, val) {
                            options += '<option value="' + val.id + '">' + val.name + '</option>';
                        });
                    }
                    $('#clientCombo').html(options);
                    // if(typeof callback === 'function') {
                    //     callBack();
                    // }
                    callBack();
                }
            });
        }

        function projectCombo(client_id, callBack) {
            var options = '';
            $.ajax({
                type: "GET",
                url: "/api/get/project_by_client/" + client_id,
                data: null,
                cache: false,
                success: function(data) {
                    if (data.length == 0 || data == undefined) {
                        options = "<option>No Data</option>"
                    } else {
                        $.each(data, function(key, val) {
                            options += '<option value="' + val.id + '">' + val.name + '</option>';
                        });
                    }
                    $('#projects').html(options);
                    callBack();
                }
            });
        }

        function paymentsTable(project_id) {
            var row = '';
            $.ajax({
                type: "GET",
                url: "/api/get/payments_by_project/" + project_id,
                data: null,
                cache: false,
                success: function(data) {
                    console.log(data);
                    if (data.length == 0 || data == undefined) {
                        row = "<tr><td>No Data</td></tr>"
                    } else {
                        $.each(data, function(key, val) {
                            row += '<tr><td>' + val.id + '</td><td>' + val.received_date + '</td><td>' +
                                val.type + '</td><td>' + val.payment_method + '</td><td>' + val.amount +
                                '</td></tr>';
                        });
                    }
                    $('#payments tbody').html(row);
                }
            });
        }
    </script>
@endsection
