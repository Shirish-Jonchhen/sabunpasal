<?php

namespace App\Livewire\Customer;

use App\Models\District;
use App\Models\Municipality;
use Livewire\Component;

class AddressForm extends Component
{

    public $districts=[];
    public $municipalities = [];
    public $wards = [];
    public $district_id;
    public $municipality_id;
    public $ward_id;

    public function mount()
    {
        $this->districts = District::all();
    }

    public function updatedDistrictId($district_id)
    {
        $this->municipalities = District::find($district_id)->municipalities;
        $this->wards = [];

        $this->municipality_id = null;
        $this->ward_id = null;
    }

    public function updatedMunicipalityId($municipality_id)
    {
        $this->wards = Municipality::find($municipality_id)->wards;
        $this->ward_id = null;
    }

    public function render()
    {
        return view('livewire.customer.address-form');
    }
}
