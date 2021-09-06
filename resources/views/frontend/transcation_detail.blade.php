@extends('frontend.layouts.app')
@section('title', 'Transcation Detail')


@section('content')
    <div class="transcation-detail">
        <div class="d-flex mb-3">
            <h4>{{ __('messages.payment') }}</h4>
        </div>
        <div class="card mb-3">

            <div class="card-body ">
                <div class="check text-center mb-3">
                    <img src="{{ asset('img/checked.png') }}" alt="">
                </div>
                <h4 class="text-center mb-3">
                    @if ($transcation->type == 1)
                    <span style="color: green">+ {{ number_format($transcation->amount) }}
                        <small>MMK</small></span>
                @elseif($transcation -> type == 2)
                    <span style="color: red">- {{ number_format($transcation->amount) }}
                        <small>MMK</small></span>
                @endif
                </h4>
                <div class="d-flex justify-content-between ">
                    <p class="text-muted">{{ __('messages.total_transfer') }}</p>

                    @if ($transcation->type == 1)
                        <span style="color: green">+ {{ number_format($transcation->amount) }}
                            <small>MMK</small></span>
                    @elseif($transcation -> type == 2)
                        <span style="color: red">- {{ number_format($transcation->amount) }}
                            <small>MMK</small></span>
                    @endif

                </div>
                <hr>
                <div class="d-flex justify-content-between ">
                    <p class="text-muted">
                        @if ($transcation->type == 1)

                            {{ __('messages.transfer_from') }}
                        @elseif($transcation -> type == 2)

                        {{ __('messages.transfer_to') }}
                        @endif
                    </p>
                    <span>


                        {{ $transcation->transcationSource ? $transcation->transcationSource->name : '' }}

                    </span>
                </div>
                <hr>
                <div class="d-flex justify-content-between ">
                    <p class="text-muted">{{ __('messages.date_time') }}</p>
                    <span>
                        {{ $transcation->created_at }}
                    </span>
                </div>

                <hr>
                <div class="d-flex justify-content-between">
                    <p class="text-muted">{{ __('messages.transcation_id') }}</p>
                    <span class="text-muted">
                        {{ $transcation->transcation_id }}
                    </span>
                </div>

                <hr>
                <div class="d-flex justify-content-between">
                    <p class="text-muted">{{ __('messages.ref_no') }}</p>
                    <span class="text-muted">
                        {{ $transcation->ref_no }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
