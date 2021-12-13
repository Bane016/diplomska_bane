@extends('layouts.admin-app')
@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.21.0/slimselect.min.css" rel="stylesheet">
    <style>

    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <br>
        <div class="card border-0 all-ads-card col-md-12 pl-2" style="background-color: white">
            <br>
            <div class="form-group pl-3">
                <label class="label-text"
                       for="sort_category"></label>
                <select type="text"
                        class="border-top-0 border-left-0 border-right-0 pl-0"
                        id="sort_category" name="sort_category">
                    <option selected value="All">All</option>
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
            <div class="row p-3">
                @if($all_ads)
                    @foreach($all_ads as $key => $all_ad)
                        <div class="col-md-3 mb-3" style="border-color: black">
                            <div class="card-header"
                                 style="background-color: #3d464d; text-align: left">
                                <label class="label-text col-lg-10 text-white">
                                    <h5 class="font-weight-bold">{{$all_ad['name']}}</h5>
                                </label>
                                <button class="popup delete-admin-ads btn btn-danger text-white btn-sm"
                                        data-ad_id="{{$all_ad['id']}}"><h4><i class="far fa-trash-alt"></i></h4>
                                </button>
                            </div>
                            <div class="card-body col-md12 p-3"
                                 style="background: #616d74;">
                                <div class="row pl-3">
                                    <label class="text-white">
                                        Added by: {{$all_ad['users'][0]['name']}} {{$all_ad['users'][0]['surname']}}
                                        <br>
                                        Mobile: {{$all_ad['users'][0]['mobile_number']}}
                                    </label>
                                </div>
                                <br>
                                <div class="row pl-3">
                                    <label class="text-white">
                                        Category: {{$all_ad['category']}}
                                    </label>
                                </div>
                                <div class="row pl-3">
                                    <label class="text-white">
                                        Price: {{$all_ad['price']}} $
                                    </label>
                                </div>
                                <div class="row pl-3">
                                    <label class="text-white">
                                        Description:
                                        <br>
                                        <?php echo nl2br(htmlspecialchars($all_ad['description'])); ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
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
@section('scripts')
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.21.0/slimselect.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let sort_category = new SlimSelect({
                select: "#sort_category",
            });

            $(document).on('click', '.delete-admin-ads', function () {

                id = $(this).attr('data-ad_id');

                delete_btn = $(this);

                $('.yes_ad').attr('data-value', id);

                $('#deleteAd').modal('show');
            });

            $('.yes_ad').on('click', function () {

                $.ajax({
                    url: `{{ route('admin.delete.ads') }}`,
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
