@extends('layouts.user')
@section('user_page_title', 'Sabun Pasal - Checkout')
@section('user_content')
    <div class="container page-content">
        <h1>Checkout</h1>
        <livewire:customer.address-form :cartItems="$cartItems" />
    </div>


@endsection
