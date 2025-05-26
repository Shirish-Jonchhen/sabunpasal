@extends('layouts.user')
@section('user_page_title', 'Sabun Pasal - Checkout')
@section('user_content')
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumbs">
            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('user.cart') }}">Cart</a></li>
                <li aria-current="page">Checkout</li>
            </ol>
        </nav>
        <h1>Checkout</h1>
        <livewire:customer.address-form :cartItems="$cartItems" />
    </div>


@endsection
