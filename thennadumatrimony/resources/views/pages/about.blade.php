@extends('layout.default')

@section('content')
    <!-- ================> Page Header section start here <================== -->
    <section class="about-header-section position-relative overflow-hidden py-5" style="background: linear-gradient(135deg, #900C3F 0%, #7b0a36 100%);">
        <div class="div-overlay" style="position: absolute; top:0; left:0; width:100%; height:100%; background: url('{{ asset('assets/images/bg-img/01.jpg') }}') center/cover; opacity: 0.1;"></div>
        <div class="container position-relative z-index-1 py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="serif-font text-white display-3 mb-3">About <span style="color: #D4AF37;">Thennadu</span> Matrimony</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}" class="text-white-50">Home</a></li>
                            <li class="breadcrumb-item active text-gold" aria-current="page">About Our Journey</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ================> Page Header section end here <================== -->

    <!-- ================> Our Mission section start here <================== -->
    <section class="mission-section py-5 mt-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 wow fadeInLeft">
                    <div class="position-relative">
                        <img src="{{ asset('assets/images/matri/tradition-getting-married-hindu-religion.jpg') }}" alt="Mission" class="img-fluid rounded-4 shadow-lg">
                        <div class="experience-badge shadow-lg">
                            <h3 class="serif-font mb-0">10+</h3>
                            <p class="mb-0 small text-uppercase fw-bold">Years of Trust</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight">
                    <h6 class="text-gold text-uppercase fw-bold ls-1 mb-2">Our Core Mission</h6>
                    <h2 class="serif-font display-5 mb-4">Your Trusted Bridge to <span class="text-maroon">Finding</span> a Life Partner</h2>
                    <p class="lead text-muted mb-4">Thennadu Matrimony is deeply rooted in Tamil culture, tradition, and the sacred values of marriage. We blend centuries-old heritage with modern technology to help you find your perfect soulmate.</p>
                    
                    <div class="row g-4 mt-2">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="mission-icon-circle"><i class="fas fa-heart"></i></div>
                                <div>
                                    <h6 class="mb-1 fw-bold">Cultural Values</h6>
                                    <p class="small text-muted mb-0">Deep respect for Tamil family traditions.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="mission-icon-circle"><i class="fas fa-check-double"></i></div>
                                <div>
                                    <h6 class="mb-1 fw-bold">Verified Profiles</h6>
                                    <p class="small text-muted mb-0">100% manual profile screening process.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="mt-4 text-muted">We recognize the nuances that make each Tamil family unique and strive to offer a platform where these individual aspirations can be met. From diverse sub-castes to regional preferences and NRI connections, we cover it all.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ================> Stats Section <================== -->
    <section class="stats-counter py-5 my-5 bg-dark" style="background: linear-gradient(rgba(144, 12, 63, 0.9), rgba(144, 12, 63, 0.9)), url('{{ asset('assets/images/bg-img/02.jpg') }}') center/cover fixed;">
        <div class="container py-4">
            <div class="row text-center g-4">
                <div class="col-md-3 col-6">
                    <h2 class="text-gold serif-font display-4 mb-1">50K+</h2>
                    <p class="text-white-50 text-uppercase small ls-2">Active Members</p>
                </div>
                <div class="col-md-3 col-6">
                    <h2 class="text-gold serif-font display-4 mb-1">15K+</h2>
                    <p class="text-white-50 text-uppercase small ls-2">Success Stories</p>
                </div>
                <div class="col-md-3 col-6">
                    <h2 class="text-gold serif-font display-4 mb-1">200+</h2>
                    <p class="text-white-50 text-uppercase small ls-2">Communities</p>
                </div>
                <div class="col-md-3 col-6">
                    <h2 class="text-gold serif-font display-4 mb-1">100%</h2>
                    <p class="text-white-50 text-uppercase small ls-2">Safe & Secure</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ================> Approach section <================== -->
    <section class="approach-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-gold text-uppercase fw-bold ls-1">Why Choose Us</h6>
                <h2 class="serif-font display-5">Tradition Meets <span class="text-maroon">Technology</span></h2>
                <div class="title-divider mx-auto mt-3"></div>
            </div>
            
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="approach-card p-5 h-100 text-center">
                        <div class="approach-icon-wrap mb-4 mx-auto"><i class="fas fa-fingerprint"></i></div>
                        <h4 class="serif-font mb-3">Rigorously Screened</h4>
                        <p class="text-muted">Every profile undergoes a strict verification process to ensure authenticity and safety for our members.</p>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="approach-card p-5 h-100 text-center">
                        <div class="approach-icon-wrap mb-4 mx-auto"><i class="fas fa-lock"></i></div>
                        <h4 class="serif-font mb-3">Privacy First</h4>
                        <p class="text-muted">Your safety is our priority with robust privacy settings, allowing you to connect with absolute confidence.</p>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="approach-card p-5 h-100 text-center theme-bg-maroon">
                        <div class="approach-icon-wrap mb-4 mx-auto" style="background: rgba(212, 175, 55, 0.2); color: #D4AF37;"><i class="fas fa-bolt"></i></div>
                        <h4 class="serif-font mb-3 text-white">Smart Match</h4>
                        <p class="text-white-50">Our sophisticated algorithms analyze your preferences to suggest the most compatible Tamil profiles.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================> Call to Action <================== -->
    <section class="about-cta-section py-5 mb-5">
        <div class="container">
            <div class="cta-box rounded-5 p-5 text-center shadow-lg" style="background: linear-gradient(45deg, #D4AF37 0%, #B8860B 100%);">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="serif-font text-white mb-3">Connect With Your Soulmate Today</h2>
                        <p class="text-white opacity-75 mb-4">Join Thennadu Matrimony and take the first step towards a beautiful, traditional journey of a lifetime.</p>
                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            <a href="{{ url('register') }}" class="btn btn-dark rounded-pill px-5 py-3 fw-bold">Register Now Free</a>
                            <a href="{{ url('contact') }}" class="btn btn-outline-light rounded-pill px-5 py-3 fw-bold">Contact Support</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .text-maroon { color: #900C3F; }
        .text-gold { color: #D4AF37; }
        .ls-1 { letter-spacing: 1px; }
        .ls-2 { letter-spacing: 2px; }
        
        .about-header-section { min-height: 300px; display: flex; align-items: center; }
        
        .experience-badge {
            position: absolute;
            bottom: -30px;
            right: -30px;
            background: #fff;
            padding: 25px 35px;
            border-radius: 20px;
            text-align: center;
            border-left: 5px solid #D4AF37;
        }
        
        .mission-icon-circle {
            width: 50px;
            height: 50px;
            background: rgba(144, 12, 63, 0.1);
            color: #900C3F;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 1.2rem;
            flex-shrink: 0;
        }
        
        .approach-card {
            background: #fff;
            border-radius: 30px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid #f0f0f0;
        }
        .approach-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 30px 60px rgba(0,0,0,0.1);
            border-color: #D4AF37;
        }
        .approach-icon-wrap {
            width: 80px;
            height: 80px;
            background: #fdf2f6;
            color: #900C3F;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            font-size: 2rem;
        }
        .theme-bg-maroon { background: #900C3F !important; }
        
        .cta-box { position: relative; overflow: hidden; }
        .cta-box::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            pointer-events: none;
        }

        .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,0.3); }
        
        @media (max-width: 991px) {
            .experience-badge { bottom: 20px; right: 20px; padding: 15px 25px; }
            .about-header-section { min-height: 200px; }
        }
    </style>
@endsection
