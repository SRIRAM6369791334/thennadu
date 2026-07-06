@extends('layout.default')

@section('content')
<div class="contact-page" style="background-color: #fdfdfd; min-height: 100vh;">
    <!-- Hero Section -->
    <div class="contact-hero position-relative d-flex align-items-center justify-content-center text-center text-white" style="height: 40vh; background: linear-gradient(rgba(144, 12, 63, 0.8), rgba(144, 12, 63, 0.8)), url('{{ asset('assets/images/contact/hero_bg.png') }}'); background-size: cover; background-position: center;">
        <div class="container animate__animated animate__fadeIn">
            <h1 class="display-3 fw-bold mb-3 serif-font" style="color: #ffd700;">Get In Touch</h1>
            <p class="lead fs-4 mb-0">We are here to help you find your perfect life partner.</p>
            <div class="gold-divider mx-auto mt-4" style="width: 100px; height: 3px; background: #ffd700;"></div>
        </div>
    </div>

    <!-- Contact Info Cards -->
    <section class="py-5 position-relative" style="margin-top: -10px; z-index: 10;">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card border-0 shadow-lg rounded-4 p-4 text-center h-100 animate__animated animate__fadeInUp">
                        <div class="icon-box bg-maroon-light rounded-circle mx-auto mb-4 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                            <i class="fas fa-location-dot fa-2x text-maroon"></i>
                        </div>
                        <h4 class="serif-font text-maroon fw-bold mb-3">Our Office</h4>
                        <p class="text-muted mb-0">Nambi G, 68E Middle street,<br>Vallioor.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 shadow-lg rounded-4 p-4 text-center h-100 animate__animated animate__fadeInUp animate__delay-100ms">
                        <div class="icon-box bg-maroon-light rounded-circle mx-auto mb-4 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                            <i class="fas fa-phone-volume fa-2x text-maroon"></i>
                        </div>
                        <h4 class="serif-font text-maroon fw-bold mb-3">Phone Number</h4>
                        <p class="text-muted mb-2"><a href="tel:+919944301543" style="color: inherit; text-decoration: none;">+91 9944301543</a></p>
                        <!--<p class="text-muted mb-0">+91 44 1234 5678</p>-->
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 shadow-lg rounded-4 p-4 text-center h-100 animate__animated animate__fadeInUp animate__delay-200ms">
                        <div class="icon-box bg-maroon-light rounded-circle mx-auto mb-4 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                            <i class="fas fa-envelope-open-text fa-2x text-maroon"></i>
                        </div>
                        <h4 class="serif-font text-maroon fw-bold mb-3">Email Address</h4>
                        <p class="text-muted mb-2"><a href="mailto:support@thennadumatrimony.com" style="color: inherit; text-decoration: none;">support@thennadumatrimony.com</a></p>
                        <p class="text-muted mb-0"><a href="mailto:info@thennadumatrimony.com" style="color: inherit; text-decoration: none;">info@thennadumatrimony.com</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map & Form Section -->
    <section class="py-5">
        <div class="container py-lg-5">
            <div class="row g-5">
                <!-- Contact Form -->
                <div class="col-lg-6">
                    <div class="bg-white p-4 p-lg-5 rounded-4 shadow-lg animate__animated animate__fadeInLeft">
                        <h2 class="serif-font text-maroon fw-bold mb-4">Send Us a Message</h2>
                        <p class="text-muted mb-5">Have a question or need assistance? Fill out the form below and our team will get back to you shortly.</p>
                        
                        @if(session('success'))
                            <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4">
                                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="name" class="form-control rounded-3 @error('name') is-invalid @enderror" id="name" placeholder="Full Name" value="{{ old('name') }}" required>
                                        <label for="name">Your Name *</label>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="email" name="email" class="form-control rounded-3 @error('email') is-invalid @enderror" id="email" placeholder="Email Address" value="{{ old('email') }}" required>
                                        <label for="email">Email Address *</label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="subject" class="form-control rounded-3 @error('subject') is-invalid @enderror" id="subject" placeholder="Subject" value="{{ old('subject') }}" required>
                                        <label for="subject">Subject *</label>
                                        @error('subject')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-4">
                                        <textarea name="message" class="form-control rounded-3 @error('message') is-invalid @enderror" placeholder="Leave a message here" id="message" style="height: 150px" required>{{ old('message') }}</textarea>
                                        <label for="message">Message *</label>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-maroon btn-lg w-100 rounded-pill py-3 fw-bold shadow-lg">
                                        Send Message <i class="fas fa-paper-plane ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Map Location -->
                <div class="col-lg-6">
                    <div class="map-container h-100 rounded-4 overflow-hidden shadow-lg animate__animated animate__fadeInRight" style="min-height: 480px;">
                        <!-- Using iframe for Google Maps - centered on Chennai, Anna Salai -->
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15545.918961726053!2d80.24523995541991!3d13.061405999999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a52661031338875%3A0xe543ea47c61bf87!2sAnna%20Salai%2C%20Chennai%2C%20Tamil%20Nadu!5e0!3m2!1sen!2sin!4v1710580000000!5m2!1sen!2sin" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Social Connect -->
    <section class="py-5 bg-maroon text-white text-center">
        <div class="container py-4">
            <h3 class="serif-font mb-4">Follow Us on Social Media</h3>
            <div class="d-flex justify-content-center gap-4">
                <a href="#" class="social-icon-large text-white"><i class="fab fa-facebook-f fa-2x"></i></a>
                <a href="#" class="social-icon-large text-white"><i class="fab fa-instagram fa-2x"></i></a>
                <a href="#" class="social-icon-large text-white"><i class="fab fa-twitter fa-2x"></i></a>
                <a href="#" class="social-icon-large text-white"><i class="fab fa-linkedin-in fa-2x"></i></a>
                <a href="#" class="social-icon-large text-white"><i class="fab fa-youtube fa-2x"></i></a>
            </div>
        </div>
    </section>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600;700&display=swap');

    .contact-page { font-family: 'Poppins', sans-serif; }
    .serif-font { font-family: 'Playfair Display', serif; }

    :root {
        --maroon: #900C3F;
        --gold: #ffd700;
    }

    .text-maroon { color: var(--maroon); }
    .bg-maroon { background-color: var(--maroon); }
    .bg-maroon-light { background-color: rgba(144, 12, 63, 0.05); }

    .btn-maroon {
        background-color: var(--maroon);
        color: white;
        transition: all 0.3s ease;
        border: none;
    }
    .btn-maroon:hover {
        background-color: var(--gold);
        color: var(--maroon);
        transform: translateY(-3px);
    }

    .form-control:focus {
        border-color: var(--maroon);
        box-shadow: 0 0 0 0.25rem rgba(144, 12, 63, 0.25);
    }

    .social-icon-large {
        transition: all 0.3s ease;
        opacity: 0.8;
    }
    .social-icon-large:hover {
        opacity: 1;
        transform: scale(1.2);
        color: var(--gold) !important;
    }

    /* Animation Delays */
    .animate__delay-100ms { animation-delay: 0.1s; }
    .animate__delay-200ms { animation-delay: 0.2s; }
</style>
@endsection
