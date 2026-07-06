<!-- Step 6: Profile Verification & Photos -->
<div class="form-step hidden" id="step-verification">
    <div class="registration-header">
        <h1>Verify & Complete Your Profile</h1>
        <p class="sub-heading">Add a photo and tell us your interests to find better matches.</p>
    </div>

    <div class="form-section">

        <div class="row g-4">
            <!-- Photo Upload Area -->
            <div class="col-md-12">
                <div class="section-card">
                    <h3 class="section-title"><i class="fa-regular fa-image"></i> Profile Photo<span class="required-asterisk">*</span></h3>
                    <p class="section-desc">Profiles with photos receive 10x more responses.</p>
                    <div class="photo-upload-container">
                        <div class="photo-upload-area" id="photoDropZone">
                            <div class="photo-preview-wrap" id="photoPreviewWrap">
                                <img id="photoPreview" src="" alt="Preview" style="display:none;">
                                <div class="photo-placeholder" id="photoPlaceholder">
                                    <div class="upload-icon-circle">
                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                    </div>
                                    <p>Drop your photo here or <span class="upload-link">browse</span></p>
                                    <small>High quality JPG/PNG recommended</small>
                                </div>
                            </div>
                            <input type="file" id="photoInput" name="profile_photo" accept="image/*" required hidden>
                        </div>
                        <div class="field-error" id="photoError" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text">Profile Photo is required</span></div>
                    </div>
                    @error('profile_photo')<div class="field-error" style="margin-top:8px;"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
                </div>
            </div>

            <!-- Verification & Selfie -->
            <div class="col-md-12">
                <div class="section-card">
                    <h3 class="section-title"><i class="fa-solid fa-shield-check"></i> Identity Verification</h3>
                    <p class="section-desc">Take a live selfie to get a <span class="verified-badge-premium">Verified Account</span> status.</p>
                    
                    <div class="verification-box">
                        <div class="camera-area" id="cameraArea" style="display:none;">
                            <video id="cameraVideoFeed" autoplay playsinline></video>
                            <div class="camera-overlay"></div>
                            <button type="button" class="btn-capture-premium" id="captureBtn">
                                <span class="capture-inner"></span>
                            </button>
                            <canvas id="snapCanvas" hidden></canvas>
                        </div>
                        
                        <div class="selfie-result-wrap">
                            <img id="selfiePreview" src="" alt="Selfie" style="display:none;">
                            <input type="hidden" name="selfie_image" id="selfieImageHidden">
                        </div>

                        <div id="cameraStartPlaceholder" class="camera-placeholder">
                            <i class="fa-solid fa-face-smile-wink"></i>
                            <div class="d-flex flex-column gap-3 align-items-center">
                                <button type="button" class="btn-outline-premium" id="startCameraBtn">
                                    <i class="fa-solid fa-video"></i> Start Verification
                                </button>
                                <button type="button" class="btn btn-link text-muted text-decoration-none small" id="skipSelfieBtn">
                                    <i class="fa-solid fa-forward"></i> Skip for now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== Interests ===== -->
        <div class="section-card">
            <h3 class="section-title"><i class="fa-solid fa-heart-pulse"></i> Interests & Hobbies</h3>
            <p class="section-desc">Select all that apply. This helps us personalise your experience.</p>
            <div class="interests-chips">
                <div class="chip" data-value="sports"><i class="fa-solid fa-football"></i> Sports</div>
                <div class="chip" data-value="reading"><i class="fa-solid fa-book-open"></i> Reading</div>
                <div class="chip" data-value="music"><i class="fa-solid fa-music"></i> Music</div>
                <div class="chip" data-value="traveling"><i class="fa-solid fa-plane"></i> Traveling</div>
                <div class="chip" data-value="cooking"><i class="fa-solid fa-utensils"></i> Cooking</div>
                <div class="chip" data-value="movies"><i class="fa-solid fa-film"></i> Movies</div>
                <div class="chip" data-value="fitness"><i class="fa-solid fa-dumbbell"></i> Fitness</div>
                <div class="chip" data-value="photography"><i class="fa-solid fa-camera"></i> Photography</div>
                <div class="chip" data-value="gaming"><i class="fa-solid fa-gamepad"></i> Gaming</div>
                <div class="chip" data-value="gardening"><i class="fa-solid fa-seedling"></i> Gardening</div>
                <div class="chip" data-value="yoga"><i class="fa-solid fa-spa"></i> Yoga</div>
                <div class="chip" data-value="art"><i class="fa-solid fa-palette"></i> Art</div>
            </div>
            <!-- Hidden input to store selected interests -->
            <input type="hidden" name="interests" id="interestsHidden">
        </div>

        <div class="section-card mb-4">
            <h3 class="section-title"><i class="fa-solid fa-shield-halved"></i> Account Security</h3>
            <p class="section-desc">Create a strong password to secure your Matrimony account credentials.</p>
            <div class="input-group">
                <label for="password">Create Password<span class="required-asterisk">*</span></label>
                <input type="password" id="password" name="password" placeholder="Create a strong password" required>
                <i class="fa-solid fa-lock input-icon"></i>
                <div class="field-error" id="passwordError" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
                @error('password')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-actions-row">
            <button type="button" class="btn-outline-premium prev-step" data-prev="5">Back</button>
            <button type="submit" class="btn-primary-premium flex-grow-1">
                Complete Registration <i class="fa-solid fa-heart"></i>
            </button>
        </div>

        <div class="reg-trust-text mt-3">
            <i class="fa-solid fa-shield-halved"></i> Your information is 100% secure and private.
        </div>

    </div>
</div>
