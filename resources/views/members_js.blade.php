@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Members</h1>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <input type="hidden" name="id" id="id" value="">

                    <div class="card-body">
                        <h4 class="card-text mb-3">Create New Member</h4>
                        <div class="mb-3">
                            <label for="name" class="form-label">Member Name</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" id="address">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="text" class="form-control" name="email" id="email">
                        </div>

                        <div class="mb-3">
                            <label for="telephone" class="form-label">Telephone Number</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" name="telephone" id="telephone">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="whatsapp_number" class="form-label">Whatsapp Number</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" name="whatsapp_number" id="whatsapp_number">
                            </div>
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
                        <table class="table table-bordered table-striped table-hover" id="members-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Telephone</th>
                                    <th>Whatsapp</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    
    <script>
        $(function() {
            membersTable();
        });

        $("#save").click(function(e) {
            if ($(this).hasClass('btn-update')) {
                // update
                updateMember(function(member) {
                    // get tr with the id
                    var tr = $('tr[data-row_id=' + member.id + ']');
                    tr.html(`<td>${member.id}</td>
                            <td>${member.name}</td>
                            <td>${member.address}</td>
                            <td>${member.email}</td>
                            <td>${member.telephone}</td>
                            <td>${member.whatsapp_number}</td>
                            <td><button class ="btn btn-info btn-sm btn-edit" data-id="${member.id}"> Edit </button> 
                                <button class="btn btn-danger btn-sm btn-delete" data-id="${member.id}">Delete</button></td>
                        `);
                    // reset field values
                    $("#id, #name, #address, #email, #telephone, #whatsapp_number").val('');

                    $('#save').addClass('btn-primary').removeClass('btn-warning btn-update').text('Create');
                });

            } else {
                // save
                createMember(function(member) {
                    console.log(member);
                    let tr = `<tr data-row_id="${member.id}">
                            <td>${member.id}</td>
                            <td>${member.name}</td>
                            <td>${member.address}</td>
                            <td>${member.email}</td>
                            <td>${member.telephone}</td>
                            <td>${member.whatsapp_number}</td>
                            <td><button class ="btn btn-info btn-sm btn-edit" data-id="${member.id}"> Edit </button> 
                                <button class="btn btn-danger btn-sm btn-delete" data-id="${member.id}">Delete</button></td>
                        </tr>`;
                    $("#members-table > tbody").append(tr);

                    $("#name, #address, #email, #telephone, #whatsapp_number").val('');
                });
            }
        });

        function createMember(callBack) {

            var formData = {
                name: $("#name").val(),
                address: $("#address").val(),
                email: $("#email").val(),
                telephone: $("#telephone").val(),
                whatsapp_number: $("#whatsapp_number").val(),
            };
            ajaxRequest('POST', "/api/create/members", formData, function(data) {
                alert("Member successfully added!");
                callBack(data);
            });

            // $.post("/api/create/members", formData, function(data) {
            //     alert("Member successfully added!");
            //     callBack(data);
            // });
        }

        

        function membersTable() {
            var row = '';
            
            // $.get('/api/get/members', function(data) {
            //     if (data.length == 0 || data == undefined) {
            //         row = "<tr><td>No Data</td></tr>"
            //     } else {
            //         $.each(data, function(key, val) {
            //             row += '<tr data-row_id="' + val.id + '">\
            //                         <td>' + val.id + '</td><td>' + val.name + '</td>\
            //                         <td>' + val.address + '</td>\
            //                         <td>' + val.email + '</td>\
            //                         <td>' + val.telephone + '</td>\
            //                         <td>' + val.whatsapp_number + '</td>\
            //                         <td><button class="btn btn-info btn-sm btn-edit"\
            //                                 data-id="' + val.id + '"> Edit </button>\
            //                         <button class="btn btn-danger btn-sm btn-delete"\
            //                                 data-id="' + val.id + '">Delete</button>\
            //                     </td>\
            //                     </tr>';
            //         });
            //     }
            //     $('#members-table tbody').html(row);
            // });

            ajaxRequest('GET', `/api/get/members`, null, function(data) {
                if (data.length == 0 || data == undefined) {
                    row = "<tr><td>No Data</td></tr>"
                } else {
                    $.each(data, function(key, val) {
                        row += '<tr data-row_id="' + val.id + '">\
                                    <td>' + val.id + '</td><td>' + val.name + '</td>\
                                    <td>' + val.address + '</td>\
                                    <td>' + val.email + '</td>\
                                    <td>' + val.telephone + '</td>\
                                    <td>' + val.whatsapp_number + '</td>\
                                    <td><button class="btn btn-info btn-sm btn-edit"\
                                            data-id="' + val.id + '"> Edit </button>\
                                    <button class="btn btn-danger btn-sm btn-delete"\
                                            data-id="' + val.id + '">Delete</button>\
                                </td>\
                                </tr>';
                    });
                }
                $('#members-table tbody').html(row);
            });
        }

        $(document).on('click', ".btn-delete", function(e) {
            var id = $(this).data("id");
            var parent = $('tr[data-row_id=' + id + ']');
           
            ajaxRequest('delete', "/api/member/delete/" + id, null, function(data) {
                alert("Member Deleted");
                parent.remove();
            }, function(error){
                alert(error);
            });
        });

        $(document).on('click', ".btn-edit", function(e) {
            var id = $(this).data("id");

            ajaxRequest('GET', "/api/member/" + id, null, function(data) {
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#address').val(data.address);
                $('#email').val(data.email);
                $('#telephone').val(data.telephone);
                $('#whatsapp_number').val(data.whatsapp_number);

                $('#save').removeClass('btn-primary').addClass('btn-warning btn-update').text(
                    'Update');
            });
        });

        function updateMember(callBack) {
            var id = $('#id').val();

            var formData = {
                name: $("#name").val(),
                address: $("#address").val(),
                email: $("#email").val(),
                telephone: $("#telephone").val(),
                whatsapp_number: $("#whatsapp_number").val(),
            };

            ajaxRequest('POST', "/api/member/edit/" + id, formData, function(data) {
                alert("Member successfully updated!");
                callBack(data);
            });
        }
    </script>
@endsection
