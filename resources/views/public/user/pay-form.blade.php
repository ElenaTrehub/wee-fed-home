@extends('layouts.app')
@push('scripts')
    {{--<script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript">
        Stripe.setPublishableKey('pk_test_KCQMasTijZDLSyaDMpkNt0RZ00ky4QnoYy');
    </script>
    <script src="{{asset('js/pay.js')}}"></script>--}}
@endpush


@section('content')

    <div class="container">
        @include("partial.error")
        @include("partial.success")

        <form action="{{route('payMonth')}}" method="POST" style="width: 400px;" id="payment-form">
            {{csrf_field()}}
            <span class="payment-errors"></span>
            <div class="form-group">
                <label for="number">Card Number</label>
                <input class="form-control" id="number" type="text" size="20" data-stripe="number">
            </div>
            <div class="form-group">
                <label style="width: 100%">Expiration (MM/YY)</label>
                <input class="form-control" style="width: 50px; float: left; margin-right: 10px" type="text" size="2" data-stripe="exp_month">
                <input class="form-control" style="width: 50px" type="text" size="2" data-stripe="exp_year">
            </div>
            <div class="form-group">
                <label for="number">CVC</label>
                <input id="cvc" class="form-control" style="width: 50px" type="text" size="4" data-stripe="cvc">
            </div>
            <div class="form-group">
                <label for="name">Cardholder Name</label>
                <input class="form-control" id="name" type="text" size="20" data-stripe="name">
            </div>
            <input type="hidden" name="user" value="{{$id}}">
            <input class="btn btn-primary" type="submit"  value="Submit">
        </form>

    </div>

@endsection
