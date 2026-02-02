<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Your Order Has Been Confirmed!</title>
    <style type="text/css">
        /* Reset styles for better consistency across email clients */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* Large screens (>= 992px, but applies to <=992px) */
        @media screen and (max-width: 992px) {
            .lg-px-4 {
                padding-left: 16px !important;
                padding-right: 16px !important;
            }

            .lg-px-10 {
                padding-left: 40px !important;
                padding-right: 40px !important;
            }

            .lg-text-2xl {
                font-size: 24px !important;
            }

            .lg-leading-loose {
                line-height: 1.75 !important;
            }

            /* Equivalent to leading-7 */
        }

        /* Medium screens (>= 768px, but applies to <=768px) */
        @media screen and (max-width: 768px) {
            .md-px-4 {
                padding-left: 16px !important;
                padding-right: 16px !important;
            }

            .md-px-16 {
                padding-left: 32px !important;
                padding-right: 32px !important;
            }

            .md-pt-8 {
                padding-top: 32px !important;
            }

            .md-pb-8 {
                padding-bottom: 32px !important;
            }

            .md-text-xl {
                font-size: 20px !important;
            }

            .md-text-base {
                font-size: 16px !important;
            }
        }

        /* Small screens (<= 576px) */
        @media screen and (max-width: 576px) {
            .sm-leading-24 {
                line-height: 24px !important;
            }

            .sm-leading-32 {
                line-height: 32px !important;
            }

            .sm-px-0 {
                padding-left: 0 !important;
                padding-right: 0 !important;
            }

            .sm-px-20 {
                padding-left: 20px !important;
                padding-right: 20px !important;
            }

            .sm-pt-4 {
                padding-top: 4px !important;
            }

            .sm-pb-4 {
                padding-bottom: 4px !important;
            }

            .sm-w-full {
                width: 100% !important;
            }

            .sm-text-left {
                text-align: left !important;
            }

            .sm-text-center {
                text-align: center !important;
            }

            .sm-text-sm {
                font-size: 14px !important;
            }

            .sm-text-lg {
                font-size: 18px !important;
            }

            /* Specific table responsiveness - Adjusted for columns */
            .responsive-table {
                width: 100% !important;
                /* Note: Email clients have limited support for overflow-x.
                   Very wide content in narrow columns may still cause issues or truncations. */
            }

            .responsive-table td {
                /* Remove display: block to allow cells to stay in columns */
                /* width: auto !important; Let browser calculate */
                padding-left: 5px !important;
                /* Reduce padding to fit more */
                padding-right: 5px !important;
                font-size: 13px !important;
                /* Smaller font for tighter fit */
                text-align: center !important;
                /* Center align all table cell content */
                vertical-align: middle !important;
                /* Align content vertically */
            }

            .responsive-table tr {
                /* Remove display: block to keep rows as table rows */
                margin-bottom: 0 !important;
                /* Remove extra margin if rows are not stacking */
            }

            .responsive-table .item-details-cell {
                padding-left: 5px !important;
                padding-right: 5px !important;
                text-align: center !important;
            }

            /* Ensure table headers are visible on small screens */
            .responsive-table .sm-hidden {
                display: table-cell !important;
            }

            /* Hide the "Qty: X" span that was designed for the stacked view */
            .sm-hide-stacked-info {
                display: none !important;
            }
        }
    </style>
</head>

<body
    style="
      margin: 0;
      padding: 0;
      width: 100%;
      background-color: #f8f9fa;
      font-family: 'Inter', sans-serif;
      -webkit-font-smoothing: antialiased;
    ">
    <!-- Main Wrapper Table -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8f9fa">
        <tr>
            <td align="center" style="padding: 20px 10px">
                <!-- Content Area Table -->
                <table border="0" cellpadding="0" cellspacing="0" width="100%"
                    class="max-w-[600px] rounded-lg shadow-md bg-white"
                    style="
              max-width: 600px;
              border-collapse: separate;
              border-spacing: 0;
              background-color: #ffffff;
              border-radius: 5px;
              box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            ">
                    <!-- Header Section -->
                    <tr>
                        <td align="center" class="p-8 lg-px-10 md-px-16 sm-px-20" style="padding: 32px">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center" class="pb-4">
                                        <!-- Company Logo -->
                                        <img src="https://firebasestorage.googleapis.com/v0/b/medic-predict.appspot.com/o/sabunpasal%2Fsabun_pasal_linear.png?alt=media&token=617588c7-547f-4d9d-a369-dcec2be09a0a"
                                            alt="Company Logo" width="150"
                                            style="
                          display: block;
                          border: 0;
                          width: 150px;
                          max-width: 150px;
                          height: auto;
                        " />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" class="text-3xl lg-text-2xl font-bold text-gray-800"
                                        style="
                        font-size: 28px;
                        font-weight: 700;
                        color: #333333;
                        padding-bottom: 16px;
                      ">
                                        Order Confirmation
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" class="text-base md-text-base text-gray-600 sm-leading-24"
                                        style="font-size: 16px; line-height: 24px; color: #666666">
                                        Thank you for your purchase! Your order has been confirmed
                                        and is being processed.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Order Summary -->
                    <tr>
                        <td class="px-8 lg-px-10 md-px-16 sm-px-20 py-4" style="padding: 16px 32px">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                class="bg-gray-50 rounded-md p-4"
                                style="
                    background-color: #f8f9fa;
                    border-radius: 5px;
                    padding: 16px;
                  ">
                                <tr>
                                    <td class="font-semibold text-gray-700 pb-2"
                                        style="
                        font-size: 16px;
                        font-weight: 600;
                        color: #666666;
                        padding-bottom: 8px;
                      ">
                                        Order Summary
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td colspan="2"
                                                    class="w-1/2 text-right font-medium text-gray-800 pb-1"
                                                    style="
                              width: 50%;
                              font-size: 15px;
                              text-align: left;
                              font-weight: 500;
                              color: #333333;
                              padding-bottom: 4px;
                            ">
                                                    {{ $order->order_tracking_number }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="w-1/2 text-gray-600 pb-1"
                                                    style="
                              width: 50%;
                              font-size: 15px;
                              color: #666666;
                              padding-bottom: 4px;
                            ">
                                                    Order Date:
                                                </td>
                                                <td class="w-1/2 text-right font-medium text-gray-800 pb-1"
                                                    style="
                              width: 50%;
                              font-size: 15px;
                              text-align: right;
                              font-weight: 500;
                              color: #333333;
                              padding-bottom: 4px;
                            ">
                                                    {{ $order->created_at->format('F j, Y') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="w-1/2 text-gray-600"
                                                    style="width: 50%; font-size: 15px; color: #666666">
                                                    Payment Method:
                                                </td>
                                                <td class="w-1/2 text-right font-medium text-gray-800"
                                                    style="
                              width: 50%;
                              font-size: 15px;
                              text-align: right;
                              font-weight: 500;
                              color: #333333;
                            ">
                                                    {{ $order->payment_method == 'cod' ? 'Cash on Delivery' : 'Online Payment' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="w-1/2 text-gray-600"
                                                    style="width: 50%; font-size: 15px; color: #666666">
                                                    Payment Status:
                                                </td>
                                                <td class="w-1/2 text-right font-medium text-gray-800"
                                                    style="
                              width: 50%;
                              font-size: 15px;
                              text-align: right;
                              font-weight: 500;
                              color: #333333;
                            ">
                                                    {{ $order->payment_status }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Shipping Address -->
                    <tr>
                        <td class="px-8 lg-px-10 md-px-16 sm-px-20 py-4" style="padding: 16px 32px">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td class="font-semibold text-gray-700 pb-2"
                                        style="
                        font-size: 16px;
                        font-weight: 600;
                        color: #666666;
                        padding-bottom: 8px;
                      ">
                                        Billing Address
                                    </td>
                                    <td class="font-semibold text-gray-700 pb-2"
                                        style="
                        font-size: 16px;
                        font-weight: 600;
                        color: #666666;
                        padding-bottom: 8px;
                      ">

                                        Shipping Address
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-gray-600 leading-normal"
                                        style="font-size: 15px; line-height: 22px; color: #666666">
                                        {{ optional($order->user)->name ?? 'Customer' }}<br />
                                        {{ $order->street }}, {{ $order->ward }}<br />
                                        {{ $order->municipality }}, {{ $order->district }}<br>
                                        {{ $order->country }}
                                    </td>
                                    <td class="text-gray-600 leading-normal"
                                        style="font-size: 15px; line-height: 22px; color: #666666">
                                        @if ($order->delivery_method == 'pickup')
                                            Store Pick-Up
                                        @else
                                            {{ optional($order->user)->name ?? 'Customer' }}<br />
                                            {{ $order->street }}, {{ $order->ward }}<br />
                                            {{ $order->municipality }}, {{ $order->district }}<br>
                                            {{ $order->country }}
                                        @endif

                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Order Items Section -->
                    <tr>
                        <td class="px-8 lg-px-10 md-px-16 sm-px-20 py-4" style="padding: 16px 32px">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td class="font-semibold text-gray-700 pb-2"
                                        style="
                        font-size: 16px;
                        font-weight: 600;
                        color: #666666;
                        padding-bottom: 8px;
                      ">
                                        Order Details
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                            class="responsive-table">
                                            <!-- Table Header -->
                                            <tr style="background-color: #f8f9fa">
                                                <td class="py-2 px-3 text-sm font-medium text-gray-600 rounded-tl-md sm-hidden"
                                                    style="
                              padding: 8px 12px;
                              font-size: 14px;
                              font-weight: 500;
                              color: #666666;
                              border-top-left-radius: 5px;
                            ">
                                                    Product
                                                </td>
                                                <td class="py-2 px-3 text-sm font-medium text-gray-600 text-center sm-hidden"
                                                    style="
                              padding: 8px 12px;
                              font-size: 14px;
                              font-weight: 500;
                              color: #666666;
                              text-align: center;
                            ">
                                                    Qty
                                                </td>
                                                <td class="py-2 px-3 text-sm font-medium text-gray-600 text-right sm-hidden"
                                                    style="
                              padding: 8px 12px;
                              font-size: 14px;
                              font-weight: 500;
                              color: #666666;
                              text-align: right;
                            ">
                                                    Unit Price
                                                </td>
                                                <td class="py-2 px-3 text-sm font-medium text-gray-600 text-right sm-hidden"
                                                    style="
                              padding: 8px 12px;
                              font-size: 14px;
                              font-weight: 500;
                              color: #666666;
                              text-align: right;
                            ">
                                                    Discounted Price
                                                </td>
                                                <td class="py-2 px-3 text-sm font-medium text-gray-600 text-right rounded-tr-md sm-hidden"
                                                    style="
                              padding: 8px 12px;
                              font-size: 14px;
                              font-weight: 500;
                              color: #666666;
                              text-align: right;
                              border-top-right-radius: 5px;
                            ">
                                                    Subtotal
                                                </td>
                                            </tr>


                                            @foreach ($order->storeOrders as $store_order)
                                                @foreach ($store_order->storeOrederProducts as $product)
                                                    <tr>
                                                        <td class="item-details-cell py-3 px-3 text-gray-800 font-medium sm-text-sm"
                                                            style="
                              padding: 12px 12px;
                              font-size: 15px;
                              font-weight: 500;
                              color: #333333;
                            ">
                                                            {{ $product->variantPrice->variant->product->name }}<br />
                                                            <small>Variant:
                                                                {{ $product->variantPrice->variant->variant_name }}
                                                                | Size: {{ $product->variantPrice->variant->size }} |
                                                                Unit:
                                                                {{ $product->variantPrice->unit->attribute_value }}
                                                            </small>
                                                        </td>
                                                        <td class="item-details-cell py-3 px-3 text-center text-gray-600 sm-text-sm"
                                                            style="
                              padding: 12px 12px;
                              font-size: 15px;
                              color: #666666;
                              text-align: center;
                            ">
                                                            {{ $product->quantity }}
                                                        </td>
                                                        <td class="item-details-cell py-3 px-3 text-right text-gray-600 sm-text-sm"
                                                            style="
                              padding: 12px 12px;
                              font-size: 15px;
                              color: #666666;
                              text-align: right;
                            ">
                                                            NRs. {{ $product->variantPrice->old_price }}
                                                        </td>
                                                        <td class="item-details-cell py-3 px-3 text-right text-gray-600 sm-text-sm"
                                                            style="
                              padding: 12px 12px;
                              font-size: 15px;
                              color: #666666;
                              text-align: right;
                            ">
                                                            NRs. {{ $product->variantPrice->price }}
                                                        </td>
                                                        <td class="item-details-cell py-3 px-3 text-right text-gray-800 font-medium sm-text-sm"
                                                            style="
                              padding: 12px 12px;
                              font-size: 15px;
                              font-weight: 500;
                              color: #333333;
                            ">
                                                            NRs.
                                                            {{ number_format($product->variantPrice->price * $product->quantity, 2) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                            <!-- Product 1 -->



                                            <!-- Totals -->
                                            <tr>
                                                <td colspan="4"
                                                    class="py-2 px-3 text-right text-gray-600 sm-text-sm"
                                                    style="
                              padding: 8px 12px;
                              font-size: 15px;
                              color: #666666;
                              text-align: right;
                            ">
                                                    Subtotal:
                                                </td>
                                                <td class="py-2 px-3 text-right font-medium text-gray-800 sm-text-sm"
                                                    style="
                              padding: 8px 12px;
                              font-size: 15px;
                              font-weight: 500;
                              color: #333333;
                              text-align: right;
                            ">
                                                    NRs. {{ $order->subtotal }}
                                                </td>
                                            </tr>

                                            {{-- discount --}}
                                            <tr>
                                                <td colspan="4"
                                                    class="py-2 px-3 text-right text-gray-600 sm-text-sm"
                                                    style="
                              padding: 8px 12px;
                              font-size: 15px;
                              color: #666666;
                              text-align: right;
                            ">
                                                    Discount:
                                                </td>
                                                <td class="py-2 px-3 text-right font-medium text-gray-800 sm-text-sm"
                                                    style="
                              padding: 8px 12px;
                              font-size: 15px;
                              font-weight: 500;
                              color: #333333;
                              text-align: right;
                            ">
                                                    NRs. {{ $order->discount }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"
                                                    class="py-2 px-3 text-right text-gray-600 sm-text-sm"
                                                    style="
                              padding: 8px 12px;
                              font-size: 15px;
                              color: #666666;
                              text-align: right;
                            ">
                                                    Shipping:
                                                </td>
                                                <td class="py-2 px-3 text-right font-medium text-gray-800 sm-text-sm"
                                                    style="
                              padding: 8px 12px;
                              font-size: 15px;
                              font-weight: 500;
                              color: #333333;
                              text-align: right;
                            ">
                                                    NRs. {{ $order->delivery_charge }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"
                                                    class="py-2 px-3 text-right text-gray-600 sm-text-sm"
                                                    style="
                              padding: 8px 12px;
                              font-size: 15px;
                              color: #666666;
                              text-align: right;
                            ">
                                                    Tax (Est.):
                                                </td>
                                                <td class="py-2 px-3 text-right font-medium text-gray-800 sm-text-sm"
                                                    style="
                              padding: 8px 12px;
                              font-size: 15px;
                              font-weight: 500;
                              color: #333333;
                              text-align: right;
                            ">
                                                    NRs. {{ $order->tax }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"
                                                    class="py-3 px-3 text-right text-lg font-bold text-gray-800 rounded-bl-md sm-text-lg"
                                                    style="
                              padding: 12px 12px;
                              font-size: 18px;
                              font-weight: 700;
                              color: #333333;
                              text-align: right;
                              border-bottom-left-radius: 5px;
                            ">
                                                    Total:
                                                </td>
                                                <td class="py-3 px-3 text-right text-lg font-bold text-green-600 rounded-br-md sm-text-lg"
                                                    style="
                              padding: 12px 12px;
                              font-size: 18px;
                              font-weight: 700;
                              color: #28a745;
                              text-align: right;
                              border-bottom-right-radius: 5px;
                            ">
                                                    NRs.
                                                    {{ $order->total_amount }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Call to Action Button -->
                    {{-- <tr>
                        <td align="center" class="p-8 lg-px-10 md-px-16 sm-px-20" style="padding: 32px">
                            <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" class="bg-blue-600 rounded-md"
                                        style="border-radius: 5px; background-color: #007788">
                                        <a href="https://yourwebsite.com/track-order/ABCDE12345" target="_blank"
                                            class="block py-3 px-6 text-white font-semibold no-underline"
                                            style="
                          display: block;
                          padding: 12px 24px;
                          color: #ffffff;
                          text-decoration: none;
                          font-weight: 600;
                        ">
                                            Track Your Order
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr> --}}

                    <!-- Footer Section -->
                    <tr>
                        <td align="center" class="bg-gray-100 py-6 px-8 lg-px-10 md-px-16 sm-px-20 rounded-b-lg"
                            style="
                  background-color: #212529;
                  padding: 24px 32px;
                  border-bottom-left-radius: 8px;
                  border-bottom-right-radius: 8px;
                ">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center" class="text-sm text-gray-500 pb-2 sm-leading-24"
                                        style="
                        font-size: 14px;
                        line-height: 22px;
                        color: #adb5bd;
                        padding-bottom: 8px;
                      ">
                                        &copy; 2025 SabunPasal.com, All rights reserved.
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" class="text-sm text-gray-500 sm-leading-24"
                                        style="font-size: 14px; line-height: 22px; color: #adb5bd">
                                        <a href="mailto:info@sabunpasal.com" class="text-blue-500 no-underline"
                                            style="color: #007788; text-decoration: none">info@sabunpasal.com</a>
                                        |
                                        <a href="{{ route('privacy.policy') }}" target="_blank"
                                            class="text-blue-500 no-underline"
                                            style="color: #007788; text-decoration: none">Privacy Policy</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!-- End Content Area Table -->
            </td>
        </tr>
    </table>
    <!-- End Main Wrapper Table -->
</body>

</html>
