<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('user_page_title')</title>
    {{-- <link rel="stylesheet" href="css/style.css"> --}}
    <link href="{{ asset('user_asset/css/style.css') }}" rel="stylesheet">
{{-- 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-DQvkBjpPgn7RC31MCQoOeC9TI2kdqa4+BSgNMNj8v77fdC77Kj5zpWFTJaaAoMbC" crossorigin="anonymous"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @livewireStyles
</head>

<body>
    <header class="header">
        <div class="container header-top-bar">
            <span class="announcement">Free Shipping on Orders Over $50!</span>
            <div class="top-bar-links">
                <a href="#">Track Order</a>
                <a href="#">Login</a>
                <a href="#">Register</a>
            </div>
        </div>
        <div class="container header-main">
            <a href="index.html" class="logo">
                <i class="fas fa-soap logo-icon"></i> <!-- Example icon -->
                <span class="logo-text">CleanSweep Mart</span>
            </a>

            <div class="search-bar">
                <!-- Basic search form - point action to your Laravel search route -->
                <form action="/search" method="GET" style="display: flex; width: 100%;">
                    <input type="text" name="query" placeholder="Search for products..." class="search-input-main"
                        aria-label="Search products">
                    <button type="submit" class="search-button" aria-label="Submit search"><i
                            class="fas fa-search"></i></button>
                </form>
            </div>

            <div class="header-actions">
                <a href="wishlist.html" class="header-action-link">
                    <i class="fas fa-heart"></i>
                    <span>Wishlist</span>
                    <span class="count" id="wishlist-count">0</span>
                </a>
                <a href="cart.html" class="header-action-link cart-link">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Cart</span>
                    <span class="count cart-count" id="cart-count">0</span>
                </a>
                <a href="#" class="header-action-link"> <!-- Link to account page -->
                    <i class="fas fa-user"></i>
                    <span>Account</span>
                </a>
            </div>
        </div>
        <!-- <nav class="navigation-bar">
             <div class="container">
                 <ul class="nav-list">
                     <li><a href="index.html" class="nav-link active">Home</a></li>
                     <li><a href="/category/bathroom-cleaners" class="nav-link">Bathroom</a></li>
                     <li><a href="/category/kitchen-cleaners" class="nav-link">Kitchen</a></li>
                     <li><a href="/category/laundry-detergents" class="nav-link">Laundry</a></li>
                     <li><a href="/category/floor-care" class="nav-link">Floor Care</a></li>
                     <li><a href="/category/eco-friendly" class="nav-link">Eco-Friendly</a></li>
                     <li><a href="orders.html" class="nav-link">Orders</a></li>
                     <li><a href="contact.html" class="nav-link">Contact</a></li>
                 </ul>
             </div>
         </nav> -->
    </header>

    <main class="page-content">

        @yield('user_content')


    </main>

    <footer class="footer">
        <div class="footer-main container">
            <div class="footer-column about-column">
                <a href="index.html" class="logo footer-logo">
                    <i class="fas fa-soap logo-icon"></i>
                    <span class="logo-text">CleanSweep Mart</span>
                </a>
                <p>Your one-stop shop for quality cleaning supplies. We provide effective solutions for a sparkling
                    clean home and business.</p>
                <div class="social-media-links">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="Pinterest"><i class="fab fa-pinterest"></i></a>
                </div>
            </div>
            <div class="footer-column">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="/products">All Products</a></li> <!-- Link to products page -->
                    <li><a href="orders.html">Order History</a></li>
                    <li><a href="wishlist.html">Wishlist</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                    <li><a href="#">FAQs</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Customer Service</h4>
                <ul>
                    <li><a href="#">Track Your Order</a></li>
                    <li><a href="terms.html">Terms of Service</a></li>
                    <li><a href="privacy.html">Privacy Policy</a></li>
                    <li><a href="#">Returns & Exchanges</a></li>
                    <li><a href="#">Shipping Information</a></li>
                </ul>
            </div>
            <div class="footer-column newsletter-column">
                <h4>Stay Updated</h4>
                <p>Subscribe to our newsletter for exclusive deals and updates.</p>
                <!-- Basic newsletter form - point action to Laravel route -->
                <form action="/newsletter/subscribe" method="POST" class="newsletter-form">
                    <!-- Add CSRF token in Laravel: @csrf -->
                    <input type="email" name="email" placeholder="Enter your email" required
                        aria-label="Email for newsletter">
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </form>
                <div class="payment-methods">
                    <span>We Accept:</span>
                    <i class="fab fa-cc-visa" title="Visa"></i>
                    <i class="fab fa-cc-mastercard" title="Mastercard"></i>
                    <i class="fab fa-cc-amex" title="American Express"></i>
                    <i class="fab fa-cc-paypal" title="PayPal"></i>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p>&copy; <span id="current-year"></span> CleanSweep Mart. All rights reserved. </p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('user_asset/js/script.js') }}"></script>
    
    @livewireScripts
</body>

</html>
