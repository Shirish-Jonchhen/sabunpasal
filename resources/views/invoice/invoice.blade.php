<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('logos/sabun_pasal_logo.png') }}" type="image/png">

    <title>Invoice - {{ $order->order_tracking_number }}</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }

        .invoice-container {
            position: relative;
            width: 80%;
            max-width: 800px;
            margin: 30px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            /* background-image: url('{{ asset('logos/sabun_pasal_logo.png') }}');
            background-repeat: no-repeat;
            background-position: center; */

        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-bottom: 20px;
            border-bottom: 2px solid #007788;
            /* Primary color */
            margin-bottom: 20px;
        }

        .company-logo {
            display: flex;
            align-items: center;
        }

        .company-logo img {
            width: 50px;
            /* Adjust as needed */
            height: 50px;
            margin-right: 10px;
        }

        .company-logo .logo-text {
            font-size: 1.8em;
            font-weight: 700;
            color: #007788;
            /* Primary color */
        }

        .invoice-details {
            text-align: right;
        }

        .invoice-details h1 {
            margin: 0 0 5px 0;
            font-size: 2.2em;
            color: #333;
        }

        .invoice-details p {
            margin: 0;
            font-size: 0.9em;
            color: #555;
        }

        .addresses {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .addresses div {
            width: 50%;
        }

        .addresses h3 {
            font-size: 1.1em;
            color: #007788;
            /* Primary color */
            margin-bottom: 8px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }

        .addresses p {
            margin: 0 0 5px 0;
            font-size: 0.9em;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            /* align-self: center; */
        }

        .items-table th,
        .items-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            font-size: 0.9em;
        }

        .items-table th {
            background-color: #f0f8ff;
            /* Light blue */
            color: #005566;
            /* Accent color */
            font-weight: 600;
        }

        .items-table td.numerical {
            text-align: right;
        }

        .totals-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        /* .status-table {
            width: 50%;
            max-width: 350px;

        } */

        .totals-table {
            width: 50%;
            max-width: 350px;
        }

        .totals-table td {
            padding: 8px 10px;
            font-size: 0.95em;
        }

        .totals-table td:first-child {
            text-align: right;
            font-weight: 600;
            color: #555;
        }

        .totals-table td:last-child {
            text-align: right;
        }

        .totals-table tr.grand-total td {
            font-size: 1.2em;
            font-weight: 700;
            color: #007788;
            /* Primary color */
            border-top: 2px solid #007788;
            padding-top: 10px;
        }

        .invoice-footer {
            text-align: center;
            font-size: 0.85em;
            color: #777;
            padding-top: 20px;
            border-top: 1px solid #eee;
            margin-top: 30px;
        }

        .invoice-footer p {
            margin: 5px 0;
        }

        .print-button {
            display: block;
            width: 150px;
            margin: 20px auto;
            padding: 10px 15px;
            background-color: #007788;
            /* Primary color */
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .print-button:hover {
            background-color: #005566;
            /* Accent color */
        }


        a {
            /* display: none; */
            text-align: center;
            text-decoration: none;
            color: #007788;
            /* Primary color */
            font-size: 1em;
            margin-top: 50px;
            align-self: center;
        }


        @media print {
            body {
                background-color: #fff;
                margin: 0;
                padding: 0;
            }

            .invoice-container {
                width: 100%;
                max-width: none;
                margin: 0;
                box-shadow: none;
                border-radius: 0;
                padding: 20px 0px;
            }

            .print-button {
                display: none;
            }

            a {
                display: none;
            }

            .invoice-header,
            .invoice-footer {
                border-color: #ccc;
            }

            .items-table th {
                background-color: #e9ecef !important;
                /* Ensure print styles for background */
                color: #212529 !important;
                -webkit-print-color-adjust: exact;
                /* Chrome, Safari */
                color-adjust: exact;
                /* Standard */
            }

            .totals-table tr.grand-total td {
                border-color: #ccc;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <img src="{{ asset('logos/sabun_pasal_logo.png') }}"
            style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 0.05; z-index: 0;" />

        <header class="invoice-header">
            <div class="company-logo">
                <!-- Placeholder for Font Awesome icon if images are disabled or for consistency -->
                <img src="{{ asset('/logos/sabun_pasal_linear.png') }}" alt="sabunpasal.com Logo"
                    style='width: 15rem; height:5rem' />
            </div>
            <div class="invoice-details">
                <h1>INVOICE</h1>
                <p>Order #: {{ $order->order_tracking_number }}</p>
                <p>Invoice Date: {{ $order->created_at }}</p>
                {{-- <p>Due Date: August 27, 2024</p> --}}
            </div>
        </header>

        <section class="addresses">
            <div class="billing-address">
                <h3>Bill To:</h3>
                <p><strong>{{ $order->user->name }}</strong></p>
                <p>{{ $order->street }}, {{ $order->ward }}</p>
                <p>{{ $order->municipality }}, {{ $order->district }}</p>
                <p>{{ $order->country }}</p>
                <p>{{ $order->user->email }}</p>
            </div>
            <div class="shipping-address">
                <h3>Ship To:</h3>
                @if ($order->delivery_method == 'pickup')
                    <p>Store Pick-Up</p>
                @else
                    <p><strong>{{ $order->user->name }}</strong></p>
                    <p>{{ $order->street }}, {{ $order->ward }}</p>
                    <p>{{ $order->municipality }}, {{ $order->district }}</p>
                    <p>{{ $order->country }}</p>
                @endif
            </div>
        </section>

        <section class="items-section">
            <table class="items-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item Description</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Unit Discounted Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $itemCount = 1;
                    @endphp
                    @foreach ($order->storeOrders as $store_order)
                        @foreach ($store_order->storeOrederProducts as $product)
                            <tr>
                                <td>{{ $itemCount }}</td>
                                <td>{{ $product->variantPrice->variant->product->name }}({{ $product->variantPrice->variant->variant_name }}
                                    | {{ $product->variantPrice->variant->size }})</td>
                                <td class="numerical">{{ $product->quantity }}
                                    {{ $product->variantPrice->unit->attribute_value }}</td>
                                <td class="numerical">{{ $product->variantPrice->old_price }}</td>
                                <td class="numerical">{{ $product->variantPrice->price }}</td>
                                <td class="numerical">
                                    {{ number_format($product->variantPrice->price * $product->quantity, 2) }}</td>
                            </tr>
                            @php
                                $itemCount++;
                            @endphp
                        @endforeach
                    @endforeach

                    <!-- Add more items as needed -->
                </tbody>
            </table>
        </section>

        <section class="totals-section">
            <table class="totals-table">
                <tbody>
                    <tr>
                        <td>Payment Method:</td>
                        <td>{{ $order->payment_method == 'cod' ? 'Cash On Delivery' : $order->payment_method }}</td>
                    </tr>
                    <tr>
                        <td>Delivery Method:</td>
                        <td>{{ $order->delivery_method == 'pickup' ? 'Store Pick-Up' : 'Home Delivery' }}</td>
                    </tr>
                    <tr>
                        <td>Payment Status:</td>
                        <td>{{ Str::upper($order->payment_status) }}</td>
                    </tr>
                    <tr>
                        <td>Order Status:</td>
                        <td>{{ Str::upper($order->order_status) }}</td>
                    </tr>
                    <tr>
                        <td>Processed By:</td>
                        <td>SabunPasal.com</td>
                    </tr>

                </tbody>
            </table>

            <table class="totals-table">
                <tbody>
                    <tr>

                        <td>Subtotal:</td>
                        <td>NRs. {{ $order->subtotal }}</td>
                    </tr>
                    <tr>
                        <td>Discount:</td>
                        <td>NRs. {{ $order->discount }}</td>
                    </tr>
                    <tr>
                        <td>Tax:</td>
                        <td>NRs. {{ $order->tax }}</td>
                    </tr>
                    <tr>
                        <td>Shipping:</td>
                        <td>NRs. {{ $order->delivery_charge }}</td>
                    </tr>
                    <tr class="grand-total">
                        <td>Grand Total:</td>
                        <td>NRs. {{ $order->total_amount }}</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <footer class="invoice-footer">
            <p>Thank you for your business!</p>
            <p>
                SabunPasal.com | Asan-25,Kathmandu,Nepal | (+977) 01-5352642
            </p>
            {{-- <p>Payment terms: 30 days from invoice date.</p> --}}
        </footer>

        <button class="print-button" onclick="window.print()">
            Print Invoice
        </button>
        <center>
            <a href="{{ route('user.show.order', $order->order_tracking_number) }}">
                Go Back
            </a>
        </center>

    </div>
</body>

</html>
