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
            <div class="card-body p-2">
                <div class="row">

                    <div class="col-lg-12 col-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Type</label>
                            </div>
                            <select class="custom-select" id="inputGroupSelect01">
                                <option selected value="">All</option>
                                <option value="1">Income</option>
                                <option value="2">Expense</option>
                            </select>
                        </div>
                    </div>

                    <!--div class="col-6">
                        <div class="input-group">
                            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                                aria-describedby="search-addon" />
                            <button type="button" class="btn btn-outline-primary">search</button>
                        </div>
                    </div-->
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <span class="p-3"><i class="fa fa-history" style="margin-right: 5px"
                aria-hidden="true"></i>{{ __('messages.transcation_history') }}</span>
        <div class="infinite-scroll">
            @foreach ($transcations as $transcation)
                <a href="{{ url('transcation', $transcation->transcation_id) }}">
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
            <!--span style="display: none;">{{ $transcations->links() }}</span-->
        </div>
    </div>

    </div>
@endsection

@section('scripts')

    <!--script>

                    $('.infinite-scroll').jscroll({
                        debug: false,
                        padding : 0,
                        autoTrigger: true,
                        loadingFunction: false,
                        //nextSelector: 'a:last',
                        nextSelector: '.pagination li.active + li a',
                        contentSelector: 'div.infinite-scroll',
                        pagingSelector: '',
                        callback: false,

                    });
            </script-->
@endsection
