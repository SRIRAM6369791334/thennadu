<!-- Step 1: Profile Creator Selection -->
<div class="form-step active" id="step-1">
    <div class="registration-header">
        <h1>Create Matrimony Profile</h1>
        <p class="sub-heading">Who are you creating this profile for?</p>
    </div>

    <div class="profile-options">
        <label class="option-card">
            <input type="radio" name="profile_for" value="self" checked>
            <div class="option-content">
                <i class="fa-regular fa-user option-icon"></i>
                <div class="option-label">Self</div>
            </div>
        </label>
        <label class="option-card">
            <input type="radio" name="profile_for" value="daughter">
            <div class="option-content">
                <i class="fa-solid fa-person-dress option-icon"></i>
                <div class="option-label">Daughter</div>
            </div>
        </label>
        <label class="option-card">
            <input type="radio" name="profile_for" value="son">
            <div class="option-content">
                <i class="fa-solid fa-person option-icon"></i>
                <div class="option-label">Son</div>
            </div>
        </label>
        <label class="option-card">
            <input type="radio" name="profile_for" value="sister">
            <div class="option-content">
                <i class="fa-solid fa-person-dress option-icon"></i>
                <div class="option-label">Sister</div>
            </div>
        </label>
        <label class="option-card">
            <input type="radio" name="profile_for" value="brother">
            <div class="option-content">
                <i class="fa-solid fa-person option-icon"></i>
                <div class="option-label">Brother</div>
            </div>
        </label>
        <label class="option-card">
            <input type="radio" name="profile_for" value="friend">
            <div class="option-content">
                <i class="fa-solid fa-user-group option-icon"></i>
                <div class="option-label">Friend</div>
            </div>
        </label>
        <label class="option-card">
            <input type="radio" name="profile_for" value="relative">
            <div class="option-content">
                <i class="fa-solid fa-users option-icon"></i>
                <div class="option-label">Relative</div>
            </div>
        </label>
    </div>

    <div class="form-section">
        <div class="input-group">
            <label for="fullName">Full Name<span class="required-asterisk">*</span></label>
            <input type="text" id="fullName" name="full_name" placeholder="Enter full name" required>
            <i class="fa-regular fa-id-badge input-icon"></i>
            <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
            @error('full_name')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
        </div>
        
        <div class="input-group">
            <label for="mobile">Mobile Number<span class="required-asterisk">*</span></label>
            <input type="tel" id="mobile" name="mobile" placeholder="Enter mobile number" required>
            <i class="fa-solid fa-mobile-screen-button input-icon"></i>
            <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
            @error('mobile')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
        </div>

        <div class="input-group">
            <label for="email">Email Address<span class="required-asterisk">*</span></label>
            <input type="email" id="email" name="email" placeholder="Enter email address" required>
            <i class="fa-regular fa-envelope input-icon"></i>
            <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
            @error('email')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
        </div>

        <button type="button" class="btn-submit-reg next-step" data-next="2">
            Continue <i class="fa-solid fa-arrow-right-long"></i>
        </button>
    </div>

    <div class="reg-footer-elements">
        <div class="reg-trust-text">
            <i class="fa-solid fa-shield-circle-check"></i> 
            Your information is encrypted & 100% secure
        </div>
        <div class="login-invitation">
            Already have an account? 
            <a href="javascript:void(0)" class="open-login-modal">Login Here</a>
        </div>
    </div>
</div>
