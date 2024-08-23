@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Comprar {{ $product->name }}</h2>
    <div class="col-md-6 offset-md-4">
        <div class="alert alert-info" role="alert">

            <strong>Test Card Details:</strong>
            <ul>
                <li>Card Number: <strong>4242 4242 4242 4242</strong></li>
                <li>Expiry Date: <strong>12/34</strong></li>
                <li>CVC: <strong>123</strong></li>
                <li>CP: <strong>12345</strong></li>
            </ul>
        </div>
    </div>
    <form action="{{ route('payment.process') }}" method="POST" id="payment-form">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <div class="form-group">
            <label for="card-element">Tarjeta de crédito o débito</label>
            <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
            </div>
            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert"></div>
        </div>
        <button type="submit" class="btn btn-primary">Pagar</button>

    </form>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-element');

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            form.submit();
        }
    });
</script>
@endsection
