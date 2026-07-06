<!-- Step 2: OTP Verification -->
<div class="form-step hidden" id="step-2">
    <div class="registration-header text-center">
        <div class="otp-icon-wrap mb-4">
            <div class="icon-circle">
                <i class="fa-solid fa-envelope-circle-check"></i>
            </div>
        </div>
        <h1>Verify Your Email</h1>
        <p class="sub-heading">We've sent a 6-digit verification code to your email.</p>
        <div class="target-email-display mt-2">
            <span id="displayEmail">user@example.com</span>
            <a href="javascript:void(0)" class="prev-step edit-email-link" data-prev="1">
                <i class="fa-solid fa-pen-to-square"></i> Edit
            </a>
        </div>
    </div>

    <div class="otp-container">
        <div class="otp-inputs">
            <input type="text" maxlength="1" class="otp-field" id="otp-1" inputmode="numeric">
            <input type="text" maxlength="1" class="otp-field" id="otp-2" inputmode="numeric">
            <input type="text" maxlength="1" class="otp-field" id="otp-3" inputmode="numeric">
            <input type="text" maxlength="1" class="otp-field" id="otp-4" inputmode="numeric">
            <input type="text" maxlength="1" class="otp-field" id="otp-5" inputmode="numeric">
            <input type="text" maxlength="1" class="otp-field" id="otp-6" inputmode="numeric">
        </div>
        
        <div class="resend-wrapper mb-4">
            <p class="resend-text text-muted mb-2">Didn't receive the code?</p>
            <div class="timer-box" id="timerBox">
                <i class="fa-regular fa-clock me-1"></i> Resend in <span id="countdown" class="fw-bold">00:30</span>
            </div>
            <button type="button" class="btn-resend-otp" id="resendBtn" disabled>
                <i class="fa-solid fa-rotate-right"></i> Resend OTP
            </button>
        </div>

        <div class="form-actions-row">
            <button type="button" class="btn-outline-premium prev-step" data-prev="1">
                <i class="fa-solid fa-arrow-left"></i> Back
            </button>
            <button type="button" class="btn-primary-premium flex-grow-1 next-step" data-next="3">
                Verify & Continue <i class="fa-solid fa-circle-check"></i>
            </button>
        </div>
    </div>
</div>

<style>
.otp-icon-wrap {
    display: flex;
    justify-content: center;
}
.icon-circle {
    width: 80px;
    height: 80px;
    background: var(--rgl);
    color: var(--rp);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.22rem;
    box-shadow: 0 10px 25px rgba(144, 12, 63, 0.1);
}
.target-email-display {
    background: #f8f9fa;
    padding: 8px 16px;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-weight: 600;
    color: var(--rt);
    border: 1px solid #eee;
}
.edit-email-link {
    color: var(--rp);
    font-size: 0.85rem;
    text-decoration: none;
    transition: var(--tr);
}
.edit-email-link:hover {
    color: var(--rpl);
    text-decoration: underline;
}
.timer-box {
    font-size: 0.9rem;
    color: var(--rm);
    display: block;
}
.btn-resend-otp {
    background: none;
    border: none;
    color: var(--rp);
    font-weight: 700;
    font-size: 1rem;
    cursor: pointer;
    display: none; /* Hidden while timer is active */
    margin: 0 auto;
    transition: var(--tr);
}
.btn-resend-otp:disabled {
    color: #ccc;
    cursor: default;
}
.btn-resend-otp:not(:disabled):hover {
    color: var(--rpl);
    transform: scale(1.05);
}
</style>
