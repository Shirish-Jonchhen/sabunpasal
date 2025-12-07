<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class KhaltiService
{
    public function initiate(Order $order, int $amountInPaisa): array
    {
        $payload = [
            'return_url' => config('khalti.return_url'),
            'website_url' => config('app.url'),
            'amount' => $amountInPaisa,
            'purchase_order_id' => $order->order_tracking_number ?? Str::uuid()->toString(),
            'purchase_order_name' => 'Order ' . ($order->order_tracking_number ?? $order->id),
        ];

        $customerInfo = array_filter([
            'name' => $order->getAttribute('customer_name'),
            'email' => $order->getAttribute('customer_email'),
            'phone' => $order->getAttribute('customer_phone'),
        ]);

        if (!empty($customerInfo)) {
            $payload['customer_info'] = $customerInfo;
        }

        $response = Http::withHeaders([
            'Authorization' => 'Key ' . config('khalti.secret_key'),
        ])->post(rtrim(config('khalti.base_url'), '/') . '/epayment/initiate/', $payload);

        return $this->handleResponse($response);
    }

    public function lookup(string $pidx): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Key ' . config('khalti.secret_key'),
        ])->post(rtrim(config('khalti.base_url'), '/') . '/epayment/lookup/', [
            'pidx' => $pidx,
        ]);

        return $this->handleResponse($response);
    }

    private function handleResponse(Response $response): array
    {
        $response->throw();

        return $response->json();
    }
}
