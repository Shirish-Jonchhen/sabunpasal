<div>
    <label for="category_id" class="form-label fw-bold mb-2">Product Category</label>
    <select class="form-control mb-2" name="category_id" wire:model.live="selectedCategory">
        <option value="">Select a Category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
        @endforeach
    </select>

    {{-- {{ $selectedCategory }} --}}
    <label for="subcategory_id" class="form-label fw-bold mb-2">Product Subcategory</label>
    <select class="form-control mb-2" name='subcategory_id' wire:model.live="selectedSubcategory">
        <option value="">Select a Subcategory</option>
        @foreach($subcategories as $subcategory)
            <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</option>
        @endforeach
    </select>
</div>