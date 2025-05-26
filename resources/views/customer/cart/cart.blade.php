@extends('layouts.user')
@section('user_page_title', 'Sabun Pasal - Cart')

@section('user_content')
<div class='container'>
    <nav aria-label="breadcrumb" class="breadcrumbs">
        <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li aria-current="page">Cart</li>
        </ol>
    </nav>
    <h1>Shopping Cart</h1>

    <livewire:cart.cart-component />

</div>

@endsection