@extends('frontend.layouts.app')
@section('title', 'Update')


@section('content')
    <div class="change-password">
        <div class="card mt-3">
            <div class="card-body">
                <form action="{{ route('change.password.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="old">{{ __('messages.old_password') }}</label>
                        <input type="password" class="form-control @error('old_password') is-invalid @enderror"
                            name="old_password" value="{{ old('old_password') }}" required>
                        @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="new">{{ __('messages.new_password') }}</label>
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                            name="new_password" value="{{ old('new_password') }}" required>
                        @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirm">{{ __('messages.confirm_password') }}</label>
                        <input type="password" class="form-control @error('confirm_password') is-invalid @enderror"
                            name="confirm_password" value="{{ old('confirm_password') }}" required>
                        @error('confirm_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-center " style="margin-top: 30px">
                        <button class="btn btn-secondary custom-btn back-btn mr-3 back">{{ __('messages.cancel') }}</button>
                        <button type="submit" class="btn btn-color custom-btn">{{ __('messages.confirm') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(
            function() {

                $('.back').click(function(e) {
                    e.preventDefault();
                    window.history.back(1);
                });


            }
        );
    </script>
@endsection
