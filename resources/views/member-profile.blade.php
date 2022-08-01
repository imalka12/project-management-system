@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Member Profile</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <form action="/api/profile/image" method="post" enctype="multipart/form-data" id="form_submit">
                        <div class="card-body">
                            <label for="image" class="form-label">Add member image</label>
                            <input type="file" name="profile_image" id="profile_image" class="form-control">
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary col-4" type="submit" id="save">Save</button>
                        </div>
                    </form>
                </div>
                <div id="output" class="alert alert-info mt-3">Form response will be displayed here.</div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                       <h5>Profile</h5> 
                    </div>
                    <div class="card-body">
                        <img src="" class="img-fluid" style="height: 150px;" alt="" id="my_image">
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-danger col-4 btn_delete" data-id="" type="button" id="Remove">Remove</button>    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>


        function setMemberImage(form) {
            // create new form data object using form
            var data = new FormData(form);   

            // send using ajax
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "{{ route('save.profile.image') }}",
                data: data,
                processData: false,
                contentType: false,
                success: function(data) {
                    var url = '{{ url('storage/profile_images/') }}';
                    $("#my_image").attr("src", url + '/' + data.image);
                    // show output in html element
                    $("#output").html(data);
                    toastr.success('Image saved!')
                    // console.log("SUCCESS : ", data);
                    // console.log("SUCCESS : ", data.image);
                    $("#save").prop("disabled", false);
                    $("#Remove").data('id', data.id);
                },
                error: function(e) {
                    $("#output").html("<strong>Error</strong><br />" + e.responseText);
                    toastr.warning('There is an error!')
                    console.log("ERROR : ", e);
                    $("#save").prop("disabled", false);
                }
            });
        }

        // trigger on form submit event
        $('#form_submit').submit(function(e){
            // prevent default browser form submission
            e.preventDefault();
            // get the form element
            var form = document.getElementById('form_submit');
            // call the set member image function with form element passed
            setMemberImage(form);
        });

        $(document).on('click', ".btn_delete", function(e) {
            let id = $(this).data('id');
            // var url = '{{ url('storage/profile_images/') }}';
            $.ajax({
                type: "delete",
                url: "/api/profile/image/delete/" + id ,
                cache: false,
                success: function(data) {
                    alert("Image deleted");
                    $("#my_image").attr("src", '');
                    $('#Remove').data('id', '');
                }
            });
        });
    </script>
@endsection
