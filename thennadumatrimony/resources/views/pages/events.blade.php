@extends('layout.default')

@section('content')
<div class="events-page" style="background-color: #fffaf0; min-height: 100vh;">
    <!-- Hero Section -->
    <div class="event-hero position-relative d-flex align-items-center justify-content-center text-center text-white" style="height: 60vh; background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('assets/images/events/hero_bg.png') }}'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="container animate__animated animate__fadeIn">
            <h1 class="display-3 fw-bold mb-3 serif-font" style="color: #ffd700;">Wedding Event Services</h1>
            <p class="lead fs-4 mb-4">Making your special day extraordinary with our premium wedding services.</p>
            <div class="gold-divider mx-auto mb-4" style="width: 150px; height: 3px; background: #ffd700;"></div>
            <a href="#services" class="btn btn-maroon btn-lg rounded-pill px-5 py-3 shadow-lg fw-bold">Explore Our Services</a>
        </div>
    </div>

    <!-- Intro Section -->
    <section class="py-5 bg-white">
        <div class="container py-lg-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h2 class="serif-font text-maroon mb-4 fw-bold display-5">A Perfect Celebration for Your Perfect Union</h2>
                    <p class="text-muted fs-5">At Thennadu Matrimony, we don't just find your soulmate; we help you celebrate the union in the most grand and memorable way. Our curated list of verified wedding service providers ensures a stress-free and spectacular event.</p>
                    <div class="row mt-5 g-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-maroon-light p-3 rounded-circle text-maroon">
                                    <i class="fas fa-check-circle fa-2x"></i>
                                </div>
                                <h5 class="mb-0 fw-bold">Verified Vendors</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-maroon-light p-3 rounded-circle text-maroon">
                                    <i class="fas fa-star fa-2x"></i>
                                </div>
                                <h5 class="mb-0 fw-bold">Premium Quality</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="rounded-4 overflow-hidden shadow-2xl position-relative">
                        <img src="{{ asset('assets/images/events/decor.png') }}" alt="Wedding Decor" class="img-fluid scale-hover-lg">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-5" style="background-color: #fffaf0;">
        <div class="container py-lg-5">
            <div class="text-center mb-5">
                <h2 class="serif-font text-maroon display-4 fw-bold mb-3">Our Core Wedding Services</h2>
                <div class="gold-divider mx-auto mb-5" style="width: 100px; height: 4px; background: #ffd700;"></div>
            </div>

            <div class="row g-4">
                @foreach($services as $service)
                <div class="col-lg-4 col-md-6">
                    <div class="service-card h-100 bg-white shadow-lg border-0 rounded-4 overflow-hidden position-relative animate__animated animate__zoomIn">
                        <div class="service-img-container position-relative overflow-hidden" style="height: 250px;">
                            <img src="{{ env('DASHBOARD_URL', 'https://dashboard.varan2varan.com/') . $service->image }}" alt="{{ $service->title }}" class="w-100 h-100 object-fit-cover scale-hover">
                            @if($service->tag)
                                <div class="service-tag position-absolute top-0 end-0 m-3 bg-maroon text-white px-3 py-1 rounded-pill small fw-bold">{{ $service->tag }}</div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="serif-font text-maroon mb-3">{{ $service->title }}</h3>
                            <div class="text-muted small mb-4 service-details-preview">
                                {!! \Illuminate\Support\Str::limit(strip_tags($service->details), 150) !!}
                            </div>
                            <div class="service-details-full d-none">
                                {!! $service->details !!}
                            </div>
                            <button type="button" class="btn btn-outline-maroon w-100 rounded-pill mt-auto" 
                                data-bs-toggle="modal" 
                                data-bs-target="#bookingModal" 
                                data-service-id="{{ $service->id }}" 
                                data-service-title="{{ $service->title }}">
                                Book Consultation
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Other Services -->
                <div class="col-lg-4 col-md-6">
                    <div class="service-card h-100 bg-maroon text-white border-0 rounded-4 p-5 d-flex flex-column justify-content-center text-center animate__animated animate__fadeIn">
                        <i class="fas fa-calendar-plus fa-4x mb-4 opacity-50"></i>
                        <h3 class="serif-font mb-4">And Much More...</h3>
                        <p class="mb-5 opacity-80">From invitations and transport to mehendi artists and return gifts, we manage everything to perfection.</p>
                        <a href="{{ url('contact') }}" class="btn btn-gold btn-xl rounded-pill fw-bold">Contact Coordinator</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-xl">
                <div class="modal-header bg-maroon text-white rounded-top-4 p-4">
                    <h5 class="modal-title serif-font fs-4" id="bookingModalLabel">Book Consultation</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('service.book') }}" method="POST">
                    @csrf
                    <input type="hidden" name="service_id" id="modal_service_id">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-maroon">Service Selected</label>
                            <input type="text" id="modal_service_title" class="form-control bg-light border-0" readonly>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold small">Your Name *</label>
                                <input type="text" class="form-control rounded-pill" name="name" value="{{ Auth::user()->name ?? '' }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="mobile" class="form-label fw-bold small">Mobile Number *</label>
                                <input type="tel" class="form-control rounded-pill" name="mobile" value="{{ Auth::user()->phone ?? Auth::user()->mblno ?? '' }}" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label fw-bold small">Preferred Date *</label>
                            <input type="date" class="form-control rounded-pill" name="date" min="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label fw-bold small">Message / Special Requirements *</label>
                            <textarea class="form-control rounded-4" name="message" rows="3" placeholder="Tell us more about your event..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-maroon rounded-pill px-5 shadow-lg">Confirm Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Why Choose Us -->
    <section class="py-5 bg-white">
        <div class="container py-lg-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="row g-3">
                        <div class="col-6">
                            <img src="{{ asset('assets/images/events/catering.png') }}" alt="Catering" class="img-fluid rounded-4 mb-3">
                            <img src="{{ asset('assets/images/events/photography.png') }}" alt="Photography" class="img-fluid rounded-4">
                        </div>
                        <div class="col-6 mt-lg-5">
                            <img src="{{ asset('assets/images/events/makeup.png') }}" alt="Makeup" class="img-fluid rounded-4 mb-3">
                            <img src="{{ asset('assets/images/events/decor.png') }}" alt="Decor" class="img-fluid rounded-4">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2">
                    <h2 class="serif-font text-maroon mb-4 fw-bold display-5">Why Plan Your Event With Us?</h2>
                    <div class="gold-divider mb-4" style="width: 80px; height: 3px; background: #ffd700;"></div>
                    <div class="accordion accordion-flush" id="whyAccordion">
                        <div class="accordion-item border-bottom py-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-maroon bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    <i class="fas fa-shield-alt me-3"></i> Curated & Trusted Vendors
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#whyAccordion">
                                <div class="accordion-body text-muted">We only partner with highly rated and verified service providers who have a proven track record of excellence in the wedding industry.</div>
                            </div>
                        </div>
                        <div class="accordion-item border-bottom py-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-maroon bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                    <i class="fas fa-coins me-3"></i> Transparent Pricing
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#whyAccordion">
                                <div class="accordion-body text-muted">No hidden costs. We provide clear package details and transparent quotes to ensure you get the best value for your budget.</div>
                            </div>
                        </div>
                        <div class="accordion-item border-bottom py-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold text-maroon bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                    <i class="fas fa-user-tie me-3"></i> Dedicated Event Manager
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#whyAccordion">
                                <div class="accordion-body text-muted">Wait no more. Get a dedicated wedding coordinator who will handle all communications and logistics for your smooth celebration.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTW Section -->
    <section class="py-5 bg-maroon text-white text-center position-relative overflow-hidden">
        <div class="position-absolute w-100 h-100 top-0 start-0 opacity-10" style="background-image: url('{{ asset('assets/images/events/hero_bg.png') }}'); background-size: cover; background-position: center;"></div>
        <div class="container py-lg-5 position-relative z-1">
            <h2 class="serif-font display-4 fw-bold mb-4" style="color: azure;">Ready to Start Planning Your Big Day?</h2>
            <p class="lead mb-5 opacity-80">Our coordinators are here to make your wedding events seamless and stunning.</p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ url('contact') }}" class="btn btn-gold btn-xl rounded-pill fw-bold shadow-lg">Request a Free Quote</a>
                <a href="tel:+1234567890" class="btn btn-outline-light btn-xl rounded-pill fw-bold border-2">Call Event Manager</a>
            </div>
        </div>
    </section>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600;700&display=swap');

    .serif-font { font-family: 'Playfair Display', serif; }
    .events-page { font-family: 'Poppins', sans-serif; }

    :root {
        --maroon: #900C3F;
        --maroon-dark: #7a0a35;
        --gold: #ffd700;
        --gold-dark: #e6c200;
    }

    .text-maroon { color: var(--maroon); }
    .bg-maroon { background-color: var(--maroon); }
    .bg-maroon-light { background-color: rgba(144, 12, 63, 0.05); }
    .bg-gold { background-color: var(--gold); }
    
    .btn-maroon {
        background-color: var(--maroon);
        color: white;
        transition: all 0.3s ease;
    }
    .btn-maroon:hover {
        background-color: var(--gold);
        color: var(--maroon);
        transform: translateY(-3px);
    }

    .btn-gold {
        background-color: var(--gold);
        color: var(--maroon);
        transition: all 0.3s ease;
    }
    .btn-gold:hover {
        background-color: #fff;
        color: var(--maroon);
        transform: translateY(-3px);
    }

    .btn-outline-maroon {
        border-color: var(--maroon);
        color: var(--maroon);
        font-weight: 600;
    }
    .btn-outline-maroon:hover {
        background-color: var(--maroon);
        color: white;
    }

    .btn-xl { padding: 18px 45px; font-size: 1.1rem; }

    .service-card {
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
    }

    .scale-hover { transition: transform 0.5s ease; }
    .service-card:hover .scale-hover { transform: scale(1.1); }
    
    .scale-hover-lg { transition: transform 0.8s ease; }
    .scale-hover-lg:hover { transform: scale(1.05); }

    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .accordion-button:not(.collapsed) {
        background-color: transparent;
        color: var(--maroon);
        box-shadow: none;
    }
    .accordion-button:focus { box-shadow: none; }

    /* Custom Animation Delay */
    .animate__delay-1s { animation-delay: 0.3s; }
    .animate__delay-2s { animation-delay: 0.6s; }
</style>

@push('scripts')
<script>
    $(document).ready(function() {
        var bookingModal = document.getElementById('bookingModal')
        if (bookingModal) {
            bookingModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget
                var serviceId = button.getAttribute('data-service-id')
                var serviceTitle = button.getAttribute('data-service-title')
                
                var modalServiceIdInput = bookingModal.querySelector('#modal_service_id')
                var modalServiceTitleInput = bookingModal.querySelector('#modal_service_title')

                modalServiceIdInput.value = serviceId
                modalServiceTitleInput.value = serviceTitle
            })
        }
    });
</script>
@endpush
@endsection
