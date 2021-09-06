@extends('frontend.layouts.app')
@section('title', 'Money Transfer')


@section('content')
    <div class="transfer">
        <div class="card mt-3">
            <div class="card-body">
                <form action="{{ route('draw.amount') }}" method="POST">
                    @csrf

                    @foreach ($errors->all() as $error)
                                <span class="text-danger" role="alert">
                                    <p>{{ $error }}</p>
                                </span>
                            @endforeach

                    <div class="form-group mb-4">
                        <label for="to">{{ __('messages.transfer') }} <span class="text-success transfer_to"></span><span
                                class=" text-danger error_msg"></span></label>
                        <div class="input-group">
                            <input type="text" name="to_phone" id="phone"
                                class="form-control @error('to_phone')
                                is-invalid
                            @enderror"
                                required>
                            <div class="input-group-append">
                                <span class="input-group-text phone-verify">
                                    <i class="fa fa-mobile"></i>
                                </span>
                            </div>
                        </div>

                        @error('to_password')


                        @enderror
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-color custom-btn ">{{ __('messages.continue') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



@section('scripts')
    <script>
        $(document).ready(function() {

            $('.phone-verify').on('click', function() {
                $.ajax({
                    url: '/phone-verify?phone=' + $('input[name=to_phone]').val(),
                    type: 'GET',
                    success: function(res) {
                        if (res.status == "success") {
                            $('.transfer_to').text('(' + res.data['name'] + ')').show();
                            $('.error_msg').hide();
                        }
                        if (res.status == "fail") {
                            $('.error_msg').text("(User no exists)").show();
                            $('.transfer_to').hide();
                        }
                    }
                });
            });
        });
    </script>
@endsection
