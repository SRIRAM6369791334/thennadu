@extends('layout.auth')

@section('content')

<style>
:root {
    --rp:  #900C3F;
    --rpl: #C70039;
    --rpd: #7b0a36;
    --rg:  #D4AF37;
    --rgl: rgba(212,175,55,.12);
    --tr:  all .4s cubic-bezier(.4, 0, .2, 1);
    --shadow-soft: 0 20px 50px rgba(0,0,0,0.05);
    /* Forgot Password Colors */
    --reset-bg: #fff;
    --reset-accent: #900C3F;
}

/* ── Forgot Password Modal Refinement ── */
#forgotPasswordModal .modal-content {
    border-radius: 24px;
    box-shadow: 0 30px 60px -12px rgba(144, 12, 63, 0.15);
}

.forgot-step-content {
    animation: fadeInSlide .5s ease forwards;
}

@keyframes fadeInSlide {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.modal-header .modal-title {
    font-size: 1.5rem;
    letter-spacing: -0.5px;
}

.otp-digit-group {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin: 25px 0;
}

.otp-digit-group input {
    width: 48px;
    height: 56px;
    border: 2px solid #f0f0f0;
    border-radius: 12px;
    text-align: center;
    font-size: 1.4rem;
    font-weight: 700;
    font-family: 'Outfit';
    transition: var(--tr);
    background: #fafafa;
}

.otp-digit-group input:focus {
    border-color: var(--rp);
    background: #fff;
    box-shadow: 0 4px 15px rgba(144, 12, 63, 0.08);
}

/* Page Layout */
.login-page-wrapper {
    min-height: 100vh;
    display: flex;
    background: #fff;
    font-family: 'Outfit', sans-serif;
}

/* ── Left Visual Panel ── */
.login-visual-panel {
    flex: 1.1;
    position: relative;
    overflow: hidden;
    display: none;
}
@media (min-width: 992px) {
    .login-visual-panel { display: flex; flex-direction: column; justify-content: flex-end; }
}

.login-visual-panel .bg-image {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to bottom,
        rgba(0,0,0,0.15) 0%,
        rgba(144,12,63,0.35) 40%,
        rgba(0,0,0,0.75) 100%
    ), url('{{ asset("assets/images/matri/banner_2.png") }}') no-repeat center 20% / cover;
}

.login-visual-panel .panel-content {
    position: relative;
    z-index: 2;
    padding: 60px;
    color: #fff;
}



.panel-content h2 {
    font-family: 'Playfair Display', serif;
    font-size: 3.2rem;
    line-height: 1.15;
    margin-bottom: 18px;
    text-shadow: 0 4px 20px rgba(0,0,0,0.4);
}

.panel-content p {
    font-size: 1.1rem;
    opacity: 0.85;
    max-width: 420px;
    line-height: 1.7;
    font-weight: 300;
}

.panel-stats {
    display: flex;
    gap: 35px;
    margin-top: 45px;
    padding-top: 30px;
    border-top: 1px solid rgba(255,255,255,0.2);
}
.panel-stats .stat { display: flex; flex-direction: column; gap: 3px; }
.panel-stats .stat-val { font-size: 1.7rem; font-weight: 700; color: var(--rg); }
.panel-stats .stat-lbl { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1.5px; opacity: 0.7; }

/* Decorative quote card */
.quote-card {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 20px;
    padding: 24px 28px;
    margin-bottom: 40px;
    max-width: 420px;
}
.quote-card p {
    font-size: 1rem;
    font-style: italic;
    margin: 0;
    opacity: 1;
}
.quote-card .quote-author {
    margin-top: 12px;
    font-size: 0.85rem;
    opacity: 0.7;
    font-style: normal;
}

/* ── Right Form Panel ── */
.login-form-panel {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 40px;
    background: #fff;
    position: relative;
    overflow: hidden;
}

/* Soft decorative blobs */
.login-form-panel::before {
    content: '';
    position: absolute;
    top: -120px;
    right: -120px;
    width: 350px;
    height: 350px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(144,12,63,0.06), transparent 70%);
    pointer-events: none;
}
.login-form-panel::after {
    content: '';
    position: absolute;
    bottom: -100px;
    left: -100px;
    width: 300px;
    height: 300px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(212,175,55,0.07), transparent 70%);
    pointer-events: none;
}

.login-form-inner {
    width: 100%;
    max-width: 420px;
    position: relative;
    z-index: 2;
}

/* Logo for mobile only */
.mobile-logo {
    display: flex;
    justify-content: center;
    margin-bottom: 40px;
}
.mobile-logo img { height: 55px; }
@media (min-width: 992px) { .mobile-logo { display: none; } }

/* Form Header */
.form-header { margin-bottom: 38px; }
.form-header .welcome-chip {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: var(--rgl);
    color: var(--rpd);
    border-radius: 50px;
    padding: 6px 16px;
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 18px;
}
.form-header .welcome-chip i { font-size: 0.85rem; color: var(--rg); }

.form-header h1 {
    font-family: 'Playfair Display', serif;
    font-size: 2.4rem;
    font-weight: 800;
    color: #1a1a1a;
    margin-bottom: 10px;
    line-height: 1.2;
}
.form-header p {
    color: #888;
    font-size: 1rem;
    margin: 0;
    line-height: 1.6;
}

/* Error Alert */
.login-error-box {
    background: #fff5f7;
    border: 1.5px solid rgba(144,12,63,0.2);
    border-radius: 14px;
    padding: 14px 18px;
    margin-bottom: 24px;
    color: var(--rpd);
    font-size: 0.9rem;
    display: flex;
    align-items: flex-start;
    gap: 10px;
}
.login-error-box i { margin-top: 2px; color: var(--rp); }

/* Input fields */
.field-group { margin-bottom: 22px; }
.field-group label {
    display: block;
    font-size: 0.78rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #aaa;
    margin-bottom: 10px;
}
.field-wrap {
    position: relative;
}
.field-wrap .field-icon {
    position: absolute;
    left: 18px;
    top: 50%;
    transform: translateY(-50%);
    color: #ccc;
    font-size: 1rem;
    transition: var(--tr);
    pointer-events: none;
}
.field-wrap input {
    width: 100%;
    height: 54px;
    border: 1.8px solid #f0f0f0;
    border-radius: 14px;
    background: #fafafa;
    padding: 0 18px 0 50px;
    font-size: 0.95rem;
    font-family: 'Outfit', sans-serif;
    color: #333;
    transition: var(--tr);
    outline: none;
}
.field-wrap input:focus {
    border-color: var(--rp);
    background: #fff;
    box-shadow: 0 8px 25px rgba(144,12,63,0.08);
}
.field-wrap input:focus + .field-icon,
.field-wrap input:focus ~ .field-icon { color: var(--rp); }

/* Show/hide password toggle */
.field-wrap .toggle-pass {
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #bbb;
    cursor: pointer;
    font-size: 1rem;
    transition: color 0.3s;
    z-index: 3;
}
.field-wrap .toggle-pass:hover { color: var(--rp); }

/* Remember / Forgot row */
.form-meta-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 28px;
    margin-top: -6px;
}
.remember-label {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    font-size: 0.88rem;
    color: #777;
}
.remember-label input[type="checkbox"] {
    width: 16px;
    height: 16px;
    accent-color: var(--rp);
    cursor: pointer;
}
.forgot-link {
    font-size: 0.88rem;
    color: var(--rp);
    font-weight: 700;
    text-decoration: none;
    transition: opacity 0.2s;
}
.forgot-link:hover { opacity: 0.75; }

/* Submit button */
.btn-login-submit {
    width: 100%;
    height: 56px;
    background: linear-gradient(135deg, var(--rp), var(--rpl));
    color: #fff;
    border: none;
    border-radius: 16px;
    font-size: 1rem;
    font-weight: 800;
    font-family: 'Outfit', sans-serif;
    cursor: pointer;
    transition: var(--tr);
    box-shadow: 0 20px 45px -12px rgba(144,12,63,0.35);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    letter-spacing: 0.4px;
}
.btn-login-submit:hover {
    transform: translateY(-3px);
    box-shadow: 0 28px 55px -10px rgba(144,12,63,0.45);
}
.btn-login-submit .arrow-icon {
    width: 30px;
    height: 30px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
}

/* Divider */
.form-divider {
    display: flex;
    align-items: center;
    gap: 14px;
    margin: 28px 0;
    color: #ddd;
    font-size: 0.8rem;
}
.form-divider::before, .form-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: #f0f0f0;
}

/* Register CTA */
.register-cta {
    text-align: center;
    font-size: 0.9rem;
    color: #888;
}
.register-cta a {
    color: var(--rp);
    font-weight: 800;
    text-decoration: none;
    padding: 4px 12px;
    background: var(--rgl);
    border-radius: 8px;
    transition: var(--tr);
}
.register-cta a:hover { background: var(--rp); color: #fff; }

/* Trust badges */
.trust-badges {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1.5px solid #f5f5f5;
}
.trust-badge {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    font-size: 0.72rem;
    color: #aaa;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.trust-badge i { font-size: 1.2rem; color: #10b981; }
.trust-badge.gold i { color: var(--rg); }
</style>

<div class="login-page-wrapper">

    <!-- ── Left Visual Panel ── -->
    <div class="login-visual-panel">
        <div class="bg-image"></div>
        <div class="panel-content">
    

            <div class="quote-card">
                <p>"A successful marriage requires falling in love many times, always with the same person."</p>
                <div class="quote-author">— Mignon McLaughlin</div>
            </div>

            <h2>Welcome<br>Back to<br><span style="color: #D4AF37;">Thennadu</span></h2>
            <p>Continue your journey to finding the perfect soulmate among thousands of verified Tamil profiles.</p>

            <div class="panel-stats">
                <div class="stat">
                    <span class="stat-val">10K+</span>
                    <span class="stat-lbl">Profiles</span>
                </div>
                <div class="stat">
                    <span class="stat-val">1.5K+</span>
                    <span class="stat-lbl">Weddings</span>
                </div>
                <div class="stat">
                    <span class="stat-val">100%</span>
                    <span class="stat-lbl">Trusted</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ── Right Form Panel ── -->
    <div class="login-form-panel">
        <div class="login-form-inner">

            <!-- Mobile Logo -->
            <div class="mobile-logo">
                <img src="{{ asset('assets/images/logo/matrilogo.png') }}" alt="Logo">
            </div>

            <!-- Header -->
            <div class="form-header">
                <div class="welcome-chip"><i class="fas fa-heart"></i> Members Login</div>
                <h1>Sign In to<br>Your Account</h1>
                <p>Enter your registered email or mobile number and password to access your profile and matches.</p>
            </div>

            <!-- Errors -->
            @if($errors->any())
                <div class="login-error-box">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ url('login') }}" method="POST" id="loginForm">
                @csrf

                <!-- Email or Mobile -->
                <div class="field-group">
                    <label for="login_id">Email or Mobile Number</label>
                    <div class="field-wrap">
                        <input
                            type="text"
                            id="login_id"
                            name="login_id"
                            value="{{ old('login_id') }}"
                            placeholder="Enter email or mobile no"
                            required
                            autocomplete="username"
                        >
                        <i class="fas fa-user field-icon"></i>
                    </div>
                </div>

                <!-- Password -->
                <div class="field-group">
                    <label for="password">Password</label>
                    <div class="field-wrap">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            required
                            autocomplete="current-password"
                        >
                        <i class="fas fa-lock field-icon"></i>
                        <button type="button" class="toggle-pass" onclick="togglePassword()" title="Show/Hide password">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember / Forgot -->
                <div class="form-meta-row">
                    <label class="remember-label">
                        <input type="checkbox" name="remember" id="remember">
                        Remember me
                    </label>
                    <a href="javascript:void(0)" class="forgot-link" id="showForgotFlow">Forgot Password?</a>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-login-submit" id="loginBtn">
                    Sign In to Account
                    <span class="arrow-icon"><i class="fas fa-arrow-right"></i></span>
                </button>

                <div class="form-divider">or</div>

                <div class="register-cta">
                    Don't have an account? <a href="{{ url('register') }}">Register for Free</a>
                </div>
            </form>

            <!-- Embedded Forgot Password Flow (Initially Hidden) -->
            <div id="pageForgotFlow" style="display: none; animation: fadeInSlide .5s ease;">
                <!-- Step 1: Email Input -->
                <div id="fStep1">
                    <div class="text-center mb-4">
                        <div class="icon-circle bg-light text-maroon mx-auto mb-3" style="width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; background: var(--rgl) !important;">
                            <i class="fas fa-envelope-open-text" style="color: var(--rp);"></i>
                        </div>
                        <h2 class="serif-font fw-bold mb-2">Reset Password</h2>
                        <p class="text-muted small">Enter your email to receive a recovery code.</p>
                    </div>
                    
                    <div class="field-group">
                        <label class="small fw-bold text-uppercase ls-1">Email Address</label>
                        <div class="field-wrap">
                            <input type="email" id="f_email" placeholder="e.g. name@example.com" class="form-control" style="height: 54px; border-radius: 14px; padding-left: 50px;">
                            <i class="fas fa-at field-icon"></i>
                        </div>
                    </div>
                    <button class="btn btn-login-submit mt-3 py-3 rounded-4 shadow-sm" id="fSendOtpBtn" style="height: 58px; width: 100%;">
                        Send Verification Code <i class="fas fa-long-arrow-right ms-2 mt-1"></i>
                    </button>
                    <div class="text-center mt-4 pt-2">
                        <a href="javascript:void(0)" class="text-muted small text-decoration-none fw-bold" id="backToLoginCard"><i class="fas fa-arrow-left me-2"></i> Back to Login</a>
                    </div>
                </div>

                <!-- Step 2: OTP Input -->
                <div id="fStep2" style="display: none;">
                    <div class="text-center mb-4">
                        <div class="icon-circle bg-light text-maroon mx-auto mb-3" style="width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; background: var(--rgl) !important;">
                            <i class="fas fa-shield-alt" style="color: var(--rp);"></i>
                        </div>
                        <h2 class="serif-font fw-bold mb-2">Check Your Inbox</h2>
                        <p class="text-muted small">We've sent a 6-digit code to <br><strong id="fEmailDisplay" class="text-dark"></strong></p>
                    </div>

                    <div class="otp-digit-group">
                        <input type="text" maxlength="1" class="f-otp-input">
                        <input type="text" maxlength="1" class="f-otp-input">
                        <input type="text" maxlength="1" class="f-otp-input">
                        <input type="text" maxlength="1" class="f-otp-input">
                        <input type="text" maxlength="1" class="f-otp-input">
                        <input type="text" maxlength="1" class="f-otp-input">
                    </div>
                    <input type="hidden" id="f_otp">

                    <button class="btn btn-login-submit mt-2 py-3 rounded-4 shadow-sm" id="fVerifyOtpBtn" style="height: 58px; width: 100%;">
                        Verify & Continue <i class="fas fa-check-double ms-2"></i>
                    </button>

                    <div class="text-center mt-4 pt-2">
                        <p class="text-muted small mb-1">Didn't receive the code?</p>
                        <a href="javascript:void(0)" class="text-maroon fw-bold small text-decoration-none" id="fResendOtp">
                            <i class="fas fa-redo-alt me-1"></i> Resend Now
                        </a>
                    </div>
                </div>

                <!-- Step 3: New Password Input -->
                <div id="fStep3" style="display: none;">
                    <div class="text-center mb-4">
                        <div class="icon-circle bg-light text-success mx-auto mb-3" style="width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; background: rgba(16, 185, 129, 0.1) !important;">
                            <i class="fas fa-lock-open" style="color: #10b981;"></i>
                        </div>
                        <h2 class="serif-font fw-bold mb-2">New Password</h2>
                        <p class="text-muted small">Set your new secure password.</p>
                    </div>

                    <div class="field-group mb-3">
                        <label class="small fw-bold text-uppercase ls-1">New Password</label>
                        <div class="field-wrap">
                            <input type="password" id="fNewPass" placeholder="••••••••" class="form-control" style="height: 54px; border-radius: 14px; padding-left: 50px;">
                            <i class="fas fa-shield-halved field-icon"></i>
                        </div>
                    </div>
                    <div class="field-group mb-4">
                        <label class="small fw-bold text-uppercase ls-1">Confirm New Password</label>
                        <div class="field-wrap">
                            <input type="password" id="fConfirmPass" placeholder="••••••••" class="form-control" style="height: 54px; border-radius: 14px; padding-left: 50px;">
                            <i class="fas fa-check-circle field-icon"></i>
                        </div>
                    </div>
                    <button class="btn btn-login-submit mt-2 py-3 rounded-4 shadow-sm" id="fResetPassBtn" style="height: 58px; width: 100%;">
                        Update & Login <i class="fas fa-lock ms-2"></i>
                    </button>
                </div>
            </div>

            <!-- Trust Badges -->
            <div class="trust-badges">
                <div class="trust-badge">
                    <i class="fas fa-shield-alt"></i>
                    Secure Login
                </div>
                <div class="trust-badge gold">
                    <i class="fas fa-user-check"></i>
                    Verified Profiles
                </div>
                <div class="trust-badge">
                    <i class="fas fa-lock"></i>
                    Privacy Safe
                </div>
            </div>

        </div>
    </div>

</div>

<!-- Removed Forgot Password Modal as it is now embedded -->

<script>
function togglePassword() {
    const input = document.getElementById('password');
    const icon = document.getElementById('eyeIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

// Add loading state on submit
document.getElementById('loginForm').addEventListener('submit', function() {
    const btn = document.getElementById('loginBtn');
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Signing In...';
    btn.style.opacity = '0.85';
    btn.disabled = true;
});

/* ---- Page Forgot Password Flow ---- */
const showForgot = document.getElementById('showForgotFlow');
const backToLogin = document.getElementById('backToLoginCard');
const loginForm = document.getElementById('loginForm');
const forgotFlow = document.getElementById('pageForgotFlow');
const formHeader = document.querySelector('.form-header');

if (showForgot) {
    showForgot.onclick = function() {
        loginForm.style.display = 'none';
        formHeader.style.display = 'none';
        forgotFlow.style.display = 'block';
    };
}

if (backToLogin) {
    backToLogin.onclick = function() {
        loginForm.style.display = 'block';
        formHeader.style.display = 'block';
        forgotFlow.style.display = 'none';
    };
}

const fSendOtpBtn = document.getElementById('fSendOtpBtn');
const fVerifyOtpBtn = document.getElementById('fVerifyOtpBtn');
const fResetPassBtn = document.getElementById('fResetPassBtn');

fSendOtpBtn.onclick = async function() {
    const email = document.getElementById('f_email').value;
    if(!email) return Swal.fire('Error', 'Please enter your email', 'error');

    fSendOtpBtn.disabled = true;
    fSendOtpBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending Code...';

    try {
        const resp = await fetch('{{ url("/forgot-password") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ email })
        });
        const data = await resp.json();
        fSendOtpBtn.disabled = false;
        fSendOtpBtn.innerHTML = 'Send Verification Code <i class="fas fa-long-arrow-right ms-2 mt-1"></i>';

        if(data.success) {
            document.getElementById('fEmailDisplay').textContent = email;
            document.getElementById('fStep1').style.display = 'none';
            document.getElementById('fStep2').style.display = 'block';
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    } catch(e) {
        fSendOtpBtn.disabled = false;
        fSendOtpBtn.innerHTML = 'Send Verification Code <i class="fas fa-long-arrow-right ms-2 mt-1"></i>';
        Swal.fire('Error', 'Connection failed. Please check your internet.', 'error');
    }
}

fVerifyOtpBtn.onclick = async function() {
    const otp = document.getElementById('f_otp').value;
    if(otp.length < 6) return Swal.fire('Error', 'Enter the 6-digit OTP', 'error');

    fVerifyOtpBtn.disabled = true;
    try {
        const resp = await fetch('{{ url("/verify-reset-otp") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ otp })
        });
        const data = await resp.json();
        fVerifyOtpBtn.disabled = false;

        if(data.success) {
            document.getElementById('fStep2').style.display = 'none';
            document.getElementById('fStep3').style.display = 'block';
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    } catch(e) {
        fVerifyOtpBtn.disabled = false;
        Swal.fire('Error', 'Connection failed.', 'error');
    }
}

fResetPassBtn.onclick = async function() {
    const password = document.getElementById('fNewPass').value;
    const confirm = document.getElementById('fConfirmPass').value;

    if(password.length < 6) return Swal.fire('Error', 'Password must be at least 6 characters', 'error');
    if(password !== confirm) return Swal.fire('Error', 'Passwords do not match', 'error');

    fResetPassBtn.disabled = true;
    try {
        const resp = await fetch('{{ url("/reset-password") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ password, password_confirmation: confirm })
        });
        const data = await resp.json();
        fResetPassBtn.disabled = false;

        if(data.success) {
            Swal.fire('Success', data.message, 'success').then(() => {
                location.reload();
            });
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    } catch(e) {
        fResetPassBtn.disabled = false;
        Swal.fire('Error', 'Connection failed.', 'error');
    }
}

document.getElementById('fResendOtp').onclick = () => fSendOtpBtn.onclick();

// OTP Auto-tabbing Logic
const fOtpInputs = document.querySelectorAll('.f-otp-input');
fOtpInputs.forEach((input, index) => {
    input.onkeyup = (e) => {
        if (e.key >= 0 && e.key <= 9) {
            if (index < fOtpInputs.length - 1) fOtpInputs[index + 1].focus();
        } else if (e.key === 'Backspace' && index > 0) {
            fOtpInputs[index - 1].focus();
        }
        let fullOtp = "";
        fOtpInputs.forEach(inp => fullOtp += inp.value);
        document.getElementById('f_otp').value = fullOtp;
    };
    input.addEventListener('input', (e) => {
        e.target.value = e.target.value.replace(/[^0-9]/g, '');
    });
});
</script>

@endsection
