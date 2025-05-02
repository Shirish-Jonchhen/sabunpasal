@extends('vendor.layouts.layout')
@section('vendor_page_title', 'Manage Product - Vendor')

@section('vendor_layout')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">All Products</h5>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissable fade show">
                        @foreach ($errors->all() as $error)
                            *{{ $error }} <br>
                        @endforeach
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissable fade show">
                        {{ session('success') }}
                    </div>
                @endif

                <livewire:vendor.product-manager />

                <div class="table-responsive mt-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Image</th>
                                <th>SKU</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Store</th>
                                <th>Price</th>
                                <th>Tax(%)</th>
                                <th>Stock</th>
               
                                <th>Status</th>
                                <th>Visibility</th>
                                <th>On Sale</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                @php
                                    $firstVariant = $product->variants->first();
                                    $firstPrice = $firstVariant?->prices->first();
                                    $imagePath = $firstVariant?->images->first()?->image_path;
                                @endphp

                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        @if ($imagePath)
                                            <img src="{{ asset('storage/' . $imagePath) }}" alt="Product Image" width="50">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>{{ $product->sku }}</td>
                                    <td>{{ $product->category->category_name ?? '-' }}</td>
                                    <td>{{ $product->subcategory->subcategory_name ?? '-' }}</td>
                                    <td>{{ $product->store->store_name ?? '-' }}</td>
                                    <td>{{ $firstPrice?->price ?? 'N/A' }}</td>
                                    <td>{{ $product->tax_rate }}%</td>
                                    <td>{{ $firstPrice?->stock ?? '0' }}</td>
                               
                                    <td>{{ $product->status }}</td>
                                    <td>{{ $product->visibility }}</td>
                                    <td>{{ $product->is_on_sale ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <a href="{{ route('vendor.product.show', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('vendor.product.delete', $product->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> {{-- end table-responsive --}}
            </div>
        </div>
    </div>
</div>
@endsection
