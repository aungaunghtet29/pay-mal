@extends('backend.layouts.app')

@section('title' , 'Dashboard')

@section('page-title' , 'Admin Dashboard')

@section('icon' , 'pe-7s-display2')

@section('admin-home' , 'mm-active')


@section('content')
    <div class="admin-home pt-3">
        <div class="d-flex">
            <div class="col-2"></div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body user-left">
                        <img src="{{ asset('img/group.png') }}" alt=""> <span class="text-muted">Users</span>
                        <h2 class="text-center">{{ number_format($users) }}</h2>

                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-body admin-left">
                        <img src="{{ asset('img/admin.png') }}" alt=""> <span class="text-muted">Admins</span>
                        <h2 class="text-center">{{ number_format($adminUsers) }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>




        </div>
    </div>
@endsection
