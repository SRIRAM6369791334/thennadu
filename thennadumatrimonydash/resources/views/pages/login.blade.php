<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('images/logoeng.jpeg') }}" type="image/jpeg" />
    <!--plugins-->
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <title>Thennadu Matrimony - Admin Login</title>
    <style>
        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1a0000 0%, #4a0000 30%, #8B0000 60%, #c0392b 100%);
            position: relative;
            overflow: hidden;
        }

        /* Animated background blobs */
        body::before {
            content: '';
            position: fixed;
            top: -40%;
            left: -20%;
            width: 700px;
            height: 700px;
            background: radial-gradient(circle, rgba(192,57,43,0.4) 0%, transparent 70%);
            animation: blob1 8s ease-in-out infinite alternate;
            z-index: 0;
        }
        body::after {
            content: '';
            position: fixed;
            bottom: -30%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(212,168,83,0.2) 0%, transparent 70%);
            animation: blob2 10s ease-in-out infinite alternate;
            z-index: 0;
        }
        @keyframes blob1 {
            from { transform: translate(0, 0) scale(1); }
            to   { transform: translate(60px, 40px) scale(1.15); }
        }
        @keyframes blob2 {
            from { transform: translate(0, 0) scale(1); }
            to   { transform: translate(-50px, -30px) scale(1.1); }
        }

        /* Floating decorative circles */
        .deco-circle {
            position: fixed;
            border-radius: 50%;
            opacity: 0.06;
            background: #fff;
            z-index: 0;
        }
        .deco-circle:nth-child(1) { width:300px; height:300px; top:5%;  left:5%;  }
        .deco-circle:nth-child(2) { width:180px; height:180px; bottom:12%; right:8%;  }
        .deco-circle:nth-child(3) { width:100px; height:100px; top:55%; left:3%;  }

        .login-outer {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 440px;
            padding: 20px;
        }

        /* Logo area */
        .login-logo-wrap {
            text-align: center;
            margin-bottom: 24px;
        }
        .login-logo-wrap img {
            max-height: 80px;
            max-width: 260px;
            object-fit: contain;
            border-radius: 10px;
            filter: drop-shadow(0 4px 16px rgba(0,0,0,0.4));
            transition: transform 0.3s ease;
        }
        .login-logo-wrap img:hover { transform: scale(1.04); }
        .login-tagline {
            color: rgba(255,255,255,0.65);
            font-size: 13px;
            margin-top: 8px;
            letter-spacing: 0.8px;
            font-style: italic;
        }

        /* Glass card */
        .login-card {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.18);
            border-radius: 20px;
            padding: 36px 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.35);
        }

        .login-heading {
            text-align: center;
            margin-bottom: 28px;
        }
        .login-heading h3 {
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 26px;
            margin: 0 0 4px 0;
            letter-spacing: 0.5px;
        }
        .login-heading p {
            color: rgba(255,255,255,0.55);
            font-size: 13px;
            margin: 0;
        }

        /* Divider */
        .login-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }
        .login-divider::before,
        .login-divider::after {
            content:'';
            flex: 1;
            height: 1px;
            background: rgba(255,255,255,0.2);
        }
        .login-divider span {
            color: rgba(255,255,255,0.4);
            font-size: 11px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* Form labels */
        .login-card .form-label {
            color: rgba(255,255,255,0.8);
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 6px;
        }

        /* Inputs */
        .login-card .form-control {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            color: #fff;
            border-radius: 10px;
            height: 46px;
            font-size: 14px;
            transition: all 0.25s ease;
        }
        .login-card .form-control::placeholder { color: rgba(255,255,255,0.35); }
        .login-card .form-control:focus {
            background: rgba(255,255,255,0.15);
            border-color: rgba(212,168,83,0.7);
            box-shadow: 0 0 0 3px rgba(212,168,83,0.2);
            color: #fff;
        }

        /* Password input group */
        .login-card .input-group .form-control {
            border-right: none;
            border-radius: 10px 0 0 10px;
        }
        .login-card .input-group-text {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            border-left: none;
            color: rgba(255,255,255,0.6);
            border-radius: 0 10px 10px 0;
            cursor: pointer;
        }
        .login-card .input-group-text:hover { color: #fff; }

        /* Login button */
        .btn-login {
            width: 100%;
            height: 48px;
            background: linear-gradient(135deg, #d4a853 0%, #c0862c 100%);
            border: none;
            border-radius: 12px;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 15px;
            letter-spacing: 0.5px;
            box-shadow: 0 6px 20px rgba(192,134,44,0.4);
            transition: all 0.3s ease;
            cursor: pointer;
            margin-top: 8px;
        }
        .btn-login:hover {
            background: linear-gradient(135deg, #c0862c 0%, #a87020 100%);
            box-shadow: 0 8px 28px rgba(192,134,44,0.55);
            transform: translateY(-1px);
        }
        .btn-login i { margin-right: 8px; }

        /* Alert */
        .alert-danger {
            background: rgba(231,76,60,0.2);
            border: 1px solid rgba(231,76,60,0.4);
            color: #ffb3b3;
            border-radius: 10px;
            font-size: 13px;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card { padding: 28px 22px; }
            .login-card .type h3 { font-size: 22px; }
        }
    </style>
</head>

<body>
    <!-- Decorative circles -->
    <div class="deco-circle"></div>
    <div class="deco-circle"></div>
    <div class="deco-circle"></div>

    <div class="login-outer">
        <!-- Logo -->
        <div class="login-logo-wrap">
            <img src="{{ asset('images/logoeng.jpeg') }}" alt="Thennadu Matrimony Logo">
            <p class="login-tagline">Admin Dashboard — Thennadu Matrimony</p>
        </div>

        <!-- Card -->
        <div class="login-card">
            <div class="login-heading">
                <h3>Welcome Back</h3>
                <p>Sign in to your admin account</p>
            </div>

            <div class="login-divider"><span>Login</span></div>

            @if(session()->get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session()->get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form method="POST" action="/authenticate">
                @csrf
                <div class="mb-3">
                    <label for="inputEmailAddress" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="inputEmailAddress" name="email" placeholder="Enter your email address">
                </div>
                <div class="mb-4">
                    <label for="inputChoosePassword" class="form-label">Password</label>
                    <div class="input-group" id="show_hide_password">
                        <input type="password" class="form-control border-end-0" name="password" id="inputChoosePassword" placeholder="Enter your password">
                        <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-show'></i></a>
                    </div>
                </div>
                <button type="submit" class="btn-login">
                    <i class='bx bxs-lock-open'></i>Sign In
                </button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function () {
            $("#show_hide_password a").on('click', function (event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-show");
                    $('#show_hide_password i').removeClass("bx-hide");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-show");
                    $('#show_hide_password i').addClass("bx-hide");
                }
            });
        });
    </script>
    <!--app JS-->
    <script src="assets/js/app.js"></script>
</body>

</html>




