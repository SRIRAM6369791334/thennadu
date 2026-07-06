@extends('layout.default')

@section('content')
<div class="info-page py-5" style="background: #fafafa;">
    <div class="container py-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5 text-center mb-5" style="background: linear-gradient(135deg, #900C3F, #7a0a35); color: #fff;">
                    <i class="fas fa-shield-halved fa-4x mb-4 text-warning"></i>
                    <h1 class="serif-font mb-3 fw-bold">Your Safety is Our Priority</h1>
                    <p class="lead mb-0 fs-4">Follow these essential tips to ensure a safe and secure matchmaking experience on Thennadu Matrimony.</p>
                </div>
                
                <div class="row g-4 text-muted" style="line-height: 1.8;">
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm rounded-4 p-4 scroll-reveal">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-circle bg-maroon-light me-3"><i class="fas fa-eye-slash text-maroon"></i></div>
                                <h4 class="text-dark mb-0 fw-bold">1. Guard Your Identity</h4>
                            </div>
                            <p>Avoid sharing highly sensitive personal information like your home address, workplace, or ID numbers during the early stages of conversation.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm rounded-4 p-4 scroll-reveal">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-circle bg-maroon-light me-3"><i class="fas fa-money-bill-transfer text-maroon"></i></div>
                                <h4 class="text-dark mb-0 fw-bold">2. Never Send Money</h4>
                            </div>
                            <p>Never send money or share bank details with anyone you meet online, regardless of the story or emergency they present. Report any such requests immediately.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm rounded-4 p-4 scroll-reveal">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-circle bg-maroon-light me-3"><i class="fas fa-map-location-dot text-maroon"></i></div>
                                <h4 class="text-dark mb-0 fw-bold">3. First Meetings in Public</h4>
                            </div>
                            <p>For your first meeting, always choose a busy public place like a cafe or mall. Inform your family or friends about the location and time of your meeting.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm rounded-4 p-4 scroll-reveal">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-circle bg-maroon-light me-3"><i class="fas fa-user-check text-maroon"></i></div>
                                <h4 class="text-dark mb-0 fw-bold">4. Verify Before Finalizing</h4>
                            </div>
                            <p>Don't rush. Conduct thorough family and background checks before committing to a marriage. Ask for references and take your time to build trust.</p>
                        </div>
                    </div>
                    
                    <div class="col-lg-12">
                        <div class="card border-0 shadow-sm rounded-4 p-4 text-center mt-4">
                            <h4 class="text-dark mb-3 fw-bold"><i class="fas fa-flag text-danger me-2"></i> Report Suspicious Activity</h4>
                            <p>If you encounter a profile that seems fake, abusive, or suspicious, use the "Report Profile" feature immediately or contact our support team at <a href="mailto:support@thennadumatrimony.com" class="text-maroon fw-bold">support@thennadumatrimony.com</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.text-maroon { color: #900C3F !important; }
.bg-maroon-light { background: rgba(144, 12, 63, 0.1); }
.serif-font { font-family: 'Playfair Display', serif; }
.icon-circle {
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 1.2rem;
}
</style>
@endsection
