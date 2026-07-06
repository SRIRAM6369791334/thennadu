@extends('layout.default')

@section('content')
<div class="info-page py-5" style="background: #fcfcfc;">
    <div class="container py-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5">
                    <h1 class="serif-font text-maroon mb-4 fw-bold border-bottom pb-3">Privacy Policy</h1>
                    
                    <div class="info-content text-muted" style="line-height: 1.8;">
                        <p class="lead text-dark mb-4">At Thennadu Matrimony, we prioritize the privacy and security of our members. This policy outlines how we collect, use, and protect your information.</p>
                        
                        <h4 class="text-dark mt-5 mb-3">1. Information Collection</h4>
                        <p>We collect information you provide directly to us during registration, including your name, contact details, date of birth, religion, and family details. This is necessary to facilitate matchmaking and ensure the authenticity of profiles.</p>
                        
                        <h4 class="text-dark mt-5 mb-3">2. Data Usage</h4>
                        <p>Your data is used to suggest matches, communicate with you about your account, and improve our services. We do not sell or rent your personal information to third parties for marketing purposes.</p>
                        
                        <h4 class="text-dark mt-5 mb-3">3. Profile Visibility</h4>
                        <p>By default, your profile is visible to other registered members who meet your criteria. You have controls to restrict visibility or blur your profile picture as per your comfort.</p>
                        
                        <h4 class="text-dark mt-5 mb-3">4. Cookies and Tracking</h4>
                        <p>We use cookies to maintain your session, remember your preferences, and analyze site usage. These cookies are essential for the core functionality of our website.</p>
                        
                        <h4 class="text-dark mt-5 mb-3">5. Data Security</h4>
                        <p>We implement advanced industry-standard security measures to protect your data from unauthorized access, disclosure, or destruction. However, no internet transmission is 100% secure.</p>
                        
                        <h4 class="text-dark mt-5 mb-3">6. Account Deletion</h4>
                        <p>You can request to delete your account at any time through the dashboard. Once deleted, your personal data will be purged from our active databases within 30 days.</p>
                        
                        <div class="last-updated mt-5 p-3 bg-light rounded-3 text-center">
                            <small>Last Updated: March 2024</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.text-maroon { color: #900C3F !important; }
.serif-font { font-family: 'Playfair Display', serif; }
</style>
@endsection
