<div>
    <select class="form-control" wire:model.live="selectedCategory">
        <option value="">Select a Category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
        @endforeach
    </select>

    {{-- {{ $selectedCategory }} --}}

    <select class="form-control" wire:model.live="selectedSubcategory">
        <option value="">Select a Subcategory</option>
        @foreach($subcategories as $subcategory)
            <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</option>
        @endforeach
    </select>
</div>
