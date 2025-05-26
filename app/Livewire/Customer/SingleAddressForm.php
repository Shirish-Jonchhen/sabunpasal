<?php

namespace App\Livewire\Customer;

use App\Models\District;
use App\Models\Municipality;
use App\Models\VariantPrice;
use Livewire\Component;

class SingleAddressForm extends Component
{
    public $districts = [];
    // public $cartItems = [];
    public $municipalities = [];
    public $wards = [];
    public $district_id;
    public $municipality_id;
    public $ward_id;
    public $subtotal;
    public $totalTax;
    public $delivery_charge;
    public $productVariantPriceId;
    public $productVariantPrice;
    public $quantity;
    public $shipping_method = 'delivery';






    public function mount($productVariantPriceId, $quantity)
    {
        $this->districts = District::all();
        $this->productVariantPriceId = $productVariantPriceId;
        $this->productVariantPrice = VariantPrice::where("id",$productVariantPriceId)->firstOrFail();
        $this->quantity = $quantity;
        $this->subtotal = $this->productVariantPrice->price * $this->quantity;
        $this->totalTax = $this->productVariantPrice->variant->product->tax_rate /100 * $this->subtotal;
        $this->delivery_charge = 0;
    }

    public function updatedDistrictId($district_id)
    {
        if(!$district_id) {
            $this->municipalities = [];
            $this->wards = [];
            $this->municipality_id = null;
            $this->ward_id = null;
            $this->delivery_charge = 0;
            return;
        }
        $this->municipalities = District::find($district_id)->municipalities;
        $this->wards = [];

        $this->municipality_id = null;
        $this->delivery_charge = 0;
        $this->ward_id = null;
    }

    public function updatedMunicipalityId($municipality_id)
    {
        if(!$municipality_id) {
            $this->wards = [];
            $this->ward_id = null;
            $this->delivery_charge = 0;
            return;
        }
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
        return view('livewire.customer.single-address-form');
    }
}
