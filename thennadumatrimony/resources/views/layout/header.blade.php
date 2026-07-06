<header class="header sticky-top" id="navbar">
    <div class="header__bottom">
        <div class="container">
                <nav class="navbar navbar-expand-lg w-100">
                    <a class="navbar-brand notranslate" href="{{ url('/') }}">
                        <img src="{{ asset('assets/images/logo/logoeng.png') }}" alt="logo" class="notranslate">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                        <div class="navbar-nav mainmenu">
                            <ul class="d-flex align-items-center">
                                <li class="{{ Request::is('home') ? 'active' : '' }}">
                                    <a href="{{ url('/home') }}">Home</a>
                                </li>
                                <li class="{{ Request::is('stories') ? 'active' : '' }}">
                                    <a href="{{ url('/home#success-stories') }}">Stories</a>
                                </li>
                                <li class="{{ Request::is('matches') ? 'active' : '' }}">
                                    <a href="{{ url('matches') }}">Matches</a>
                                </li>
                                <!-- <li class="{{ Request::is('search') ? 'active' : '' }}">
                                    <a href="{{ url('search') }}">Search</a>
                                </li> -->
                                <li class="{{ Request::is('services/horoscope') ? 'active' : '' }}">
                                    <a href="{{ route('services.horoscope') }}">Astrology</a>
                                </li>
                                <li class="{{ Request::is('events') ? 'active' : '' }}">
                                    <a href="{{ route('events') }}">Events</a>
                                </li>
                                <li class="{{ Request::is('plans') ? 'active' : '' }}">
                                    <a href="{{ route('plans.index') }}">Plans</a>
                                </li>
                                <li class="{{ Request::is('contact') ? 'active' : '' }}">
                                    <a href="{{ url('contact') }}">Contact</a>
                                </li>
                            </ul>
                        </div>
                        <div class="header__more ms-lg-4 d-flex align-items-center">
                            <div id="google_translate_element"></div>
                            
                            <!-- Premium Language Toggle -->
                            <div class="lang-toggle-container d-flex align-items-center notranslate me-4">
                                <span class="small fw-bold me-2 text-maroon" id="en-label" style="font-size: 0.75rem;">EN</span>
                                <label class="premium-switch">
                                    <input type="checkbox" id="langToggle" onchange="translatePage()">
                                    <span class="premium-slider"></span>
                                </label>
                                <span class="small fw-bold ms-2 text-muted" id="ta-label" style="font-size: 0.75rem;">தமிழ்</span>
                            </div>
                            @auth
                                <div class="dropdown">
                                    <button class="profile-nav-btn dropdown-toggle d-flex align-items-center" type="button" id="profileDropdown"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-user-circle me-2"></i> {{ auth()->user()->Name ?? 'My Profile' }}
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 py-2"
                                        aria-labelledby="profileDropdown" style="min-width: 200px;">
                                        <li class="px-3 py-2 border-bottom mb-1">
                                            <p class="mb-0 fw-bold text-dark small">{{ auth()->user()->Name }}</p>
                                            <p class="mb-0 text-muted" style="font-size:0.75rem;">ID:
                                                {{ auth()->user()->varan_id }}</p>
                                        </li>
                                        <li><a class="dropdown-item py-2" href="{{ url('dashboard') }}"><i class="fa-solid fa-th-large me-2 text-maroon"></i> Dashboard</a></li>
                                        <li><a class="dropdown-item py-2" href="{{ route('profile.view') }}"><i class="fa-solid fa-id-card me-2 text-maroon"></i> My Public Profile</a></li>
                                        <li>
                                            <hr class="dropdown-divider my-1">
                                        </li>
                                        <li>
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item py-2 text-danger"><i
                                                        class="fa-solid fa-sign-out-alt me-2"></i> Logout</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <div class="d-flex gap-2">
                                    <a href="{{ url('login') }}" class="btn-login-header">Login</a>
                                    <a href="{{ url('register') }}" class="btn-register-header">Register</a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </nav>
        </div>
    </div>
</header>

<style>
    .navbar-brand {
        display: flex;
        align-items: center;
        padding: 5px 0 !important;
        margin-right: 1.5rem;
        flex-shrink: 0;
        min-width: 150px;
    }
    .navbar-brand img {
        height: 70px !important;
        width: auto !important;
        transition: all 0.3s ease;
        object-fit: contain;
    }
    .header__bottom {
        background: #f7f7f7;
        box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        padding: 5px 0;
    }
    .header {
        background: #f7f7f7;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
        padding: 10px 0;
        transition: all 0.3s ease;
    }

    .header.scrolled {
        padding: 5px 0;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .text-maroon {
        color: #900C3F !important;
    }

    .mainmenu ul li a {
        font-weight: 500;
        color: #444;
        padding: 10px 15px;
        font-family: 'Inter', sans-serif;
        position: relative;
        transition: all 0.3s ease;
    }

    .mainmenu ul li a:hover,
    .mainmenu ul li.active a {
        color: #900C3F;
    }

    .mainmenu ul li a::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 15px;
        right: 15px;
        height: 2px;
        background: #900C3F;
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .mainmenu ul li a:hover::after,
    .mainmenu ul li.active a::after {
        transform: scaleX(1);
    }

    .btn-outline-maroon {
        color: #900C3F;
        border: 1px solid #900C3F;
        background: transparent;
        transition: all 0.3s ease;
    }

    .btn-outline-maroon:hover, 
    .btn-outline-maroon:focus,
    .btn-outline-maroon:active {
        background: #900C3F !important;
        color: #fff !important;
        border-color: #900C3F !important;
    }

    .dropdown-item.active.bg-maroon {
        background-color: #900C3F !important;
    }

    .btn-login-header {
        color: #900C3F;
        border: 1px solid #900C3F;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-login-header:hover {
        background: #900C3F;
        color: #fff;
    }

    .btn-register-header {
        background: #900C3F;
        color: #fff;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(144, 12, 63, 0.2);
    }

    .btn-register-header:hover {
        background: #7a0a35;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(144, 12, 63, 0.3);
    }

    .profile-nav-btn {
        background: #f8f9fa;
        border: 1px solid #eee;
        padding: 8px 15px;
        border-radius: 50px;
        font-weight: 500;
        color: #333;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .profile-nav-btn:hover {
        background: #eee;
    }

    /* Mobile Responsive Styles */
    @media (max-width: 991px) {
        .navbar-collapse {
            background: #fff;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            padding: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-radius: 0 0 15px 15px;
            z-index: 1000;
        }

        .mainmenu ul {
            flex-direction: column;
            align-items: flex-start !important;
            width: 100%;
            padding: 0;
        }

        .mainmenu ul li {
            width: 100%;
            border-bottom: 1px solid #f0f0f0;
        }

        .mainmenu ul li:last-child {
            border-bottom: none;
        }

        .mainmenu ul li a {
            display: block;
            padding: 12px 0;
        }

        .mainmenu ul li a::after {
            left: 0;
            right: 0;
            bottom: 5px;
        }

        .header__more {
            margin-top: 20px;
            margin-left: 0 !important;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        .btn-login-header,
        .btn-register-header {
            flex: 1;
            text-align: center;
            padding: 10px;
        }

        .navbar-brand img {
            height: 60px !important;
        }
    }

    .navbar-toggler {
        border: none;
        padding: 0;
    }

    .navbar-toggler:focus {
        box-shadow: none;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28144, 12, 63, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }
    /* Premium Switch Styling */
    .premium-switch {
        position: relative;
        display: inline-block;
        width: 42px;
        height: 22px;
    }
    .premium-switch input { opacity: 0; width: 0; height: 0; }
    .premium-slider {
        position: absolute;
        cursor: pointer;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: #dfdfdf;
        transition: .4s;
        border-radius: 34px;
    }
    .premium-slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    input:checked + .premium-slider { background-color: #900C3F; }
    input:checked + .premium-slider:before { transform: translateX(20px); }

    .goog-te-banner-frame, .goog-te-gadget, .skiptranslate { display: none !important; }
    #google_translate_element { position: absolute; bottom: -100px; visibility: hidden; }
    body { top: 0px !important; }
    
    .lang-toggle-container { cursor: pointer; }
    .premium-slider { cursor: pointer; }
</style>

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            autoDisplay: false
        }, 'google_translate_element');
    }

    function translatePage() {
        var toggle = document.getElementById('langToggle');
        var select = document.querySelector('.goog-te-combo');
        var lang = toggle.checked ? 'ta' : 'en';
        
        // Update Label Colors
        if (toggle.checked) {
            document.getElementById('ta-label').classList.replace('text-muted', 'text-maroon');
            document.getElementById('en-label').classList.replace('text-maroon', 'text-muted');
        } else {
            document.getElementById('en-label').classList.replace('text-muted', 'text-maroon');
            document.getElementById('ta-label').classList.replace('text-maroon', 'text-muted');
        }

        // Manual cookie setting for extra reliability
        document.cookie = "googtrans=/en/" + lang + "; path=/";
        document.cookie = "googtrans=/en/" + lang + "; domain=" + location.hostname + "; path=/";

        if (select) {
            select.value = lang;
            select.dispatchEvent(new Event('change'));
            setTimeout(function() {
                select.dispatchEvent(new Event('change'));
            }, 100);
        } else {
            setTimeout(translatePage, 500);
        }
    }

    // Initialize toggle state on load and periodically check for widget
    (function checkWidget() {
        var select = document.querySelector('.goog-te-combo');
        var toggle = document.getElementById('langToggle');
        if (select && toggle) {
            if (select.value === 'ta') {
                toggle.checked = true;
                document.getElementById('ta-label').classList.replace('text-muted', 'text-maroon');
            } else {
                toggle.checked = false;
                document.getElementById('en-label').classList.replace('text-muted', 'text-maroon');
            }
        } else {
            setTimeout(checkWidget, 500);
        }
    })();
</script>
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>