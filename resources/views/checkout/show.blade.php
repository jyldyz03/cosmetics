@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Оформление заказа</h1>

        @if (auth()->check())
            <form action="{{ route('checkout.process') }}" method="post">
                @csrf

                <!-- Информация о покупателе -->
                <div class="form-group">
                    <label for="first_name">Имя</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" value="{{ auth()->user()->name }}" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Фамилия</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" value="{{ auth()->user()->surname }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}" required>
                </div>

                <div class="form-group">
                    <label for="phone">Номер телефона*</label>
                    <input type="tel" name="phone" id="phone" class="form-control" value="{{ auth()->user()->phone_number }}" required>
                </div>

            <div class="form-group">
                <label for="address">Адрес</label>
                <input type="text" name="address" id="address" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="comment">Комментарий</label>
                <textarea name="comment" id="comment" class="form-control" rows="4"></textarea>
            </div>

                <div class="form-group">
                    <label for="payment_method">Способ оплаты</label>
                    <div class="form-check">
                        <input type="radio" name="payment_method" id="cash" value="cash" class="form-check-input" required>
                        <label for="cash" class="form-check-label">Наличными</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="payment_method" id="online" value="online" class="form-check-input" required>
                        <label for="online" class="form-check-label">Онлайн оплата</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Далее</button>
            </form>
        @else
            <p>You are not logged in. Please log in to proceed with the checkout.</p>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const paymentMethod = document.getElementsByName('payment_method');

            for (let i = 0; i < paymentMethod.length; i++) {
                paymentMethod[i].addEventListener('change', function () {
                    if (this.value === 'online') {
                        window.location.href = '{{ route("payment.online") }}';
                    }
                });
            }
        });
    </script>
@endsection
