@extends('backend.layouts.app')

@section('title' , 'Admin Users Edit')

@section('page-title' , 'Admin Users Edit')

@section('icon' ,'pe-7s-user' )
@section('admin-user' , 'mm-active')

@section('content')

<div class="content pt-3">
    <div class="card custom-card">
        <div class="card-body">
            <form action="{{ route('admin.admin-user.update' , $admin->id) }}" method="POST" id="edit">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $admin -> name }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $admin -> email }}">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="number" name="phone" class="form-control" value="{{ $admin -> phone }}">
                </div>
                <div class="form-group mb-4">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" >
                </div>

                <div class="d-flex justify-content-center">
                    <button class="btn btn-secondary custom-btn back-btn mr-3">Cancel</button>
                    <button type="submit" class="btn btn-primary custom-btn">Confirm</button>
                </div>


            </form>
        </div>
    </div>
</div>


@endsection


@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\UpdateAdminUser' , '#edit') !!}
    <script>
        $(document).ready(function(){
            $('.back-btn').click(function (e) {
                e.preventDefault();
                window.history.go(-1);
                return false;
            });
        });
    </script>
@endsection
