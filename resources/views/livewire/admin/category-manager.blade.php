@php use Illuminate\Support\Str; @endphp
<div class="position-relative">
    <input 
        type="text"
        wire:model.live="search" 
        placeholder="Search category..."
        class="form-control mb-2"
        autocomplete="off"
    />

    @if (!empty($search))
        @if (count($categories) > 0)
            <ul class="list-group position-absolute w-100 z-10 shadow" style="max-height: 300px; overflow-y: auto;">
                @foreach ($categories as $category)
                    <li class="list-group-item">
                        <div class="d-flex align-items-center gap-3">
                            @if ($category->icon_path)
                                <img src="{{ asset('storage/' . $category->icon_path) }}" alt="Icon" width="40" height="40" class="rounded">
                            @else
                                <div style="width: 40px; height: 40px; background-color: #eee;" class="rounded text-center d-flex align-items-center justify-content-center">N/A</div>
                            @endif
                            
                            <div>
                                <strong>{!! preg_replace("/(" . preg_quote($search) . ")/i", "<span style='color:orange;'>$1</span>", $category->category_name, 1) !!}</strong><br>
                                <small>ID: {{ $category->id }} | Slug: {{ $category->slug }} | Featured: {{ $category->is_featured ? 'Yes' : 'No' }}</small>
                            </div>

                            <a href="{{ route('show.cat', $category->id) }}" class="btn btn-sm btn-outline-primary ms-auto">Edit</a>
                            <form action="{{ route('delete.cat', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
                No categories found.
            </div>
        @endif
    @endif
</div>
