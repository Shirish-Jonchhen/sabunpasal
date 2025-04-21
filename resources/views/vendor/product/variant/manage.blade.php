@extends('vendor.layouts.layout')
@section('vendor_page_title', 'Manage Product variant - Vendor')

@section('vendor_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Product variants</h5>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissable fade show">
                            {{-- <ul type="none"> --}}
                                @foreach ($errors->all() as $error)
                                    {{-- <li> --}}
                                        *{{ $error }} <br>
                                        {{-- </li> --}}
                                @endforeach
                                {{-- </ul> --}}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissable fade show">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Attribute/Unit</th>
                                    <th scope="col">Regular Price</th>
                                    <th scope="col">Discounted Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_variants as $variant)
                                    <tr>
                                        {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                        <td> {{ $variant->id }}</td>
                                        <td>{{ $variant->product->product_name }}</td>
                                        <td>
                                            @if ($variant->product->images && $variant->product->images->count() > 0)
                            
                                                @foreach ($variant->product->images as $image)
                                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image"
                                                        width="50">
                                                @endforeach
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>{{ $variant->attribute->attribute_value }}</td>
                                        <td>{{ $variant->regular_price }}</td>
                                        <td>{{ $variant->discounted_price }}</td>
                                        <td>{{ $variant->stock_quantity }}</td>
            
                                        <td>
                                            <a href="{{ route('vendor.product.variant.show', $variant->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>

                                            <form action="{{ route('vendor.product.variant.delete', $variant->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                            </form>
                                            {{-- <a href="#" class="btn btn-danger btn-sm">Delete</a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection