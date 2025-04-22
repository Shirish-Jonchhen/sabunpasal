@php use Illuminate\Support\Str; @endphp
<div class="position-relative">
    <input 
        type="text"
        wire:model.live="search" 
        placeholder="Search brand..."
        class="form-control mb-2"
        autocomplete="off"
    />

    @if (!empty($search))
        @if (count($variants) > 0)
            <ul class="list-group position-absolute w-100 z-10 shadow" style="max-height: 300px; overflow-y: auto;">
                @foreach ($variants as $variant)
                    <li class="list-group-item">
                        <div class="d-flex align-items-center gap-3">
                            @if ($variant->product->images)
                                <img src="{{ asset('storage/' . $variant->product->images->first()->image_path) }}" alt="Icon" width="40" height="40" class="rounded">
                            @else
                                <div style="width: 40px; height: 40px; background-color: #eee;" class="rounded text-center d-flex align-items-center justify-content-center">N/A</div>
                            @endif
                            
                            <div>
                                <strong>{!! preg_replace("/(" . preg_quote($search) . ")/i", "<span style='color:orange;'>$1</span>", $variant->product->product_name, 1) !!} / {{ $variant->attribute->attribute_value }}</strong><br>
                                <small>ID: {{ $variant->id }} | Unit: {{ $variant->attribute->attribute_value }} | Regular Price: {{ $variant->regular_price }} | Discounted Price: {{ $variant->discounted_price }} | Quantity: {{ $variant->stock_quantity }}</small>
                            </div>

                            <a href="{{ route('vendor.product.variant.show', $variant->id) }}" class="btn btn-sm btn-outline-primary ms-auto">Edit</a>
                            <form action="{{ route('vendor.product.variant.delete', $variant->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger ms-2">Delete</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="alert alert-warning mt-2 position-absolute w-100 z-10 shadow">
                No variant found.
            </div>
        @endif
    @endif
</div>
