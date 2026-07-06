<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Create your matrimony profile and find your perfect life partner.">
    <title>Register — Matrimony</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo/matrilogo.png') }}">

    <!-- Font Awesome (already in all.min.css or CDN fallback) -->
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #FFFDF9;
            min-height: 100vh;
            color: #2A2A2A;
        }
    </style>
</head>
<body>

    <style>
        .auth-header {
            background: #900C3F;
            padding: 14px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s ease;
        }

        .auth-logo {
            height: 75px;
            border-radius: 10px;
            transition: height 0.3s ease;
        }

        .header-nav {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .login-invite {
            color: rgba(255,255,255,0.9);
            font-size: 0.92rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .back-home {
            color: rgba(255,255,255,0.75);
            font-size: 0.9rem;
            font-family: 'Outfit', sans-serif;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            border-left: 1px solid rgba(255,255,255,0.1);
            padding-left: 20px;
        }

        @media (max-width: 768px) {
            .auth-header { padding: 12px 20px; }
            .auth-logo { height: 60px; }
            .header-nav { gap: 15px; }
            .login-invite span { display: none; } /* Hide 'Already have an account?' text */
            .back-home { border-left: none; padding-left: 0; }
            .back-home span { display: none; } /* Hide 'Back to Home' text, keep icon */
        }

        @media (max-width: 480px) {
            .auth-logo { height: 50px; }
            .header-nav { gap: 10px; }
            .open-login-modal { padding: 5px 10px; font-size: 0.85rem; }
        }
    </style>

    {{-- ===== Top Minimal Brand Bar ===== --}}
    <div class="auth-header">
        <a href="{{ url('/') }}">
            <img src="{{ asset('assets/images/logo/logoeng.png') }}" alt="Logo" class="auth-logo">
        </a>
        <div class="header-nav">
            <div id="google_translate_element" style="display:none !important;"></div>
                                
            <!-- Premium Language Toggle -->
            <div class="lang-toggle-container d-flex align-items-center notranslate me-3">
                <span class="small fw-bold me-2 text-white" id="en-label" style="font-size: 0.7rem;">EN</span>
                <label class="premium-switch">
                    <input type="checkbox" id="langToggle" onchange="translatePage()">
                    <span class="premium-slider"></span>
                </label>
                <span class="small fw-bold ms-2 text-white-50" id="ta-label" style="font-size: 0.7rem;">தமிழ்</span>
            </div>

            <div class="login-invite">
                <span>Already have an account?</span>
                <a href="javascript:void(0)" class="open-login-modal" style="color: #D4AF37; font-weight: 800; text-decoration: none; padding: 6px 14px; background: rgba(212, 175, 55, 0.1); border-radius: 10px; transition: all 0.3s ease;">Login Here</a>
            </div>
            <a href="{{ url('/home') }}" class="back-home">
                <i class="fa-solid fa-house"></i> <span>Back to Home</span>
            </a>
        </div>
    </div>

    {{-- ===== Page Content ===== --}}
    @yield('content')

    {{-- ===== Minimal Footer ===== --}}
    <div style="text-align:center; padding:20px; font-size:0.82rem; color: #999; background:#FAFAFA; border-top:1px solid #F0EBF0;">
        &copy; {{ date('Y') }} Matrimony. All Rights Reserved. &nbsp;|&nbsp;
        <a href="#" style="color:#900C3F; text-decoration:none;">Privacy Policy</a> &nbsp;|&nbsp;
        <a href="#" style="color:#900C3F; text-decoration:none;">Terms of Use</a>
    </div>

    <!-- JS Dependencies -->
    <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Font Awesome 6 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                confirmButtonColor: '#900C3F'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                confirmButtonColor: '#900C3F'
            });
        @endif
    </script>
    {{-- ===== Language Switch CSS ===== --}}
    <style>
        .premium-switch { position: relative; display: inline-block; width: 44px; height: 24px; }
        .premium-switch input { opacity: 0; width: 0; height: 0; }
        .premium-slider {
            position: absolute; cursor: pointer; inset: 0; background-color: rgba(255,255,255,0.2);
            transition: .4s; border-radius: 34px; border: 1px solid rgba(255,255,255,0.3);
        }
        .premium-slider:before {
            position: absolute; content: ""; height: 16px; width: 16px; left: 4px; bottom: 3px;
            background-color: white; transition: .4s; border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        input:checked + .premium-slider { background-color: #D4AF37; border-color: #D4AF37; }
        input:checked + .premium-slider:before { transform: translateX(20px); }

        .goog-te-banner-frame, .goog-te-gadget, .skiptranslate { display: none !important; }
        #google_translate_element { position: absolute; visibility: hidden; }
        body { top: 0px !important; }
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
                document.getElementById('ta-label').classList.replace('text-white-50', 'text-white');
                document.getElementById('en-label').classList.replace('text-white', 'text-white-50');
            } else {
                document.getElementById('en-label').classList.replace('text-white-50', 'text-white');
                document.getElementById('ta-label').classList.replace('text-white', 'text-white-50');
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
                    document.getElementById('ta-label').classList.replace('text-white-50', 'text-white');
                    document.getElementById('en-label').classList.replace('text-white', 'text-white-50');
                } else {
                    toggle.checked = false;
                    document.getElementById('en-label').classList.replace('text-white-50', 'text-white');
                    document.getElementById('ta-label').classList.replace('text-white', 'text-white-50');
                }
            } else {
                setTimeout(checkWidget, 500);
            }
        })();
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>
