<!-- Step 5: Education & Profession -->
<div class="form-step hidden" id="step-5">
    <div class="registration-header">
        <h1>Education & Career</h1>
        <p class="sub-heading">Professional information adds credibility to your profile.</p>
    </div>

    <div class="form-section">
        <div class="input-group">
            <label for="education">Highest Education<span class="required-asterisk">*</span></label>
            <select id="education" name="education" class="form-select custom-select" required>
                <option value="">Select Highest Education</option>
            </select>
            <i class="fa-solid fa-graduation-cap input-icon"></i>
            <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
            @error('education')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
        </div>

        <div class="input-group">
            <label for="college">College / Institution<span class="required-asterisk">*</span></label>
            <input type="text" id="college" name="college" placeholder="Enter college name" required>
            <i class="fa-solid fa-school-flag input-icon"></i>
            <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
            @error('college')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="input-group">
                    <label for="employment">Employment Type<span class="required-asterisk">*</span></label>
                    <select id="employment" name="employment_type" class="form-select custom-select" required>
                        <option value="1">Private Sector</option>
                        <option value="2">Government Sector</option>
                        <option value="3">Self Employed / Business</option>
                        <option value="0">Not Working</option>
                    </select>
                    <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
                    @error('employment_type')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <label for="jobCategory">Job Category<span class="required-asterisk">*</span></label>
                    <select id="jobCategory" name="job_category" class="form-select custom-select" required>
                        <option value="">Select Category</option>
                    </select>
                    <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
                    @error('job_category')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="input-group">
            <label for="occupation">Occupation Detail<span class="required-asterisk">*</span></label>
            <input type="text" id="occupation" name="occupation" placeholder="e.g. Senior Software Engineer" required>
            <i class="fa-solid fa-briefcase input-icon"></i>
            <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
            @error('occupation')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
        </div>

        <div class="input-group">
            <label for="income">Annual Income<span class="required-asterisk">*</span></label>
            <select id="income" name="annual_income" class="form-select custom-select" required>
                <option value="">Select Annual Income</option>
            </select>
            <i class="fa-solid fa-wallet input-icon"></i>
            <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
            @error('annual_income')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
        </div>

        <div class="input-group">
            <label for="workLocation">Work Location<span class="required-asterisk">*</span></label>
            <input type="text" id="workLocation" name="work_location" placeholder="City where you work" required>
            <i class="fa-solid fa-location-dot input-icon"></i>
            <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
            @error('work_location')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
        </div>

        <div class="checkbox-group mb-3">
            <label class="custom-checkbox">
                <input type="checkbox" name="notifications" checked>
                <span class="checkmark"></span>
                <span class="label-text">Notify me when matching profiles are available</span>
            </label>
        </div>

        <div class="form-actions-row">
            <button type="button" class="btn-outline-reg prev-step" data-prev="4">Back</button>
            <button type="button" class="btn-submit-reg next-step flex-grow-1" data-next="6">
                Next <i class="fa-solid fa-arrow-right-long"></i>
            </button>
        </div>
    </div>
</div>
