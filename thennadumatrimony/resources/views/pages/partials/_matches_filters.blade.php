<form action="{{ route('matches') }}" method="GET">
    <div class="info-card p-4 shadow-sm border-0 bg-white rounded-4">
        <h5 class="serif-font mb-4 text-maroon border-bottom pb-2">Refine Matches</h5>
        
        <div class="filter-group mb-4">
            <label class="small fw-bold mb-2 text-dark">Match Intensity</label>
            <select class="form-select form-select-sm rounded-pill px-3" name="intensity" onchange="this.form.submit()">
                <option value="50" {{ request('intensity') == '50' ? 'selected' : '' }}>All Matches (50%+)</option>
                <option value="85" {{ request('intensity') == '85' ? 'selected' : '' }}>High Accuracy (85%+)</option>
                <option value="95" {{ request('intensity') == '95' ? 'selected' : '' }}>Perfect Hits (95%+)</option>
            </select>
        </div>

        <div class="filter-group mb-4">
            <label class="small fw-bold mb-4 text-dark">Premium Options</label>
            <div class="form-check small mb-2 d-flex align-items-center gap-2 border p-2 rounded-3 bg-light-soft border-gold" style="cursor: pointer;">
                <input class="form-check-input mt-0" type="checkbox" name="include_horoscope" value="1" id="horoMatch" {{ request('include_horoscope') == '1' ? 'checked' : '' }} onchange="this.form.submit()">
                <label class="form-check-label fw-bold text-maroon mb-0" for="horoMatch" style="cursor: pointer;">
                    <i class="fas fa-star text-gold me-1"></i> Horoscope Match <span class="badge bg-gold text-white ms-1">+15%</span>
                </label>
            </div>
            <div class="form-check small mt-3">
                <input class="form-check-input" type="checkbox" name="has_photos" value="1" id="f1" {{ request('has_photos') ? 'checked' : '' }} onchange="this.form.submit()">
                <label class="form-check-label" for="f1">Has Photos</label>
            </div>
            <div class="form-check small">
                <input class="form-check-input" type="checkbox" name="is_verified" value="1" id="f2" {{ request('is_verified') ? 'checked' : '' }} onchange="this.form.submit()">
                <label class="form-check-label" for="f2">Verified Profiles</label>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-maroon w-100 rounded-pill py-2 small fw-bold shadow-sm">Apply Filters</button>
            <a href="{{ route('dashboard') }}" class="d-block mt-3 small text-muted text-decoration-none">Update Partner Preferences <i class="fas fa-chevron-right ms-1" style="font-size: 8px;"></i></a>
        </div>
    </div>
</form>

<div class="premium-upgrade-card mt-4 p-4 text-center rounded-4 bg-light-gold border border-gold shadow-sm">
    <div class="icon-circle-gold mb-3 mx-auto">
        <i class="fas fa-crown text-gold h4 mb-0"></i>
    </div>
    <h6 class="serif-font mb-2">Unlock Contact Details</h6>
    <p class="xx-small text-muted mb-3">Get direct access to phone numbers and addresses.</p>
    <button class="btn btn-gold btn-sm rounded-pill w-100 text-white fw-bold shadow-sm">Upgrade Now</button>
</div>

<style>
.bg-light-gold { background: linear-gradient(135deg, #fff9eb 0%, #fff2d1 100%); }
.icon-circle-gold {
    width: 50px;
    height: 50px;
    background: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 10px rgba(212, 175, 55, 0.2);
}
</style>
