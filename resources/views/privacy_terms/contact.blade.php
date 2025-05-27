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
                <p><a href="tel:+1234567890" style="font-size: 1.1rem; color: var(--text-color);">+1 (234) 567-890</a></p>
            </div>
            <div class="contact-method" style="">
                <i class="fas fa-envelope fa-2x" style="color: var(--primary-color); margin-bottom: 0.5rem;"></i>
                <h3>Email</h3>
                <p><a href="mailto:support@cleansweepmart.com" style="font-size: 1.1rem; color: var(--text-color);">support@cleansweepmart.com</a></p>
            </div>
            <div class="contact-method">
                <i class="fab fa-whatsapp fa-2x" style="color: var(--primary-color); margin-bottom: 0.5rem;"></i>
                <h3>WhatsApp</h3>
                <p><a href="https://wa.me/1234567890" target="_blank" style="font-size: 1.1rem; color: var(--text-color);">+1 (234) 567-890</a></p>
            </div>
        </div>
        <div style="margin-top: 2rem; font-size: 0.9rem; color: var(--muted-text-color); text-align: center;">
            <p><strong>Business Hours:</strong> Monday - Friday, 9:00 AM - 6:00 PM (EST)</p>
            <p><strong>Address:</strong> 123 Clean Avenue, Sparkle City, SC 54321 (Visits by appointment only)</p>
        </div>
</div>

@endsection