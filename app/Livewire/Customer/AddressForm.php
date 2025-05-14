<?php

namespace App\Livewire\Customer;

use App\Models\District;
use App\Models\Municipality;
use Livewire\Component;

class AddressForm extends Component
{

    public $districts = [];
    public $cartItems = [];
    public $municipalities = [];
    public $wards = [];
    public $district_id;
    public $municipality_id;
    public $ward_id;
    public $subtotal;
    public $totalTax;
    public $delivery_charge;
    public $shipping_method = 'delivery';

    public function mount($cartItems)
    {
        $this->districts = District::all();
        $this->cartItems = $cartItems;
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->variantPrice->price * $item->quantity;
        }
        $this->subtotal = $subtotal;
        $totalTax = 0;
        foreach ($cartItems as $item) {
            $totalTax += (($item->variantPrice->variant->product->tax_rate / 100) * $item->variantPrice->price) * $item->quantity;
        }
        $this->totalTax = $totalTax;
        $this->delivery_charge = 0;
    }


    public function updatedDistrictId($district_id)
    {
        $this->municipalities = District::find($district_id)->municipalities;
        $this->wards = [];

        $this->municipality_id = null;
        $this->delivery_charge = 0;
        $this->ward_id = null;
    }

    public function updatedMunicipalityId($municipality_id)
    {
        $this->wards = Municipality::find($municipality_id)->wards;
        $this->calculateDeliveryCharge();
        $this->ward_id = null;
    }
    public function updatedShippingMethod($value)
    {
        $this->shipping_method = $value;
        $this->calculateDeliveryCharge();
    }


    public function calculateDeliveryCharge()
    {
        if ($this->shipping_method === 'pickup') {
            $this->delivery_charge = 0;
        } elseif ($this->shipping_method === 'delivery' && $this->municipality_id) {
            $municipality = Municipality::find($this->municipality_id);
            $this->delivery_charge = $municipality ? $municipality->delivery_charge : 0;
        }
    }


    public function render()
    {
        return view('livewire.customer.address-form');
    }
}
