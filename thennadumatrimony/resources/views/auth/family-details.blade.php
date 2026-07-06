<!-- Step: Family Details -->
<div class="form-step hidden" id="step-6">
    <div class="registration-header">
        <h1>Family Background</h1>
        <p class="sub-heading">Tell us about your family roots and siblings.</p>
    </div>

    <div class="form-section">
        <div class="row g-3">
            <div class="col-md-6">
                <div class="input-group">
                    <label for="fatherName">Father's Name<span class="required-asterisk">*</span></label>
                    <input type="text" id="fatherName" name="father_name" placeholder="Enter name" required>
                    <i class="fa-solid fa-user-tie input-icon"></i>
                    <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
                    @error('father_name')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <label for="fatherJob">Father's Occupation<span class="required-asterisk">*</span></label>
                    <input type="text" id="fatherJob" name="father_occuption" placeholder="Occupation" required>
                    <i class="fa-solid fa-briefcase input-icon"></i>
                    <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
                    @error('father_occuption')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="input-group">
                    <label for="motherName">Mother's Name<span class="required-asterisk">*</span></label>
                    <input type="text" id="motherName" name="mother_name" placeholder="Enter name" required>
                    <i class="fa-solid fa-user-nurse input-icon"></i>
                    <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
                    @error('mother_name')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <label for="motherJob">Mother's Occupation<span class="required-asterisk">*</span></label>
                    <input type="text" id="motherJob" name="mother_occuption" placeholder="Occupation" required>
                    <i class="fa-solid fa-briefcase input-icon"></i>
                    <div class="field-error" style="display:none;"><i class="fa-solid fa-circle-exclamation"></i><span class="error-text"></span></div>
                    @error('mother_occuption')<div class="field-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <hr class="form-divider">
        <h3 class="section-title"><i class="fa-solid fa-people-group"></i> Siblings Details</h3>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="input-group">
                    <label for="totalSiblings">Total Siblings</label>
                    <input type="number" id="totalSiblings" name="total_sibblings" value="0" min="0">
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <label for="elderSister">Elder Sisters</label>
                    <input type="number" id="elderSister" name="elder_sister" value="0" min="0">
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="input-group">
                    <label for="youngerSister">Younger Sisters</label>
                    <input type="number" id="youngerSister" name="younger_sister" value="0" min="0">
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <label for="elderBrother">Elder Brothers</label>
                    <input type="number" id="elderBrother" name="elder_brother" value="0" min="0">
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="input-group">
                    <label for="youngerBrother">Younger Brothers</label>
                    <input type="number" id="youngerBrother" name="younger_brother" value="0" min="0">
                </div>
            </div>
        </div>

        <div class="form-actions-row">
            <button type="button" class="btn-outline-reg prev-step" data-prev="5">Back</button>
            <button type="button" class="btn-submit-reg next-step flex-grow-1" data-next="verification">
                Next <i class="fa-solid fa-arrow-right-long"></i>
            </button>
        </div>
    </div>
</div>
