@extends('backend.layouts.app')

@section('title', 'Users')

@section('page-title', 'Users')

@section('icon', 'pe-7s-users')
@section('users', 'mm-active')

@section('content')

    <div class="pt-3 admin-table-css">

        <div class="d-flex">
            <div class="col-6">
                <a href="{{ route('admin.user.create') }}" class="btn btn-outline-primary"> <i
                        class="fa fa-plus-circle"></i> Add Users</a>

            </div>

            <div class="col-6 text-right">
                <a href="{{ route('admin.user.create') }}" class="btn btn-outline-danger"> <i
                        class="fa fa-file-export"></i> Export PDF</a>

            </div>
        </div>


    </div>

    <div class="content pt-3 py-3">
        <div class="card custom-card">
            <div class="card-body">
                <table class="table table-bordered" id="user">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>IP</th>
                        <th>User Agent</th>
                        <th>Login At</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
           var table =  $('#user').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "user/datatables/server",
                "columns": [{
                        data: "id",
                        name: "id"
                    },
                    {
                        data: "name",
                        name: "name"
                    },
                    {
                        data: "email",
                        name: "email",
                        sortable: false,
                        searchable: false,
                    },
                    {
                        data: "phone",
                        name: "phone",
                        sortable: false,
                        searchable: false,
                    },
                    {
                        data: "ip",
                        name: "ip",
                        sortable: false,
                        searchable: false,
                    },
                    {
                        data: "user_agent",
                        name: "user_agent",
                        sortable: false,
                        searchable: false,
                    },
                    {
                        data: "login_at",
                        name: "login_at",
                        sortable: false,
                        searchable: false,
                    },
                    {
                        data: "created_at",
                        name: "created_at",
                        sortable: false,
                        searchable: false,
                    },
                    {
                        data: "action",
                        name: "action",
                        sortable: false,
                        searchable: false,
                    },

                ]
            });

            $(document).on('click', '.delete', function(e) {
                e.preventDefault();

                var id = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure to delete this?',
                    showCancelButton: true,
                    confirmButtonText: `Confirm`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            url : '/admin/user/' + id,
                            type : 'delete',
                            success : function(){
                                table.ajax.reload();
                            }
                        });
                    }
                })


            });
        });
    </script>
@endsection
