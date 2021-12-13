@extends('layouts.admin-app')

@section('styles')

@endsection
@section('content')
    <br>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><b>Profile Settings</b></div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="name" class=" col-form-label text-md-right"><b>Name</b></label>
                            <input type="text"
                                   class="form-control border-right-0 border-left-0 border-top-0 pl-0"
                                   name="name"
                                   id="name"
                                   placeholder="Name"
                                   value="{{(auth()->user()->name == null) ? "" : auth()->user()->name}}">
                            <span style="display: none" id="name-error" class="text-danger"
                                  role="alert"></span>
                        </div>
                        <div class="col-md-4">
                            <label for="surname" class=" col-form-label text-md-right"><b>Surname</b></label>
                            <input type="text"
                                   class="form-control border-right-0 border-left-0 border-top-0 pl-0"
                                   name="surname"
                                   id="surname"
                                   placeholder="Surname"
                                   value="{{(auth()->user()->surname == null) ? "" : auth()->user()->surname}}">
                            <span style="display: none" id="surname-error" class="text-danger"
                                  role="alert"></span>
                        </div>
                        <div class="col-md-4">
                            <label for="email" class=" col-form-label text-md-right"><b>E-Mail</b></label>
                            <input type="text"
                                   class="form-control border-right-0 border-left-0 border-top-0 pl-0"
                                   name="email"
                                   id="email"
                                   placeholder="E-Mail"
                                   value="{{(auth()->user()->email == null) ? "" : auth()->user()->email}}">
                            <span style="display: none" id="email-error" class="text-danger"
                                  role="alert"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button id="save-profile-btn" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script>
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            let admin_email = $("#email"), name = $("#name"), surname = $("#surname");

            $("#save-profile-btn").on('click', function () {
                var form_data = new FormData();
                form_data.append("name", name.val());
                form_data.append("surname", surname.val());
                form_data.append("email", admin_email.val());
                $.ajax({
                    method: "post",
                    url: "{{route('admin.edit-profile')}}",
                    processData: false,
                    contentType: false,
                    data: form_data,
                }).done(function (data) {
                    if (data.success) {
                        $("#success-message").find("span").text(data.success.message);
                        $("#success-message").fadeIn();
                        setTimeout(function () {
                            $("#success-message").fadeOut();
                        }, 2000)
                    }
                    if (data.error) {
                        $("#email-error").text(data.error.message);
                        $("#email-error").show();
                        setTimeout(function () {
                            $("#email-error").fadeOut();
                        }, 2000)
                    }
                })
            });
        });
    </script>
@endsection
