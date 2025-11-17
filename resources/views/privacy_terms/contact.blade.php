@extends('layouts.user')
@section('user_page_title', 'Sabun Pasal - Contact Us')

@section('user_content')
<div class="container">
    <nav aria-label="breadcrumb" class="breadcrumbs">
        <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li aria-current="page">Contact Us</li>
        </ol>
    </nav>

        <h1>Contact Us</h1>
        <p class="contact-intro">We'd love to hear from you! Reach out to us through any of the channels below.</p>

        <div class="contact-details-container">
            <div class="contact-method" style="">
                <i class="fas fa-phone-alt fa-2x" style="color: var(--primary-color); margin-bottom: 0.5rem;"></i>
                <h3>Phone</h3>
                <p><a href="#" style="font-size: 1.1rem; color: var(--text-color);">+977 9843631160</a></p>
            </div>
            <div class="contact-method" style="">
                <i class="fas fa-envelope fa-2x" style="color: var(--primary-color); margin-bottom: 0.5rem;"></i>
                <h3>Email</h3>
                <p><a href="#" style="font-size: 1.1rem; color: var(--text-color);">info@sabunpasal.com</a></p>
            </div>
            <div class="contact-method">
                <i class="fab fa-whatsapp fa-2x" style="color: var(--primary-color); margin-bottom: 0.5rem;"></i>
                <h3>WhatsApp</h3>
                <p><a href="https://wa.me/9843631160" target="_blank" style="font-size: 1.1rem; color: var(--text-color);">+977 9843631160</a></p>
            </div>
        </div>
        <div style="margin-top: 2rem; font-size: 0.9rem; color: var(--muted-text-color); text-align: center;">
            <p><strong>Business Hours:</strong> Monday - Friday, 9:00 AM - 6:00 PM (EST)</p>
            <p><strong>Address:</strong> Asan-25, Kathmandu, Bagmati, Nepal</p>
        </div>
</div>

@endsection