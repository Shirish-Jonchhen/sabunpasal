@extends('layouts.user')
@section('user_page_title', 'Sabun Pasal - Wishlist')

@section('user_content')
<div class="container">
    <nav aria-label="breadcrumb" class="breadcrumbs">
        <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li aria-current="page">Wishlist</li>
        </ol>
    </nav>
    <h1>My Wishlist</h1>
    <livewire:wishlist.wishlist-component />
</div>

@endsection