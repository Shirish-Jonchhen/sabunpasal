@extends('layouts.user')
@section('user_page_title', 'Sabun Pasal - Terms of service')

@section('user_content')
<div class="container">
    <nav aria-label="breadcrumb" class="breadcrumbs">
        <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li aria-current="page">Terms of Service</li>
        </ol>
    </nav>
    <h1>Terms of Service</h1>
    <p>Last updated: <span id="last-updated-date"></span></p>

    <p>
      Please read these Terms of Service ("Terms", "Terms of Service")
      carefully before using the CleanSweep Mart website (the "Service")
      operated by [Your Company Name - **REPLACE THIS**] ("us", "we", or "our").
    </p>

    <p>
      Your access to and use of the Service is conditioned on your acceptance
      of and compliance with these Terms. These Terms apply to all visitors,
      users and others who access or use the Service.
    </p>

    <p>
      By accessing or using the Service you agree to be bound by these Terms.
      If you disagree with any part of the terms then you may not access the
      Service.
    </p>

    <h2>Accounts</h2>
    <p>
      When you create an account with us (if applicable), you must provide us information that
      is accurate, complete, and current at all times. Failure to do so
      constitutes a breach of the Terms, which may result in immediate
      termination of your account on our Service.
    </p>
    <p>
      You are responsible for safeguarding the password that you use to access
      the Service and for any activities or actions under your password,
      whether your password is with our Service or a third-party service.
    </p>
    <p>
      You agree not to disclose your password to any third party. You must
      notify us immediately upon becoming aware of any breach of security or
      unauthorized use of your account.
    </p>

    <h2>Purchases</h2>
     <p>
       If you wish to purchase any product or service made available through
       the Service ("Purchase"), you may be asked to supply certain
       information relevant to your Purchase including, without limitation,
       your credit card number, the expiration date of your credit card, your
       billing address, and your shipping information.
     </p>
     <p>
       You represent and warrant that: (i) you have the legal right to use any
       credit card(s) or other payment method(s) in connection with any
       Purchase; and that (ii) the information you supply to us is true,
       correct and complete.
     </p>
     <p>
       By submitting such information, you grant us the right to provide the
       information to third parties (like payment processors) for purposes of facilitating the completion
       of Purchases.
     </p>
    <p>
      We reserve the right to refuse or cancel your order at any time for
      certain reasons including but not limited to: product or service
      availability, errors in the description or price of the product or
      service, error in your order or other reasons.
    </p>

    <h2>Intellectual Property</h2>
    <p>
        The Service and its original content, features and functionality are and will remain the exclusive property of [Your Company Name - **REPLACE THIS**] and its licensors. The Service is protected by copyright, trademark, and other laws of both the [Your Country - **REPLACE THIS**] and foreign countries. Our trademarks and trade dress may not be used in connection with any product or service without the prior written consent of [Your Company Name - **REPLACE THIS**].
    </p>

    <h2>Links To Other Web Sites</h2>
    <p>
        Our Service may contain links to third-party web sites or services that are not owned or controlled by [Your Company Name - **REPLACE THIS**].
    </p>
    <p>
        [Your Company Name - **REPLACE THIS**] has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any third party web sites or services. You further acknowledge and agree that [Your Company Name - **REPLACE THIS**] shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with use of or reliance on any such content, goods or services available on or through any such web sites or services.
    </p>

    <h2>Termination</h2>
    <p>
        We may terminate or suspend access to our Service immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms.
    </p>
    <p>
        All provisions of the Terms which by their nature should survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.
    </p>

    <h2>Governing Law</h2>
    <p>
        These Terms shall be governed and construed in accordance with the laws of [Your Jurisdiction/Country - **REPLACE THIS**], without regard to its conflict of law provisions.
    </p>

    <h2>Changes</h2>
    <p>
        We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material we will try to provide at least 30 days notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.
    </p>

    <h2>Contact Us</h2>
    <p>
      If you have any questions about these Terms, please <a href="contact.html">contact us</a>.
    </p>
</div>

@endsection