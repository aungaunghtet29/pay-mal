@extends('frontend.layouts.app')
@section('title', 'Account')


@section('content')
    <div class="account">
        <div class="profile text-center mb-3">

            <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=c9184a&color=fff" alt="">
            <h4 class="mt-3">{{ Str::upper($user->name) }}</h4>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between ">
                    <span>{{ __('messages.account_number') }}</span>
                    <span>{{ $user->walletInfo->account_number }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between ">
                    <span>{{ __('messages.email') }}</span>
                    <span>{{ $user->email }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between ">
                    <span>{{ __('messages.phone') }}</span>
                    <span>{{ $user->phone }}</span>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-body">
                <a href="{{ route('change.password') }}" class="d-flex justify-content-between ">
                    <span>{{ __('messages.change_password') }}</span>
                    <span> <i class="fa fa-arrow-alt-circle-right"></i></span>
                </a>
                <hr>
                <a href="" class="d-flex justify-content-between logout">
                    <span>{{ __('messages.logout') }}</span>
                    <span><i class="fa fa-sign-out-alt"></i></span>
                </a>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.logout', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure to logout?',
                    showCancelButton: true,
                    confirmButtonText: `Confirm`,
                    reverseButtons : true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('logout') }}',
                            type: 'POST',
                            contentType: "application/json; charset=utf-8",
                            dataType: "json",
                            success: function() {
                                window.location.reload();
                            }
                        });
                    }
                })

            });
        });
    </script>
@endsection
