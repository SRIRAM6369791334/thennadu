@extends('layout.default')

@section('content')
<div class="astrology-page" style="background-color: #F7F7F7; min-height: 100vh;">
    <!-- Sub-pattern background overlay -->
    <div class="position-fixed w-100 h-100 top-0 start-0 opacity-05 pointer-events-none" style="background-image: url('{{ asset('assets/images/astrology/pattern.png') }}'); background-repeat: repeat; z-index: 0; opacity: 0.05;"></div>

    <!-- 1. Hero Section -->
    <section class="hero-section py-5 position-relative overflow-hidden" style="background: linear-gradient(135deg, #6A1B9A 0%, #4A148C 100%);">
        <div class="hero-pattern position-absolute w-100 h-100 top-0 start-0" style="background-image: url('{{ asset('assets/images/astrology/hero_bg.png') }}'); background-size: cover; opacity: 0.2; mix-blend-mode: overlay;"></div>
        <div class="container position-relative z-1">
            <div class="row align-items-center g-5">
                <div class="col-lg-7 text-white">
                    <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInDown serif-font" style="color:#faebd7;">Divine Horoscope Matching</h1>
                    <p class="lead mb-4 animate__animated animate__fadeInUp opacity-90" style="font-size: 1.25rem;">Unlock cosmic compatibility secrets. Upload your Jathagam and discover a bond written in the stars.</p>
                    <div class="d-flex flex-wrap gap-3 animate__animated animate__fadeInUp animate__delay-1s">
                        <button class="btn btn-gold btn-lg rounded-pill px-5 py-3 shadow-lg border-0 fw-bold" onclick="document.getElementById('upload-section').scrollIntoView({behavior: 'smooth'})">
                            <i class="fas fa-upload me-2"></i> Upload & Match
                        </button>
                        <button class="btn btn-outline-light btn-lg rounded-pill px-4 py-3 border-2 fw-bold">
                            View Sample Jathagam
                        </button>
                    </div>
                </div>
                <div class="col-lg-5 text-center animate__animated animate__zoomIn">
                    <img src="{{ asset('assets/images/astrology/hero_main.png') }}" alt="Astrology Illustration" class="img-fluid floating-animation" style="max-height: 420px; filter: drop-shadow(0 20px 40px rgba(0,0,0,0.4));">
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Astrology Introduction Section -->
    <section class="intro-section py-5 px-3 position-relative z-1">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="serif-font text-purple fw-bold mb-2">Why Horoscope Matters in Matrimony</h2>
                <div class="gold-divider mx-auto mb-4" style="width: 80px; height: 3px; background: #FFD54F;"></div>
                <p class="text-muted max-w-700 mx-auto">Vedic astrology provides deep insights into the alignment of energy and personality between two individuals.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card intro-card border-0 text-center h-100 p-4 shadow-soft rounded-4 bg-white">
                        <div class="icon-wrapper mb-4 animate__animated animate__fadeIn">
                            <img src="{{ asset('assets/images/astrology/icon_birth.png') }}" alt="Birth Chart" class="img-fluid" style="width: 80px;">
                        </div>
                        <h4 class="fw-bold text-dark mb-3">Birth Chart Analysis</h4>
                        <p class="text-muted small px-lg-2">Detailed mapping of planetary positions at the time of birth to understand destiny and character.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card intro-card border-0 text-center h-100 p-4 shadow-soft rounded-4 bg-white">
                        <div class="icon-wrapper mb-4 animate__animated animate__fadeIn">
                            <img src="{{ asset('assets/images/astrology/icon_match.png') }}" alt="Compatibility" class="img-fluid" style="width: 80px;">
                        </div>
                        <h4 class="fw-bold text-dark mb-3">Gun Milan Harmony</h4>
                        <p class="text-muted small px-lg-2">Checking the 36 Gunas to quantify the level of harmony and longevity in the relationship.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card intro-card border-0 text-center h-100 p-4 shadow-soft rounded-4 bg-white">
                        <div class="icon-wrapper mb-4 animate__animated animate__fadeIn">
                            <img src="{{ asset('assets/images/astrology/icon_balance.png') }}" alt="Emotional Balance" class="img-fluid" style="width: 80px;">
                        </div>
                        <h4 class="fw-bold text-dark mb-3">Life Balance</h4>
                        <p class="text-muted small px-lg-2">Ensuring emotional stability and growth potential for both partners in their shared future.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. NEW: Process Overview Section -->
    <section class="process-section py-5 bg-white shadow-sm position-relative z-1">
        <div class="container text-center">
            <h2 class="serif-font text-purple fw-bold mb-5">How Matching Works</h2>
            <div class="row align-items-center g-5">
                <div class="col-lg-6 order-2 order-lg-1 animate__animated animate__fadeInLeft">
                    <div class="process-image-container p-4">
                        <img src="{{ asset('assets/images/astrology/process.png') }}" alt="Process" class="img-fluid rounded-4">
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 text-start px-lg-5 animate__animated animate__fadeInRight">
                    <div class="step-item mb-5 d-flex gap-4">
                        <div class="step-number bg-gold text-dark fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; flex-shrink: 0;">1</div>
                        <div>
                            <h4 class="fw-bold text-purple">Upload Jathagam</h4>
                            <p class="text-muted">Upload high-quality PDF or Image files of both Bride and Groom's horoscopes to our secure system.</p>
                        </div>
                    </div>
                    <div class="step-item mb-5 d-flex gap-4">
                        <div class="step-number bg-purple text-white fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; flex-shrink: 0;">2</div>
                        <div>
                            <h4 class="fw-bold text-purple">Digital Analysis</h4>
                            <p class="text-muted">Our smart algorithm extracts key planetary details and cross-references them against Vedic standards.</p>
                        </div>
                    </div>
                    <div class="step-item d-flex gap-4">
                        <div class="step-number bg-success text-white fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; flex-shrink: 0;">3</div>
                        <div>
                            <h4 class="fw-bold text-purple">Get Compatibility Report</h4>
                            <p class="text-muted">Instantly view your matching percentage and detailed breakdown of various Vedic Poruthams.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Horoscope Instant Matching (Dropdowns) -->
    <section class="upload-section py-5 bg-light-purple position-relative z-1" id="upload-section" style="background-color: #f3e5f533;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="serif-font text-purple fw-bold mb-2">Instant Compatibility Tool</h2>
                <div class="gold-line mx-auto mb-3" style="width: 40px; height: 2px; background: #FFD54F;"></div>
                <p class="text-muted">Select Rasi & Natchathiram for both candidates to check matching scores.</p>
            </div>
            
            <div class="row g-4 justify-content-center">
                <!-- Groom Selection -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow-soft rounded-4 h-100 bg-white overflow-hidden">
                        <div class="card-header bg-purple text-white p-3 text-center border-0">
                            <h5 class="mb-0 fw-bold" style="color: azure;">Groom Details</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Groom Rasi</label>
                                <select class="form-select custom-input rounded-pill shadow-none" id="male_rasi">
                                    <option value="">Select Rasi</option>
                                    @foreach($rasis as $r) <option value="{{$r->id}}">{{$r->name}}</option> @endforeach
                                </select>
                            </div>
                            <div class="mb-0">
                                <label class="form-label small fw-bold text-muted text-uppercase">Groom Natchathiram</label>
                                <select class="form-select custom-input rounded-pill shadow-none" id="male_star">
                                    <option value="">Select Star</option>
                                    @foreach($stars as $s) <option value="{{$s->id}}">{{$s->name}}</option> @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bride Selection -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow-soft rounded-4 h-100 bg-white overflow-hidden">
                        <div class="card-header bg-maroon text-white p-3 text-center border-0">
                            <h5 class="mb-0 fw-bold" style="color: azure;">Bride Details</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted text-uppercase">Bride Rasi</label>
                                <select class="form-select custom-input rounded-pill shadow-none" id="female_rasi">
                                    <option value="">Select Rasi</option>
                                    @foreach($rasis as $r) <option value="{{$r->id}}">{{$r->name}}</option> @endforeach
                                </select>
                            </div>
                            <div class="mb-0">
                                <label class="form-label small fw-bold text-muted text-uppercase">Bride Natchathiram</label>
                                <select class="form-select custom-input rounded-pill shadow-none" id="female_star">
                                    <option value="">Select Star</option>
                                    @foreach($stars as $s) <option value="{{$s->id}}">{{$s->name}}</option> @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5">
                <button class="btn btn-purple-gradient btn-xl rounded-pill px-5 py-3 shadow-lg border-0 fw-bold scale-hover" onclick="checkMatch()">
                    Calculate Compatibility <i class="fas fa-magic ms-2"></i>
                </button>
            </div>

            <!-- Match Result Placeholder -->
            <div id="match-result-container" class="mt-5 d-none">
                 <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-lg rounded-4 p-4 text-center bg-white border-top border-5 border-gold">
                            <h3 class="serif-font text-purple mb-3">Matching Result</h3>
                            <div class="display-4 fw-bold text-maroon mb-2" id="match-score-text">0/12</div>
                            <div class="h5 fw-bold mb-4" id="match-status-text">...</div>
                            <div class="progress rounded-pill mb-3" style="height: 10px;">
                                <div class="progress-bar bg-gold" id="match-progress" style="width: 0%"></div>
                            </div>
                            <p class="text-muted small">This is a digital calculation based on Star and Rasi compatibility standards.</p>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </section>

    <!-- 5. Expert Consultation Section -->
    <section class="consultancy-section py-5 position-relative z-1 overflow-hidden" style="background: white;">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-5" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h2 class="serif-font text-purple fw-bold mb-4">Book a Consultation</h2>
                    <p class="text-muted mb-4 lead">Speak with our certified Pandits and Astrologers for a deep personal reading and remedy suggestions.</p>
                    
                    <div class="consultation-form-card card border-0 shadow-soft p-4 rounded-4 bg-light bg-opacity-50">
                        <form action="{{ route('consultation.book') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold text-muted">Your Name</label>
                                    <input type="text" name="name" class="form-control rounded-pill custom-input" placeholder="Enter Full Name" required value="{{ auth()->check() ? auth()->user()->Name : '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold text-muted">Phone Number</label>
                                    <input type="text" name="phone" class="form-control rounded-pill custom-input" placeholder="Contact number" required value="{{ auth()->check() ? auth()->user()->mblno : '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold text-muted">Email Address</label>
                                    <input type="email" name="email" class="form-control rounded-pill custom-input" placeholder="Email address" value="{{ auth()->check() ? (auth()->user()->email ?? auth()->user()->email_id) : '' }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold text-muted">Consultation For (Optional)</label>
                                    <textarea name="message" class="form-control rounded-4 custom-input" rows="3" placeholder="Describe your query or provide birth details..."></textarea>
                                </div>
                                <div class="col-12 mt-4 text-center">
                                    <button type="submit" class="btn btn-gold btn-lg rounded-pill px-5 py-3 shadow-sm fw-bold w-100">
                                        Submit Request <i class="fas fa-paper-plane ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 text-center animate__animated animate__fadeInRight">
                    <div class="position-relative">
                        <img src="{{ asset('assets/images/astrology/expert.png') }}" alt="Astro Expert" class="img-fluid rounded-circle shadow-lg" style="max-height: 450px; border: 15px solid #F3E5F5;">
                        <div class="floating-badge bg-white p-3 rounded-4 shadow-sm position-absolute top-10 start-0 animate__animated animate__bounceIn">
                             <div class="text-maroon fw-bold mb-0 lh-1">20+ Years</div>
                             <div class="xx-small text-muted">Experience</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Personal Horoscope Section -->
    <!-- <section class="personal-section py-5 bg-grey-light position-relative z-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mx-auto">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                        <div class="card-header bg-purple text-white p-4 border-0 text-center">
                            <h3 class="serif-font fw-bold mb-0" style="color: azure;">My Personal Jathagam</h3>
                            <p class="mb-0 small opacity-75">Upload your own file to receive matching requests</p>
                        </div>
                        <div class="card-body p-4 p-lg-5 bg-white">
                            <form action="{{ route('services.horoscope.upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label small fw-bold text-muted">Document Name</label>
                                    <input type="text" name="title" class="form-control rounded-pill custom-input" placeholder="e.g. Rahul's Horoscope" value="{{ auth()->check() ? auth()->user()->Name : '' }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label small fw-bold text-muted">Upload Jathagam</label>
                                    <div class="mini-upload border-dashed rounded-4 p-4 text-center cursor-pointer" onclick="document.getElementById('personal-file').click()">
                                        <i class="fas fa-file-pdf text-danger fs-2 mb-2"></i>
                                        <p class="text-muted small mb-0" id="file-name-display">Select Image or PDF</p>
                                        <input type="file" name="horoscope_file" id="personal-file" class="d-none" onchange="updateFileName(this)">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-purple btn-lg w-100 rounded-pill py-3 fw-bold shadow-sm mt-3">
                                    Save to Profile <i class="fas fa-save ms-2"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- 7. NEW: Wisdom & Success Section -->
    <section class="wisdom-section py-5 text-white position-relative overflow-hidden" style="background: #4A148C;">
        <div class="position-absolute w-100 h-100 top-0 start-0 opacity-10" style="background-image: url('{{ asset('assets/images/astrology/pattern.png') }}'); background-repeat: repeat;"></div>
        <div class="container text-center position-relative z-1">
            <div class="row align-items-center g-5">
                <div class="col-lg-4 text-lg-start">
                    <img src="{{ asset('assets/images/astrology/match_success.png') }}" alt="Success" class="img-fluid rounded-4 shadow-lg mb-4 mb-lg-0 scale-hover">
                </div>
                <div class="col-lg-8 text-lg-start px-lg-5">
                    <h2 class="serif-font fw-bold mb-4">"A match written in the stars, nurtured on Earth."</h2>
                    <blockquote class="blockquote mb-4">
                        <p class="opacity-80"style="color: #000000;">Thousands of couples found their perfect celestial alignment with Thennadu Matrimony. Our Vedic matching system ensures that your union starts on the strongest spiritual foundation possible.</p>
                    </blockquote>
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-gold p-2 rounded-circle" style="width: 10px; height: 10px;"></div>
                        <span class="small fw-bold text-uppercase ls-1 text-dark">85% Success Matching Rate</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. Uploaded Horoscope Preview Section -->
    <section class="preview-section py-5 px-3 position-relative z-1">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="serif-font text-purple fw-bold mb-2">Your Uploaded Files</h2>
                <div class="gold-divider mx-auto" style="width: 50px; height: 3px; background: #FFD54F;"></div>
            </div>

            <div class="text-center mb-4">
                <form action="{{ route('services.horoscope.upload') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                    @csrf
                    <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center gap-3">
                        <input type="text" name="title" class="form-control rounded-pill" placeholder="Document Name (e.g. Rahul's Horoscope)" value="{{ auth()->check() ? auth()->user()->Name : '' }}" style="max-width: 300px;">
                        <div class="mini-upload border-dashed rounded-pill px-4 py-2 text-center cursor-pointer" onclick="document.getElementById('preview-file').click()" style="min-width: 200px;">
                            <i class="fas fa-cloud-upload-alt me-2 text-purple"></i>
                            <span id="preview-file-name" class="text-muted small">Select File</span>
                            <input type="file" name="horoscope_file" id="preview-file" class="d-none" onchange="updatePreviewFileName(this)" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <button type="submit" class="btn btn-purple rounded-pill px-4 py-2 fw-bold">
                            <i class="fas fa-upload me-1"></i> Upload
                        </button>
                    </div>
                </form>
            </div>

            @if($my_horoscopes->isEmpty())
                <div class="card border-0 shadow-soft rounded-4 p-5 text-center bg-white min-h-300 d-flex align-items-center justify-content-center">
                    <div class="opacity-20 mb-3"><i class="fas fa-cloud-upload-alt fa-4x text-purple"></i></div>
                    <h5 class="text-muted fw-bold">No files here yet.</h5>
                </div>
            @else
                <div class="row g-4">
                    @foreach($my_horoscopes as $item)
                        <div class="col-lg-3 col-md-6">
                            <div class="card preview-card border-0 shadow-soft h-100 rounded-4 overflow-hidden bg-white">
                                <div class="preview-thumb p-4 bg-light text-center position-relative d-flex align-items-center justify-content-center" style="min-height: 180px;">
                                    @php
                                        $ext = pathinfo($item->img_name, PATHINFO_EXTENSION);
                                        $isImg = in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif']);
                                    @endphp
                                    @if($isImg)
                                        <img src="{{ asset(($item->directory_path !== 'uploads/horoscopes' ? 'uploads/horoscopes' : $item->directory_path) . '/' . $item->img_name) }}" alt="Jathagam" class="img-fluid rounded shadow-sm" style="max-height: 120px;">
                                    @else
                                        <i class="fas fa-file-pdf text-danger" style="font-size: 70px;"></i>
                                    @endif
                                    <span class="badge position-absolute top-0 end-0 m-3 px-2 py-1 bg-maroon text-white" style="font-size: 0.65rem;">{{ strtoupper($ext) }}</span>
                                </div>
                                <div class="card-body p-3">
                                    <h6 class="fw-bold text-truncate mb-1" style="color: #4A148C;">{{ $item->title }}</h6>
                                    <p class="text-muted mb-3" style="font-size: 0.7rem;">Uploaded: {{ \Carbon\Carbon::parse($item->created_at)->format('d M, Y') }}</p>
                                    <div class="d-flex gap-2 align-items-center">
                                        <a href="{{ asset(($item->directory_path !== 'uploads/horoscopes' ? 'uploads/horoscopes' : $item->directory_path) . '/' . $item->img_name) }}" target="_blank" class="btn btn-sm rounded-pill flex-grow-1 fw-bold" style="background: linear-gradient(135deg, #6A1B9A, #9C27B0); color: #fff; border: none; padding: 8px 16px; box-shadow: 0 4px 12px rgba(106,27,154,0.3); transition: all 0.3s ease;">
                                            <i class="fas fa-eye me-1"></i> View
                                        </a>
                                        <form action="{{ route('services.horoscope.delete', $item->id) }}" method="POST" class="d-flex align-items-center" onsubmit="return confirm('Are you sure you want to delete this file?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm rounded-pill fw-bold px-3" style="background: linear-gradient(135deg, #C62828, #E53935); color: #fff; border: none; padding: 8px 14px; box-shadow: 0 4px 12px rgba(198,40,40,0.3); transition: all 0.3s ease;">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- 9. NEW: FAQ Section -->
    <section class="faq-section py-5 bg-white position-relative z-1">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="serif-font text-purple fw-bold mb-2">Astrology FAQs</h2>
                <div class="gold-divider mx-auto mb-4" style="width: 60px; height: 3px; background: #FFD54F;"></div>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="accordion accordion-flush" id="astroFaq">
                        <div class="accordion-item border-bottom py-3">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne">
                                    Is horoscope matching mandatory for all religions?
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#astroFaq">
                                <div class="accordion-body text-muted small">While deeply rooted in Hindu traditions, horoscope matching is increasingly used as a psychological and energy alignment tool across various cultures to ensure long-term harmony.</div>
                            </div>
                        </div>
                        <div class="accordion-item border-bottom py-3">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo">
                                    How accurate is the digital compatibility tool?
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#astroFaq">
                                <div class="accordion-body text-muted small">Our algorithm follows standardized Vedic calculations (Ashta Kuta). It is highly accurate for basic Gun Milan, but we recommend an expert consultation for complex cases like Manglik Dosha.</div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 py-3">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree">
                                    What file formats should I upload?
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#astroFaq">
                                <div class="accordion-body text-muted small">We support PDF, JPG, and PNG files. Please ensure the text is clear and readable for the best analysis results.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;600;700&display=swap');

    :root {
        --primary-purple: #6A1B9A;
        --secondary-purple: #4A148C;
        --accent-gold: #FFD54F;
        --text-dark: #333333;
        --maroon: #900C3F;
        --shadow-soft: 0px 4px 20px rgba(0,0,0,0.06);
    }

    body { font-family: 'Inter', sans-serif; color: var(--text-dark); }
    .serif-font { font-family: 'Playfair Display', serif; }
    
    .text-purple { color: var(--primary-purple); }
    .text-gold { color: var(--accent-gold); }
    .bg-maroon { background-color: var(--maroon); }
    .bg-gold { background-color: var(--accent-gold); }
    .bg-purple { background-color: var(--primary-purple); }
    .shadow-soft { box-shadow: var(--shadow-soft); }
    
    .btn-purple { 
        background-color: var(--primary-purple); 
        color: white; 
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
    }
    .btn-purple:hover { 
        background-color: var(--accent-gold); 
        color: var(--text-dark); 
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(106, 27, 154, 0.2);
    }

    .btn-gold {
        background-color: var(--accent-gold);
        color: var(--text-dark);
        transition: all 0.3s ease;
    }
    .btn-gold:hover {
        background-color: #fdd835;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(255, 213, 79, 0.3);
    }
    
    .btn-purple-gradient {
        background: linear-gradient(135deg, #6A1B9A, #8E24AA);
        color: white;
    }

    .btn-xl { padding: 18px 45px; font-size: 1.15rem; }

    .upload-zone {
        border: 2px dashed #E1BEE7;
        background-color: #faf7fc;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .upload-zone:hover {
        border-color: var(--primary-purple);
        background-color: #f3e5f5;
    }

    .custom-input {
        background-color: #fdfdfd;
        border: 1px solid #e0e0e0;
        padding: 14px 25px;
        font-size: 0.95rem;
    }
    .custom-input:focus {
        border-color: var(--primary-purple);
        box-shadow: 0 0 0 4px rgba(106, 27, 154, 0.05);
    }

    .preview-card {
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .preview-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.12) !important;
    }

    .floating-animation {
        animation: float 4s ease-in-out infinite;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    .scale-hover { transition: transform 0.3s ease; }
    .scale-hover:hover { transform: scale(1.05); }

    .ls-1 { letter-spacing: 1px; }
    .xx-small { font-size: 0.7rem; }
    .opacity-05 { opacity: 0.05; }
    .max-w-700 { max-width: 700px; }

    .accordion-button:not(.collapsed) {
        background-color: #f3e5f5;
        color: var(--primary-purple);
        box-shadow: none;
    }
    .accordion-button:focus { box-shadow: none; }
    .footer {
    position: relative;
    z-index: 5;
}
    .cursor-pointer { cursor: pointer; }
    .border-dashed { border: 2px dashed #ccc !important; }
    .mini-upload { transition: all 0.3s ease; }
    .mini-upload:hover { border-color: #900C3F !important; background: rgba(144,12,63,0.03); }
</style>

<script>
    function updateFileName(input) {
        const display = document.getElementById('file-name-display');
        if (input.files.length > 0) {
            display.innerText = input.files[0].name;
            display.classList.add('text-success', 'fw-bold');
        }
    }

    function updatePreviewFileName(input) {
        const display = document.getElementById('preview-file-name');
        if (input.files.length > 0) {
            display.innerText = input.files[0].name;
            display.classList.add('text-success', 'fw-bold');
        }
    }

    function checkMatch() {
        const maleRasi = document.getElementById('male_rasi').value;
        const maleStar = document.getElementById('male_star').value;
        const femaleRasi = document.getElementById('female_rasi').value;
        const femaleStar = document.getElementById('female_star').value;

        if (!maleRasi || !maleStar || !femaleRasi || !femaleStar) {
            Swal.fire({
                icon: 'warning',
                title: 'Incomplete Details',
                text: 'Please select Rasi and Star for both Bride and Groom.',
                confirmButtonColor: '#6A1B9A'
            });
            return;
        }

        Swal.fire({
            title: 'Calculating Compatibility...',
            html: 'Cross-referencing Vedic Star Matching tables.',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        // AJAX Request
        fetch(`{{ route('horoscope.check') }}?male_rasi=${maleRasi}&male_star=${maleStar}&female_rasi=${femaleRasi}&female_star=${femaleStar}`)
            .then(response => response.json())
            .then(data => {
                Swal.close();
                if (data.success) {
                    const resultContainer = document.getElementById('match-result-container');
                    const scoreText = document.getElementById('match-score-text');
                    const statusText = document.getElementById('match-status-text');
                    const progress = document.getElementById('match-progress');

                    resultContainer.classList.remove('d-none');
                    scoreText.innerText = data.no_matches + '/12';
                    statusText.innerText = data.status_tamil;
                    
                    const percent = (data.no_matches / 12) * 100;
                    progress.style.width = percent + '%';
                    
                    if (percent >= 80) progress.className = 'progress-bar bg-success';
                    else if (percent >= 50) progress.className = 'progress-bar bg-gold';
                    else progress.className = 'progress-bar bg-danger';

                    resultContainer.scrollIntoView({ behavior: 'smooth' });
                } else {
                    Swal.fire({
                        icon: 'info',
                        title: 'Notice',
                        text: data.message || 'Matching data not found for this specific combination.',
                        confirmButtonColor: '#6A1B9A'
                    });
                }
            })
            .catch(error => {
                Swal.close();
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong while calculating. Please try again.',
                });
            });
    }

    function simulateMatching() {
        // Redundant now, replaced by checkMatch
    }

    // Dynamic Upload Zone Interactions
    ['bride-upload-zone', 'groom-upload-zone'].forEach(id => {
        const zone = document.getElementById(id);
        if (zone) {
            zone.onclick = () => document.getElementById(id.split('-')[0] + '-file').click();
            
            zone.ondragover = (e) => {
                e.preventDefault();
                zone.style.borderColor = 'var(--primary-purple)';
                zone.style.background = '#f3e5f5';
            };
            
            zone.ondragleave = (e) => {
                e.preventDefault();
                zone.style.borderColor = '#E1BEE7';
                zone.style.background = '#faf7fc';
            };
            
            zone.ondrop = (e) => {
                e.preventDefault();
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Attached: ' + files[0].name,
                        showConfirmButton: false,
                        timer: 2500
                    });
                }
            };
        }
    });

    // Dynamic Rasi -> Star Dropdowns
    ['male', 'female'].forEach(type => {
        document.getElementById(type + '_rasi').addEventListener('change', function() {
            const rasiId = this.value;
            const starSelect = document.getElementById(type + '_star');
            
            if (!rasiId) {
                starSelect.innerHTML = '<option value="">Select Star</option>';
                return;
            }

            fetch(`{{ url('/services/horoscope/get-stars') }}/${rasiId}`)
                .then(response => response.json())
                .then(data => {
                    let options = '<option value="">Select Star</option>';
                    data.forEach(star => {
                        options += `<option value="${star.id}">${star.name}</option>`;
                    });
                    starSelect.innerHTML = options;
                })
                .catch(error => console.error('Error fetching stars:', error));
        });
    });
</script>
@endsection
