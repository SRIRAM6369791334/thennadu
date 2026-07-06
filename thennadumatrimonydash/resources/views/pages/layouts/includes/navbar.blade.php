<div class="sidebar-wrapper" data-simplebar="true" style="background: linear-gradient(180deg, #8B0000 0%, #c0392b 60%, #922b21 100%)">
    <div class="sidebar-header" style="background: linear-gradient(135deg, #7B0000 0%, #a93226 100%); border-bottom: 1px solid rgba(255,255,255,0.15);">
        <div class="logo-wrapper d-flex align-items-center justify-content-center w-100">
            <img src="{{ asset('images/logoeng.jpeg') }}" alt="Thennadu Matrimony Logo" class="sidebar-logo-img" style="max-height:46px; max-width:200px; object-fit:contain; border-radius:6px;">
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu" style="background: transparent;">
        <li>
            <a href="/dashboard" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>

        </li>
        <li class="menu-label">Menus</li>
        {{-- @dd(Request::path()) --}}
        @if ($menus)
            @php
                $hide_menus = ['Premium Profiles', 'Profile Images', 'Profile Videos', 'Horoscope & Document','Messages','User Permission', 'Banner Images', 'Match Maker Details', 'View Profile', 'Profile Request', 'Youtube Videos', 'Testimonials', 'Offers', 'Vendors','Dynamic Banners', 'User Logs'];
            @endphp
            @foreach ($menus as $nav)
                @if (in_array($nav->mainmenu, $hide_menus))
                    @continue
                @endif
                <li class="{{ Request()->is($nav->menulink) ? 'activesidebar' : '' }}">
                    <a href="{{ url($nav->menulink) }}">
                        <div class="parent-icon"><i class="{{ $nav->menuicon }}"></i>
                        </div>
                        <div class="menu-title">{{ $nav->mainmenu }}</div>
                    </a>
                </li>
            @endforeach
        @endif
        
        <li class="{{ Request()->is('banners*') ? 'activesidebar' : '' }}">
            <a href="{{ url('banners') }}">
                <div class="parent-icon"><i class="bx bx-image-add"></i>
                </div>
                <div class="menu-title">Dynamic Banners</div>
            </a>
        </li>

        <li class="{{ Request()->is('admin/interests*') ? 'activesidebar' : '' }}">
            <a href="{{ url('admin/interests') }}">
                <div class="parent-icon"><i class="bx bxs-heart"></i>
                </div>
                <div class="menu-title">Interest Requests</div>
            </a>
        </li>

        <li class="{{ Request()->is('success-stories*') ? 'activesidebar' : '' }}">
            <a href="{{ url('success-stories') }}">
                <div class="parent-icon"><i class="bx bx-award"></i>
                </div>
                <div class="menu-title">Success Stories</div>
            </a>
        </li>

        <li class="{{ Request()->is('services*') ? 'activesidebar' : '' }}">
            <a href="{{ url('services') }}">
                <div class="parent-icon"><i class="bx bx-briefcase"></i>
                </div>
                <div class="menu-title">Wedding Services</div>
            </a>
        </li>

        <li class="{{ Request()->is('service-bookings*') ? 'activesidebar' : '' }}">
            <a href="{{ url('service-bookings') }}">
                <div class="parent-icon"><i class="bx bx-calendar-check"></i>
                </div>
                <div class="menu-title">Service Bookings</div>
            </a>
        </li>

        <li class="{{ Request()->is('astro-bookings*') ? 'activesidebar' : '' }}">
            <a href="{{ url('astro-bookings') }}">
                <div class="parent-icon"><i class="bx bxs-component"></i>
                </div>
                <div class="menu-title">Astro Consultations</div>
            </a>
        </li>

        <li class="{{ Request()->is('contact-enquiries*') ? 'activesidebar' : '' }}">
            <a href="{{ url('contact-enquiries') }}">
                <div class="parent-icon"><i class="bx bx-envelope"></i>
                </div>
                <div class="menu-title">Contact Enquiries</div>
            </a>
        </li>

        <!-- <li class="{{ Request()->is('chat*') ? 'activesidebar' : '' }}">
            <a href="{{ url('chat') }}">
                <div class="parent-icon"><i class="bx bx-message-rounded-dots"></i>
                </div>
                <div class="menu-title d-flex justify-content-between align-items-center w-100">
                    Messages
                    @php
                        $unreadCount = \App\Models\Message::whereHas('conversation', function($q) {
                            $q->where('user_one', auth()->id())->orWhere('user_two', auth()->id());
                        })->where('sender_id', '!=', auth()->id())->where('is_read', false)->count();
                    @endphp
                    @if($unreadCount > 0)
                        <span class="badge bg-danger rounded-pill">{{ $unreadCount }}</span>
                    @endif
                </div>
            </a>
        </li> -->

        @if(auth()->user()->role == 1 || auth()->user()->role == 2)
        <li class="{{ Request()->is('admin/chat*') ? 'activesidebar' : '' }}">
            <a href="{{ url('admin/chat') }}">
                <div class="parent-icon"><i class="bx bx-shield-quarter"></i>
                </div>
                <div class="menu-title">Chat Moderation</div>
            </a>
        </li>
        @endif

        {{-- <li>
            <a href="/profiles">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">All Profiles</div>
            </a>
        </li>
        <li>
            <a href="/packages">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">Packages</div>
            </a>
        </li>
        <li>
            <a href="/newprofiles">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">New Profiles</div>
            </a>
        </li>

        <li>
            <a href="/profile-images">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">Profiles Images</div>
            </a>
        </li>
        <li>
            <a href="/">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">Profiles Videos</div>
            </a>
        </li>
        <li>
            <a href="/horoscopeimg">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">Horoscope Images</div>
            </a>
        </li>

        <li>
            <a href="/broker">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">Create Profile</div>
            </a>
        </li>
        <li>
            <a href="/brokers">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">Brokers Details</div>
            </a>
        </li>
        <li>
            <a href="/brokersview">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">View Profiles</div>
            </a>
        </li>

        <li>
            <a href="{{route('broker.show',auth()->user()->id)}}">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">Payment Request</div>
            </a>
        </li>

        <li>
            <a href="/caste">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">Caste</div>
            </a>
        </li>
        <li>
            <a href="/subcaste">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">SubCaste</div>
            </a>
        </li>
        <li>
            <a href="/banner">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">Banner Image</div>
            </a>
        </li>
        <li>
            <a href="user-profile.html">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">Report Data</div>
            </a>
        </li>
        <li>
            <a href="user-profile.html">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">Profile Request</div>
            </a>
        </li>
        <li>
            <a href="/matches">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">Matches</div>
            </a>
        </li>
        <li>
            <a href="/tracking">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">Profile Tracking</div>
            </a>
        </li>
        <li>
            <a href="/users">
                <div class="parent-icon"><i class="bx bx-user-circle"></i>
                </div>
                <div class="menu-title">User Permission</div>
            </a>
        </li> --}}


    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
<!--start header -->
<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>

            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item mobile-search-icon">
                        <a class="nav-link" href="#"> <i class='bx bx-search'></i>
                        </a>
                    </li>

                    <li class="nav-item dropdown dropdown-large">

                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                            role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                            @if ($adminnotification->count() > 0)
                                <span class="alert-count">{{ $adminnotification->count() }}</span>
                            @endif
                            <i class='bx bx-bell'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" style="min-width: 320px; right: 0 !important; left: auto !important;">
                            <div class="msg-header d-flex align-items-center justify-content-between p-3 border-bottom">
                                <h6 class="msg-header-title mb-0">Notifications</h6>
                                @if ($adminnotification->count() > 0)
                                    <a href="{{ url('navbar') }}" class="msg-header-clear text-decoration-none font-13 text-primary">Mark all as read</a>
                                @endif
                            </div>
                            <div class="header-notifications-list">

                                @if ($adminnotification && $adminnotification->count() > 0)

                                    @foreach ($adminnotification as $not)
                                        <a class="dropdown-item border-bottom" href="{{ url('navbar/' . $not->id) }}">
                                            <div class="d-flex align-items-center">
                                                <div class="notify bg-light-primary text-primary">
                                                    <i class="bx bx-user-plus"></i>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="msg-name mb-0 font-14">{{ $not->title }} <span class="msg-time float-end text-muted font-11">{{ $not->created_at ? \Carbon\Carbon::parse($not->created_at)->diffForHumans() : '' }}</span></h6>
                                                    <p class="msg-info mb-0 font-13 text-secondary">{{ $not->description }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    <div class="text-center py-4 text-muted">
                                        <i class="bx bx-bell-off fs-3 mb-2"></i>
                                        <p class="mb-0">No new notifications</p>
                                    </div>
                                @endif

                            </div>

                        </div>
                    </li>

                </ul>
            </div>
            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../assets/images/avatars/user.png" class="user-img" alt="user avatar">
                    <div class="user-info ps-3" style="display: none;">
                        <p class="user-name mb-0 text-white">{{ auth()->user()->name }}</p>
                        <p class="designattion mb-0 text-white">
                            @if (auth()->user()->role == 1)
                                Admin
                            @elseif (auth()->user()->role == 2)
                                Office Staff
                            @elseif (auth()->user()->role == 3)
                                Broker
                            @endif
                        </p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">

                    <li><a class="dropdown-item" href="{{ url('/logout') }}"><i
                                class='bx bx-log-out-circle'></i><span>Logout</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>




