<div>
    <div>
        <label for="link_type" class="form-label fw-bold mb-2">Banner Type</label>
        <select class="form-control mb-2" name="link_type" wire:model.live="selectedBannerType">
            <option value="">Banner Type</option>
            @foreach ($bannerTypes as $type)
                <option value="{{ $type }}">{{ ucfirst($type) }}</option>
            @endforeach
        </select>

        <label for="link_id" class="form-label fw-bold mb-2">Banner {{ ucfirst($selectedBannerType) }}</label>
        <select class="form-control mb-2" name="link_id" wire:model.live="selectedBannerLink"
            @if (empty($bannerLinkIds)) disabled @endif>
            <option value="">Select {{ $selectedBannerType }}</option>
            @foreach ($bannerLinkIds as $link)
                <option value="{{ $link->id }}">
                    @if ($selectedBannerType == 'brand')
                        {{ $link->name }}
                    @elseif($selectedBannerType == 'subcategory')
                        {{ $link->subcategory_name }}
                    @elseif($selectedBannerType == 'product')
                        {{ $link->product_name }} - {{ $link->store->store_name }} - {{ $link->vendor->name }}
                    @endif
                </option>
            @endforeach
        </select>
    </div>
</div>
