@extends('frontend.layouts.app')
@section('title', 'Transcation')


@section('content')
    <div class="transcation">
        <div class="d-flex  mb-3">
            <div>
                <h4>{{ $user->walletInfo ? number_format($user->walletInfo->amount) : 0 }} <span>MMK</span></h4>
                <p class="text-muted">{{ __('messages.balance') }}</p>
            </div>
        </div>

        <div class="card mb-3">
            <span class="p-3"><i class="fa fa-history" style="margin-right: 5px"
                    aria-hidden="true"></i>{{ __('messages.transcation_history') }}</span>
            @foreach ($transcations as $transcation)
                <a href="{{ url("transcation" , $transcation -> transcation_id)  }}">
                    <div class="card-body ">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="mb-0 text-muted">

                                    @if ($transcation->type == 1)

                                        {{ __('messages.transfer_from') }}
                                    @elseif($transcation -> type == 2)

                                    {{ __('messages.transfer_to') }}
                                    @endif

                                    {{ $transcation->transcationSource ? $transcation->transcationSource->name : '' }}

                                </p>
                                <span class="text-muted ">
                                    {{ $transcation->created_at }}
                                </span>
                            </div>
                            <span style="font-weight: 600">
                                @if ($transcation->type == 1)
                                    <span style="color: green">+ {{ number_format($transcation->amount) }}
                                        <small>MMK</small></span>
                                @elseif($transcation -> type == 2)
                                    <span style="color: red">- {{ number_format($transcation->amount) }}
                                        <small>MMK</small></span>
                                @endif


                            </span>

                        </div>

                    </div>
                </a>
            @endforeach
            {{ $transcations->links() }}
        </div>

    </div>
@endsection
