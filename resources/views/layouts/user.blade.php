<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('user_page_title')</title>
    {{--
    <link rel="stylesheet" href="css/style.css"> --}}
    {{--
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-DQvkBjpPgn7RC31MCQoOeC9TI2kdqa4+BSgNMNj8v77fdC77Kj5zpWFTJaaAoMbC" crossorigin="anonymous">
    --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-DQvkBjpPgn7RC31MCQoOeC9TI2kdqa4+BSgNMNj8v77fdC77Kj5zpWFTJaaAoMbC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="icon" href="{{ asset('logos/sabun_pasal_logo.png') }}" type="image/png">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="{{ asset('user_asset/css/style.css') }}" rel="stylesheet">

    @livewireStyles
</head>

<body class="relative">


    <div id="page-loader">
        <div class="loader-inner">
            {{-- Make sure you have a spinner.gif in public/images/ --}}
            <img src="{{ asset('gifs/loading.gif') }}" alt="Loading..." />
            {{-- <p>Loading, please wait...</p> --}}
        </div>
    </div>

    @if ($errors->updatePassword->any())
        <div id="errorPwAlert" class="alert alert-danger alert-dismissable show">
            @foreach ($errors->updatePassword->all() as $error)
                <p>* {{ $error }}</p>
            @endforeach
        </div>

        <style>
            #errorPwAlert {
                position: fixed;
                top: 20px;
                /* right: 0; */
                left: 50%;
                transform: translateX(-50%);
                background-color: rgba(220, 53, 69, 0.95);
                /* Bootstrap danger with transparency */
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

            #errorPwAlert.fade {
                opacity: 0;
                visibility: hidden;
            }

            #errorPwAlert p {
                margin: 0;
                padding: 2px 0;
            }
        </style>

        <script>
            setTimeout(function() {
                const alert = document.getElementById('errorPwAlert');
                if (alert) alert.classList.add('fade');
            }, 2500);
        </script>
    @endif



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
                background-color: rgba(220, 53, 69, 0.95);
                /* Bootstrap danger with transparency */
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
            setTimeout(function() {
                const alert = document.getElementById('errorAlert');
                if (alert) alert.classList.add('fade');
            }, 2500);
        </script>
    @endif


    @if (session('status'))
        <div id="statusAlert" class="alert alert-success alert-dismissable show">
            <p>{{ session('status') }}</p>
        </div>

        <style>
            #statusAlert {
                position: fixed;
                top: 20px;
                /* right: 0; */
                left: 50%;
                transform: translateX(-50%);
                background-color: rgba(6, 147, 20, 0.51);
                /* Bootstrap danger with transparency */
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

            #statusAlert.fade {
                opacity: 0;
                visibility: hidden;
            }

            #statusAlert p {
                margin: 0;
                padding: 2px 0;
            }
        </style>

        <script>
            setTimeout(function() {
                const alert = document.getElementById('statusAlert');
                if (alert) alert.classList.add('fade');
            }, 2500);
        </script>
    @endif



    @if (session('success'))
        <div id="successAlert" class="alert alert-success alert-dismissable show">
            <p>{{ session('success') }}</p>
        </div>

        <style>
            #successAlert {
                position: fixed;
                top: 20px;
                /* right: 0; */
                left: 50%;
                transform: translateX(-50%);
                background-color: rgba(6, 147, 20, 0.51);
                /* Bootstrap danger with transparency */
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
            setTimeout(function() {
                const alert = document.getElementById('successAlert');
                if (alert) alert.classList.add('fade');
            }, 2500);
        </script>
    @endif


    @if (session('error'))
        <div id="errorAlerts" class="alert alert-danger alert-dismissable show">
            <p>{{ session('error') }}</p>
        </div>

        <style>
            #errorAlerts {
                position: fixed;
                top: 20px;
                /* right: 0; */
                left: 50%;
                transform: translateX(-50%);
                background-color: rgba(220, 53, 69, 0.95);
                /* Bootstrap danger with transparency */
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

            #errorAlerts.fade {
                opacity: 0;
                visibility: hidden;
            }

            #errorAlerts p {
                margin: 0;
                padding: 2px 0;
            }
        </style>

        <script>
            setTimeout(function() {
                const alert = document.getElementById('errorAlerts');
                if (alert) alert.classList.add('fade');
            }, 2500);
        </script>
    @endif


    <header class="header">
        <div class="container header-top-bar">
            <span class="announcement"></span>
            <div class="top-bar-links">
                {{-- <a href="#">Track Order</a> --}}
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
                <img src="{{ asset('logos/sabun_pasal_linear.png') }}" alt="SabunPasal.com Logo" class="logo-image">
            </a>

            <livewire:customer.search-bar />

            <div class="header-actions">
                @if (Auth::user())
                    <a href="{{ route('user.wishlist') }}" class="header-action-link">
                        <i class="fas fa-heart"></i>
                        <span>Wishlist</span>
                        {{-- <span class="count" id="wishlist-count">0</span> --}}
                    </a>
                @else
                    <a href="wishlist.html" class="header-action-link"
                        onclick="event.preventDefault(); openLoginModal();">
                        {{-- <a href="{{ route('user.wishlist') }}" class="header-action-link"> --}}
                        {{-- <a href="#" class="header-action-link" onclick="event.preventDefault(); openLoginModal();"> --}}
                        <i class="fas fa-heart"></i>
                        <span>Wishlist</span>
                        {{-- <span class="count" id="wishlist-count">0</span> --}}
                    </a>
                @endif


                @if (Auth::user())
                    <a href="{{ route('user.cart') }}" class="header-action-link cart-link">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Cart</span>
                        {{-- <span class="count cart-count" id="cart-count">0</span> --}}
                    </a>
                @else
                    <a href="#" class="header-action-link cart-link"
                        onclick="event.preventDefault(); openLoginModal();">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Cart</span>
                        {{-- <span class="count cart-count" id="cart-count">0</span> --}}
                @endif
                <div x-data="{ open: false }" style="position: relative;">
                    <a href="#" @click.prevent="open = !open" class="header-action-link ">
                        <i class="fas fa-user"></i>
                        @if (Auth::check())
                            <span>{{ explode(' ', Auth::user()->name)[0] }}
                                @if (Auth::user()->email_verified_at)
                                    <i class="fa-regular fa-circle-check" style="font-size: 1em;"></i>
                                @endif
                            </span>
                        @else
                            <span>Account</span>
                        @endif
                    </a>

                    <!-- Dropdown -->
                    <div x-show="open" @click.outside="open = false" class="bg-white border rounded"
                        style="position: absolute; width:200px; right: 0; z-index: 10;" x-transition>
                        @if (Auth::check())
                            @if (!Auth::user()->email_verified_at)
                                <a href="" class=" px-2 py-2 hover:bg-gray-100 block"
                                    onclick="event.preventDefault(); openVerifyEmailModal();">Verify Email</a><br>
                            @endif

                            <a href="" class=" px-2 py-2 hover:bg-gray-100 block"
                                onclick="event.preventDefault(); openChangePasswordModal();">Change Password</a><br>
                            <a href="{{ route('user.orders') }}" class="px-2 py-2 hover:bg-gray-100 block">My
                                Orders</a><br>
                        @endif
                        <a href="{{ route('privacy.policy') }}" class=" px-2 py-2 hover:bg-gray-100 block">Privacy
                            Policy</a><br>
                        <a href="{{ route('terms.service') }}" class=" px-2 py-2 hover:bg-gray-100 block">Terms of
                            Service</a><br>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <main class="page-content">

        @yield('user_content')


    </main>

    <footer class="footer">
        <div class="footer-main container">
            <div class="footer-column about-column">
                <a href="{{ route('home') }}" class="logo footer-logo">
                    <img src="{{ asset('logos/sabun_pasal_linear_color_inversion.png') }}" alt="SabunPasal.com Logo"
                        class="logo-image-footer">
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
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('user.all.product') }}">All Products</a></li> <!-- Link to products page -->
                    <li><a href="{{ route('user.orders') }}">Order History</a></li>
                    <li><a href="{{ route('user.wishlist') }}">Wishlist</a></li>
                    <li><a href="{{ route('contact.us') }}">Contact Us</a></li>
                    {{-- <li><a href="#">FAQs</a></li> --}}
                </ul>
            </div>
            <div class="footer-column">
                <h4>Customer Service</h4>
                <ul>
                    {{-- <li><a href="#">Track Your Order</a></li> --}}
                    <li><a href="{{ route('terms.service') }}">Terms of Service</a></li>
                    <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                    {{-- <li><a href="#">Returns & Exchanges</a></li> --}}
                    {{-- <li><a href="#">Shipping Information</a></li> --}}
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
                {{-- <div class="payment-methods">
                    <span>We Accept:</span>
                    <i class="fab fa-cc-visa" title="Visa"></i>
                    <i class="fab fa-cc-mastercard" title="Mastercard"></i>
                    <i class="fab fa-cc-amex" title="American Express"></i>
                    <i class="fab fa-cc-paypal" title="PayPal"></i>
                </div> --}}
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p>&copy; <span id="current-year"></span> SabunPasal.com. All rights reserved. </p>
            </div>
        </div>
    </footer>


    {{-- Login Modal --}}
    <div id="loginModal" class="modal" style="display: none;">
        <div class="modal-content">
            <img src="{{ asset('logos/sabun_pasal_linear.png') }}" alt="SabunPasal.com Logo"
                class="logo-image-modal mb-4">

            <h3 class="">Login to Your Account</h3>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email-login" class="block mt-1 w-full" type="email" name="email"
                        value="{{ old('email') }}" required autofocus />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password-login" class="block mt-1 w-full" type="password" name="password"
                        required />
                </div>

                <div class="d-flex mt-4" style="justify-content:space-between;">

                    <div>
                        <label>
                            <input type="checkbox" name="remember"> Remember me
                        </label>
                    </div>
                    <div>
                        <label>
                            <a style="cursor:pointer !important;"
                                onclick="openForgotPasswordModal(); closeLoginModal()">Forgot Password?</a>
                        </label>
                    </div>

                </div>


                <div class="mt-4">
                    <button type="submit">Login</button>
                </div>

                <center class="mt-4 mb-4">
                    --- OR ---
                </center>

                <a href="{{ route('google.login') }}" class="btn btn-danger modal-btn">
                    <i class="fab fa-google"></i> Login with Google
                </a>




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
            <img src="{{ asset('logos/sabun_pasal_linear.png') }}" alt="SabunPasal.com Logo"
                class="logo-image-modal mb-4">

            <h3 class="">Register a New Account</h3>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <div class="mt-4">
                    <x-input-label for="email-register" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password-register" class="block mt-1 w-full" type="password" name="password"
                        required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                </div>

                <label for="terms" class="inline-flex items-center">
                    <input id="terms" type="checkbox" name="terms"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                        {{ old('terms') ? 'checked' : '' }} required>
                    <span class="ml-2 text-sm text-gray-600">
                        I agree to the <a href="{{ route('terms.service') }}"
                            class="underline text-sm text-gray-600 hover:text-gray-900">Terms and Conditions</a>
                    </span>
                </label>
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


    {{-- Change Password Modal --}}
    <div id="changePasswordModal" class="modal" style="display: none;">
        <div class="modal-content">
            <img src="{{ asset('logos/sabun_pasal_linear.png') }}" alt="SabunPasal.com Logo"
                class="logo-image-modal mb-4">

            <h3 class="">Want to change your password?</h3>
            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('put')

                <div>
                    <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                    <x-text-input id="update_password_current_password" name="current_password" type="password"
                        class="mt-1 block w-full" autocomplete="current-password" />
                    {{-- <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" /> --}}
                </div>

                <div>
                    <x-input-label for="update_password_password" :value="__('New Password')" />
                    <x-text-input id="update_password_password" name="password" type="password"
                        class="mt-1 block w-full" autocomplete="new-password" />
                    {{-- <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" /> --}}
                </div>

                <div>
                    <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="update_password_password_confirmation" name="password_confirmation"
                        type="password" class="mt-1 block w-full" autocomplete="new-password" />
                    {{-- <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" /> --}}
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>

                    @if (session('status') === 'password-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- forgot Password Modal --}}

    <div id="forgotPasswordModal" class="modal" style="display: none;">
        <div class="modal-content">
            <img src="{{ asset('logos/sabun_pasal_linear.png') }}" alt="SabunPasal.com Logo"
                class="logo-image-modal mb-4">

            <h4 class="">Forgot your password? No problem. Just let us know your email address and we will email
                you a password reset link that will allow you to choose a new one.</h4>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email-forgot-password" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autofocus />
                    {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button>
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>


    {{-- verify email Modal --}}
    <div id="verifyEmailModal" class="modal" style="display: none;">
        <div class="modal-content">
            <img src="{{ asset('logos/sabun_pasal_linear.png') }}" alt="SabunPasal.com Logo"
                class="logo-image-modal mb-4">

            <h3 class="">Seems like you havent verified your email?</h3>

            <p>
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the
                link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.
            </p>
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-primary-button>
                        {{ __('Resend Verification Email') }}
                    </x-primary-button>
                </div>
            </form>

        </div>
    </div>

    {{-- 4) INTERCEPT INTERNAL LINK CLICKS TO SHOW LOADER IMMEDIATELY --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Grab all <a> tags on the page
            document.querySelectorAll('a').forEach(function(link) {
                // Only intercept “same-host” links (i.e. internal navigation)
                const href = link.getAttribute('href');
                if (!href || href.startsWith('http') || href.startsWith('#')) {
                    // console.log("Intercepted link clickss:", href);

                    return;
                }

                link.addEventListener('click', function(e) {
                    // Let special links (e.g. target="_blank") behave normally:
                    if (link.target === '_blank' || e.metaKey || e.ctrlKey) {
                        return;
                    }

                    // Prevent the default jump immediately
                    e.preventDefault();

                    console.log("Intercepted link click:", href);

                    // Show our loader overlay right away
                    document.getElementById('page-loader').style.display = 'flex';
                    document.getElementById('main-content').style.display = 'none';

                    // Wait a tiny tick so the loader actually paints:
                    setTimeout(function() {
                        window.location.href = href;
                    }, 5000);
                });
            });
        });
    </script>
    <script>
        window.addEventListener('load', function() {
            // Once all CSS, JS, images, etc. are fully loaded:
            document.getElementById('page-loader').style.display = 'none';
            document.getElementById('main-content').style.display = 'block';
        });
    </script>

    <script>
        @if (Auth::user() && !Auth::user()->email_verified_at && !session('shown_verify_email_popup'))
            window.onload = function() {
                openVerifyEmailModal();
            };

            @php
                session(['shown_verify_email_popup' => true]);
            @endphp
        @endif
        function openLoginModal() {
            console.log("hello");
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

        function openChangePasswordModal() {
            document.getElementById('changePasswordModal').style.display = 'block';
        }

        function closeChangePasswordModal() {
            document.getElementById('changePasswordModal').style.display = 'none';
        }

        function openForgotPasswordModal() {
            document.getElementById('forgotPasswordModal').style.display = 'block';
        }

        function closeForgotPasswordModal() {
            document.getElementById('forgotPasswordModal').style.display = 'none';
        }

        function openVerifyEmailModal() {
            document.getElementById('verifyEmailModal').style.display = 'block';
        }

        function closeVerifyEmailModal() {
            document.getElementById('verifyEmailModal').style.display = 'none';
        }


        window.addEventListener('click', function(event) {
            const loginModal = document.getElementById('loginModal');
            const registerModal = document.getElementById('registerModal');
            const changePasseordModal = document.getElementById('changePasswordModal');
            const forgotPasseordModal = document.getElementById('forgotPasswordModal');
            const verifyEmailModal = document.getElementById('verifyEmailModal');
            if (event.target === loginModal) {
                closeLoginModal();
            } else if (event.target === registerModal) {
                closeRegisterModal();
            } else if (event.target === changePasseordModal) {
                closeChangePasswordModal();
            } else if (event.target === forgotPasseordModal) {
                closeForgotPasswordModal();
            } else if (event.target === verifyEmailModal) {
                closeVerifyEmailModal();
            }
        });
    </script>



    <script src="{{ asset('user_asset/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    @livewireScripts
</body>

</html>
