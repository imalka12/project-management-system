@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <input type="hidden" name="id" id="id" value="">

                    <div class="card-body">
                        <h4 class="card-text mb-3">Create New Client</h4>

                        <div class="mb-3">
                            <label for="clientname" class="form-label">Client Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="companyname" class="form-label">Company Name</label>
                            <input type="text" class="form-control" name="company" id="company">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Company Address</label>
                            <input type="text" class="form-control" name="address" id="address">
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label for="telephone" class="form-label">Telephone</label>
                            <input type="text" class="form-control" name="telephone" id="telephone">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="text" class="form-control" name="email" id="email">
                        </div>
                        <hr class="bg-primary" style="height:4px;">
                        <div class="mb-3">
                            <label for="contact_person" class="form-label">Contact Person Name</label>
                            <input type="text" class="form-control" name="contact_person" id="contact_person">
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label for="contact_person_telephone" class="form-label">Telephone Number</label>
                            <input type="text" class="form-control" name="contact_person_telephone"
                                id="contact_person_telephone">
                        </div>
                        <div class="mb-3">
                            <label for="contact_person_email" class="form-label">Email Address</label>
                            <input type="text" class="form-control" name="contact_person_email" id="contact_person_email">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary col-4" type="button" id="save">Create</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover" id="clients-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Telephone</th>
                                    <th>Email</th>
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
            clientsTable();
        });

        //save and update
        $("#save").click(function(e) {
            if ($(this).hasClass('btn-update')) {

                // callback for update
                updateClient(function(client) {

                    var tr = $('tr[data-row_id=' + client.id + ']');
                    tr.html(`<td>${client.id}</td>
                            <td>${client.name}</td>
                            <td>${client.address}</td>
                            <td>${client.telephone}</td>
                            <td>${client.email}</td>
                            <td><button class ="btn btn-info btn-sm btn-edit" data-id="${client.id}"> Edit </button> 
                                <button class="btn btn-danger btn-sm btn-delete" data-id="${client.id}">Delete</button></td>
                        `);

                    $("#name, #company, #address, #telephone, #email, #contact_person, #contact_person_telephone, #contact_person_email")
                        .val('');

                    $('#save').addClass('btn-primary').removeClass('btn-warning btn-update').text('Create');
                });

            } else {

                //callback for create
                createClient(function(client) {
                    let tr = `<tr data-row_id="${client.id}">
                            <td>${client.id}</td>
                            <td>${client.name}</td>
                            <td>${client.address}</td>
                            <td>${client.telephone}</td>
                            <td>${client.email}</td>
                            <td><button class ="btn btn-info btn-sm btn-edit" data-id="${client.id}"> Edit </button> 
                                <button class="btn btn-danger btn-sm btn-delete" data-id="${client.id}">Delete</button></td>
                        </tr>`;

                    $("#clients-table > tbody").append(tr);
                    $("#name, #company, #address, #telephone, #email, #contact_person, #contact_person_telephone, #contact_person_email")
                        .val('');
                });
            }
        });

        //get one member
        $(document).on('click', ".btn-edit", function(e) {
            var id = $(this).data("id");

            $.ajax({
                type: "get",
                url: "/api/client/" + id,
                cache: false,
                success: function(data) {
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#company').val(data.company);
                    $('#address').val(data.address);
                    $('#telephone').val(data.telephone);
                    $('#email').val(data.email);
                    $('#contact_person').val(data.contact_person);
                    $('#contact_person_telephone').val(data.contact_person_telephone);
                    $('#contact_person_email').val(data.contact_person_email);

                    $('#save').removeClass('btn-primary').addClass('btn-warning btn-update').text(
                        'Update');
                }
            });
        });

        //create function
        function createClient(callBack) {
            var formData = {
                name: $("#name").val(),
                company: $("#company").val(),
                address: $("#address").val(),
                telephone: $("#telephone").val(),
                email: $("#email").val(),
                contact_person: $("#contact_person").val(),
                contact_person_telephone: $("#contact_person_telephone").val(),
                contact_person_email: $("#contact_person_email").val(),
            };

            $.ajax({
                type: "POST",
                url: "/api/create/clients",
                data: formData,
                cache: false,
                success: function(data) {
                    alert("client successfully added!");
                    callBack(data);
                }
            });
        }

        function clientsTable() {
            var row = '';
            $.ajax({
                type: "GET",
                url: "/api/get/clients",
                data: null,
                cache: false,
                success: function(data) {
                    if (data.length == 0 || data == undefined) {
                        row = "<tr><td>No Data</td></tr>"
                    } else {
                        $.each(data, function(key, val) {
                            row += '<tr data-row_id="' + val.id + '">\
                                    <td>' + val.id + '</td><td>' + val.name + '</td>\
                                    <td>' + val.address + '</td>\
                                    <td>' + val.telephone + '</td>\
                                    <td>' + val.email + '</td>\
                                    <td><button class="btn btn-info btn-sm btn-edit"\
                                            data-id="' + val.id + '"> Edit </button>\
                                    <button class="btn btn-danger btn-sm btn-delete"\
                                            data-id="' + val.id + '">Delete</button>\
                                    </td>\
                                    </tr>';
                        });
                    }
                    $('#clients-table tbody').html(row);
                },
                error: function(err){
                    alert('Failed to load client records. Please try again later.');
                }
            }).done(function(){
                alert('all is done');
            });
        }

        //delete function
        $(document).on('click', ".btn-delete", function(e) {
            var id = $(this).data("id");
            var parent = $('tr[data-row_id=' + id + ']');
            deleteClient(id, function() {
                alert("Client Deleted");
                parent.remove();
            });
        });

        function deleteClient(id, callback) {
            $.ajax({
                type: "delete",
                url: "/api/client/delete/" + id,
                cache: false,
                success: function(res){
                    if(typeof callback == 'function') {
                        callback();
                    }
                }
            });
        }

        //update function
        function updateClient(callBack) {
            var id = $('#id').val();

            var formData = {
                name: $("#name").val(),
                company: $("#company").val(),
                address: $("#address").val(),
                telephone: $("#telephone").val(),
                email: $("#email").val(),
                contact_person: $("#contact_person").val(),
                contact_person_telephone: $("#contact_person_telephone").val(),
                contact_person_email: $("#contact_person_email").val(),
            };

            $.ajax({
                type: "POST",
                url: "/api/client/edit/" + id,
                data: formData,
                cache: false,
                success: function(data) {
                    alert("Client successfully updated!");
                    callBack(data);
                }
            });
        }
    </script>
@endsection
