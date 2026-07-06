<div class="dashboard-sidebar-container mb-4">
    <!-- Mobile Dashboard Header -->
    <div class="d-lg-none bg-white p-3 rounded-4 shadow-sm mb-3 border-0">
        <div class="d-flex align-items-center gap-3">
            @php
                $mainImage = $images->where('image_status', 'Main')->first();
                $imagePath = $mainImage ? asset('uploads/' . $mainImage->image_name) : asset('assets/images/matri/user.png');
            @endphp
            <img src="{{ $imagePath }}" alt="User" class="rounded-circle border border-2 border-maroon" style="width: 50px; height: 50px; object-fit: cover;">
            <div>
                <h6 class="serif-font mb-0 text-dark small fw-bold">{{ auth()->user()->Name }}</h6>
                <p class="text-muted xx-small mb-0">ID: {{ auth()->user()->varan_id }}</p>
            </div>
            <div class="ms-auto">
                <span class="badge bg-success bg-opacity-10 text-success rounded-pill xx-small">Online</span>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <div class="dashboard-sidebar rounded-4 shadow-sm border-0 bg-white overflow-hidden">
        <div class="sidebar-user-brief p-4 text-center border-bottom bg-light d-none d-lg-block">
            <div class="position-relative d-inline-block mb-3">
                <img src="{{ $imagePath }}" alt="User" class="rounded-circle border border-3 border-white shadow-sm" style="width: 80px; height: 80px; object-fit: contain;">
                <div class="status-indicator online"></div>
            </div>
            <h6 class="serif-font mb-0 text-dark">{{ auth()->user()->Name }}</h6>
            <p class="text-muted small mb-0">ID: {{ auth()->user()->varan_id }}</p>
        </div>
        <div class="sidebar-menu py-lg-3 d-flex d-lg-block overflow-auto custom-scrollbar-hidden">
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-th-large"></i> <span>Dashboard</span>
            </a>
            @php
                $sessionUser = auth()->user();
                $actualUser = \App\Models\User::where('email', $sessionUser->email ?? $sessionUser->email_id)->first();
                $unreadCount = 0;
                if ($actualUser) {
                    $unreadCount = \App\Models\Message::whereHas('conversation', function($query) use ($actualUser) {
                        $query->where('user_one', $actualUser->id)->orWhere('user_two', $actualUser->id);
                    })->where('sender_id', '!=', $actualUser->id)->where('is_read', false)->count();
                }
            @endphp
            <a href="{{ route('chat.index') }}" class="sidebar-link {{ request()->routeIs('chat.*') ? 'active' : '' }}">
                <i class="fa-solid fa-comment-dots"></i> <span>Messages</span>
                @if($unreadCount > 0)
                    <span class="badge bg-danger rounded-pill d-none d-lg-inline-block ms-auto small">{{ $unreadCount }}</span>
                @endif
            </a>
            <a href="{{ route('dashboard.matches') }}" class="sidebar-link {{ request()->routeIs('dashboard.matches') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i> <span>Matches</span>
            </a>
            <a href="{{ route('dashboard.interests') }}" class="sidebar-link {{ request()->routeIs('dashboard.interests') ? 'active' : '' }}">
                <i class="fa-solid fa-paper-plane"></i> <span>Interests</span>
            </a>
            <a href="{{ route('dashboard.visitors') }}" class="sidebar-link {{ request()->routeIs('dashboard.visitors') ? 'active' : '' }}">
                <i class="fa-solid fa-eye"></i> <span>Visitors</span>
            </a>
            {{-- <a href="{{ route('dashboard.shortlist') }}" class="sidebar-link {{ request()->routeIs('dashboard.shortlist') ? 'active' : '' }}">
                <i class="fa-solid fa-star"></i> <span>Shortlist</span>
            </a> --}}
            @php
                $activePackage = $activePackage ?? \App\Models\UserPackage::where('user_varan_id', auth()->user()->varan_id)
                    ->where('status', 1)
                    ->where('validity_date', '>', now())
                    ->first();
            @endphp
            <a href="{{ route('plans.index') }}" class="sidebar-link {{ $activePackage ? 'text-success' : 'text-warning' }} bg-dark bg-opacity-10">
                <i class="fa-solid fa-crown"></i> <span>{{ $activePackage ? $activePackage->package_name : 'Membership' }}</span>
            </a>
            <div class="d-none d-md-block">
                <a href="#" class="sidebar-link" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                    <i class="fa-solid fa-user-edit"></i> <span>Edit Profile</span>
                </a>
                <hr class="mx-4 my-2 opacity-50">
                <form action="{{ route('logout') }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit" class="sidebar-link text-danger border-0 bg-transparent w-100 text-start">
                        <i class="fa-solid fa-sign-out-alt"></i> <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .xx-small { font-size: 0.65rem; }
    .sidebar-link {
        display: flex;
        align-items: center;
        padding: 12px 25px;
        color: #555;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        font-size: 0.95rem;
        white-space: nowrap;
    }
    .sidebar-link i {
        width: 25px;
        text-align: center;
        color: #900C3F;
        margin-right: 15px;
        font-size: 1.1rem;
    }
    .sidebar-link:hover {
        background-color: #fcecef;
        color: #900C3F;
    }
    .sidebar-link.active {
        background-color: #900C3F;
        color: #fff !important;
    }
    .sidebar-link.active i {
        color: #fff !important;
    }
    .status-indicator {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 15px;
        height: 15px;
        border-radius: 50%;
        border: 2px solid #fff;
    }
    .status-indicator.online { background-color: #28a745; }

    @media (max-width: 767px) {
        .dashboard-sidebar-container {
            position: sticky;
            top: 70px;
            z-index: 900;
        }
        .sidebar-menu {
            padding: 5px;
        }
        .sidebar-link {
            padding: 10px 15px;
            flex-direction: column;
            justify-content: center;
            font-size: 0.7rem;
            border-radius: 12px;
            margin: 0 5px;
        }
        .sidebar-link i {
            margin-right: 0;
            margin-bottom: 5px;
            font-size: 1rem;
        }
        .sidebar-link span {
            font-weight: 600;
        }
        .custom-scrollbar-hidden::-webkit-scrollbar {
            display: none;
        }
        .custom-scrollbar-hidden {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    }
</style>
