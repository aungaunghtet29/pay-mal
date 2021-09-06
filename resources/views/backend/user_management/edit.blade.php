@extends('backend.layouts.app')

@section('title' , 'Users Edit')

@section('page-title' , 'Users Edit')

@section('icon' ,'pe-7s-user' )
@section('users' , 'mm-active')

@section('content')

<div class="content pt-3">
    <div class="card custom-card">
        <div class="card-body">
            <form action="{{ route('admin.user.update' , $user->id) }}" method="POST" id="edit">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $user -> name }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user -> email }}">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="number" name="phone" class="form-control" value="{{ $user -> phone }}">
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
{!! JsValidator::formRequest('App\Http\Requests\UpdateUser' , '#edit') !!}
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
