@extends('layouts.app')
@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript">
        Stripe.setPublishableKey('pk_test_KCQMasTijZDLSyaDMpkNt0RZ00ky4QnoYy');
    </script>
    <script src="{{asset('js/pay.js')}}"></script>
@endpush

<meta name="_token" content="{!! csrf_token() !!}">
@section('content')

    <div class="container">
        @include("partial.error")
        @include("partial.success")

        <form action="{{route('pay')}}" method="GET" id="payment-form">
            {{csrf_field()}}
            <span class="payment-errors"></span>
            <div class="form-group">
                <label>Card Number</label>
                <input type="text" size="20" data-stripe="number">
            </div>
            <div class="form-group">
                <label>Expiration (MM/YY)</label>
                <input type="text" size="2" data-stripe="exp_month">
                <input type="text" size="2" data-stripe="exp_year">
            </div>
            <div class="form-group">
                <label>CVC</label>
                <input type="text" size="4" data-stripe="cvc">
            </div>
            <input type="hidden" name="user" value="{{$id}}">
            <input type="submit" class="submit" value="Submit">
        </form>

    </div>

@endsection
