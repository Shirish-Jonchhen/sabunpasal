@extends('layouts.user')
@section('user_page_title', 'Sabun Pasal - Terms of Service')

@section('user_content')
<div class="container">
    <nav aria-label="breadcrumb" class="breadcrumbs">
        <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li aria-current="page">Terms of Service</li>
        </ol>
    </nav>
    <h1>Terms of Service</h1>
    <p>Last updated: <span id="last-updated-date"> <strong> 25th August, 2025</strong></span></p>

    <p>
      Welcome to SabunPasal.com! These Terms of Service ("Terms") govern your 
      use of our website and services. By registering, placing an order, or 
      accessing the site, you agree to comply with these Terms. If you do not 
      agree, please do not use our services.
    </p>

    <h2>Accounts</h2>
    <p>
      To place an order on SabunPasal.com, you may be required to create an 
      account by providing accurate and complete personal information such as 
      your name, phone number, address, and email. You are responsible for 
      maintaining the confidentiality of your login details and for all 
      activities under your account.
    </p>
    <p>
      If we suspect any unauthorized use or security breach, we may suspend 
      or terminate your account without prior notice.
    </p>

    <h2>Orders and Deliveries</h2>
    <p>
      Once you place an order, you will receive a confirmation. Orders can be 
      fulfilled through either <strong>home delivery</strong> or 
      <strong>store pickup</strong>, as per your selection. Delivery times 
      may vary depending on location, availability, and circumstances beyond 
      our control.
    </p>
    <p>
      We reserve the right to refuse or cancel orders in cases of product 
      unavailability, pricing errors, or suspicious/fraudulent activity.
    </p>

    <h2>Payments</h2>
    <p>
      Currently, we only support <strong>Cash on Delivery (COD)</strong> as a 
      payment method. In the near future, we will introduce secure electronic 
      payment options such as eSewa, Fonepay, and other digital wallets. 
      If digital payments are introduced, transactions will be processed 
      securely by the respective payment providers, and their terms will 
      apply.
    </p>

    <h2>Pricing & Product Information</h2>
    <p>
      All product prices listed on the site are subject to change without 
      notice. While we strive to ensure accuracy, errors in pricing, 
      availability, or product descriptions may occur. We reserve the right 
      to correct such errors and cancel or modify orders accordingly.
    </p>

    <h2>Intellectual Property</h2>
    <p>
      All content, trademarks, logos, and materials on SabunPasal.com remain 
      the property of Sabun Pasal and/or its licensors. You may not copy, 
      distribute, or reproduce any content without our prior written consent.
    </p>

    <h2>Third-Party Links</h2>
    <p>
      Our website may contain links to third-party websites or services. We 
      are not responsible for the content, policies, or practices of any 
      third-party platforms. Use of such sites is at your own risk.
    </p>

    <h2>Termination</h2>
    <p>
      We may suspend or terminate your access to our services immediately, 
      without notice, if you violate these Terms or engage in fraudulent, 
      illegal, or abusive activity. Certain provisions, such as limitations 
      of liability and ownership rights, shall survive termination.
    </p>

    <h2>Governing Law</h2>
    <p>
      These Terms shall be governed by and construed in accordance with the 
      laws of Nepal, without regard to conflict of law principles.
    </p>

    <h2>Changes to Terms</h2>
    <p>
      We may update these Terms from time to time. Any changes will be posted 
      on this page with the updated date. Your continued use of our services 
      after such updates constitutes acceptance of the revised Terms.
    </p>

    <h2>Contact Us</h2>
    <p>
      For any questions regarding these Terms, please contact us via our 
      <a href="{{ route('contact.us') }}">Contact Page</a> or email us at 
      <strong>info@sabunpasal.com</strong>.
    </p>
</div>
@endsection
