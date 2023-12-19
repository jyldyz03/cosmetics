document.addEventListener("DOMContentLoaded", function () {
    const checkoutBtn = document.getElementById('checkout-btn');

    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', function (e) {
            e.preventDefault();

            // Здесь вы можете использовать AJAX, чтобы отправить запрос на сервер
            // и добавить заказ в историю пользователя

            // Пример с использованием fetch API
            fetch('{{ route("checkout.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    // Здесь можете передать необходимые данные о заказе
                }),
            })
            .then(response => response.json())
            .then(data => {
                // Обработка ответа от сервера

                // Например, перенаправление на страницу успешного оформления заказа
                window.location.href = '{{ route("checkout.success", ["order" => "__ORDER_ID__"]) }}'.replace('__ORDER_ID__', data.order_id);
            })
            .catch(error => {
                console.error('Error:', error);
                // Обработка ошибки
            });
        });
    }
});
