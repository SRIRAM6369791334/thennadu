<!-- Step 4: Religion & Location -->
<div class="form-step hidden" id="step-4">
    <div class="registration-header">
        <h1>Religion & Community</h1>
        <p class="sub-heading">Your religious and cultural details help us refine your partner search.</p>
    </div>

    <div class="form-section">
        <div class="input-group">
            <label for="religion">Religion<span class="required-asterisk">*</span></label>
            <select id="religion" name="religion" class="form-select custom-select" required>
                <option value="">Select Religion</option>
            </select>
            <i class="fa-solid fa-om input-icon"></i>
            <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
            @error('religion')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
        </div>

        <div class="input-group">
            <label for="caste">Caste<span class="required-asterisk">*</span></label>
            <select id="caste" name="caste" class="form-select custom-select" required>
                <option value="">Select Caste</option>
            </select>
            <i class="fa-solid fa-users-rays input-icon"></i>
            <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
            @error('caste')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
        </div>

        <div class="input-group">
            <label for="subCaste">Sub Caste<span class="required-asterisk">*</span></label>
            <select id="subCaste" name="sub_caste" class="form-select custom-select" required>
                <option value="">Select Sub Caste</option>
            </select>
            <i class="fa-solid fa-users-viewfinder input-icon"></i>
            <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
            @error('sub_caste')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
        </div>

        <div class="input-group">
            <label for="motherTongue">Mother Tongue<span class="required-asterisk">*</span></label>
            <select id="motherTongue" name="mother_tongue" class="form-select custom-select" required>
                <option value="">Select Mother Tongue</option>
                <option value="Tamil">Tamil</option>
                <option value="Telugu">Telugu</option>
                <option value="Malayalam">Malayalam</option>
                <option value="Kannada">Kannada</option>
                <option value="Hindi">Hindi</option>
                <option value="English">English</option>
            </select>
            <i class="fa-solid fa-language input-icon"></i>
            <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
            @error('mother_tongue')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
        </div>

        <hr class="form-divider">
        <h3 class="section-title">Horoscope Details</h3>

        <div class="input-group">
            <label for="timeOfBirth">Time of Birth<span class="required-asterisk">*</span></label>
            <input type="time" id="timeOfBirth" name="birth_time" required>
            <i class="fa-regular fa-clock input-icon"></i>
            <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
            @error('birth_time')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="input-group">
                    <label for="rasi">Rasi<span class="required-asterisk">*</span></label>
                    <select id="rasi" name="rasi" class="form-select custom-select" required>
                        <option value="">Select Rasi</option>
                    </select>
                    <i class="fa-solid fa-moon input-icon"></i>
                    <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
                    @error('rasi')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <label for="laknam">Laknam<span class="required-asterisk">*</span></label>
                    <select id="laknam" name="laknam" class="form-select custom-select" required>
                        <option value="">Select Laknam</option>
                    </select>
                    <i class="fa-solid fa-sun input-icon"></i>
                    <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
                    @error('laknam')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="row g-3 mt-1">
            <div class="col-md-6">
                <div class="input-group">
                    <label for="star">Star (Nakshatra)<span class="required-asterisk">*</span></label>
                    <select id="star" name="star" class="form-select custom-select" required>
                        <option value="">Select Star</option>
                    </select>
                    <i class="fa-solid fa-star input-icon"></i>
                    <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
                    @error('star')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <label for="dosam">Dosam</label>
                    <select id="dosam" name="dosam" class="form-select custom-select">
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                        <option value="Don't Know">Don't Know</option>
                    </select>
                    <i class="fa-solid fa-triangle-exclamation input-icon"></i>
                </div>
            </div>
        </div>

        <div class="input-group mt-3">
            <label for="horoscopeFile">Upload Horoscope (PDF or Image)</label>
            <input type="file" id="horoscopeFile" name="horoscope_file" accept=".pdf,image/*" style="padding-left: 15px;">
        </div>

        <hr class="form-divider">
        <h3 class="section-title">Location Details</h3>

        <div class="input-group">
            <label for="country">Country<span class="required-asterisk">*</span></label>
            <select id="country" name="country" class="form-select custom-select" required>
                <option value="101">India</option>
            </select>
            <i class="fa-solid fa-globe input-icon"></i>
            <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
            @error('country')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="input-group">
                    <label for="state">State<span class="required-asterisk">*</span></label>
                    <input type="text" id="state" name="state" placeholder="State" required>
                    <i class="fa-solid fa-map-location-dot input-icon"></i>
                    <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
                    @error('state')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <label for="city">City<span class="required-asterisk">*</span></label>
                    <input type="text" id="city" name="city" placeholder="City" required>
                    <i class="fa-solid fa-city input-icon"></i>
                    <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
                    @error('city')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="form-actions-row">
            <button type="button" class="btn-outline-reg prev-step" data-prev="3">Back</button>
            <button type="button" class="btn-submit-reg next-step flex-grow-1" data-next="5">
                Next <i class="fa-solid fa-arrow-right-long"></i>
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rasiSelect = document.getElementById('rasi');
        const starSelect = document.getElementById('star');

        if (rasiSelect && starSelect) {
            rasiSelect.addEventListener('change', function() {
                const rasiId = this.value;
                if (!rasiId) {
                    starSelect.innerHTML = '<option value="">Select Star</option>';
                    return;
                }

                // Using the API we created for horoscope matching to fetch stars
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
        }
    });
</script>
