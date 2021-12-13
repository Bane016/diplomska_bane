@extends('layouts.admin-app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.21.0/slimselect.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <br>
                <div class="card pl-2" id="usersContent">
                    <br>
                    <table id="users"
                           class="table table-hover"
                           width="100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>City</th>
                            <th>Mobile number</th>
                            <th>Email</th>
                            <th>Personal number</th>
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
    <div class="modal fade pt-5" id="userModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content -->
            <div class="modal-content color_white">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h5 class="modal-text" style="word-break: break-word"></h5>
                </div>
                <div class="modal-footer">
                    <button id="yes" class="btn btn-primary" data-dismiss="modal">Yes</button>
                    <button id="no" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.21.0/slimselect.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let table = $('#users').DataTable({
                responsive: true,
                // lengthChange: false,
                "processing": false,
                "lengthMenu": [5, 10, 15, 25],
                ajax: {
                    url: `{{ route('admin.get.users') }}`,
                    method: 'POST',
                    dataType: 'json',
                },
                columns: [
                    {
                        render: function (data, type, full, meta) {
                            return full.name;
                        }
                        // data: "name"
                    },
                    {
                        render: function (data, type, full, meta) {
                            return full.surname;
                        }
                        // data: "surname"
                    },
                    {
                        render: function (data, type, full, meta) {
                            return full.city;
                        }
                    },
                    {
                        render: function (data, type, full, meta) {
                            return full.mobile_number;
                        }
                    },
                    {
                        render: function (data, type, full, meta) {
                            return full.email;
                        }
                    },
                    {
                        render: function (data, type, full, meta) {
                            return full.personal_number;
                        }
                    },
                    {
                        render:function (data, type, full, meta) {
                            return `<a class="popup user_delete btn btn-danger text-white btn-sm" data-user_id="${full.id}"><i class="far fa-trash-alt"></i></a>`
                        }
                    }
                ],
                "initComplete": function (settings, json) {

                }
            });

            $(document).on('click', '.user_delete', function () {
                user_id =$(this).attr('data-user_id');
                delete_btn = $(this);
                $('#yes').attr('data-value', user_id);
                $('.modal-text').text('This user will be removed from database. Do you want to proceed?');
                $('#userModal').modal();
            });
            $('#yes').on('click', function () {
                $.ajax({
                    url: `{{ route('admin.user.delete') }}`,
                    method: `POST`,
                    async: false,
                    dataType: `JSON`,
                    data: {
                        'user_id': user_id
                    },
                    success: function (data) {
                        if (data.status != 'success') {
                            $('#error-ad_category').text()
                        } else  {
                            table.ajax.reload(null,false)
                        }
                    },
                    error: function (result) {

                    },
                })
            });
            $('#no').on('click', function () {
                $('#userModal').modal();
            });

        });
    </script>
@endsection
