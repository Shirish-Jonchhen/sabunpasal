@extends('layouts.user')
@section('user_page_title', 'Sabun Pasal - Cart')

@section('user_content')
<div class='container page-content'>
    <h1>Shopping Cart</h1>

    <livewire:cart.cart-component />

</div>

@endsection