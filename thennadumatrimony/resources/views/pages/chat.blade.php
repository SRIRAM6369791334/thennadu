@extends('layout.default')

@section('content')
<div class="dashboard-wrapper py-5" style="background: #f8f9fa;">
    <div class="container">
        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-md-4 col-lg-3">
                @include('layout.dashboard_sidebar')
            </div>

            <!-- Right Content: Chat Interface -->
            <div class="col-md-8 col-lg-9">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white chat-main-container">
                    <div class="row g-0 h-100">
                        <!-- Chat List Panel -->
                        <div class="col-md-4 border-end h-100 d-flex flex-column chat-list-panel">
                            <div class="p-3 border-bottom bg-light">
                                <h5 class="serif-font mb-0 text-dark">Messages</h5>
                            </div>
                            <div class="p-3">
                                <div class="position-relative">
                                    <input type="text" class="form-control rounded-pill border-0 ps-4 bg-light small" placeholder="Search matches...">
                                    <i class="fas fa-search position-absolute top-50 translate-middle-y start-0 ms-3 text-muted" style="font-size: 0.8rem;"></i>
                                </div>
                            </div>
                            <div class="chat-list overflow-auto flex-grow-1">
                                @for($i = 1; $i <= 5; $i++)
                                <div class="chat-item d-flex align-items-center p-3 cursor-pointer {{ $i == 1 ? 'active' : '' }}" onclick="toggleChatView()">
                                    <div class="position-relative me-3 flex-shrink-0">
                                        <img src="{{ asset('assets/images/matri/user.png') }}" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                        <div class="status-indicator online"></div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <h6 class="mb-0 text-truncate x-small fw-bold">Priya Shankari {{ $i }}</h6>
                                            <span class="xx-small text-muted">10:45 AM</span>
                                        </div>
                                        <p class="text-muted xx-small mb-0 text-truncate">Hello, I reviewed your profile and...</p>
                                    </div>
                                    @if($i == 1)
                                        <div class="bg-maroon rounded-circle ms-2" style="width: 8px; height: 8px;"></div>
                                    @endif
                                </div>
                                @endfor
                            </div>
                        </div>

                        <!-- Chat Conversation Panel -->
                        <div class="col-md-8 h-100 d-flex flex-column chat-conversation-panel">
                            <!-- Chat Header -->
                            <div class="p-3 border-bottom d-flex justify-content-between align-items-center bg-white sticky-top">
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-link d-md-none text-maroon me-2 p-0" onclick="toggleChatView()">
                                        <i class="fas fa-arrow-left"></i>
                                    </button>
                                    <div class="position-relative me-3 flex-shrink-0">
                                        <img src="{{ asset('assets/images/matri/user.png') }}" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                        <div class="status-indicator online"></div>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 x-small fw-bold">Priya Shankari</h6>
                                        <span class="xx-small text-success">Online Now</span>
                                    </div>
                                </div>
                                <div class="d-flex gap-2 gap-md-3">
                                    <button class="btn btn-link text-muted p-0 d-none d-sm-inline-block"><i class="fas fa-phone-alt"></i></button>
                                    <button class="btn btn-link text-muted p-0 d-none d-sm-inline-block"><i class="fas fa-video"></i></button>
                                    <div class="dropdown">
                                        <button class="btn btn-link text-muted p-0" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm small">
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> View Profile</a></li>
                                            <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-ban me-2"></i> Block User</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Chat Messages Area -->
                            <div class="chat-messages p-3 p-md-4 overflow-auto flex-grow-1 bg-light bg-opacity-50">
                                <div class="text-center mb-4">
                                    <span class="badge bg-white text-muted px-3 py-1 rounded-pill shadow-xs xx-small fw-normal">Today, Oct 24</span>
                                </div>

                                <div class="message-received mb-4 d-flex">
                                    <div class="message-content p-3 bg-white shadow-sm rounded-4 rounded-tl-0 x-small max-w-85 max-w-md-75">
                                        Hello Navin! I saw your profile and really liked your interests. My family is also looking for someone with a similar background.
                                        <div class="text-end xx-small text-muted mt-1">10:42 AM</div>
                                    </div>
                                </div>

                                <div class="message-sent mb-4 d-flex justify-content-end">
                                    <div class="message-content p-3 bg-maroon text-white shadow-sm rounded-4 rounded-tr-0 x-small max-w-85 max-w-md-75">
                                        Hello Priya, thank you! I am glad to hear that. I checked your profile as well and find it very compatible.
                                        <div class="text-end xx-small text-white-50 mt-1">10:45 AM <i class="fas fa-check-double ms-1"></i></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Chat Input Area -->
                            <div class="p-2 p-md-3 border-top bg-white">
                                <div class="d-flex align-items-center gap-2 gap-md-3">
                                    <button class="btn btn-light rounded-circle shadow-sm d-none d-md-flex align-items-center justify-content-center" style="width: 40px; height: 40px;"><i class="fas fa-plus text-maroon"></i></button>
                                    <div class="flex-grow-1 position-relative">
                                        <input type="text" class="form-control rounded-pill border-0 bg-light px-3 px-md-4 py-2 small" placeholder="Type message...">
                                        <button class="btn btn-link position-absolute top-50 translate-middle-y end-0 me-2 p-0 text-muted d-none d-md-inline-block"><i class="far fa-smile fs-5"></i></button>
                                    </div>
                                    <button class="btn btn-maroon rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;"><i class="fas fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleChatView() {
        if (window.innerWidth < 768) {
            const listPanel = document.querySelector('.chat-list-panel');
            const convPanel = document.querySelector('.chat-conversation-panel');
            
            if (listPanel.classList.contains('d-none')) {
                listPanel.classList.remove('d-none');
                convPanel.classList.remove('active');
            } else {
                listPanel.classList.add('d-none');
                convPanel.classList.add('active');
            }
        }
    }

    // Ensure correct state on load and resize
    function handleResize() {
        const listPanel = document.querySelector('.chat-list-panel');
        const convPanel = document.querySelector('.chat-conversation-panel');
        if (window.innerWidth >= 768) {
            listPanel.classList.remove('d-none');
            convPanel.classList.remove('active');
        }
    }
    window.addEventListener('resize', handleResize);
</script>

<style>
    .chat-main-container { height: 700px; }
    @media (max-width: 767px) {
        .chat-main-container { height: calc(100vh - 180px); }
        .chat-conversation-panel { display: none; }
        .chat-conversation-panel.active { display: flex !important; width: 100% !important; }
    }

    .chat-item { border-left: 4px solid transparent; transition: all 0.2s ease; }
    .chat-item:hover { background-color: #fcecef; }
    .chat-item.active { background-color: #fdf2f5; border-left-color: #900C3F; }
    .cursor-pointer { cursor: pointer; }
    .xx-small { font-size: 0.65rem; }
    .x-small { font-size: 0.85rem; }
    .max-w-75 { max-width: 75%; }
    .max-w-85 { max-width: 85%; }
    .rounded-tl-0 { border-top-left-radius: 0 !important; }
    .rounded-tr-0 { border-top-right-radius: 0 !important; }
    .text-maroon { color: #900C3F !important; }
    .bg-maroon { background-color: #900C3F !important; }
    .shadow-xs { box-shadow: 0 1px 3px rgba(0,0,0,0.05); }

    .chat-messages::-webkit-scrollbar, .chat-list::-webkit-scrollbar { width: 4px; }
    .chat-messages::-webkit-scrollbar-thumb, .chat-list::-webkit-scrollbar-thumb { background: #ddd; border-radius: 10px; }
    
    .status-indicator {
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: 2px solid #fff;
        background-color: #28a745;
    }
</style>
@endsection
