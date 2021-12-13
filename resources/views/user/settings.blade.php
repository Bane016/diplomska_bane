@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.21.0/slimselect.min.css" rel="stylesheet">
    <style>
        /*input:checked + .slider {*/
        /*    background-color: #c1d62f;*/
        /*}*/
    </style>
@endsection
@section('content')
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
                        <div class="col-md-4">
                            <label for="personal-number" class=" col-form-label text-md-right"><b>Personal
                                    Number</b></label>
                            <input type="text"
                                   class="form-control border-right-0 border-left-0 border-top-0 pl-0"
                                   name="personal-number"
                                   id="personal-number"
                                   placeholder="Personal Number"
                                   value="{{(auth()->user()->personal_number == null) ? "" : auth()->user()->personal_number}}"
                                   readonly>
                            <span style="display: none" id="personal-number-error" class="text-danger"
                                  role="alert"></span>
                        </div>
                        <div class="col-md-4">
                            <label for="mobile-number" class=" col-form-label text-md-right"><b>Mobile
                                    Number</b></label>
                            <input type="text"
                                   class="form-control border-right-0 border-left-0 border-top-0 pl-0"
                                   name="mobile-number"
                                   id="mobile-number"
                                   placeholder="Mobile Number"
                                   value="{{(auth()->user()->mobile_number == null) ? "" : auth()->user()->mobile_number}}">
                            <span style="display: none" id="personal-number-error" class="text-danger"
                                  role="alert"></span>
                        </div>
                        <div class="col-md-4">
                            <label for="city" class=" col-form-label text-md-right"><b>City</b></label>
                            <select type="text"
                                    {{--                                   class="border-right-0 border-left-0 border-top-0 pl-0"--}}
                                    name="city"
                                    id="city"
                            >
                                <option selected
                                        value="{{(auth()->user()->city == null) ? "" : auth()->user()->city}}"></option>
                                <option value="Berovo">Berovo</option>
                                <option value="Bitola">Bitola</option>
                                <option value="Bogdanci">Bbogdanci</option>
                                <option value="Valandovo">Valandovo</option>
                                <option value="Veles">Veles</option>
                                <option value="Gevgelija">Gevgelija</option>
                                <option value="Gostivar">Gostivar</option>
                                <option value="Debar">Debar</option>
                                <option value="Delcevo">Delcevo</option>
                                <option value="Demir Kapija">Demir Kapija</option>
                                <option value="Demir Hisar">Demir Hisar</option>
                                <option value="Kavadarci">Kavadarci</option>
                                <option value="Kicevo">Kicevo</option>
                                <option value="Kocani">Kocani</option>
                                <option value="Kratovo">Kratovo</option>
                                <option value="Kriva Palanka">Kriva Palanka</option>
                                <option value="Krusevo">Krusevo</option>
                                <option value="Kumanovo">Kumanovo</option>
                                <option value="Makedonski Brod">Makedonski Brod</option>
                                <option value="Makedonska Kamenica">Makedonska Kamenica</option>
                                <option value="Negotino">Negotino</option>
                                <option value="Ohrid">Ohrid</option>
                                <option value="Pehcevo">Pehcevo</option>
                                <option value="Prilep">Prilep</option>
                                <option value="Probistip">Probistip</option>
                                <option value="Radovis">Radovis</option>
                                <option value="Resen">Resen</option>
                                <option value="Sveti Nikole">Sveti Nikole</option>
                                <option value="Skopje">Skopje</option>
                                <option value="Struga">Struga</option>
                                <option value="Strumica">Strumica</option>
                                <option value="Tetovo">Tetovo</option>
                                <option value="Stip">Stip</option>
                            </select>
                            <span style="display: none" id="city-error" class="text-danger"
                                  role="alert"></span>
                        </div>
                        {{--                        <div class="col-md-4">--}}
                        {{--                            <label for="city" class=" col-form-label text-md-right"><b>City</b></label>--}}
                        {{--                            <input type="text"--}}
                        {{--                                   class="form-control border-right-0 border-left-0 border-top-0 pl-0"--}}
                        {{--                                   name="city"--}}
                        {{--                                   id="city"--}}
                        {{--                                   placeholder="City"--}}
                        {{--                                   value="{{(auth()->user()->city == null) ? "" : auth()->user()->city}}">--}}
                        {{--                            <span style="display: none" id="city-error" class="text-danger"--}}
                        {{--                                  role="alert"></span>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-3 offset-lg-0 offset-md-4 text-center">
                            <div class="container-upload">
                                <img src="" class="hidden" alt="Uploaded file"
                                                               id="uploadImg" width="100%">
                                <label class="label" for="input"><img
                                        src="{{is_null($image) ? asset("images/addphoto.jpg") : asset($image)}}"
                                        alt=""
                                        srcset=""></label>
                                <div class="input">
                                    <input name="input" id="file" type="file">
                                </div>
                            </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.21.0/slimselect.min.js"></script>
    <script>


        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let city = new SlimSelect({
                select: '#city'
            });

            let user_email = $("#email"), name = $("#name"), surname = $("#surname"),
                user_city = $("#city"), personal_number = $("#personal-number"), mobile_number = $("#mobile-number"),
                img = $("#img");

            $("#save-profile-btn").on('click', function () {
                var file_data = $("file").prop("files")[0];
                var form_data = new FormData();
                form_data.append("name", name.val());
                form_data.append("surname", surname.val());
                form_data.append("personal_number", personal_number.val());
                form_data.append("mobile_number", mobile_number.val());
                form_data.append("city", user_city.val());
                form_data.append("email", user_email.val());
                form_data.append("img", file_data);
                $.ajax({
                    method: "post",
                    url: "{{route('user.edit-profile')}}",
                    processData: false,
                    contentType: false,
                    data: form_data,
                }).done(function (data) {
                    if (data.success) {
                        if (data.image != null) {
                            $("#image-icon").html('<img alt="Profile Pic" src="{{asset('user_images')}}/' + data.image + '" class="avatar-profile">')
                        }
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
                    var container = $('.container-upload'), inputFile = $('#file'), image, btn, txt = 'Browse',
                        txtAfter = 'Update';

                    if (!container.find('#upload').length) {
                        container.find('.input').append('<input type="button" value="' + txt + '" id="upload">');
                        btn = $('#upload');
                        container.prepend('<img src="" class="hidden" alt="Uploaded file" id="uploadImg" width="100%">');
                        image = $('#uploadImg');
                    }
                })
            });
        });

    </script>

@endsection
