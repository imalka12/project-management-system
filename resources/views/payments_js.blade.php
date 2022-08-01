@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <input type="hidden" name="id" id="id" value="">

                    <div class="card-body">
                        <h4 class="card-text mb-3">Add payments</h4>
                        <div class="mb-3">
                            <label for="project_id" class="form-label">Project</label>
                            <select name="projectCombo" id="projectCombo" class="form-control">
                                <option value="">no data-</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="text" name="amount" id="amount" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select name="type" id="type" class="form-control">
                                @foreach ($payment_types as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="payment" class="form-label">Payment Method</label>
                            <select name="payment_method" id="payment_method" class="form-control">
                                @foreach ($payment_methods as $method)
                                    <option value="{{ $method }}">{{ $method }}</option>
                                @endforeach
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
                        <button type="submit" class="btn btn-primary" id="save">Add Payment</button>
                    </div>
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
    <script>
        $(function() {
            projectCombo();
            paymentsTable();
        });


        function projectCombo() {
            var options = '';
            $.ajax({
                type: "GET",
                url: "/api/get/projects",
                data: null,
                cache: false,
                success: function(data) {
                    if (data.length == 0 || data == undefined) {
                        options = "<option>No Data</option>"
                    } else {
                        $.each(data, function(key, val) {
                            options += '<option value="' + val.id + '">' + val.id + ' - ' + val.name +
                                '</option>';
                        });
                    }
                    $('#projectCombo').html(options);
                }
            });
        }

        function paymentsTable() {
            var row = '';
            $.ajax({
                type: "GET",
                url: "/api/get/payments",
                data: null,
                cache: false,
                success: function(data) {
                    if (data.length == 0 || data == undefined) {
                        row = "<tr><td>No Data</td></tr>"
                    } else {
                        $.each(data, function(key, val) {
                            row += '<tr data-row_id="' + val.id + '">\
                                                                <td>' + val.id + '</td><td>' + val.project_id + '</td>\
                                                                <td>' + val.amount + '</td>\
                                                                <td>' + val.type + '</td>\
                                                                <td>' + val.payment_method + '</td>\
                                                                <td>' + val.received_date + '</td>\
                                                                <td><button class="btn btn-info btn-sm btn-edit"\
                                                                    data-id="' + val.id + '"> Edit </button>\
                                                                <button class="btn btn-danger btn-sm btn-delete"\
                                                                    data-id="' + val.id + '">Delete</button>\
                                                                </td>\
                                                                </tr>';
                        });
                    }
                    $('#payments-table tbody').html(row);
                }
            });
        }
        $("#save").click(function(e) {
            if ($(this).hasClass('btn-update')) {

                // callback for update
                updateClient(function(payment) {

                    var tr = $('tr[data-row_id=' + payment.id + ']');
                    tr.html(`<td>${payment.id}</td>
                        <td>${payment.projectCombo}</td>
                        <td>${payment.amount}</td>
                        <td>${payment.type}</td>
                        <td>${payment.payment_method}</td>
                        <td>${payment.received_date}</td>
                        <td><button class ="btn btn-info btn-sm btn-edit" data-id="${payment.id}"> Edit </button> 
                        <button class="btn btn-danger btn-sm btn-delete" data-id="${payment.id}">Delete</button></td>
        `);

                    $("#name, #company, #address, #telephone, #email, #contact_person, #contact_person_telephone, #contact_person_email")
                        .val('');

                    $('#save').addClass('btn-primary').removeClass('btn-warning btn-update').text('Create');
                });

            } else {
                createPayment(function(payment) {
                    let tr = `<tr data-row_id="${payment.id}">
                        <td>${payment.id}</td>
                        <td>${payment.project_id}</td>
                        <td>${payment.amount}</td>
                        <td>${payment.type}</td>
                        <td>${payment.payment_method}</td>
                        <td>${payment.received_date}</td>
                        <td><button class ="btn btn-info btn-sm btn-edit" data-id="${payment.id}"> Edit </button> 
                            <button class="btn btn-danger btn-sm btn-delete" data-id="${payment.id}">Delete</button></td>
                    </tr>`;

                    $("#payments-table > tbody").append(tr);
                    $("#projectCombo, #amount, #type, #payment_method, #received_date, #remarks").val('');
                });
            }
        });

        //add payment function
        function createPayment(callBack) {
            var formData = {
                project_id: $("#projectCombo").val(),
                amount: $("#amount").val(),
                type: $("#type").val(),
                payment_method: $("#payment_method").val(),
                received_date: $("#received_date").val(),
                remarks: $("#remarks").val(),
            };

            $.ajax({
                type: "POST",
                url: "/api/create/payments",
                data: formData,
                cache: false,
                success: function(data) {
                    alert("payment successfully added!");
                    callBack(data);
                }
            });
        }

        //delete payment
        $(document).on('click', ".btn-delete", function(e) {
            var id = $(this).data("id");
            var parent = $('tr[data-row_id=' + id + ']');
            $.ajax({
                type: "delete",
                url: "/api/payment/delete/" + id,
                cache: false,
                success: function(data) {
                    alert("Payment record deleted");
                    parent.remove();
                }
            });
        });

        //get one payment
        $(document).on('click', ".btn-edit", function(e) {
            var id = $(this).data("id");

            $.ajax({
                type: "get",
                url: "/api/payment/" + id,
                cache: false,
                success: function(data) {
                    $('#id').val(data.id);
                    $('#projectCombo').val(data.projectCombo);
                    $('#amount').val(data.amount);
                    $('#type').val(data.type);
                    $('#payment_method').val(data.payment_method);
                    $('#received_date').val(data.received_date);
                    $('#remarks').val(data.remarks);

                    $('#save').removeClass('btn-primary').addClass('btn-warning btn-update').text(
                        'Update');
                }
            });
        });

        //update function
        function updatePayment(callBack) {
            var id = $('#id').val();

            var formData = {
                project_id: $("#projectCombo").val(),
                amount: $("#amount").val(),
                type: $("#type").val(),
                payment_method: $("#payment_method").val(),
                received_date: $("#received_date").val(),
                remarks: $("#remarks").val(),
            };

            $.ajax({
                type: "POST",
                url: "/api/payment/edit/" + id,
                data: formData,
                cache: false,
                success: function(data) {
                    alert("Payment successfully updated!");
                    callBack(data);
                }
            });
        }
    </script>
@endsection
