@extends('layout.default')

@section('content')
<div class="plans-page" style="background-color: #fffaf0; min-height: 100vh;">
    <!-- Hero Section -->
    <div class="plans-hero position-relative d-flex align-items-center justify-content-center text-center text-white" style="height: 50vh; background: linear-gradient(135deg, rgba(144,12,63,0.9), rgba(64,5,28,0.9)), url('{{ asset('assets/images/matri/banner1.png') }}'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="container animate__animated animate__fadeIn">
            <h1 class="display-3 fw-bold mb-3 serif-font" style="color: #ffd700;">Premium Membership Plans</h1>
            <p class="lead fs-4 mb-4">Unlock advanced features and find your perfect match faster.</p>
            <div class="gold-divider mx-auto" style="width: 150px; height: 3px; background: #ffd700;"></div>
        </div>
    </div>

    <!-- Pricing Section -->
    <section class="py-5">
        <div class="container py-lg-5">
            <div class="text-center mb-5">
                <h2 class="serif-font text-maroon display-5 fw-bold mb-3">Choose Your Desired Plan</h2>
                <p class="text-muted fs-5">Transparent pricing. No hidden fees. Cancel anytime.</p>
            </div>

            <div class="row g-5 justify-content-center">
                @foreach($packages as $index => $plan)
                <div class="col-lg-4 col-md-6">
                    <div class="card pricing-card h-100 border-0 rounded-4 overflow-hidden position-relative {{ $index == 1 ? 'premium-plan scale-up' : 'bg-white shadow-lg' }} animate__animated animate__fadeInUp" style="animation-delay: {{ $index * 0.2 }}s;">
                        
                        @if($index == 1)
                        <!-- Popular Badge -->
                        <div class="popular-badge position-absolute top-0 end-0 bg-gold text-maroon px-4 py-1 rounded-bl-3 fw-bold small">
                            Most Popular
                        </div>
                        @endif

                        <div class="{{ $index == 1 ? 'bg-maroon text-white p-5 text-center' : 'bg-light p-5 text-center border-bottom' }}">
                            <h3 class="serif-font fw-bold mb-3 {{ $index == 1 ? 'text-gold' : 'text-maroon' }}">{{ $plan->package_name }}</h3>
                            <div class="display-4 fw-bold mb-2">₹{{ number_format($plan->package_price) }}</div>
                            <span class="small {{ $index == 1 ? 'opacity-75' : 'text-muted' }}">Valid for {{ $plan->validity }} Days</span>
                        </div>

                        <div class="card-body p-5">
                            <ul class="list-unstyled mb-5 plan-features">
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="fas fa-check-circle me-3 {{ $index == 1 ? 'text-gold' : 'text-maroon' }}"></i>
                                    <span><strong>{{ $plan->no_of_images ?: 0 }}</strong> Profile Images Upload</span>
                                </li>
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="fas fa-check-circle me-3 {{ $index == 1 ? 'text-gold' : 'text-maroon' }}"></i>
                                    <span><strong>{{ $plan->noofmblno ?: 0 }}</strong> Verified Contacts View</span>
                                </li>

                                @if($plan->no_of_videos)
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="fas fa-check-circle me-3 {{ $index == 1 ? 'text-gold' : 'text-maroon' }}"></i>
                                    <span>Video Profile Upload</span>
                                </li>
                                @endif

                                @if(strtolower($plan->specification_3) === 'yes')
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="fas fa-check-circle me-3 {{ $index == 1 ? 'text-gold' : 'text-maroon' }}"></i>
                                    <span>Direct Chat Booking</span>
                                </li>
                                @else
                                <li class="mb-3 d-flex align-items-center opacity-50 text-muted">
                                    <i class="fas fa-times-circle me-3"></i>
                                    <del>Direct Chat</del>
                                </li>
                                @endif

                                @if(strtolower($plan->specification_5) === 'yes')
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="fas fa-check-circle me-3 {{ $index == 1 ? 'text-gold' : 'text-maroon' }}"></i>
                                    <span>Advanced Profile Search</span>
                                </li>
                                @else
                                <li class="mb-3 d-flex align-items-center opacity-50 text-muted">
                                    <i class="fas fa-times-circle me-3"></i>
                                    <del>Advanced Profile Search</del>
                                </li>
                                @endif

                                @if(strtolower($plan->specification_6) === 'yes')
                                <li class="mb-3 d-flex align-items-center">
                                    <i class="fas fa-check-circle me-3 {{ $index == 1 ? 'text-gold' : 'text-maroon' }}"></i>
                                    <span>Voice/Video Call Option</span>
                                </li>
                                @else
                                <li class="mb-3 d-flex align-items-center opacity-50 text-muted">
                                    <i class="fas fa-times-circle me-3"></i>
                                    <del>Call Option</del>
                                </li>
                                @endif

                            </ul>

                            @if(isset($activePackageName) && $activePackageName === $plan->package_name)
                                <button type="button" class="btn w-100 rounded-pill fw-bold py-3 shadow-sm btn-secondary" disabled>
                                    Current Plan
                                </button>
                            @else
                                <button type="button" onclick="buyPackage({{ $plan->id }}, '{{ $plan->package_name }}')" class="btn w-100 rounded-pill fw-bold py-3 shadow-sm {{ $index == 1 ? 'btn-gold' : 'btn-outline-maroon' }}">
                                    Select {{ $plan->package_name }}
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                
                @if($packages->isEmpty())
                <div class="col-12 text-center text-muted">
                    <p class="fs-5">No plans are currently available. Please check back later.</p>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- CTW Section -->
    <section class="py-5 bg-white text-center">
        <div class="container">
            <h3 class="serif-font text-maroon mb-4">Still deciding?</h3>
            <p class="text-muted mb-4 pb-2">Our matchmakers can help you choose the right plan based on your preferences.</p>
            <a href="{{ url('contact') }}" class="btn btn-maroon rounded-pill px-5 py-2">Contact Support</a>
        </div>
    </section>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600;700&display=swap');

    .serif-font { font-family: 'Playfair Display', serif; }
    .plans-page { font-family: 'Poppins', sans-serif; }

    :root {
        --maroon: #900C3F;
        --maroon-dark: #7a0a35;
        --gold: #ffd700;
        --gold-dark: #e6c200;
    }

    .text-maroon { color: var(--maroon); }
    .text-gold { color: var(--gold); }
    .bg-maroon { background-color: var(--maroon); }
    .bg-gold { background-color: var(--gold); }
    
    .btn-maroon {
        background-color: var(--maroon);
        color: white;
        transition: all 0.3s ease;
    }
    .btn-maroon:hover {
        background-color: var(--maroon-dark);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(144,12,63,0.3);
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
        box-shadow: 0 10px 20px rgba(255, 215, 0, 0.4);
    }

    .btn-outline-maroon {
        border: 2px solid var(--maroon);
        color: var(--maroon);
        background: transparent;
        transition: all 0.3s ease;
    }
    .btn-outline-maroon:hover {
        background-color: var(--maroon);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(144,12,63,0.2);
    }

    .pricing-card {
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        border: 1px solid rgba(0,0,0,0.05);
    }
    .pricing-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 30px 60px rgba(0,0,0,0.12) !important;
    }

    .premium-plan {
        background: white;
        box-shadow: 0 20px 40px rgba(144, 12, 63, 0.15) !important;
        border: 2px solid var(--maroon);
        z-index: 2;
    }
    
    @media (min-width: 992px) {
        .scale-up {
            transform: scale(1.05);
        }
        .scale-up:hover {
            transform: scale(1.08) translateY(-10px);
        }
    }

    .rounded-bl-3 {
        border-bottom-left-radius: 15px;
    }
    
    .plan-features li {
        font-size: 1.05rem;
    }
</style>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    function buyPackage(packageId, packageName) {
        // Fetch order details from server
        fetch('{{ route('payment.create') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ package_id: packageId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert('Error creating order: ' + data.error);
                return;
            }

            var options = {
                "key": data.razorpay_key,
                "amount": data.amount,
                "currency": "INR",
                "name": "Thennadu Matrimony",
                "description": "Payment for " + data.package_name,
                "order_id": data.order_id,
                "handler": function (response){
                    // Verify payment on server
                    fetch('{{ route('payment.verify') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            package_id: packageId,
                            razorpay_payment_id: response.razorpay_payment_id,
                            razorpay_order_id: response.razorpay_order_id,
                            razorpay_signature: response.razorpay_signature
                        })
                    })
                    .then(res => res.json())
                    .then(verifyData => {
                        if(verifyData.success) {
                            window.location.href = verifyData.redirect_url;
                        } else {
                            alert(verifyData.message);
                        }
                    });
                },
                "prefill": {
                    "name": "{{ Auth::user()->Name ?? '' }}",
                    "email": "{{ Auth::user()->email_id ?? '' }}",
                    "contact": "{{ Auth::user()->mobile_no ?? '' }}"
                },
                "theme": {
                    "color": "#900C3F"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.on('payment.failed', function (response){
                alert("Payment Failed. Reason: " + response.error.description);
            });
            rzp1.open();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Something went wrong! Please try again.');
        });
    }
</script>
@endsection
