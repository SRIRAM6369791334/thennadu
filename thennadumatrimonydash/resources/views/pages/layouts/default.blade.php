<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('images/logoeng.jpeg') }}" type="image/jpeg" />
    <!--plugins-->
    {{-- <link href="/assets/plugins/notifications/css/lobibox.min.css" rel="stylesheet"/> --}}
    <link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="/assets/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/header-colors.css') }}" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <title>@yield('title')</title>
</head>
<style>
    /* ============================================
       THENNADU MATRIMONY - Custom Dashboard Theme
       ============================================ */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap');

    :root {
        --tm-primary:    #8B0000;
        --tm-primary-2:  #c0392b;
        --tm-primary-3:  #922b21;
        --tm-accent:     #e74c3c;
        --tm-gold:       #d4a853;
        --tm-gold-light: #f0c97a;
        --tm-sidebar-bg: linear-gradient(180deg, #8B0000 0%, #c0392b 60%, #922b21 100%);
        --tm-topbar-bg:  linear-gradient(135deg, #7B0000 0%, #a93226 100%);
    }

    body {
        font-family: 'Inter', 'Roboto', sans-serif;
        background: #f5f0f0;
    }

    /* ---- Sidebar ---- */
    .sidebar-wrapper {
        background: var(--tm-sidebar-bg) !important;
        box-shadow: 4px 0 18px rgba(139,0,0,0.18) !important;
    }

    .sidebar-header {
        background: linear-gradient(135deg, #7B0000 0%, #a93226 100%) !important;
        border-bottom: 1px solid rgba(255,255,255,0.15) !important;
        padding: 8px 12px !important;
    }

    /* ---- Sidebar menu items ---- */
    .sidebar-wrapper .metismenu a {
        color: rgba(255,255,255,0.88);
        border-radius: 8px;
        margin: 2px 0;
        transition: all 0.25s ease;
        font-weight: 400;
        letter-spacing: 0.3px;
    }

    .sidebar-wrapper .metismenu a:hover,
    .sidebar-wrapper .metismenu a:focus,
    .sidebar-wrapper .metismenu .mm-active > a {
        background: rgba(255,255,255,0.18) !important;
        color: #fff !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        transform: translateX(3px);
    }

    .activesidebar {
        background: rgba(255,255,255,0.22) !important;
        border-left: 3px solid var(--tm-gold) !important;
        border-radius: 8px !important;
    }

    .menu-label {
        color: rgba(255,255,255,0.5) !important;
        font-size: 10px;
        letter-spacing: 1.5px;
        font-weight: 600;
        text-transform: uppercase;
        padding: 18px 15px 6px 15px;
    }

    /* ---- Topbar / Header ---- */
    .topbar .navbar {
        background: linear-gradient(135deg, #7B0000 0%, #c0392b 100%) !important;
        box-shadow: 0 2px 14px rgba(139,0,0,0.25) !important;
    }

    .topbar {
        box-shadow: 0 2px 14px rgba(139,0,0,0.18) !important;
        border-bottom: 0 !important;
    }

    /* ---- User info in topbar ---- */
    .user-name { color: #fff !important; font-weight: 600; }
    .designattion { color: rgba(255,255,255,0.75) !important; }
    .user-img {
        border: 2px solid var(--tm-gold) !important;
        border-radius: 50% !important;
    }

    /* ---- Notification bell ---- */
    .alert-count {
        background: var(--tm-gold) !important;
        color: #7B0000 !important;
        font-weight: 700;
    }

    /* ---- Cards ---- */
    .card {
        border: 0;
        border-radius: 14px;
        box-shadow: 0 2px 15px rgba(139,0,0,0.07);
        transition: box-shadow 0.25s ease, transform 0.25s ease;
    }
    .card:hover {
        box-shadow: 0 6px 30px rgba(139,0,0,0.14);
        transform: translateY(-2px);
    }
    .card-header {
        background: linear-gradient(135deg, #8B0000 0%, #c0392b 100%);
        color: #fff;
        border-radius: 14px 14px 0 0 !important;
        border-bottom: 0;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
    }

    /* ---- Buttons ---- */
    .btn-primary {
        background: linear-gradient(135deg, #8B0000, #c0392b) !important;
        border: none !important;
        border-radius: 8px;
        font-weight: 500;
        box-shadow: 0 3px 10px rgba(139,0,0,0.25);
        transition: all 0.25s ease;
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #6d0000, #a93226) !important;
        box-shadow: 0 5px 16px rgba(139,0,0,0.35);
        transform: translateY(-1px);
    }
    .btn-danger {
        background: linear-gradient(135deg, #c0392b, #e74c3c) !important;
        border: none !important;
        border-radius: 8px;
    }
    .btn-success {
        background: linear-gradient(135deg, #1a7a4a, #27ae60) !important;
        border: none !important;
        border-radius: 8px;
    }
    .btn-warning {
        background: linear-gradient(135deg, #b8860b, #d4a853) !important;
        border: none !important;
        color: #fff !important;
        border-radius: 8px;
    }

    /* ---- Tables ---- */
    .table thead {
        background: linear-gradient(135deg, #8B0000, #c0392b);
        color: #000000;
    }
    .table thead th {
        border: none;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        letter-spacing: 0.3px;
    }
    .table tbody tr:hover {
        background-color: rgba(139,0,0,0.06) !important;
    }

    /* ---- Badges ---- */
    .badge.bg-primary { background: var(--tm-primary) !important; }
    .badge.bg-danger  { background: var(--tm-accent) !important; }

    /* ---- Back to top ---- */
    .back-to-top {
        background: linear-gradient(135deg, #8B0000, #c0392b) !important;
        border-radius: 50% !important;
        box-shadow: 0 4px 14px rgba(139,0,0,0.4);
    }

    /* ---- Breadcrumb ---- */
    .breadcrumb-title { color: var(--tm-primary); }

    /* ---- Page footer ---- */
    .page-footer {
        background: #fff;
        border-top: 2px solid rgba(139,0,0,0.1);
        color: #555;
        font-size: 13px;
    }

    /* ---- Stat widget cards ---- */
    .widgets-icons {
        background: linear-gradient(135deg, #8B0000, #c0392b) !important;
        color: #fff !important;
        border-radius: 12px;
    }
    .widgets-icons-2 {
        background: rgba(139,0,0,0.1) !important;
        border-radius: 12px;
    }

    /* ---- Mobile hamburger ---- */
    .mobile-toggle-menu i { color: #fff !important; }
    .mobile-toggle-menu:hover i { color: var(--tm-gold) !important; }

    /* ---- Dropdown menu ---- */
    .dropdown-menu {
        border: 0;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }
    .dropdown-item:hover {
        background: rgba(139,0,0,0.07);
        color: var(--tm-primary);
    }

    /* ---- Form inputs ---- */
    .form-control:focus,
    .form-select:focus {
        border-color: var(--tm-primary-2) !important;
        box-shadow: 0 0 0 3px rgba(192,57,43,0.15) !important;
    }

    /* ---- Select2 focus ---- */
    .select2-container--default.select2-container--focus .select2-selection--multiple,
    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: var(--tm-primary-2) !important;
    }
    .select2-container--default .select2-selection--multiple {
        height: 40px !important;
        overflow-y: scroll !important;
    }

    /* ---- Page breadcrumb heading ---- */
    .page-breadcrumb h6, .page-breadcrumb .breadcrumb-title {
        color: var(--tm-primary);
        font-family: 'Poppins', sans-serif;
    }

    /* ---- Sidebar logo image responsive ---- */
    .sidebar-logo-img {
        transition: transform 0.3s ease;
    }
    .sidebar-logo-img:hover {
        transform: scale(1.05);
    }
</style>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->

        @include('pages.layouts.includes.navbar');
        <!--end header -->
        <!--start page wrapper -->
        @yield('main-content')


        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
                class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        @include('pages.layouts.includes.footer');
    </div>
    <!--end wrapper-->
    <!--start switcher-->

    <!--end switcher-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <!-- PerfectScrollbar safety shim: silently skip if element doesn't exist -->
    <script>
        (function() {
            var _OrigPS = PerfectScrollbar;
            PerfectScrollbar = function(el, opts) {
                try {
                    var node = (typeof el === 'string') ? document.querySelector(el) : el;
                    if (!node) return {};
                    return new _OrigPS(el, opts);
                } catch(e) { return {}; }
            };
            PerfectScrollbar.prototype = _OrigPS.prototype;
        })();
    </script>
    <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/plugins/chartjs/js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/chartjs/js/Chart.extension.js') }}"></script>
    <script src="{{ asset('assets/plugins/sparkline-charts/jquery.sparkline.min.js') }}"></script>
    <!--notification js -->
    {{-- <s src="{{asset("assets/plugins/notifications/js/lobibox.min.js"></s)}}"cript> --}}
    {{-- <s src="{{asset("assets/plugins/notifications/js/notifications.min.js"></s)}}"cript> --}}
    <script src="{{ asset('assets/js/index2.js') }}"></script>
    <!--app JS-->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
        $('#example4').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        var table = $('#example2').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print']
        });

        table.buttons().container()
            .appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
</script>
<script>
    $(".status").click(function() {

        var id = $(this).attr("id");

        var varanid = $(this).data("varanid");

        $(".prid").val(id);
        $(".varanid").val(varanid);

    });
</script>

<script>
    $(".brokerstatus").click(function() {

        var id = $(this).attr("id");

        $(".getbrokerid").val(id);

    });
</script>

<script>
    $('.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
    $('.multiple-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
</script>
<script>
    $("#partnerageto").change(function() {

        var fromage = $("#partneragefrom").val();
        var toage = $(this).val();

        // alert(fromage);
        // alert(toage);

        if (fromage > toage) {


            $("#error").text("Wrong Age..! To age greater than from age")
        } else {

        }

    })
</script>

<script>
    $(".bodytype").select2();
    $("#checkbox").click(function() {
        if ($("#checkbox").is(':checked')) {
            $(".bodytype > option").prop("selected", "selected");
            $(".bodytype").trigger("change");

        } else {
            // alert("remove");
            $(".bodytype > option").removeAttr("selected");
            $(".bodytype").trigger("change");
        }
    });
</script>

<script>
    $(".complexion").select2();
    $("#checkbox2").click(function() {
        if ($("#checkbox2").is(':checked')) {
            $(".complexion > option").prop("selected", "selected");
            $(".complexion").trigger("change");

        } else {

            $(".complexion > option").removeAttr("selected");
            $(".complexion").trigger("change");
        }
    });
</script>

<script>
    $(".maritalstatus").select2();
    $("#checkbox3").click(function() {
        if ($("#checkbox3").is(':checked')) {
            $(".maritalstatus > option").prop("selected", "selected");
            $(".maritalstatus").trigger("change");

        } else {

            $(".maritalstatus > option").removeAttr("selected");
            $(".maritalstatus").trigger("change");
        }
    });
</script>

<script>
    $(".religion1").select2();
    $("#checkbox4").click(function() {
        if ($("#checkbox4").is(':checked')) {
            $(".religion1 > option").prop("selected", "selected");
            $(".religion1").trigger("change");

        } else {

            $(".religion1 > option").removeAttr("selected");
            $(".religion1").trigger("change");
        }
    });
</script>

<script>
    $(".caste").select2();
    $("#checkbox5").click(function() {
        if ($("#checkbox5").is(':checked')) {
            $(".caste > option").prop("selected", "selected");
            $(".caste").trigger("change");

        } else {

            $(".caste > option").removeAttr("selected");
            $(".caste").trigger("change");
        }
    });
</script>

<script>
    $(".subcaste").select2();
    $("#checkbox6").click(function() {
        if ($("#checkbox6").is(':checked')) {
            $(".subcaste > option").prop("selected", "selected");
            $(".subcaste").trigger("change");

        } else {

            $(".subcaste > option").removeAttr("selected");
            $(".subcaste").trigger("change");
        }
    });
</script>

<script>
    $(".star").select2();
    $("#checkbox7").click(function() {
        if ($("#checkbox7").is(':checked')) {
            $(".star > option").prop("selected", "selected");
            $(".star").trigger("change");

        } else {

            $(".star > option").removeAttr("selected");
            $(".star").trigger("change");
        }
    });
</script>

<script>
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bx-hide");
                $('#show_hide_password i').removeClass("bx-show");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bx-hide");
                $('#show_hide_password i').addClass("bx-show");
            }
        });
    });
</script>
<script>
    $(".getid").click(function() {

        var id = $(this).attr("id");

        $(".userid").val(id);
    });
</script>
<script>
    $(".viewbtn").click(function() {

        var id = $(this).data("id");
        var user = $(this).data("user");
        var view = $(this).data("view");

        $(".userid").val(id);
        $(".username").val(user);
        $(".viewpermission").val(view);
    });
</script>

<script>
    $(".getamt").click(function() {

        var amt = $(this).data("amt");

        $(".amt").val(amt);

    });
</script>
<script>
    $(".religion").change(function() {
        var religionid = $(this).val();

        $.ajax({

            url: 'https://mobilevaran.varan2varan.com/api/getcast/' + religionid,
            type: 'GET', //this is your method
            // data: { religionid:religionid,_token:'{{ csrf_token() }}' },
            contentType: "application/json; charset=utf-8",
            dataType: 'JSON',
            success: function(response) {
                $('.castes').find('option').remove().end()
                $('.subcaste').find('option').remove().end()
                $('.castes').html(
                    '<option value="">-- Choose Caste --</option>'
                );
                $.each(response, function(key, item) {
                    //   console.log(item.Caste_name);
                    $('.castes').append(
                        '<option value="' + item.id + '">' + item.Caste_name +
                        '</option>'
                    )

                });
            }
        });
    })
</script>
<script>
    $(".castes").change(function() {
        var casteid = $(this).val();

        $.ajax({

            url: 'https://mobilevaran.varan2varan.com/api/getsubcast/' + casteid,
            type: 'GET', //this is your method
            // data: { religionid:religionid,_token:'{{ csrf_token() }}' },
            contentType: "application/json; charset=utf-8",
            dataType: 'JSON',
            success: function(response) {
                $('.subcaste').find('option').remove().end();
                $('.subcaste').html(
                    '<option value="">-- Choose Subcaste --</option>'
                );
                $.each(response, function(key, item) {
                    //   console.log(item.Caste_name);
                    $('.subcaste').append(
                        '<option value="' + item.id + '">' + item.subcategory_name +
                        '</option>'
                    )

                });
            }
        });
    })
</script>

<script>
    let limitChar = (element) => {
        const maxChar = 2;

        let ele = document.getElementById(element.id);
        let charLen = ele.value.length;



        if (charLen > maxChar) {
            ele.value = ele.value.substring(0, maxChar);
            p.innerHTML = 0 + ' characters remaining';
        }
    }
</script>

<script>
    let limitChar1 = (element) => {
        const maxChar = 10;

        let ele = document.getElementById(element.id);
        let charLen = ele.value.length;



        if (charLen > maxChar) {
            ele.value = ele.value.substring(0, maxChar);
            p.innerHTML = 0 + ' characters remaining';
        }
    }
</script>


<script>
    $(document).ready(function() {

        $(".ccountry").change(function() {
            var countryid = $(this).val();

            $.ajax({

                url: 'https://mobilevaran.varan2varan.com/api/getstate/' + countryid,
                type: 'GET', //this is your method
                contentType: "application/json; charset=utf-8",
                dataType: 'JSON',
                success: function(response) {
                    $('.sstate').find('option').remove().end()
                    $('.sstate').html(
                        '<option value="">-- Choose State --</option>'
                    );
                    $.each(response, function(key, item) {
                        //   console.log(item.Caste_name);
                        $('.sstate').append(
                            '<option value="' + item.state_id + '">' + item
                            .state_name + '</option>'
                        )
                    });
                }
            })
        });

        $(".ccountry1").change(function() {
            var countryid = $(this).val();

            $.ajax({

                url: 'https://mobilevaran.varan2varan.com/api/getstate/' + countryid,
                type: 'GET', //this is your method
                contentType: "application/json; charset=utf-8",
                dataType: 'JSON',
                success: function(response) {
                    $('.sstate1').find('option').remove().end()
                    $('.sstate1').html(
                        '<option value="">-- Choose State --</option>'
                    );
                    $.each(response, function(key, item) {
                        //   console.log(item.Caste_name);
                        $('.sstate1').append(
                            '<option value="' + item.state_id + '">' + item
                            .state_name + '</option>'
                        )
                    });
                }
            })
        });
    });
</script>

<script>
    $(document).ready(function() {

        $(".sstate").change(function() {
            var stateid = $(this).val();

            $.ajax({

                url: 'https://mobilevaran.varan2varan.com/api/getcity/' + stateid,
                type: 'GET', //this is your method
                contentType: "application/json; charset=utf-8",
                dataType: 'JSON',
                success: function(response) {
                    $('.ccities').find('option').remove().end()
                    $('.ccities').html(
                        '<option value="">-- Choose State --</option>'
                    );
                    $.each(response, function(key, item) {
                        //   console.log(item.Caste_name);
                        $('.ccities').append(
                            '<option value="' + item.city_id + '">' + item
                            .city_name + '</option>'
                        )
                    });
                }
            })
        });

        $(".sstate1").change(function() {
            var stateid = $(this).val();

            $.ajax({

                url: 'https://mobilevaran.varan2varan.com/api/getcity/' + stateid,
                type: 'GET', //this is your method
                contentType: "application/json; charset=utf-8",
                dataType: 'JSON',
                success: function(response) {
                    $('.ccities1').find('option').remove().end()
                    $('.ccities1').html(
                        '<option value="">-- Choose State --</option>'
                    );
                    $.each(response, function(key, item) {
                        //   console.log(item.Caste_name);
                        $('.ccities1').append(
                            '<option value="' + item.city_id + '">' + item
                            .city_name + '</option>'
                        )
                    });
                }
            })
        });
    });
</script>


<script>
    function phonenumber(inputtxt) {
        var phoneno = /^\(?([6-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
        if (inputtxt.value.match(phoneno)) {
            return true;
        } else {
            alert("Not a valid Phone Number");
            return false;
        }
    }
</script>
@yield('script')




