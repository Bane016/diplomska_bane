@extends('layouts.app')
@section("styles")
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.21.0/slimselect.min.css" rel="stylesheet">
    <style>
        .my-bids-card {
            background-color: #E5E7E2;
            box-shadow: none !important;
        }

        .dropbtn {
            background-color: #3d464d;
            border: none;
            color: white;
            padding: 5px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }

        .button1 {
            border-radius: 50%;
        }

        .dropdown-bids {
            position: relative;
            display: inline-block;
            /*box-shadow: 0px 4px 4px 0px;*/
        }

        .dropdown-bids-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 100px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-bids-content a {
            color: black;
            padding: 6px 10px;
            text-decoration: none;
            display: block;
            border-radius: 0;
        }

        .dropdown-bids-content a:hover {
            opacity: .8;
        }

        .dropdown-bids:hover .dropdown-bids-content {
            display: block;
            right: 0;
        }

        /*.dropdown:hover .dropbtn {*/
        /*    background-color: #3e8e41;*/
        /*}*/
        .dropdown-bids:hover .dropbtn {
            background-color: #376e37;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card border-0 my-bids-card col-md-12 pl-2" style="background-color: white">
            <br>
            <div class="col-md-12 col-lg-12" id="new-ads">
                <div class="row pl-3">
                    <div class="btn-group ">
                        <button class="btn btn-primary " id="create-new-ads"
                                style="background-color: green;
                     border-left: green;
                     border-bottom: green;
                     border-top: green;
                     border-right: green;">
                            <i class="fas fa-ad"> {{ __("Create new ad") }}</i>
                        </button>
                    </div>
                </div>
            </div>
            <br>
            <div class="row p-3">
                @if($my_bids)
                    @foreach($my_bids as $key => $my_bid)
                        <div class="col-md-3 mb-3"
                             style="border-color: black;">
                            <div class="card-header"
                                 style="background-color: #3d464d; text-align: left">
                                <label class="label-text col-lg-9 text-white">
                                    <h5 class="font-weight-bold">{{$my_bid['name']}}</h5>
                                </label>
                                <div class="dropdown-bids float-right">
                                    <button class="dropbtn button1">
                                        <i class="fa fa-ellipsis-v text-white text-right"></i>
                                    </button>
                                    <div class="dropdown-bids-content rounded">
                                        <a class="popup open-edit-ads btn btn-success text-white btn-sm rounded-top"
                                           data-ad_id="{{$my_bid['id']}}"
                                           data-ad_name="{{$my_bid['name']}}"
                                           data-ad_price="{{$my_bid['price']}}"
                                           data-ad_category="{{$my_bid['category']}}"
                                           data-ad_description="{{$my_bid['description']}}">Edit</a>
                                        <a class="popup delete-ads btn btn-danger text-white btn-sm w-100 rounded-bottom"
                                           data-ad_id="{{$my_bid['id']}}">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body col-md12 p-3"
                                 style="background: #616d74;">
                                <div class="row pl-3">
                                    <label class="text-white">
                                        Category: {{$my_bid['category']}}
                                    </label>
                                </div>
                                <div class="row pl-3">
                                    <label class="text-white">
                                        Price: {{$my_bid['price']}} $
                                    </label>
                                </div>
                                <div class="row pl-3">
                                    <label class="text-white">
                                        Description:
                                        <br>
                                        <?php echo nl2br(htmlspecialchars($my_bid['description'])); ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="addAd" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content -->
            <div class="modal-content color_white">
                <div class="modal-header">
                    <label class="label-text"><h5>{{ __("Create new ad") }}</h5></label>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <form id="add-new-ad">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label class="label-text"
                                           for="adName">{{ __("Name") }}</label>
                                    <input type="text"
                                           class="form-control border-top-0 border-left-0 border-right-0 pl-0"
                                           id="ad_name" name="ad_name"
                                           placeholder="{{ __("Name") }}"
                                           value="">
                                    <span style="display: none;" id="error-ad_name"
                                          class="text-danger"
                                          role="alert"></span>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="label-text"
                                           for="adPrice">{{ __("Price") }} ($)</label>
                                    <input type="text"
                                           class="form-control border-top-0 border-left-0 border-right-0 pl-0"
                                           id="ad_price" name="ad_price"
                                           placeholder="{{ __("Price") }}"
                                           value="">
                                    <span style="display: none;" id="error-ad_price"
                                          class="text-danger"
                                          role="alert"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label-text"
                                   for="adCategory">{{ __("Category") }}</label>
                            <select type="text"
                                    class="border-top-0 border-left-0 border-right-0 pl-0"
                                    id="ad_category" name="ad_category">
                                <optgroup label="Vehicle">
                                    <option value="Bicycle">Bicycle</option>
                                    <option value="Cars">Cars</option>
                                    <option value="Trucks">Trucks</option>
                                    <option value="Motorcycle">Motorcycle</option>
                                </optgroup>
                                <optgroup label="Electronics">
                                    <option value="PC_Components">PC Components</option>
                                    <option value="Audio_equipment">Audio equipment</option>
                                    <option value="Video_equipment">Video equipment</option>
                                    <option value="Mobile_phones">Mobile phones</option>
                                </optgroup>
                                <optgroup label="Home&Garden">
                                    <option value="Major_appliance">Major appliance</option>
                                    <option value="Furniture">Furniture</option>
                                    <option value="Building_materials">Building materials</option>
                                </optgroup>
                                <optgroup label="Sport">
                                    <option value="Sport_equipment">Sport equipment</option>
                                    <option value="Sport_clothes">Sport clothes</option>
                                    <option value="Sport_footwear">Sport footwear</option>
                                </optgroup>
                            </select>
                            <span style="display: none;" id="error-ad_category"
                                  class="text-danger"
                                  role="alert"></span>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 col-sm-12">
                                <label class="label-text"
                                       for="adDescription">{{ __("Description") }}</label>
                            </div>
                            <div class="col-md-12 col-sm-12">
                            <textarea class="form-control"
                                      id="ad_description" name="ad_description"
                                      placeholder="{{ __("Description") }}"
                                      rows="3"></textarea>
                                <strong style="display: none;"
                                        class="text-danger error-ad-description"></strong>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-5">
                            <button class="btn btn-secondary" id="cancel-ads"
                                    style="min-width: 30px;">{{ __("Cancel") }}</button>
                        </div>
                        <div class="col-md-7">
                            <button type="submit" id="submit-form-ads"
                                    class="btn btn-primary"
                                    style="min-width: 50px; text-align:center; background-color: green;
                                    border-left: green;
                                    border-bottom: green;
                                    border-top: green;
                                    border-right: green;">{{ __("Create ad") }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editAd" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content color_white">
                <div class="modal-header">
                    <label class="label-text"><h5>{{ __("Edit selected ad") }}</h5></label>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <form id="edit-ads-form">
                    <div class="modal-body">
                        <input type="hidden" name="ad_id" id="ad_id_edit">
                        <div class="form-group">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label class="label-text"
                                           for="adName">{{ __("Name") }}</label>
                                    <input type="text"
                                           class="form-control border-top-0 border-left-0 border-right-0 pl-0"
                                           id="ad_name_edit" name="ad_name_edit"
                                           placeholder="{{ __("Name") }}"
                                           value="">
                                    <span style="display: none;" id="error-ad_name"
                                          class="text-danger"
                                          role="alert"></span>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="label-text"
                                           for="adPrice">{{ __("Price") }} ($)</label>
                                    <input type="text"
                                           class="form-control border-top-0 border-left-0 border-right-0 pl-0"
                                           id="ad_price_edit" name="ad_price_edit"
                                           placeholder="{{ __("Price") }}"
                                           value="">
                                    <span style="display: none;" id="error-ad_price"
                                          class="text-danger"
                                          role="alert"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label-text"
                                   for="adCategory">{{ __("Category") }}</label>
                            <select type="text"
                                   id="ad_category_edit" name="ad_category_edit">

                                <optgroup label="Vehicle">
                                    <option value="Bicycle">Bicycle</option>
                                    <option value="Cars">Cars</option>
                                    <option value="Trucks">Trucks</option>
                                    <option value="Motorcycle">Motorcycle</option>
                                </optgroup>
                                <optgroup label="Electronics">
                                    <option value="PC_Components">PC Components</option>
                                    <option value="Audio_equipment">Audio equipment</option>
                                    <option value="Video_equipment">Video equipment</option>
                                    <option value="Mobile_phones">Mobile phones</option>
                                </optgroup>
                                <optgroup label="Home&Garden">
                                    <option value="Major_appliance">Major appliance</option>
                                    <option value="Furniture">Furniture</option>
                                    <option value="Building_materials">Building materials</option>
                                </optgroup>
                                <optgroup label="Sport">
                                    <option value="Sport_equipment">Sport equipment</option>
                                    <option value="Sport_clothes">Sport clothes</option>
                                    <option value="Sport_footwear">Sport footwear</option>
                                </optgroup>
                            </select>
                            <span style="display: none;" id="error-ad_category"
                                  class="text-danger"
                                  role="alert"></span>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 col-sm-12">
                                <label class="label-text"
                                       for="adDescription">{{ __("Description") }}</label>
                            </div>
                            <div class="col-md-12 col-sm-12">
                            <textarea class="form-control"
                                      id="ad_description_edit" name="ad_description_edit"
                                      placeholder="{{ __("Description") }}"
                                      rows="3"></textarea>
                                <strong style="display: none;"
                                        class="text-danger error-ad-description"></strong>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="alert alert-block"
                                     id="alert-response-edit-ads"
                                     style="display: none;"></div>
                                <button type="button" class="close"
                                        data-dismiss="alert">x
                                </button>
                                <strong></strong>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-secondary ml-sm-3" id="cancel-edit-ads"
                                    style="min-width: 30px;">{{ __("Cancel") }}</button>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary edit-ads"
                                    id="edit-ads"
                                    style="min-width: 50px; text-align:center; background-color: green;
                                    border-left: green;
                                    border-bottom: green;
                                    border-top: green;
                                    border-right: green;">Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteAd" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content color_white">
                <div class="modal-header">
                    <label class="label-text"><h5>{{ __("Delete selected ad") }}</h5></label>
                    <button type="button" class="close" data-dismiss="modal">x</button>
                </div>
                <div class="modal-body">
                    <h5 class="modal-text" style="word-break: break-word">This Ad will be removed. Do you want to
                        proceed?</h5>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="alert alert-block" id="alert-response-delete-ad" style="display: none;">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong></strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-primary yes_ad ml-ms-3" id="yes_ad"
                                    style="min-width: 30px;">Yes
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" id="no_ad" class="btn btn-secondary"
                                    data-dismiss="modal"
                                    style="min-width: 30px;">No
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("scripts")

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

            let category = new SlimSelect({
                select: "#ad_category"
            });
            let category_edit = new SlimSelect({
                select: "#ad_category_edit"
            });

            $('#create-new-ads').on('click', function () {

                $('#cancel-ads').on('click', function () {
                    $('#addAd').modal('hide');
                });

                $('#addAd').modal('show');
            });

            $('#submit-form-ads').on('click', function (e) {
                e.preventDefault();
                var form_data = new FormData();
                let fields = $("#add-new-ad").serializeArray();
                // console.log(fields);

                fields.forEach(function (el) {
                    form_data.append(el.name, el.value);
                });

                $.ajax({
                    method: "POST",
                    url: "{{route("user.add.ad")}}",
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: form_data,
                    success: function (data) {
                        let modal_response = $('#alert-response-add-ad');
                        if (data.success) {
                            modal_response.removeClass("alert-danger");
                            modal_response.addClass("alert-success").show();
                            $("#alert-response-add-ad > strong").text(data.message);
                            setTimeout(function () {
                                $("#alert-response-add-ad").fadeOut('slow');
                            }, 2000);
                            setTimeout(function () {
                                $("#addAd").modal("hide");
                            }, 3000)
                        } else {
                            modal_response.removeClass("alert-success");
                            modal_response.addClass("alert-danger").show();
                            $("#alert-response-add-ad > strong").text(data.message);
                            setTimeout(function () {
                                $("#alert-response-add-ad").fadeOut('slow');
                            }, 2000);
                        }
                    },
                    error: function (response) {
                        if (response.status === 401) {
                            $(".response-message").text("You're have some problems with add ads.").addClass("text-danger").show();
                            setTimeout(function () {
                                $(".response-message").text('').removeClass("text-danger").hide();
                            }, 3000)
                        } else {
                            let errors = response.responseJSON.errors;
                            for (let key in errors) {
                                $(".error-" + key).text(errors[key]).show();
                                setTimeout(function () {
                                    $(".error-" + key).text('').fadeOut()
                                }, 3000)
                            }
                        }
                    }
                })
            });

            $('.open-edit-ads').on('click', function () {

                let ad_id = $(this).data("ad_id");
                category = $(this);

                let ad_name_edit = $(this).data("ad_name");
                $("#ad_name_edit").val(ad_name_edit);

                let ad_price_edit = $(this).data("ad_price");
                $("#ad_price_edit").val(ad_price_edit);

                let ad_category_edit = $(this).data("ad_category");
                $("#ad_category_edit").val(ad_category_edit);

                let ad_description_edit = $(this).data("ad_description");
                $("#ad_description_edit").val(ad_description_edit);

                $('#ad_category_edit').each(function () {
                    $(this).prop("selected", true);
                });
                category_edit.set($('#ad_category_edit').val());

                $.ajax({
                    url: `{{ route('user.get.ad.info') }}`,
                    method: 'POST',
                    data: {
                        'id': ad_id
                    },
                    success: function (response) {

                    },
                    error: function (error) {
                        let errors = error.responseJSON.errors;
                        for (let key in errors) {
                            $("#edit-ad-error-" + key).text(errors[key]).show();
                            setTimeout(function () {
                                $("#edit-ad-error-" + key).hide();
                            }, 5000)
                        }
                    }
                })

                $('#cancel-edit-ads').on('click', function () {
                    $('#editAd').modal('hide');
                });

                $('#editAd').modal('show');
            });

            $('.edit-ads').on('click', function (e) {
                e.preventDefault();
                $("#ad_id_edit").val(category.data("ad_id"));
                let fields = $("#edit-ads-form").serializeArray();
                $.ajax({
                    url: `{{ route('user.edit.ads') }}`,
                    method: 'POST',
                    data: fields,
                    success: function (data) {
                        let modal_response = $('#alert-response-edit-ads');
                        if (data.success) {
                            modal_response.removeClass("alert-danger");
                            modal_response.addClass("alert-success").show();
                            $('#alert-response-edit-ads > strong').text(data.message);
                            setTimeout(function () {
                                $('#alert-response-edit-ads').fadeOut('slow');
                            }, 2000);
                            setTimeout(function () {
                                $('#editAd').modal('hide');
                            }, 3000)
                        } else {
                            modal_response.removeClass("alert-success");
                            modal_response.addClass("alert-danger").show();
                            $('#alert-response-edit-ads > strong').text(data.message);
                            setTimeout(function () {
                                $('#alert-response-edit-ads').fadeOut('slow');
                            }, 2000);
                        }
                    },
                    error: function (error) {
                        let errors = error.responseJSON.errors;
                        for (let key in errors) {
                            $("#edit-ad-error-" + key).text(errors[key]).show();
                            setTimeout(function () {
                                $("#edit-ad-error-" + key).hide();
                            }, 5000)
                        }
                    },
                });
            });

            $(document).on('click', '.delete-ads', function () {

                id = $(this).attr('data-ad_id');

                delete_btn = $(this);

                $('.yes_ad').attr('data-value', id);

                $('#deleteAd').modal('show');
            });

            $('.yes_ad').on('click', function () {

                $.ajax({
                    url: `{{ route('user.delete.ads') }}`,
                    method: `POST`,
                    dataType: `JSON`,
                    data: {
                        'id': id
                    },
                    success: function (data) {
                        let modal_response = $('#alert-response-delete-ad');
                        if (data.success) {
                            modal_response.removeClass("alert-danger");
                            modal_response.addClass("alert-success").show();
                            $('#alert-response-delete-ad > strong').text(data.message);
                            setTimeout(function () {
                                $('#alert-response-delete-ad').fadeOut('slow');
                            }, 2000);
                            setTimeout(function () {
                                $('.alert-success').hide();
                                $('#deleteAd').modal('hide');
                            }, 3000)
                        } else {
                            modal_response.removeClass("alert-danger");
                            modal_response.addClass("alert-success").show();
                            $('#alert-response-delete-ad > strong').text(data.message);
                            // setTimeout(function () {
                            //     $('#alert-response-delete-alarms').fadeOut('slow');
                            // }, 2000)
                        }

                    }
                });
            });

            $('#no_ad').on('click', function () {
                $('#deleteAd').modal();
            });

        });
    </script>
@endsection
