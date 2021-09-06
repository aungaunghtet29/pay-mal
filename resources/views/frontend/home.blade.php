@extends('frontend.layouts.app')
@section('title', 'Pay Mal')


@section('content')
    <div class="home">
        <div class="d-flex justify-content-between mb-3 account">
            <div>
                <h4>{{ $user->walletInfo ? number_format($user->walletInfo->amount) : 0 }} <span>MMK</span></h4>
                <p class="text-muted">{{ __('messages.balance') }}</p>
            </div>
            <span>
                <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=c9184a&color=fff" alt="">
            </span>
        </div>

        <div class="card inside-img mb-4">
            <div class="card-body">
                <div class="row">
                    <a href="" class="col-3 text-center">
                        <img src="{{ asset('img/qr-code-scan.png') }}">
                        <span class="text-center">{{ __('messages.scan') }}</span>
                    </a>
                    <a href="" class="col-3 text-center">
                        <img src="{{ asset('img/qr.png') }}">
                        <span class="text-center">{{ __('messages.recieve') }}</span>
                    </a>
                    <a href="{{ route('wallet') }}" class="col-3 text-center">
                        <img src="{{ asset('img/wallet.png') }}">
                        <span class="text-center">{{ __('messages.card') }}</span>
                    </a>
                    <a href="{{ route('transfer') }}" class="col-3 text-center">
                        <img src="{{ asset('img/money-transfer.png') }}">
                        <span class="text-center">{{ __('messages.transfer_home') }}</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center mb-3 flex-img">

                    <a href="{{ url('language-setting') }}" class="col text-center">
                        <img src="{{ asset('img/language.png') }}" alt="">
                        <span>{{ __('messages.language') }}</span>
                    </a>
                    <a href="{{ route('wallet') }}" class="col text-center">
                        <img src="{{ asset('img/wallet-c.png') }}" alt="">
                        <span>{{ __('messages.wallet') }}</span>
                    </a>
                </div>
                <hr>
                <div class="d-flex justify-content-center  flex-img">
                    <a href="{{ route('transcation') }}" class="col text-center">
                        <img src="{{ asset('img/lending-c.png') }}" alt="">
                        <span>{{ __('messages.transcation') }}</span>
                    </a>
                    <a href="{{ route('account') }}" class="col text-center">
                        <img src="{{ asset('img/account.png') }}" alt="">
                        <span>{{ __('messages.account') }}</span>
                    </a>
                </div>

            </div>
        </div>

    </div>
@endsection
