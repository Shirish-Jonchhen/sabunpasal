<?php

namespace App\Livewire\Admin;

use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
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
        if ($value === 'shipped') {
            // Send email notification when order is shipped
            Mail::to($this->order->user->email)->send(new OrderShipped($this->order));
        }
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
