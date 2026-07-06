@extends('layout.auth')

@section('content')

<style>
/* ================================================
   ROOT VARIABLES — Premium Theme
================================================ */
:root {
    --rp:  #900C3F;    /* primary maroon  */
    --rpl: #C70039;    /* lighter maroon  */
    --rpd: #7b0a36;    /* darker maroon   */
    --rg:  #D4AF37;    /* gold            */
    --rgl: rgba(212,175,55,.12);
    --rc:  #FFFFFF;
    --rt:  #1A1A1A;
    --rm:  #555555;
    --rb:  #F0F0F0;
    --tr:  all .45s cubic-bezier(.4, 0, .2, 1);
}

/* ================================================
   PAGE WRAPPER
================================================ */
.registration-page-wrapper {
    font-family: 'Outfit', sans-serif;
    min-height: calc(100vh - 82px);
    background: #fdf8f9;
    background-image: radial-gradient(circle at 0% 0%, rgba(144, 12, 63, 0.03) 0%, transparent 50%),
                      radial-gradient(circle at 100% 100%, rgba(212, 175, 55, 0.05) 0%, transparent 50%);
    padding: 60px 20px 80px;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    overflow: hidden;
}

/* Floating Decorative Elements */
.deco-circle {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    z-index: 1;
    opacity: 0.5;
}

/* ================================================
   PREMIUM SPLIT BOX
================================================ */
.premium-reg-box {
    display: flex;
    width: 100%;
    max-width: 1150px;
    min-height: 750px;
    height: auto;
    background: #fff;
    border-radius: 40px;
    overflow: hidden;
    position: relative;
    z-index: 10;
    box-shadow: 0 50px 120px -20px rgba(144, 12, 63, 0.15), 
                0 30px 60px -10px rgba(0, 0, 0, 0.1);
}

/* --- Left Visual Side --- */
.reg-visual-side {
    flex: 1.1;
    background-image: linear-gradient(to bottom, rgba(144, 12, 63, 0.1), rgba(0, 0, 0, 0.7)), url("{{ asset('assets/images/backgrounds/couple.png') }}");
    background-size: cover;
    background-position: center;
    padding: 60px 50px;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    color: #fff;
    position: relative;
}

.reg-visual-side::after {
    content: '';
    position: absolute;
    inset: 0;
    border: 1px solid rgba(255,255,255,0.15);
    margin: 25px;
    border-radius: 30px;
    pointer-events: none;
}

.visual-content h2 {
    font-family: 'Playfair Display', serif;
    font-size: 3.5rem;
    line-height: 1.1;
    margin-bottom: 20px;
    text-shadow: 0 4px 15px rgba(0,0,0,0.4);
}

.visual-content p {
    font-size: 1.2rem;
    opacity: 0.9;
    font-weight: 300;
    max-width: 450px;
    letter-spacing: 0.5px;
    line-height: 1.6;
}

.brand-stats {
    display: flex;
    gap: 40px;
    margin-top: 50px;
}

.stat-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.stat-val { font-size: 1.8rem; font-weight: 700; color: var(--rg); }
.stat-lbl { font-size: 0.8rem; text-transform: uppercase; opacity: 0.8; letter-spacing: 1.5px; }

/* --- Right Form Side --- */
.reg-form-side {
    flex: 1;
    background: #fff;
    padding: 50px 60px;
    display: flex;
    flex-direction: column;
    position: relative;
    min-width: 0; /* Prevents flex from blowing out */
}

/* ================================================
   MODERN PROGRESS BAR
================================================ */
.progress-container-modern {
    margin-bottom: 50px;
    padding: 0 10px;
}

.progress-steps-modern {
    display: flex;
    justify-content: space-between;
    position: relative;
}

.progress-steps-modern::before {
    content: '';
    position: absolute;
    top: 50%; left: 0; right: 0;
    height: 3px; background: #f5f5f5;
    transform: translateY(-50%);
    z-index: 1;
}

.step-dot {
    width: 38px; height: 38px;
    background: #fff; border: 2.5px solid #f5f5f5;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.85rem; font-weight: 800; color: #ccc;
    position: relative; z-index: 2;
    transition: var(--tr);
}

.step-dot.active {
    border-color: var(--rp); background: var(--rp); color: #fff;
    box-shadow: 0 0 0 8px rgba(144, 12, 63, 0.08);
    transform: scale(1.1);
}

.step-dot.done {
    border-color: var(--rg); background: var(--rg); color: #fff;
}

/* ================================================
   STEP CONTENT STYLES
================================================ */
.registration-header { margin-bottom: 40px; }

.registration-header h1 {
    font-family: 'Playfair Display', serif;
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--rt);
    margin-bottom: 12px;
}

.registration-header .sub-heading {
    color: var(--rm);
    font-size: 1.1rem;
    font-weight: 400;
}

/* Profile Options Grid Premium */
.profile-options {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
    margin-bottom: 40px;
}

.option-card {
    border: 2px solid #f8f8f8;
    border-radius: 22px;
    padding: 22px 10px;
    text-align: center;
    cursor: pointer;
    transition: var(--tr);
    background: #fff;
    box-shadow: 0 4px 10px rgba(0,0,0,0.02);
}

.option-card:hover { border-color: var(--rg); background: #fffdf5; transform: translateY(-8px); }

.option-card:has(input:checked) {
    border-color: var(--rp);
    background: rgba(144, 12, 63, 0.03);
    box-shadow: 0 20px 40px -12px rgba(144, 12, 63, 0.12);
    transform: translateY(-8px);
}

.option-icon { font-size: 1.8rem; color: #eec; margin-bottom: 10px; transition: var(--tr); }
.option-label { font-size: 0.92rem; font-weight: 700; color: #aaa; transition: var(--tr); }

.option-card:has(input:checked) .option-icon { color: var(--rp); }
.option-card:has(input:checked) .option-label { color: var(--rp); }

/* Form Fields Premium */
.reg-form-side .form-section { display: flex; flex-direction: column; gap: 24px; }

.reg-form-side .input-group { position: relative; width: 100%; margin-bottom: 0; }

.reg-form-side .input-group label {
    font-size: 0.85rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: 0.8px;
    color: #999; margin-bottom: 10px;
    display: block;
}

.reg-form-side .input-group input,
.reg-form-side .input-group select,
.reg-form-side .custom-select {
    width: 100% !important;
    padding: 0 20px 0 52px !important; /* Removed vertical padding to use fixed height for centering */
    border: 1.8px solid #f0f0f0 !important;
    border-radius: 16px !important;
    font-size: 0.95rem !important;
    font-family: 'Outfit', sans-serif !important;
    background: #fafafa !important;
    transition: var(--tr) !important;
    box-sizing: border-box !important;
    display: block !important;
    height: 56px !important;
    line-height: 56px !important;
    appearance: none !important;
    -webkit-appearance: none !important;
}

.reg-form-side .input-group input:focus,
.reg-form-side .input-group select:focus,
.reg-form-side .custom-select:focus {
    outline: none !important;
    border-color: var(--rp) !important;
    background: #fff !important;
    box-shadow: 0 12px 25px rgba(144,12,63,0.08) !important;
}

.reg-form-side .input-group .input-icon {
    position: absolute !important;
    left: 20px !important;
    top: 45px !important; /* Icon centered in 56px input (label ~26px + (56-18)/2 = 45px) */
    bottom: auto !important;
    transform: none !important;
    font-size: 1.15rem !important;
    color: #ccc !important;
    transition: var(--tr) !important;
    pointer-events: none !important;
    z-index: 5 !important;
}

.reg-form-side .input-group input:focus ~ .input-icon,
.reg-form-side .input-group select:focus ~ .input-icon { color: var(--rp) !important; }

/* Special case for rows - column groups */
.reg-form-side .row.g-3 { margin-top: 0; }

/* OTP STYLES */
.otp-container { text-align: center; padding-top: 10px; }
.otp-inputs {
    display: flex; justify-content: center;
    gap: 12px; margin: 30px auto 25px;
}
.otp-field {
    width: 50px !important; height: 60px !important;
    border: 2px solid #f0f0f0 !important;
    border-radius: 14px !important;
    font-size: 1.5rem !important;
    font-weight: 800 !important;
    text-align: center !important;
    padding: 0 !important;
    color: var(--rp) !important;
    background: #fafafa !important;
    transition: var(--tr) !important;
}
.otp-field:focus {
    border-color: var(--rp) !important;
    background: #fff !important;
    box-shadow: 0 10px 20px rgba(144,12,63,0.1) !important;
    outline: none !important;
}

.resend-container {
    display: flex; flex-direction: column; align-items: center;
    gap: 10px; margin-bottom: 30px;
    font-size: 0.95rem; color: #777;
}

/* SECTION CARDS (Final Step) */
.section-card {
    background: #fff;
    border: 1.8px solid #f8f8f8;
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 24px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.02);
}
.section-title {
    font-size: 1.15rem; font-weight: 700;
    color: var(--rt); margin-bottom: 15px;
    display: flex; align-items: center; gap: 10px;
}
.section-title i { color: var(--rp); }
.section-desc { font-size: 0.95rem; color: #888; margin-bottom: 20px; line-height: 1.5; }

/* VERIFICATION EXTRA UNIQUE STYLES */
.verified-badge-premium {
    background: linear-gradient(135deg, #10b981, #059669);
    color: #fff; padding: 4px 12px; border-radius: 50px;
    font-size: 0.75rem; font-weight: 800; text-transform: uppercase;
    letter-spacing: 0.5px; display: inline-flex; align-items: center; gap: 5px;
}
.verified-badge-premium::before { content: '\f058'; font-family: 'Font Awesome 6 Free'; font-weight: 900; }

.verification-box { 
    background: #000; border-radius: 24px; overflow: hidden; 
    position: relative; min-height: 250px; display: flex; align-items: center; justify-content: center;
}
.camera-placeholder {
    display: flex; flex-direction: column; align-items: center; gap: 15px; color: #444; text-align: center;
}
.camera-placeholder i { font-size: 3.5rem; color: #222; }

.camera-area { width: 100%; height: 100%; position: relative; }
.camera-area video { width: 100%; height: auto; display: block; filter: contrast(1.1); }
.camera-overlay {
    position: absolute; inset: 0; 
    border: 30px solid rgba(0,0,0,0.4); border-radius: 24px; pointer-events: none;
    box-shadow: inset 0 0 100px rgba(144, 12, 63, 0.2);
}

.btn-capture-premium {
    position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%);
    width: 60px; height: 60px; border-radius: 50%; background: #fff;
    border: 4px solid rgba(255,255,255,0.3); cursor: pointer;
    display: flex; align-items: center; justify-content: center; transition: var(--tr);
}
.btn-capture-premium:hover { transform: translateX(-50%) scale(1.1); }
.capture-inner { width: 44px; height: 44px; border-radius: 50%; border: 2px solid #000; background: #fff; }

.upload-icon-circle {
    width: 64px; height: 64px; border-radius: 50%; background: var(--rgl);
    color: var(--rp); display: flex; align-items: center; justify-content: center;
    font-size: 1.5rem; margin-bottom: 15px;
}

.interests-chips { display: flex; flex-wrap: wrap; gap: 10px; }
.chip {
    padding: 10px 18px; border-radius: 12px; background: #fafafa;
    border: 1.5px solid #eee; cursor: pointer; transition: var(--tr);
    font-size: 0.88rem; font-weight: 700; color: #666;
    display: flex; align-items: center; gap: 8px;
}
.chip i { font-size: 0.9rem; opacity: 0.6; }
.chip:hover { border-color: var(--rp); color: var(--rp); transform: translateY(-2px); }
.chip.selected { 
    background: var(--rp); border-color: var(--rp); color: #fff; 
    box-shadow: 0 8px 20px rgba(144, 12, 63, 0.2);
}
.chip.selected i { opacity: 1; }

.photo-preview-wrap { position: relative; width: 100%; display: flex; justify-content: center; }
#photoPreview { width: 100%; max-height: 250px; object-fit: cover; border-radius: 12px; }
#selfiePreview { width: 100%; max-height: 250px; object-fit: cover; border-radius: 12px; }
.verification-box video { max-height: 400px; width: 100%; object-fit: cover; }

/* Buttons Premium */
.btn-primary-premium {
    background: linear-gradient(135deg, var(--rp), var(--rpl));
    color: #fff; border: none;
    padding: 20px 35px; border-radius: 18px;
    font-size: 1.15rem; font-weight: 800;
    cursor: pointer; transition: var(--tr);
    display: flex; align-items: center; justify-content: center; gap: 14px;
    box-shadow: 0 25px 50px -15px rgba(144, 12, 63, 0.35);
    width: 100%;
}

.btn-primary-premium:hover {
    transform: translateY(-4px);
    box-shadow: 0 30px 60px -12px rgba(144, 12, 63, 0.45);
}

.btn-outline-premium {
    padding: 18px 30px; border-radius: 18px;
    border: 2px solid #f0f0f0; background: #fff;
    color: #888; font-weight: 700;
    transition: var(--tr); cursor: pointer;
}

.btn-outline-premium:hover { border-color: var(--rp); color: var(--rp); background: #fffafb; }

.form-actions-row { display: flex; gap: 18px; margin-top: 10px; }
.flex-grow-1 { flex: 1; }

/* Responsive */
@media (max-width: 1000px) {
    .premium-reg-box { flex-direction: column; max-width: 650px; min-height: auto; }
    .reg-visual-side { min-height: 400px; padding: 40px; }
    .visual-content h2 { font-size: 2.8rem; }
    .reg-form-side { padding: 45px 35px; }
}

@media (max-width: 500px) {
    .reg-visual-side { display: none; }
    .reg-form-side { padding: 35px 20px; }
    .profile-options { grid-template-columns: repeat(2, 1fr); gap: 12px; }
    .registration-header h1 { font-size: 2rem; }
    .btn-primary-premium { padding: 18px 25px; }
}

/* Animations */
.form-step { animation: stepIn .7s cubic-bezier(.4, 0, .2, 1) both; }
.form-step.hidden { display: none !important; }

@keyframes stepIn {
    from { opacity: 0; transform: scale(0.95) translateX(30px); }
    to { opacity: 1; transform: scale(1) translateX(0); }
}

/* ================================================
   LOGIN POPUP MODAL STYLES
================================================ */
.modal-overlay {
    position: fixed; inset: 0; background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px); z-index: 1000;
    display: none; align-items: center; justify-content: center;
    padding: 20px; animation: fadeIn .4s ease;
}

.login-modal {
    background: #fff; width: 100%; max-width: 450px;
    border-radius: 30px; padding: 40px; position: relative;
    box-shadow: 0 40px 100px rgba(0,0,0,0.3);
    animation: slideUp .5s cubic-bezier(.17, .84, .44, 1);
}

.modal-close {
    position: absolute; right: 25px; top: 25px;
    width: 35px; height: 35px; border-radius: 50%;
    background: #f8f8f8; border: none; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    color: #888; transition: var(--tr);
}
.modal-close:hover { background: var(--rp); color: #fff; }

.login-modal h2 {
    font-family: 'Playfair Display', serif; font-size: 2.2rem;
    color: var(--rt); margin-bottom: 30px; text-align: center;
}

/* Modal Form Styles */
.modal-form .input-group { margin-bottom: 20px; }
.modal-form .input-group label {
    font-size: 0.8rem; font-weight: 800; color: #aaa;
    text-transform: uppercase; margin-bottom: 8px; display: block;
}

.modal-form .form-actions { margin-top: 30px; }

@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes slideUp { from { opacity: 0; transform: translateY(50px); } to { opacity: 1; transform: translateY(0); } }

/* ================================================
   REGISTRATION FOOTER (STEP 1)
================================================ */
.reg-footer-elements {
    margin-top: 50px; padding-top: 30px;
    border-top: 1.5px solid #f5f5f5;
    text-align: center;
}

.reg-trust-text {
    font-size: 0.9rem; color: #888; margin-bottom: 15px;
    display: flex; align-items: center; justify-content: center; gap: 8px;
}
.reg-trust-text i { color: #10b981; }

.login-invitation {
    font-size: 1rem; color: #555; font-weight: 500;
}
.open-login-modal {
    color: var(--rp); font-weight: 800; cursor: pointer;
    margin-left: 5px; text-decoration: none;
    background: var(--rgl); padding: 5px 12px; border-radius: 10px;
    transition: var(--tr);
}
.open-login-modal:hover { background: var(--rp); color: #fff; }
</style>

<div class="registration-page-wrapper">
    <!-- Decorative Blurs -->
    <div class="deco-circle" style="top: -100px; left: -100px; width: 450px; height: 450px; background: rgba(144, 12, 63, 0.08);"></div>
    <div class="deco-circle" style="bottom: -150px; right: -150px; width: 550px; height: 550px; background: rgba(212, 175, 55, 0.1);"></div>

    <div class="premium-reg-box">
        <!-- Left: Visual Side with couple image -->
        <div class="reg-visual-side">
            <div class="visual-content">
                <h2>Find Your <br><span style="color: var(--rg);">Heavenly</span> Match</h2>
                <p>Register today to browse 10,000+ verified profiles. Your journey to a happy life together starts here.</p>
                
                <div class="brand-stats">
                    <div class="stat-item">
                        <span class="stat-val">10K+</span>
                        <span class="stat-lbl">Profiles</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-val">1.5K+</span>
                        <span class="stat-lbl">Weddings</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-val">100%</span>
                        <span class="stat-lbl">Trusted</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Professional Form Interface -->
        <div class="reg-form-side">
            <!-- Modern Circular Progress -->
            <div class="progress-container-modern">
                <div class="progress-steps-modern">
                    <div class="step-dot active" id="dot-1">1</div>
                    <div class="step-dot" id="dot-2">2</div>
                    <div class="step-dot" id="dot-3">3</div>
                    <div class="step-dot" id="dot-4">4</div>
                    <div class="step-dot" id="dot-5">5</div>
                    <div class="step-dot" id="dot-6">6</div>
                    <div class="step-dot" id="dot-verification">7</div>
                </div>
            </div>

            <form action="{{ url('/register') }}" method="POST" id="regForm" enctype="multipart/form-data" novalidate>
                @csrf

                {{-- STEP 1 --}}
                @include('auth.register-step1')

                {{-- STEP 2 --}}
                @include('auth.register-otp')

                {{-- STEP 3 --}}
                @include('auth.basic-details')

                {{-- STEP 4 --}}
                @include('auth.religion-details')

                {{-- STEP 5 --}}
                @include('auth.profession-details')

                {{-- STEP 6 --}}
                @include('auth.family-details')

                {{-- STEP 7 --}}
                @include('auth.profile-verification')

            </form>
        </div>
    </div>
</div>

<!-- Login Modal -->
<div class="modal-overlay" id="loginModalOverlay">
    <div class="login-modal">
        <button class="modal-close" id="closeModal">
            <i class="fa-solid fa-xmark"></i>
        </button>
        
        <h2>Welcome Back</h2>
        
        <form action="{{ url('login') }}" method="POST" class="modal-form">
            @csrf
            <div class="input-group">
                <label>Email or Mobile Number</label>
                <div style="position: relative;">
                    <input type="text" name="login_id" placeholder="Enter email or mobile no" required style="width: 100%; height: 56px; border-radius: 16px; border: 1.8px solid #f0f0f0; padding: 0 20px 0 52px; font-family: 'Outfit';">
                    <i class="fa-regular fa-user" style="position: absolute; left: 20px; top: 18px; color: #ccc;"></i>
                </div>
            </div>
            
            <div class="input-group">
                <label>Password</label>
                <div style="position: relative;">
                    <input type="password" id="loginPasswordInput" name="password" placeholder="Enter password" required style="width: 100%; height: 56px; border-radius: 16px; border: 1.8px solid #f0f0f0; padding: 0 50px 0 52px; font-family: 'Outfit';">
                    <i class="fa-solid fa-lock" style="position: absolute; left: 20px; top: 18px; color: #ccc;"></i>
                    <i class="fa-solid fa-eye" id="toggleLoginPassword" style="position: absolute; right: 20px; top: 18px; color: #ccc; cursor: pointer;" onclick="togglePasswordVisibility('loginPasswordInput', this)"></i>
                </div>
            </div>

            <div style="text-align: right; margin-bottom: 20px;">
                <a href="javascript:void(0)" id="modalForgotLink" style="color: var(--rm); font-size: 0.85rem; text-decoration: none;">Forgot Password?</a>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary-premium">
                    Login to Account <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
        </form>

        <!-- Forgot Password Flow Container (Initially Hidden) -->
        <div id="modalForgotFlow" style="display: none; padding: 10px 0;">
             <!-- Step 1 -->
             <div id="mForgotStep1">
                <div style="text-align: center; margin-bottom: 25px;">
                    <i class="fas fa-envelope-open-text fa-3x" style="color: var(--rp); opacity: 0.8; margin-bottom: 15px;"></i>
                    <h3 style="font-family: 'Playfair Display'; margin-bottom: 10px;">Reset Password</h3>
                    <p style="color: #888; font-size: 0.9rem;">Enter email to receive code.</p>
                </div>
                <div class="input-group">
                    <label>Email Address</label>
                    <div style="position: relative;">
                        <input type="email" id="mForgotEmail" placeholder="e.g. name@example.com" style="width: 100%; height: 56px; border-radius: 16px; border: 1.8px solid #f0f0f0; padding: 0 20px 0 52px;">
                        <i class="fas fa-at" style="position: absolute; left: 20px; top: 18px; color: #ccc;"></i>
                    </div>
                </div>
                <button type="button" class="btn-primary-premium" id="mSendOtpBtn" style="width: 100%; margin-top: 20px;">Send Code <i class="fas fa-paper-plane ms-2"></i></button>
                <div style="text-align: center; margin-top: 20px;">
                    <a href="javascript:void(0)" id="backToLogin" style="color: #888; font-size: 0.85rem; text-decoration: none;">Back to Login</a>
                </div>
             </div>

             <!-- Step 2 -->
             <div id="mForgotStep2" style="display: none;">
                <div style="text-align: center; margin-bottom: 25px;">
                    <i class="fas fa-shield-alt fa-3x" style="color: var(--rp); opacity: 0.8; margin-bottom: 15px;"></i>
                    <h3 style="font-family: 'Playfair Display'; margin-bottom: 10px;">Check Email</h3>
                    <p style="color: #888; font-size: 0.9rem;">Code sent to <br><strong id="mResetEmailDisplay" style="color: #333;"></strong></p>
                </div>
                <div style="display: flex; justify-content: center; gap: 8px; margin: 20px 0;" class="m-otp-group">
                    <input type="text" maxlength="1" class="m-otp-input" style="width: 45px; height: 56px; text-align: center; border-radius: 12px; border: 1.8px solid #f0f0f0; font-weight: 700; font-size: 1.2rem;">
                    <input type="text" maxlength="1" class="m-otp-input" style="width: 45px; height: 56px; text-align: center; border-radius: 12px; border: 1.8px solid #f0f0f0; font-weight: 700; font-size: 1.2rem;">
                    <input type="text" maxlength="1" class="m-otp-input" style="width: 45px; height: 56px; text-align: center; border-radius: 12px; border: 1.8px solid #f0f0f0; font-weight: 700; font-size: 1.2rem;">
                    <input type="text" maxlength="1" class="m-otp-input" style="width: 45px; height: 56px; text-align: center; border-radius: 12px; border: 1.8px solid #f0f0f0; font-weight: 700; font-size: 1.2rem;">
                    <input type="text" maxlength="1" class="m-otp-input" style="width: 45px; height: 56px; text-align: center; border-radius: 12px; border: 1.8px solid #f0f0f0; font-weight: 700; font-size: 1.2rem;">
                    <input type="text" maxlength="1" class="m-otp-input" style="width: 45px; height: 56px; text-align: center; border-radius: 12px; border: 1.8px solid #f0f0f0; font-weight: 700; font-size: 1.2rem;">
                </div>
                <input type="hidden" id="mResetOtp">
                <button type="button" class="btn-primary-premium" id="mVerifyOtpBtn" style="width: 100%; margin-top: 10px;">Verify Code <i class="fas fa-check-circle ms-2"></i></button>
             </div>

             <!-- Step 3 -->
             <div id="mForgotStep3" style="display: none;">
                <div style="text-align: center; margin-bottom: 25px;">
                    <i class="fas fa-lock-open fa-3x" style="color: #10b981; margin-bottom: 15px;"></i>
                    <h3 style="font-family: 'Playfair Display'; margin-bottom: 10px;">Update Password</h3>
                </div>
                <div class="input-group" style="margin-bottom: 15px;">
                    <label>New Password</label>
                    <div style="position: relative;">
                        <input type="password" id="mNewPassword" placeholder="••••••••" style="width: 100%; height: 56px; border-radius: 16px; border: 1.8px solid #f0f0f0; padding: 0 50px 0 20px;">
                        <i class="fa-solid fa-eye" id="toggleNewPassword" style="position: absolute; right: 20px; top: 18px; color: #ccc; cursor: pointer;" onclick="togglePasswordVisibility('mNewPassword', this)"></i>
                    </div>
                </div>
                <div class="input-group">
                    <label>Confirm Password</label>
                    <div style="position: relative;">
                        <input type="password" id="mConfirmPassword" placeholder="••••••••" style="width: 100%; height: 56px; border-radius: 16px; border: 1.8px solid #f0f0f0; padding: 0 50px 0 20px;">
                        <i class="fa-solid fa-eye" id="toggleConfirmPassword" style="position: absolute; right: 20px; top: 18px; color: #ccc; cursor: pointer;" onclick="togglePasswordVisibility('mConfirmPassword', this)"></i>
                    </div>
                </div>
                <button type="button" class="btn-primary-premium" id="mUpdatePassBtn" style="width: 100%; margin-top: 20px;">Update & Login <i class="fas fa-lock ms-2"></i></button>
             </div>
        </div>
        
        <div style="margin-top: 30px; text-align: center; font-size: 0.95rem; color: #888;">
            Don't have an account? <span style="color: var(--rp); font-weight: 700; cursor: pointer;" id="switchToRegister">Register Now</span>
        </div>
    </div>
</div>

{{-- Style overrides to ensure the included blade files match the premium look --}}
<style>
    .btn-submit-reg { display: none !important; } /* We will use our premium button class instead or style it */
    .btn-submit-reg.next-step { 
        display: flex !important;
        background: linear-gradient(135deg, var(--rp), var(--rpl)) !important;
        padding: 18px 30px !important;
        border-radius: 18px !important;
        font-size: 1.1rem !important;
        font-weight: 800 !important;
        box-shadow: 0 15px 35px -10px rgba(144, 12, 63, 0.3) !important;
        width: 100% !important;
        border: none !important;
        color: #fff !important;
        margin-top: 20px !important;
        cursor: pointer !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
    }
    .btn-outline-reg.prev-step {
        display: block !important;
        padding: 18px 30px !important;
        border-radius: 18px !important;
        border: 2px solid #f0f0f0 !important;
        background: #fff !important;
        color: #888 !important;
        font-weight: 700 !important;
    }
    .btn-outline-reg.prev-step:hover {
        border-color: var(--rp) !important;
        color: var(--rp) !important;
    }

    /* Required field asterisk */
    .required-asterisk {
        color: #e74c3c;
        margin-left: 2px;
        font-size: 1rem;
    }

    /* Validation error message */
    .field-error {
        color: #e74c3c;
        font-size: 0.8rem;
        font-weight: 500;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .field-error i {
        font-size: 0.7rem;
    }
</style>

<script>
function togglePasswordVisibility(inputId, iconElement) {
    const input = document.getElementById(inputId);
    if (input.type === 'password') {
        input.type = 'text';
        iconElement.classList.remove('fa-eye');
        iconElement.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        iconElement.classList.remove('fa-eye-slash');
        iconElement.classList.add('fa-eye');
    }
}

document.addEventListener('DOMContentLoaded', function () {

    @if($errors->any())
        setTimeout(() => {
            document.getElementById('loginModalOverlay').style.display = 'flex';
            Swal.fire({
                icon: 'error',
                title: 'Login Failed',
                text: '{!! addslashes($errors->first()) !!}',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000
            });
        }, 500);
    @endif

    /* ---- Step Management ---- */
    const stepOrder = ['1','2','3','4','5','6','verification'];
    let currentStepId = '1';

    // Set 18+ limit for DOB calendar
    const dobInput = document.getElementById('dob');
    if (dobInput) {
        const today = new Date();
        const eighteenYearsAgo = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
        const formattedDate = eighteenYearsAgo.toISOString().split('T')[0];
        dobInput.setAttribute('max', formattedDate);
    }

    function showStep(id) {
        document.querySelectorAll('.form-step').forEach(el => el.classList.add('hidden'));
        const target = document.getElementById('step-' + id);
        if (!target) return;
        
        target.classList.remove('hidden');
        updateDots(id);
        currentStepId = id;
        
        // Scroll to top of form area on step change
        const formSide = document.querySelector('.reg-form-side');
        if (window.innerWidth < 1000) {
            window.scrollTo({ top: formSide.offsetTop - 20, behavior: 'smooth' });
        }

        // Show SweetAlert for step transition
        const stepTitles = {
            '1': 'Profile Information',
            '2': 'OTP Verification',
            '3': 'Basic Details',
            '4': 'Religion & Community',
            '5': 'Education & Career',
            '6': 'Family Background',
            'verification': 'Profile Verification'
        };

        if (id !== '1') {
            Swal.fire({
                title: stepTitles[id],
                text: 'Moving to next step...',
                icon: 'success',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });
        }
    }

    function updateDots(id) {
        stepOrder.forEach((k, i) => {
            const dot = document.getElementById('dot-' + k);
            if (!dot) return;
            dot.classList.remove('active', 'done');
            
            const currentIdx = stepOrder.indexOf(id);
            if (i < currentIdx) dot.classList.add('done');
            if (i === currentIdx) dot.classList.add('active');
        });
    }

    function showFieldError(input, message) {
        const group = input.closest('.input-group');
        if (!group) return;
        let errorEl = group.querySelector('.field-error');
        if (!errorEl) {
            errorEl = document.createElement('div');
            errorEl.className = 'field-error';
            errorEl.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span>';
            group.appendChild(errorEl);
        }
        const textSpan = errorEl.querySelector('.error-text');
        if (textSpan) textSpan.textContent = message;
        errorEl.style.display = 'flex';
    }

    function clearFieldError(input) {
        const group = input.closest('.input-group');
        if (!group) return;
        const errorEl = group.querySelector('.field-error');
        if (errorEl) {
            errorEl.style.display = 'none';
        }
    }

    function validateCurrentStep() {
        const currentStepEl = document.getElementById('step-' + currentStepId);
        const inputs = currentStepEl.querySelectorAll('input[required], select[required]');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                isValid = false;
                // For hidden inputs (like photo/selfie), we might want to highlight the container
                if (input.type === 'hidden' || input.hidden) {
                    const container = input.closest('.section-card') || input.parentElement;
                    container.style.border = '2px solid #ff4d4d';
                } else {
                    input.classList.add('is-invalid');
                    input.style.borderColor = '#ff4d4d';
                    const label = input.closest('.input-group')?.querySelector('label')?.textContent.replace('*', '').trim() || 'This field';
                    showFieldError(input, label + ' is required');
                }
            } else {
                input.classList.remove('is-invalid');
                input.style.borderColor = '#f0f0f0';
                clearFieldError(input);
                if (input.type === 'hidden' || input.hidden) {
                    const container = input.closest('.section-card') || input.parentElement;
                    container.style.border = '1.8px solid #f8f8f8';
                }
            }
        });

        // Special check for Photo on verification step
        if (currentStepId === 'verification') {
            const photo = document.getElementById('photoInput');
            const selfie = document.getElementById('selfieImageHidden');
            if (photo && !photo.value) {
                isValid = false;
                document.getElementById('photoDropZone').style.borderColor = '#ff4d4d';
                const photoError = document.getElementById('photoError');
                if (photoError) photoError.style.display = 'flex';
            } else if (photo && photo.value) {
                document.getElementById('photoDropZone').style.borderColor = '#eee';
                const photoError = document.getElementById('photoError');
                if (photoError) photoError.style.display = 'none';
            }
            // Selfie is now optional
            if (selfie && !selfie.value) {
                // No action needed, allowed to be empty
            }
        }

        if (!isValid) {
            Swal.fire({
                title: 'Required Fields',
                text: 'Please fill in all mandatory fields before proceeding.',
                icon: 'warning',
                confirmButtonColor: '#900C3F'
            });
        }
        return isValid;
    }

    async function sendOTP() {
        const email    = document.getElementById('email').value;
        const fullName = document.getElementById('fullName').value;
        const mobile   = document.getElementById('mobile').value;

        if (!fullName || !mobile || !email) {
            Swal.fire('Error', 'Please fill all fields', 'error');
            return;
        }

        Swal.fire({
            title: 'Checking & Sending OTP...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        try {
            const response = await fetch('{{ url("/send-otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email: email, mobile: mobile })
            });
            const data = await response.json();

            if (data.success) {
                Swal.fire({
                    title: 'OTP Sent!',
                    text: data.message,
                    icon: 'success',
                    confirmButtonColor: '#900C3F'
                });

                // Update display email in OTP step
                const displayEmail = document.getElementById('displayEmail');
                if (displayEmail) displayEmail.textContent = email;

                showStep('2');
                startTimer();

            } else if (data.mobile_exists) {
                // Special alert for duplicate mobile number
                Swal.fire({
                    icon: 'warning',
                    title: 'Already Registered!',
                    html: `<p style="font-size:1rem; color:#555; line-height:1.6;">
                              You are already registered with this mobile number 
                              <strong style="color:#900C3F;">${mobile}</strong>.<br><br>
                              Please login to your existing account.
                           </p>`,
                    confirmButtonText: 'Login Here',
                    confirmButtonColor: '#900C3F',
                    showCancelButton: true,
                    cancelButtonText: 'Use Different Number',
                    cancelButtonColor: '#aaa',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Open the login modal
                        const loginModal = document.getElementById('loginModalOverlay');
                        if (loginModal) {
                            loginModal.style.display = 'flex';
                        }
                    } else {
                        // Focus mobile field for correction
                        const mobileField = document.getElementById('mobile');
                        if (mobileField) {
                            mobileField.value = '';
                            mobileField.focus();
                            mobileField.style.borderColor = '#ff4d4d';
                        }
                    }
                });

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message,
                    confirmButtonColor: '#900C3F'
                });
            }
        } catch (error) {
            Swal.fire('Error', 'Something went wrong!', 'error');
        }
    }

    // OTP Auto-tabbing Logic
    const otpFields = document.querySelectorAll('.otp-field');
    otpFields.forEach((field, index) => {
        field.addEventListener('keyup', (e) => {
            if (e.key >= 0 && e.key <= 9) {
                if (index < otpFields.length - 1) {
                    otpFields[index + 1].focus();
                }
            } else if (e.key === 'Backspace') {
                if (index > 0) {
                    otpFields[index - 1].focus();
                }
            }
        });
        
        // Prevent non-numeric characters
        field.addEventListener('input', (e) => {
            e.target.value = e.target.value.replace(/[^0-9]/g, '');
        });
    });

    async function verifyOTP() {
        let otp = "";
        document.querySelectorAll('.otp-field').forEach(field => {
            otp += field.value;
        });

        if (otp.length < 6) {
            Swal.fire('Error', 'Please enter 6-digit OTP', 'error');
            return;
        }

        try {
            const response = await fetch('{{ url("/verify-otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ otp: otp })
            });
            const data = await response.json();
            
            if (data.success) {
                Swal.fire('Verified!', data.message, 'success');
                showStep('3');
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        } catch (error) {
            Swal.fire('Error', 'Something went wrong!', 'error');
        }
    }

    let timer;
    function startTimer() {
        let timeLeft = 30;
        const countdownEl = document.getElementById('countdown');
        const resendBtn = document.getElementById('resendBtn');
        const timerBox = document.getElementById('timerBox');
        
        if (resendBtn) {
            resendBtn.disabled = true;
            resendBtn.style.display = 'none';
        }
        if (timerBox) timerBox.style.display = 'block';
        
        clearInterval(timer);
        
        timer = setInterval(() => {
            timeLeft--;
            const mins = Math.floor(timeLeft / 60);
            const secs = timeLeft % 60;
            if (countdownEl) countdownEl.textContent = `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
            
            if (timeLeft <= 0) {
                clearInterval(timer);
                if (resendBtn) {
                    resendBtn.disabled = false;
                    resendBtn.style.display = 'block';
                }
                if (timerBox) timerBox.style.display = 'none';
            }
        }, 1000);
    }

    // Resend OTP handler
    const resendBtn = document.getElementById('resendBtn');
    if (resendBtn) {
        resendBtn.onclick = () => sendOTP();
    }

    // Wiring Next/Prev Buttons
    document.querySelectorAll('.next-step').forEach(btn => {
        btn.onclick = async function() {
            if (!validateCurrentStep()) return;

            const n = btn.dataset.next;
            
            if (currentStepId === '1') {
                await sendOTP();
            } else if (currentStepId === '2') {
                await verifyOTP();
            } else {
                if (n) showStep(n);
            }
        };
    });

    document.querySelectorAll('.prev-step').forEach(btn => {
        btn.onclick = function() {
            const p = btn.dataset.prev;
            if (p) showStep(p);
        };
    });

    // Form submission SweetAlert
    const regForm = document.getElementById('regForm');
    if (regForm) {
        regForm.onsubmit = function(e) {
            if (!validateCurrentStep()) {
                e.preventDefault();
                return false;
            }

            Swal.fire({
                title: 'Creating Your Profile...',
                text: 'Please wait while we set up your heavenly match journey.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            return true;
        };
    }

    /* ================================================
       Dynamic Dropdowns & API Fetch logic
    ================================================ */
    async function fetchMasterData(endpoint, params = {}) {
        try {
            const url = new URL('{{ url("/api/master") }}/' + endpoint);
            Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));
            const response = await fetch(url);
            return await response.json();
        } catch (error) {
            console.error('Error fetching ' + endpoint + ':', error);
            return [];
        }
    }

    async function populateSelect(selectId, endpoint, params = {}, defaultText = 'Select') {
        const select = document.getElementById(selectId);
        if (!select) return;
        
        select.innerHTML = `<option value="">Loading...</option>`;
        const data = await fetchMasterData(endpoint, params);
        
        select.innerHTML = `<option value="">${defaultText}</option>`;
        data.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.name;
            select.appendChild(option);
        });
    }

    // Initial population
    populateSelect('religion', 'religions', {}, 'Select Religion');
    populateSelect('maritalStatus', 'marital-statuses', {}, 'Select Marital Status');
    populateSelect('height', 'heights', {}, 'Select Height');
    populateSelect('bodyType', 'body-types', {}, 'Select Body Type');
    populateSelect('complexion', 'complexions', {}, 'Select Complexion');
    populateSelect('education', 'education', {}, 'Select Education');
    populateSelect('jobCategory', 'job-categories', {}, 'Select Job Category');
    populateSelect('income', 'income', {}, 'Select Income');
    populateSelect('rasi', 'rasis', {}, 'Select Rasi');
    populateSelect('laknam', 'rasis', {}, 'Select Laknam');
    populateSelect('star', 'stars', {}, 'Select Star');

    // Dependent fields
    const religionSelect = document.getElementById('religion');
    if (religionSelect) {
        religionSelect.addEventListener('change', function() {
            if (this.value) {
                populateSelect('caste', 'castes', { religion_id: this.value }, 'Select Caste');
            }
        });
    }

    const casteSelect = document.getElementById('caste');
    if (casteSelect) {
        casteSelect.addEventListener('change', function() {
            if (this.value) {
                populateSelect('subCaste', 'subcastes', { caste_id: this.value }, 'Select Sub Caste');
            }
        });
    }

    // Start on step 1
    showStep('1');

    // Clear field errors on input/change
    document.addEventListener('input', function(e) {
        if (e.target.matches('input[required], select[required]')) {
            if (e.target.value.trim()) {
                e.target.classList.remove('is-invalid');
                e.target.style.borderColor = '#f0f0f0';
                clearFieldError(e.target);
            }
        }
    });
    document.addEventListener('change', function(e) {
        if (e.target.matches('select[required]')) {
            if (e.target.value.trim()) {
                e.target.classList.remove('is-invalid');
                e.target.style.borderColor = '#f0f0f0';
                clearFieldError(e.target);
            }
        }
    });

    /* ================================================
       PROFILER VERIFICATION LOGIC (Final Step)
    ================================================ */

    // 1. Photo Upload Logic
    const photoInput = document.getElementById('photoInput');
    const photoDropZone = document.getElementById('photoDropZone');
    const photoPreview = document.getElementById('photoPreview');
    const photoPlaceholder = document.getElementById('photoPlaceholder');

    if (photoDropZone && photoInput) {
        photoDropZone.onclick = () => photoInput.click();

        photoInput.onchange = function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    photoPreview.src = e.target.result;
                    photoPreview.style.display = 'block';
                    photoPlaceholder.style.display = 'none';
                };
                reader.readAsDataURL(file);
                document.getElementById('photoDropZone').style.borderColor = '#eee';
                const errorEl = document.querySelector('#photoDropZone + .field-error, #photoDropZone .field-error');
                if (errorEl) errorEl.style.display = 'none';
            }
        };

        // Drag and Drop
        photoDropZone.ondragover = e => { e.preventDefault(); photoDropZone.style.borderColor = 'var(--rp)'; };
        photoDropZone.ondragleave = () => { photoDropZone.style.borderColor = '#eee'; };
        photoDropZone.ondrop = e => {
            e.preventDefault();
            photoDropZone.style.borderColor = '#eee';
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                photoInput.files = e.dataTransfer.files;
                const reader = new FileReader();
                reader.onload = ev => {
                    photoPreview.src = ev.target.result;
                    photoPreview.style.display = 'block';
                    photoPlaceholder.style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        };
    }

    // 2. Selfie Camera Logic
    const startCameraBtn = document.getElementById('startCameraBtn');
    const cameraArea = document.getElementById('cameraArea');
    const cameraPlaceholder = document.getElementById('cameraStartPlaceholder');
    const video = document.getElementById('cameraVideoFeed');
    const captureBtn = document.getElementById('captureBtn');
    const snapCanvas = document.getElementById('snapCanvas');
    const selfiePreview = document.getElementById('selfiePreview');
    const selfieHidden = document.getElementById('selfieImageHidden');

    if (startCameraBtn) {
        startCameraBtn.onclick = async function() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: true });
                video.srcObject = stream;
                cameraArea.style.display = 'block';
                cameraPlaceholder.style.display = 'none';
                selfiePreview.style.display = 'none';
            } catch (err) {
                alert("Camera access denied or not available.");
                console.error(err);
            }
        };
    }

    if (captureBtn) {
        captureBtn.onclick = function() {
            const context = snapCanvas.getContext('2d');
            snapCanvas.width = video.videoWidth;
            snapCanvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, snapCanvas.width, snapCanvas.height);
            
            const dataUrl = snapCanvas.toDataURL('image/png');
            selfiePreview.src = dataUrl;
            selfiePreview.style.display = 'block';
            selfieHidden.value = dataUrl;

            // Stop camera
            const stream = video.srcObject;
            const tracks = stream.getTracks();
            tracks.forEach(track => track.stop());
            cameraArea.style.display = 'none';
            cameraPlaceholder.style.display = 'flex';
        };
    }

    const skipSelfieBtn = document.getElementById('skipSelfieBtn');
    if (skipSelfieBtn) {
        skipSelfieBtn.onclick = function() {
            Swal.fire({
                title: 'Skip Verification?',
                text: "You can always complete your identity verification later from your dashboard to get a 'Verified' badge.",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#900C3F',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Yes, Skip for now',
                cancelButtonText: 'No, let me verify'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Verification Skipped',
                        text: 'Please click "Complete Registration" below to finish.',
                        icon: 'success',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            });
        };
    }

    // 3. Interests Selection
    const interestsHidden = document.getElementById('interestsHidden');
    const chips = document.querySelectorAll('.interests-chips .chip');
    let selectedInterests = [];

    chips.forEach(chip => {
        chip.onclick = function() {
            const val = this.dataset.value;
            if (this.classList.contains('selected')) {
                this.classList.remove('selected');
                selectedInterests = selectedInterests.filter(i => i !== val);
            } else {
                this.classList.add('selected');
                selectedInterests.push(val);
            }
            interestsHidden.value = selectedInterests.join(',');
        };
    });

    // 4. Login Modal Logic
    const loginModal = document.getElementById('loginModalOverlay');
    const openLoginBtns = document.querySelectorAll('.open-login-modal');
    const closeModalBtn = document.getElementById('closeModal');
    const switchBtn = document.getElementById('switchToRegister');

    function openModal() {
        loginModal.style.display = 'flex';
        document.body.style.overflow = 'hidden'; // Stop scrolling
    }

    function closeModal() {
        loginModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    openLoginBtns.forEach(btn => btn.onclick = openModal);
    if (closeModalBtn) closeModalBtn.onclick = closeModal;
    if (switchBtn) switchBtn.onclick = closeModal;

    // Close on click outside
    window.onclick = function(event) {
        if (event.target == loginModal) closeModal();
    }

    /* ---- Modal Forgot Password Flow ---- */
    const modalForgotLink = document.getElementById('modalForgotLink');
    const backToLogin = document.getElementById('backToLogin');
    const loginForm = document.querySelector('.modal-form');
    const modalForgotFlow = document.getElementById('modalForgotFlow');
    const modalTitle = document.querySelector('.login-modal h2');

    if (modalForgotLink) {
        modalForgotLink.onclick = function() {
            loginForm.style.display = 'none';
            modalForgotFlow.style.display = 'block';
            modalTitle.style.display = 'none';
        };
    }

    if (backToLogin) {
        backToLogin.onclick = function() {
            loginForm.style.display = 'block';
            modalForgotFlow.style.display = 'none';
            modalTitle.style.display = 'block';
        };
    }

    const mSendOtpBtn = document.getElementById('mSendOtpBtn');
    const mVerifyOtpBtn = document.getElementById('mVerifyOtpBtn');
    const mUpdatePassBtn = document.getElementById('mUpdatePassBtn');

    if (mSendOtpBtn) {
        mSendOtpBtn.onclick = async function() {
            const email = document.getElementById('mForgotEmail').value;
            if(!email) return Swal.fire('Error', 'Please enter your email', 'error');

            mSendOtpBtn.disabled = true;
            mSendOtpBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';

            try {
                const resp = await fetch('{{ url("/forgot-password") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ email })
                });
                const data = await resp.json();
                mSendOtpBtn.disabled = false;
                mSendOtpBtn.innerHTML = 'Send Code <i class="fas fa-paper-plane ms-2"></i>';

                if(data.success) {
                    document.getElementById('mResetEmailDisplay').textContent = email;
                    document.getElementById('mForgotStep1').style.display = 'none';
                    document.getElementById('mForgotStep2').style.display = 'block';
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            } catch(e) {
                mSendOtpBtn.disabled = false;
                Swal.fire('Error', 'Connection failed', 'error');
            }
        };
    }

    if (mVerifyOtpBtn) {
        mVerifyOtpBtn.onclick = async function() {
            const otp = document.getElementById('mResetOtp').value;
            if(otp.length < 6) return Swal.fire('Error', 'Enter 6-digit OTP', 'error');

            mVerifyOtpBtn.disabled = true;
            try {
                const resp = await fetch('{{ url("/verify-reset-otp") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ otp })
                });
                const data = await resp.json();
                mVerifyOtpBtn.disabled = false;
                if(data.success) {
                    document.getElementById('mForgotStep2').style.display = 'none';
                    document.getElementById('mForgotStep3').style.display = 'block';
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            } catch(e) {
                mVerifyOtpBtn.disabled = false;
                Swal.fire('Error', 'Connection failed', 'error');
            }
        };
    }

    if (mUpdatePassBtn) {
        mUpdatePassBtn.onclick = async function() {
            const password = document.getElementById('mNewPassword').value;
            const confirm = document.getElementById('mConfirmPassword').value;
            if(password.length < 6) return Swal.fire('Error', 'Min 6 characters required', 'error');
            if(password !== confirm) return Swal.fire('Error', 'Passwords do not match', 'error');

            mUpdatePassBtn.disabled = true;
            try {
                const resp = await fetch('{{ url("/reset-password") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ password, password_confirmation: confirm })
                });
                const data = await resp.json();
                mUpdatePassBtn.disabled = false;
                if(data.success) {
                    Swal.fire('Success', data.message, 'success').then(() => location.reload());
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            } catch(e) {
                mUpdatePassBtn.disabled = false;
                Swal.fire('Error', 'Connection failed', 'error');
            }
        };
    }

    // Modal OTP Auto-tabbing
    const mOtpInputs = document.querySelectorAll('.m-otp-input');
    mOtpInputs.forEach((input, index) => {
        input.onkeyup = (e) => {
            if (e.key >= 0 && e.key <= 9) {
                if (index < mOtpInputs.length - 1) mOtpInputs[index + 1].focus();
            } else if (e.key === 'Backspace' && index > 0) {
                mOtpInputs[index - 1].focus();
            }
            let fullOtp = "";
            mOtpInputs.forEach(inp => fullOtp += inp.value);
            document.getElementById('mResetOtp').value = fullOtp;
        };
    });
});
</script>

@endsection
