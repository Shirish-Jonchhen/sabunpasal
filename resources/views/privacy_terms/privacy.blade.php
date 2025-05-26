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
    <p>Last updated: <span id="last-updated-date"></span></p>

    <p>
      Welcome to CleanSweep Mart! We are committed to protecting your privacy.
      This Privacy Policy explains how we collect, use, disclose, and safeguard
      your information when you visit our website. Please read this privacy
      policy carefully. If you do not agree with the terms of this privacy
      policy, please do not access the site.
    </p>

    <h2>Collection of Your Information</h2>
    <p>
      We may collect information about you in a variety of ways. The
      information we may collect on the Site includes:
    </p>
    <ul>
      <li>
        <strong>Personal Data:</strong> Personally identifiable information,
        such as your name, shipping address, email address, and telephone
        number, and demographic information, such as your age, gender,
        hometown, and interests, that you voluntarily give to us when you
        register with the Site or when you choose to participate in various
        activities related to the Site, such as online chat and message boards.
        You are under no obligation to provide us with personal information of
        any kind, however your refusal to do so may prevent you from using
        certain features of the Site.
      </li>
      <li>
        <strong>Derivative Data:</strong> Information our servers automatically
        collect when you access the Site, such as your IP address, your
        browser type, your operating system, your access times, and the pages
        you have viewed directly before and after accessing the Site. (This part would be handled by the server-side framework like Laravel).
      </li>
       <li>
         <strong>Financial Data:</strong> Financial information, such as data related to your payment method (e.g., valid credit card number, card brand, expiration date) that we may collect when you purchase, order, return, or exchange goods or services from the Site. [We store only very limited, if any, financial information that we collect. Otherwise, all financial information is stored by our payment processor, [Payment Processor Name - **REPLACE THIS**], and you are encouraged to review their privacy policy and contact them directly for responses to your questions.]
       </li>
    </ul>

     <h2>Use of Your Information</h2>
     <p>
       Having accurate information about you permits us to provide you with a
       smooth, efficient, and customized experience. Specifically, we may use
       information collected about you via the Site to:
     </p>
    <ul>
      <li>Create and manage your account.</li>
      <li>Email you regarding your account or order.</li>
      <li>Fulfill and manage purchases, orders, payments, and other transactions related to the Site.</li>
       <li>Improve the efficiency and operation of the Site.</li>
       <li>Monitor and analyze usage and trends to improve your experience with the Site (Server-side function).</li>
       <li>Notify you of updates to the Site.</li>
     </ul>

    {/* Add more sections as needed: Disclosure of Your Information, Security of Your Information, Policy for Children, Contact Us */}

    <h2>Contact Us</h2>
    <p>
      If you have questions or comments about this Privacy Policy, please
      contact us at: [Your Contact Email/Info - **REPLACE THIS**] or via the <a href="contact.html">Contact Page</a>.
    </p>
</div>
@endsection