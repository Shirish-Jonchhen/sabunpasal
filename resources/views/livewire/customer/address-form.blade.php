<div class="form-row">
    <div class="form-group">
        <label for="city">District</label>
        {{-- <input type="text" id="district" name="district" required> --}}
        <select id="district" name="district" class="form-select mb-2" wire:model.live = 'district_id' required>
            <option value="" selected>Select District</option>
            @foreach ($districts as $district)
                <option value="{{ $district->id }}">{{ $district->district_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="state">Municipality</label>
        {{-- <input type="text" id="municipality" name="municipality" required> --}}
        <select id="municipality" name="municipality" class="form-select mb-2" wire:model.live = 'municipality_id'  required>
            <option value="" selected>Select Municipality</option>
            @foreach ($municipalities as $municipality)
                <option value="{{ $municipality->id }}">{{ $municipality->municipality_name }}</option>
            @endforeach
        </select>

    </div>
    <div class="form-group">
        <label for="zip">Ward</label>
        {{-- <input type="text" id="ward" name="ward" required> --}}
        <select id="ward" name="ward" class="form-select mb-2" wire:model.live = 'ward_id'  required>
            <option value="" selected>Select Municipality</option>

            @foreach ($wards as $ward)
                <option value="{{ $ward->id }}">{{ $ward->ward_name }}</option>
            @endforeach
        </select>
    </div>
</div>
