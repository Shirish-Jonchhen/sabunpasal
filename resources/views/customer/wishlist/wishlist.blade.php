@extends('layouts.user')
@section('user_page_title', 'Sabun Pasal - Wishlist')

@section('user_content')
<div class="container page-content">
    <h1>My Wishlist</h1>
    <livewire:wishlist.wishlist-component />
</div>

@endsection