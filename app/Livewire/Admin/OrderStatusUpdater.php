<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class OrderStatusUpdater extends Component
{

    public $order;
    public $orderStatus;
    public $paymentStatus;

    public function mount($order)
    {
        $this->order = $order;
        $this->orderStatus = $order->order_status;
        $this->paymentStatus = $order->payment_status;
    }

    public function updatedOrderStatus($value)
    {
        $this->order->order_status = $value;
        $this->order->save();
        session()->flash('message', 'Order status updated!');
    }

    public function updatedPaymentStatus($value)
    {
        $this->order->payment_status = $value;
        $this->order->save();
        session()->flash('message', 'Payment status updated!');
    }

    public function render()
    {
        return view('livewire.admin.order-status-updater');
    }
}
