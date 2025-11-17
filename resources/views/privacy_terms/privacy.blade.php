@extends('layouts.user')
@section('user_page_title', 'Sabun Pasal - Privacy Policy')

@section('user_content')
<div class="container">
    <nav aria-label="breadcrumb" class="breadcrumbs">
        <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li aria-current="page">Privacy Policy</li>
        </ol>
    </nav>
    <h1>Privacy Policy</h1>
    <p>Last updated: <span id="last-updated-date"> <strong> 25th August, 2025</strong> </span></p>

    <p>
      Welcome to SabunPasal.com! We value your trust and are committed to 
      safeguarding your personal information. This Privacy Policy explains 
      what information we collect, how we use it, and how we protect it. 
      By using our website, you agree to the practices described in this policy.
    </p>

    <h2>Collection of Your Information</h2>
    <p>
      We may collect information about you in the following ways:
    </p>
    <ul>
      <li>
        <strong>Personal Information:</strong> We collect details such as 
        your name, phone number, delivery address, and email address. 
        This information is used for record-keeping, order processing, 
        user personalization, and ensuring timely delivery of products.
      </li>
      <li>
        <strong>Derivative Data:</strong> When you access our site, our system 
        automatically collects technical information such as your IP address, 
        browser type, device information, operating system, and the pages 
        you visit. This helps us analyze usage trends and improve your 
        experience on the site.
      </li>
      <li>
        <strong>Payment Information:</strong> Currently, we only support 
        <em>Cash on Delivery (COD)</em>. In the future, we may add additional 
        payment options such as Fonepay, eSewa, and other digital wallets. 
        If and when such services are introduced, your financial details will 
        be securely handled by the respective payment providers in compliance 
        with their policies.
      </li>
    </ul>

    <h2>Use of Your Information</h2>
    <p>
       The information we collect allows us to provide you with a smooth, 
       efficient, and personalized shopping experience. We may use your 
       information to:
    </p>
    <ul>
      <li>Create and manage your account.</li>
      <li>Process and deliver your orders.</li>
      <li>Communicate with you about your account, orders, or support queries.</li>
      <li>Improve our website’s performance and user experience.</li>
      <li>Send updates about our products, offers, or important changes.</li>
    </ul>

    <h2>Security of Your Information</h2>
    <p>
      We implement appropriate technical and organizational measures to 
      protect your information. While no method of transmission over the 
      Internet is 100% secure, we strive to protect your personal data 
      to the best of our ability.
    </p>

    <h2>Changes to This Policy</h2>
    <p>
      We may update this Privacy Policy from time to time to reflect changes 
      in our practices or for other operational, legal, or regulatory reasons. 
      Any changes will be posted on this page with the updated date.
    </p>

    <h2>Contact Us</h2>
    <p>
      If you have any questions or concerns about this Privacy Policy, please 
      contact us at: <strong>info@sabunpasal.com</strong> 
      or via our <a href="{{ route('contact.us') }}">Contact Page</a>.
    </p>
</div>
@endsection
