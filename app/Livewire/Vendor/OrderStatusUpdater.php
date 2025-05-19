<?php

namespace App\Livewire\Vendor;

use Livewire\Component;

class OrderStatusUpdater extends Component
{
    public $sorder;
    public $sorderStatus;
    public $spaymentStatus;

    public function mount($sorder)
    {
        $this->sorder = $sorder;
        $this->sorderStatus = $sorder->status;
        $this->spaymentStatus = $sorder->payment_status;
    }

    public function updatedSorderStatus($value)
    {
        $this->sorder->status = $value;
        $this->sorder->save();
        session()->flash('message', 'Order status updated!');
    }

    public function updatedSpaymentStatus($value)
    {
        $this->sorder->payment_status = $value;
        $this->sorder->save();
        session()->flash('message', 'Payment status updated!');
    }

    public function render()
    {
        return view('livewire.vendor.order-status-updater');
    }
}
