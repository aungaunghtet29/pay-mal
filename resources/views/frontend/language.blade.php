@extends('frontend.layouts.app')
@section('title', 'Language')


@section('content')
    <div class="language">
        <div class="card">
            <div class="card-body">
                <form action="" method="GET">
                    <div class="d-flex justify-content-between mb-3 ">
                        <span>English</span>
                        <a href="language-setting/en">
                            <input type="radio" name="language" id="english" class="en"  value="english" checked>
                        </a>
                    </div>

                    <div class="d-flex justify-content-between mm">
                        <span>မြန်မာ</span>
                        <a href="language-setting/mm">
                            <input type="radio" name="language" id="myanmar" class="mm"  value="myanmar">
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var language = $(this).val();

            .$('input[type="radio"]').on('click', function () {

            });
        });
    </script>
@endsection
