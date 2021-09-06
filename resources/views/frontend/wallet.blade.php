@extends('frontend.layouts.app')
@section('title' , 'Wallet')


@section('content')
    <div class="wallet">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <span class="text-muted">{{ __('messages.account_number') }}</span>
                    <p>{{ $user -> walletInfo  ? number_format($user -> walletInfo -> account_number) : '' }}</p>
                </div>
                <div class="mb-3">
                    <span class="text-muted">{{ __('messages.balance') }}</span>
                    <h4>{{ $user -> walletInfo ? number_format($user -> walletInfo -> amount) : 0 }} <span>MMK</span></h4>
                </div>

                <div class="d-flex justify-content-between">
                    <span class="text-muted">{{ Str::upper($user -> name) }}</span>
                    <span class="text-muted">{{ $user -> phone }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
