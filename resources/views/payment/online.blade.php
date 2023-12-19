<!-- resources/views/payment/online.blade.php -->
@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>Оплата онлайн</h1>

        <form action="{{ route('payment.processOnlinePayment') }}" method="POST" class="payment-form">
            @csrf

            <!-- Детали карты -->

            <label for="card_number">Номер карты</label>
            <input type="text" id="card_number" name="card_number" inputmode="numeric" title="Пожалуйста, введите действительный номер карты (14-16 цифр)" required>

            <label for="expiration_date">MM/YY</label>
            <input type="text" id="expiration_date" name="expiration_date" placeholder="MM/YY" pattern="\d\d/\d\d" title="Пожалуйста, введите действительную дату (MM/YY)" required>

            <label for="cvc">CVC</label>
            <input type="text" id="cvc" name="cvc" inputmode="numeric" title="Пожалуйста, введите действительный CVC (3-4 цифры)" required>

            <label for="card_holder_name">Имя владельца</label>
            <input type="text" id="card_holder_name" name="card_holder_name" pattern="[a-zA-Z\s]+" title="Пожалуйста, введите действительное имя" required>

            <!-- Контактная информация -->

            <label for="phone_number">Номер телефона</label>
            <input type="tel" id="phone_number" name="phone_number" pattern="\+?\d{1,12}" title="Пожалуйста, введите действительный номер телефона" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <!-- Оплата -->

            <button type="submit">Оплатить</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const expirationDateInput = document.getElementById('expiration_date');
            const phoneNumberInput = document.getElementById('phone_number');

            expirationDateInput.addEventListener('input', function () {
                let value = this.value.replace(/\D/g, '');

                if (value.length > 0) {
                    value = value.match(/.{1,2}/g).join('/');
                }

                this.value = value.substring(0, 5);
            });

            phoneNumberInput.addEventListener('input', function () {
                let value = this.value.replace(/\D/g, '');

                if (value.length > 12) {
                    value = value.substring(0, 12);
                }

                this.value = "+" + value;
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const cardNumberInput = document.getElementById('card_number');
            const cvcInput = document.getElementById('cvc');
            const phoneNumberInput = document.getElementById('phone_number');

            cardNumberInput.addEventListener('input', function () {
                this.value = this.value.replace(/\D/g, '');
            });

            cvcInput.addEventListener('input', function () {
                this.value = this.value.replace(/\D/g, '');
            });

            phoneNumberInput.addEventListener('input', function () {
                let value = this.value.replace(/\D/g, '');

                // Ensure the phone number starts with "+"
                if (!value.startsWith('+')) {
                    value = '+' + value;
                }

                this.value = value;
            });
        });
    </script>

@endsection
