@extends('backend.layouts.app')

@section('title', 'Users Wallet')

@section('page-title', 'Users Wallet')

@section('icon', 'pe-7s-wallet')
@section('users-wallet', 'mm-active')

@section('content')

    <div class="pt-3 admin-table-css">



        <div class="content pt-3 py-3">
            <div class="card custom-card">
                <div class="card-body">
                    <table class="table table-bordered" id="user_wallet">
                        <thead>
                            <th>Account Owner</th>
                            <th>Account Number</th>
                            <th>Amount (MMK)</th>

                            <th>Created At</th>
                            <th>Updated At</th>
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
                var table = $('#user_wallet').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "wallet/datatables/server",
                    "columns": [{
                            data: "account_owner",
                            name: "account_owner"
                        },
                        {
                            data: "account_number",
                            name: "account_number"
                        },
                        {
                            data: "amount",
                            name: "amount",
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
                            data: "updated_at",
                            name: "updated_at",
                            searchable: false,
                        },
                    ]
                });


            });
        </script>
    @endsection
