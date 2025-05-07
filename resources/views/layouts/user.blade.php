<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('user_page_title')</title>
    {{--
    <link rel="stylesheet" href="css/style.css"> --}}
    <link href="{{ asset('user_asset/css/style.css') }}" rel="stylesheet">
    {{--
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-DQvkBjpPgn7RC31MCQoOeC9TI2kdqa4+BSgNMNj8v77fdC77Kj5zpWFTJaaAoMbC" crossorigin="anonymous">
    --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-DQvkBjpPgn7RC31MCQoOeC9TI2kdqa4+BSgNMNj8v77fdC77Kj5zpWFTJaaAoMbC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @livewireStyles
</head>

<body>
    @if ($errors->any())
    <div id="errorAlert" class="alert alert-danger alert-dismissable show">
        @foreach ($errors->all() as $error)
            <p>* {{ $error }}</p>
        @endforeach
    </div>

    <style>
        #errorAlert {
            position: fixed;
            top: 20px;
            /* right: 0; */
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(220, 53, 69, 0.95); /* Bootstrap danger with transparency */
            color: white;
            padding: 16px 24px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            opacity: 1;
            visibility: visible;
            transition: opacity 0.5s ease, visibility 0.5s ease;
            max-width: 90%;
            width: fit-content;
            text-align: left;
        }

        #errorAlert.fade {
            opacity: 0;
            visibility: hidden;
        }

        #errorAlert p {
            margin: 0;
            padding: 2px 0;
        }
    </style>

    <script>
        setTimeout(function () {
            const alert = document.getElementById('errorAlert');
            if (alert) alert.classList.add('fade');
        }, 2500);
    </script>
@endif

@if (session("success"))
<div id="successAlert" class="alert alert-success alert-dismissable show">
    <p>{{ session("success") }}</p>
</div>

<style>
    #successAlert {
        position: fixed;
        top: 20px;
        /* right: 0; */
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(6, 147, 20, 0.51); /* Bootstrap danger with transparency */
        color: white;
        padding: 16px 24px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        z-index: 9999;
        opacity: 1;
        visibility: visible;
        transition: opacity 0.5s ease, visibility 0.5s ease;
        max-width: 90%;
        width: fit-content;
        text-align: left;
    }

    #successAlert.fade {
        opacity: 0;
        visibility: hidden;
    }

    #successAlert p {
        margin: 0;
        padding: 2px 0;
    }
</style>

<script>
    setTimeout(function () {
        const alert = document.getElementById('successAlert');
        if (alert) alert.classList.add('fade');
    }, 2500);
</script>
@endif


    <header class="header">
        <div class="container header-top-bar">
            <span class="announcement"></span>
            <div class="top-bar-links">
                <a href="#">Track Order</a>
                @if (Auth::user())
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="link-button">Logout</button>
                    </form>
                @else
                    <a href="#" onclick="event.preventDefault(); openLoginModal();">Login</a>

                    <a href="#" onclick="event.preventDefault(); openRegisterModal();">Register</a>



                    {{-- <a href="{{ route('register') }}">Register</a> --}}
                @endif
            </div>
        </div>
        <div class="container header-main">
            <a href="{{ route('home') }}" class="logo">
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
                    @if (Auth::user())
                        <span>{{ Auth::user()->name }}</span>
                    @else
                        <span>Account</span>
                    @endif
                    {{-- <span>Account</span> --}}
                </a>
            </div>
        </div>
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


    {{-- Login Modal --}}
    <div id="loginModal" class="modal" style="display: none;">
        <div class="modal-content">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        value="{{ old('email') }}" required autofocus />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                        required />
                </div>

                <div class="mt-4">
                    <label>
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                </div>

                <div class="mt-4">
                    <button type="submit">Login</button>
                </div>

                <div class="mt-4 text-center">
                    <a href="#" onclick="openRegisterModal(); closeLoginModal();"
                        class="underline text-sm text-gray-600 hover:text-gray-900">
                        {{ __('Don’t have an account? Register') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Register Modal --}}
    <div id="registerModal" class="modal" style="display: none;">
        <div class="modal-content">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <button type="submit">Register</button>
                </div>

                <div class="mt-4 text-center">
                    <a href="#" onclick="closeRegisterModal(); openLoginModal();"
                        class="underline text-sm text-gray-600 hover:text-gray-900">
                        {{ __('Already have an account? Login') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openLoginModal() {
            document.getElementById('loginModal').style.display = 'block';
        }

        function closeLoginModal() {
            document.getElementById('loginModal').style.display = 'none';
        }

        function openRegisterModal() {
            document.getElementById('registerModal').style.display = 'block';
        }

        function closeRegisterModal() {
            document.getElementById('registerModal').style.display = 'none';
        }


        window.addEventListener('click', function(event) {
            const loginModal = document.getElementById('loginModal');
            const registerModal = document.getElementById('registerModal');
            if (event.target === loginModal) {
                closeLoginModal();
            } else if (event.target === registerModal) {
                closeRegisterModal();
            }
        });
    </script>



    <script src="{{ asset('user_asset/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    @livewireScripts
</body>

</html>
