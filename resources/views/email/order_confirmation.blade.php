<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #ffffff; }
        h1 { color: #0056b3; }
        ul { list-style: none; padding: 0; }
        li { margin-bottom: 5px; }
        .footer { margin-top: 20px; font-size: 0.9em; color: #777; text-align: center; border-top: 1px solid #eee; padding-top: 10px;}
    </style>
</head>
<body>
    <div class="container">
        <h1>Hello, {{ $userName }}!</h1>
        <p>Good news! Your order **#{{ $orderId }}** has been shipped.</p>
        <p>It was marked as shipped on: **{{ $shippedAt }}**</p>
        @if ($products->isNotEmpty())
            <p>Items in this shipment:</p>
            <ul>
                @foreach ($products as $product)
                    <li>- {{ $product->pivot->quantity }}x {{ $product->name }} (€{{ number_format($product->pivot->price, 2) }} each)</li>
                @endforeach
            </ul>
        @endif
        <p>You should receive it soon. We'll send you a tracking number in a separate email if available.</p>
        <p>Thank you for shopping with us!</p>
        <div class="footer">
            <p>Regards,<br>Your {{ config('app.name') }} Team</p>
        </div>
    </div>
</body>
</html>