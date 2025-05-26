@extends('layouts.user')
@section('user_page_title', 'Sabun Pasal - Checkout')
@section('user_content')
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumbs">
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a
                        href="{{ route('user.show.category', $product->category->slug) }}">{{ $product->category->category_name }}</a>
                </li>
                <li><a
                        href="{{ route('user.show.subcategory', $product->subcategory->slug) }}">{{ $product->subcategory->subcategory_name }}</a>
                </li>
                <li><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></li>
                <li aria-current="page">Checkout</li>
            </ol>
        </nav>
        <h1>Checkout</h1>

        <livewire:customer.single-address-form :productVariantPriceId="$variantPrice->id" :quantity="$quantity" />
    </div>


@endsection
