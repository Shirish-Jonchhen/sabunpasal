@php use Illuminate\Support\Str; @endphp


    <div class="search-bar">
        <!-- Basic search form - point action to your Laravel search route -->
        <form action="{{ route("user.all.product") }}" style="display: flex; width: 100%;">
            <input type="text" name="query" placeholder="Search for products..." class="search-input-main"
                aria-label="Search products" wire:model.live="search">
            <button type="submit" class="search-button" aria-label="Submit search"><i
                    class="fas fa-search"></i></button>
        </form>

        @if (!empty($search))
        @if (count($products) > 0)
            <ul class="list-group position-absolute w-[100%] z-10 shadow" style="overflow-y: auto; top: 100%;"> 
                @foreach ($products as $product)
                    <li >
                        <a href="{{ route('product.show', $product->slug) }}" class="list-group-item">
                        <div class="d-flex align-items-center gap-3">
                            @php
                            $firstVariant = $product->variants->first();
                            $firstPrice = $firstVariant?->prices->first();
                            $imagePath = $firstVariant?->images->first()?->image_path;
                        @endphp
                            @if ($imagePath)
                            <img src="{{ asset('storage/' . $imagePath) }}" alt="Icon"
                            width="40" height="40"
                            class="rounded bg-white"
                            style="width: 40px; height: 40px; object-fit: contain;">
                       
                            @else
                                <div style="width: 40px; height: 40px; background-color: #eee;" class="rounded text-center d-flex align-items-center justify-content-center">N/A</div>
                            @endif
                            
                            <div>
                                <strong>{!! preg_replace("/(" . preg_quote($search) . ")/i", "<span style='color:orange;'>$1</span>", $product->name, 1) !!}</strong><br>
                                <small class="" style="font-size: 12px; text-decoration: line-through;">
                                    @php
                                        $lowestOldPrice =
                                            $product->variants->flatMap->prices->sortBy('old_price')->first()
                                                ->old_price ?? '0.00';
                                        $highestOldPrice =
                                            $product->variants->flatMap->prices->sortByDesc('old_price')->first()
                                                ->old_price ?? '0.00';
                                        $lowestPrice =
                                            $product->variants->flatMap->prices->sortBy('price')->first()->price ??
                                            '0.00';
                                        $highestPrice =
                                            $product->variants->flatMap->prices->sortByDesc('price')->first()->price ??
                                            '0.00';
                                    @endphp
                    
                                    @if ($lowestOldPrice == $highestOldPrice)
                                        NRs.{{ $lowestOldPrice }}
                                    @else
                                        NRs.{{ $lowestOldPrice }} - NRs.{{ $highestOldPrice }}
                                    @endif
                                </small> 
                                <br>
                                <small style="font-size: 16px; color:#007788;">
                                    @php
                                        
                                    @endphp
                    
                                    @if ($lowestPrice == $highestPrice)
                                        NRs.{{ $lowestPrice }}
                                    @else
                                        NRs.{{ $lowestPrice }} - NRs.{{ $highestPrice }}
                                    @endif
                                </small>
                            </div>
                        </div>
                    </a>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="alert alert-warning mt-2 position-absolute w-[100%] z-10 shadow" style='top: 100%;'>
                No Products found.
            </div>
        @endif
    @endif
    </div>
