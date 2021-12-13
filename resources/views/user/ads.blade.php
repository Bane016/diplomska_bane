@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.css" rel="stylesheet">
    <style>

    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <br>

        <div class="card border-0 all-ads-card col-md-12 pl-2" style="background-color: white">
            <br>
            <div class="form-group pl-3">
                <label class="label-text" for="category"></label>
                <select type="text" class="border-top-0 border-left-0 border-right-0 pl-0" id="category" name="category">
                    <option value="Bicycle">Bicycle</option>
                    <option value="Cars">Cars</option>
                    <option value="Trucks">Trucks</option>
                    <option value="Motorcycle">Motorcycle</option>
                </select>
                <span style="display: none" id="error-ad_category"
                      class="text-danger"
                      role="alert"></span>
            </div>
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
                                <label class="label-text col-lg-9 text-white">
                                    <h5 class="font-weight-bold">{{$all_ad['name']}}</h5>
                                </label>
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
@endsection
@section('scripts')
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let category = new SlimSelect({
                select: "#category"
            });
            let sort_category = new SlimSelect({
                select: "#sort_category",
            });

        });
@endsection
