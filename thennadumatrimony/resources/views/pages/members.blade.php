@extends('layout.default')

@section('content')
<div class="profile-main-container">
    <div class="container">
        <!-- 🔥 4. Trust Indicators Above Results -->
        <div class="trust-indicators-bar wow fadeIn">
            <div class="trust-bar-item"><i class="fas fa-check-circle"></i> Verified Profiles</div>
            <div class="trust-bar-item"><i class="fas fa-lock"></i> 100% Privacy</div>
            <div class="trust-bar-item"><i class="fas fa-users"></i> Family Assisted Matches</div>
        </div>

        <div class="row">
            <!-- 🔥 2. Advanced Filter Sidebar (Left Side) -->
            <div class="col-lg-3">
                <div class="filter-sidebar">
                    <div class="info-card p-4">
                        <h5 class="serif-font mb-4">Refine Search</h5>
                        <div class="accordion filter-accordion" id="filterAccordion">
                            <!-- Quick Search by ID -->
                            <div class="mb-4">
                                <label class="small fw-bold mb-2">Profile ID Search</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="E.g. TM1234">
                                    <button class="btn btn-interest" type="button"><i class="fas fa-search"></i></button>
                                </div>
                            </div>

                            <!-- Gender -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGender">
                                        Gender
                                    </button>
                                </h2>
                                <div id="collapseGender" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="g1"><label class="form-check-label" for="g1">Bride</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" id="g2"><label class="form-check-label" for="g2">Groom</label></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Age Range -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAge">
                                        Age Range
                                    </button>
                                </h2>
                                <div id="collapseAge" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="d-flex align-items-center gap-2">
                                            <select class="form-select form-select-sm"><option>21</option></select>
                                            <span>to</span>
                                            <select class="form-select form-select-sm"><option>32</option></select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Religion -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseReligion">
                                        Religion
                                    </button>
                                </h2>
                                <div id="collapseReligion" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="filter-checkbox-list">
                                            <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="r1"><label class="form-check-label" for="r1">Hindu</label></div>
                                            <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="r2"><label class="form-check-label" for="r2">Christian</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" id="r3"><label class="form-check-label" for="r3">Muslim</label></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Caste -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCaste">
                                        Caste
                                    </button>
                                </h2>
                                <div id="collapseCaste" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <input type="text" class="form-control form-control-sm mb-2" placeholder="Search Caste...">
                                        <div class="filter-checkbox-list">
                                            <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="c1"><label class="form-check-label" for="c1">Brahmin - Iyer</label></div>
                                            <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="c2"><label class="form-check-label" for="c2">Mudaliyar</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" id="c3"><label class="form-check-label" for="c3">Nadar</label></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Education -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEducation">
                                        Education
                                    </button>
                                </h2>
                                <div id="collapseEducation" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="e1"><label class="form-check-label" for="e1">Bachelors</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="e2"><label class="form-check-label" for="e2">Masters</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" id="e3"><label class="form-check-label" for="e3">Doctorate</label></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Cards List -->
            <div class="col-lg-9">
                <!-- 🔥 3. Sort Options Header -->
                <div class="listing-header px-2">
                    <p class="mb-0 fw-bold">Showing 10,240 Profiles</p>
                    <div class="d-flex align-items-center gap-2">
                        <label class="small text-muted">Sort By:</label>
                        <select class="form-select form-select-sm" style="width: auto;">
                            <option>Recently Joined</option>
                            <option>Last Active</option>
                            <option>Age: Low to High</option>
                            <option>Age: High to Low</option>
                        </select>
                    </div>
                </div>

                @php
                    $profiles = [
                        ['id'=>'TM1024', 'name'=>'Ananya Ramesh', 'age'=>26, 'ht'=>"5'4\"", 'rel'=>'Hindu', 'caste'=>'Brahmin', 'edu'=>'M.S Software Engineering', 'prof'=>'Senior Developer at Zoho', 'loc'=>'Chennai, TN', 'img'=>'portrait-beautiful-woman-wearing-traditional-sari-garment.jpg', 'online'=>true, 'premium'=>true],
                        ['id'=>'TM2241', 'name'=>'Kavya Dharshini', 'age'=>24, 'ht'=>"5'2\"", 'rel'=>'Hindu', 'caste'=>'Mudaliyar', 'edu'=>'B.E IT', 'prof'=>'Work From Home', 'loc'=>'Madurai, TN', 'img'=>'cheerful-traditional-indian-woman-white-background-studio-shot.jpg', 'online'=>false, 'premium'=>false],
                        ['id'=>'TM3509', 'name'=>'Meera Krishnan', 'age'=>25, 'ht'=>"5'5\"", 'rel'=>'Hindu', 'caste'=>'Nadar', 'edu'=>'MBA Marketing', 'prof'=>'Bank Manager', 'loc'=>'Coimbatore, TN', 'img'=>'women1.png', 'online'=>true, 'premium'=>false],
                        ['id'=>'TM4412', 'name'=>'Deepika Mani', 'age'=>27, 'ht'=>"5'3\"", 'rel'=>'Hindu', 'caste'=>'Vanniyar', 'edu'=>'M.Tech IT', 'prof'=>'Civil Engineer', 'loc'=>'Trichy, TN', 'img'=>'women 2.png', 'online'=>false, 'premium'=>true],
                        ['id'=>'TM1105', 'name'=>'Rajesh Kumar', 'age'=>29, 'ht'=>"5'9\"", 'rel'=>'Hindu', 'caste'=>'Pillai', 'edu'=>'M.S Data Science', 'prof'=>'Tech Lead at Amazon', 'loc'=>'Chennai, TN', 'img'=>'men.png', 'online'=>true, 'premium'=>true],
                    ];
                @endphp

                @foreach($profiles as $index => $p)
                    <!-- 🔥 1. Horizontal Matrimony Cards -->
                    <div class="matrimony-horizontal-card wow fadeInUp">
                        <!-- Left: Image -->
                        <div class="card-img-left">
                            <a href="{{ url('profile') }}" class="d-block h-100">
                                @if($p['premium']) <div class="premium-ribbon">Premium</div> @endif
                                <img src="{{ asset('assets/images/matri/' . $p['img']) }}" alt="{{ $p['name'] }}">
                                <div class="verified-badge" style="top:10px; left:10px;"><i class="fas fa-check-circle"></i></div>
                                @if($p['online']) <div class="online-status"></div> @endif
                                <div class="photo-count-badge"><i class="fas fa-camera"></i> 5 Photos</div>
                            </a>
                        </div>

                        <!-- Center: Details -->
                        <div class="card-details-center">
                            <span class="profile-id-sm">Profile ID: {{ $p['id'] }}</span>
                            <a href="{{ url('profile') }}" style="text-decoration: none;"><h4 class="serif-font">{{ $p['name'] }}</h4></a>
                            <div class="biodata-grid">
                                <div class="biodata-row">
                                    <span><i class="fas fa-user-clock"></i> {{ $p['age'] }} Years, {{ $p['ht'] }}</span>
                                    <span><i class="fas fa-om"></i> {{ $p['rel'] }}, {{ $p['caste'] }}</span>
                                </div>
                                <div class="biodata-row">
                                    <span><i class="fas fa-graduation-cap"></i> {{ $p['edu'] }}</span>
                                </div>
                                <div class="biodata-row">
                                    <span><i class="fas fa-briefcase"></i> {{ $p['prof'] }}</span>
                                </div>
                                <div class="biodata-row">
                                    <span><i class="fas fa-map-marker-alt"></i> Living in {{ $p['loc'] }}</span>
                                </div>
                            </div>
                            <p class="short-about-text">"I am a simple, family-loving person looking for a partner with similar traditional values and a modern outlook..."</p>
                        </div>

                        <!-- Right: Actions -->
                        <div class="card-actions-right">
                            <button class="btn-card-action btn-interest"><i class="fas fa-heart"></i> Send Interest</button>
                            <button class="btn-card-action btn-alt-grey"><i class="fas fa-star"></i> Shortlist</button>
                            <button class="btn-card-action btn-chat"><i class="fas fa-comment-dots"></i> Chat Now</button>
                            <button class="btn-card-action btn-contact"><i class="fas fa-lock"></i> View Contact</button>
                        </div>
                    </div>

                    <!-- 🔥 5. Upgrade Banner (Between Listings) -->
                    @if($index == 2)
                    <div class="premium-upgrade-card wow zoomIn">
                        <i class="fas fa-crown fa-3x mb-3" style="color: var(--primary-gold);"></i>
                        <h5 class="serif-font">Upgrade Membership to View Direct Contact Details</h5>
                        <p class="mb-4">Get access to Phone Numbers, WhatsApp, and prioritized chats.</p>
                        <a href="#" class="btn btn-contact px-5">Upgrade Now</a>
                    </div>
                    @endif
                @endforeach

                <!-- 🔥 6. Improved Pagination -->
                <nav class="mt-5 large-pagination">
                    <ul class="pagination pagination-sm justify-content-center">
                        <li class="page-item"><a class="page-link" href="#"><i class="fas fa-chevron-left"></i></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
