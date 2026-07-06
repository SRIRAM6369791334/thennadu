<!-- Step 3: Basic Profile Details -->
<div class="form-step hidden" id="step-3">
    <div class="registration-header">
        <h1>Basic Details</h1>
        <p class="sub-heading">Help us find the right matches by providing a few basic details.</p>
    </div>

    <div class="form-section">
        <div class="input-group">
            <label for="dob">Date of Birth<span class="required-asterisk">*</span></label>
            <input type="date" id="dob" name="dob" required>
            <i class="fa-regular fa-calendar input-icon"></i>
            <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
            @error('dob')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
        </div>

        <div class="input-group">
            <label for="gender">Gender<span class="required-asterisk">*</span></label>
            <select id="gender" name="gender" class="form-select custom-select" required>
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
            <i class="fa-solid fa-venus-mars input-icon"></i>
            <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
            @error('gender')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
        </div>

        <div class="input-group">
            <label for="height">Height<span class="required-asterisk">*</span></label>
            <select id="height" name="height" class="form-select custom-select" required>
                <option value="">Select Height</option>
            </select>
            <i class="fa-solid fa-ruler-vertical input-icon"></i>
            <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
            @error('height')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
        </div>

        <div class="input-group">
            <label for="physicalStatus">Physical Status<span class="required-asterisk">*</span></label>
            <select id="physicalStatus" name="physical_status" class="form-select custom-select" required>
                <option value="1">Normal</option>
                <option value="2">Physically Challenged</option>
            </select>
            <i class="fa-solid fa-child-reaching input-icon"></i>
            <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
            @error('physical_status')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
        </div>

        <div class="input-group">
            <label for="maritalStatus">Marital Status<span class="required-asterisk">*</span></label>
            <select id="maritalStatus" name="marital_status" class="form-select custom-select" required>
                <option value="">Select Marital Status</option>
            </select>
            <i class="fa-solid fa-rings-wedding input-icon"></i>
            <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
            @error('marital_status')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="input-group">
                    <label for="bodyType">Body Type<span class="required-asterisk">*</span></label>
                    <select id="bodyType" name="body_type" class="form-select custom-select" required>
                        <option value="">Select</option>
                    </select>
                    <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
                    @error('body_type')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <label for="complexion">Complexion<span class="required-asterisk">*</span></label>
                    <select id="complexion" name="complexion" class="form-select custom-select" required>
                        <option value="">Select</option>
                    </select>
                    <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
                    @error('complexion')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="input-group">
            <label for="bloodGroup">Blood Group</label>
            <select id="bloodGroup" name="blood_group" class="form-select custom-select">
                <option value="">Select Blood Group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
            </select>
            <i class="fa-solid fa-droplet input-icon"></i>
            <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
            @error('blood_group')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
        </div>

        <div class="input-group">
            <label for="eatingHabit">Eating Habit<span class="required-asterisk">*</span></label>
            <select id="eatingHabit" name="eating_habit" class="form-select custom-select" required>
                <option value="">Select Eating Habit</option>
                <option value="Vegetarian">Vegetarian</option>
                <option value="Non-Vegetarian">Non-Vegetarian</option>
                <option value="Eggetarian">Eggetarian</option>
                <option value="Vegan">Vegan</option>
            </select>
            <i class="fa-solid fa-utensils input-icon"></i>
            <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
            @error('eating_habit')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
        </div>

        <div class="form-actions-row">
            <button type="button" class="btn-outline-reg prev-step" data-prev="2">Back</button>
            <button type="button" class="btn-submit-reg next-step flex-grow-1" data-next="4">
                Next <i class="fa-solid fa-arrow-right-long"></i>
            </button>
        </div>
    </div>
</div>
