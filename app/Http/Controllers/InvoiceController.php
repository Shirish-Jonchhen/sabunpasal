<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;

class InvoiceController extends Controller
{
    public function downloadInvoice($order_tracking_number)
    {
        $order = Order::where('order_tracking_number', $order_tracking_number)->firstOrFail();

        // $pdf = Pdf::loadView('invoice.invoice', compact('order'));

        // return $pdf->download('invoice_' . $order->order_tracking_number . '.pdf');
        return view('invoice.invoice', compact('order'));
    }
}
