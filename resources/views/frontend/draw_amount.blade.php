@extends('frontend.layouts.app')
@section('title', 'Draw Amount')


@section('content')
    <div class="transfer">
        <div class="card mt-3">
            <div class="card-header">


                <p class="text-muted">{{ __('messages.transfer') }}</p>
                <p style="font-size: 20px">{{ Str::upper($checkPhoneNumber->name) }}</p>
                <p class="text-muted">{{ Str::substr($phone, 0, 4) . '***' . Str::substr($phone, 7, 4) }}</p>
            </div>
            <div class="card-body">
                <form action="{{ url('transfer/confirm-password') }}" method="POST" id="draw-amount">
                    @csrf

                    <input type="hidden" name="to_phone" value="{{ $checkPhoneNumber->phone }}">
                    <div class="form-group mb-4">
                        <label for="amount" class="text-muted">{{ __('messages.amount') }} (MMK)</label>
                        <input type="text" name="amount"
                            class="form-control @error('amount')
                                is-invalid
                            @enderror"
                            required>
                        @error('amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-color custom-btn transfer-money">{{ __('messages.transfer') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            $('.transfer-money').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '<p>{{ __('messages.enter_password') }}</p>',
                    icon: 'info',
                    html: '<input type="password" class="form-control" name="password">',
                    showCancelButton: true,
                    reverseButtons: true,
                    confirmButtonText: "{{ __('messages.confirm') }}",
                    cancelButtonText: "{{ __('messages.cancel') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        //var password = $('.password').val();
                        $.ajax({
                            url: '/password-check?password=' + $('input[name=password]').val(),
                            type: 'GET',
                            success: function(res) {
                                if (res.status == "success") {
                                    $('#draw-amount').submit();
                                    //console.log('success');
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: res.message,
                                    })
                                }
                            }
                        });
                    }
                });
            });


        });
    </script>
@endsection
