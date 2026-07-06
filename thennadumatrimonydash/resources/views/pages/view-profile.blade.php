@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Dashboard')
@section('main-content')

<div class="page-wrapper" style="margin-top:0px">
			<div class="page-content" style="padding-top:60px;background-image:url('');background-size:cover;background-attachment:fixed;background-repeat:no-repeat">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">User Profile</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">User Profile</li>
							</ol>
						</nav>
					</div>

				</div>
				<!--end breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">
							<div class="col-lg-4">
								<div class="card">
									<div class="card-body">
										<div class="d-flex flex-column align-items-center text-center">
                                            {{-- <img src="{{asset('public/images/'.$register->job_category)}}" class="rounded-circle p-1 bg-primary" width="110"> --}}
                                            
                                            @if($viewid->image_name != "")
											<img src="{{ $mainUrl }}/{{$viewid->image_name}}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
											@else
                                                @php
                                                    $fallback = ($register->Gender == 2) ? 'women 2.png' : 'men2.png';
                                                    $baseUrl = str_replace('/uploads', '', $mainUrl);
                                                @endphp
											    <img src="{{ $baseUrl }}/assets/images/matri/{{ $fallback }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
											@endif
											<div class="mt-3">
											    
												<h4>{{$register->Name}}</h4>
												<!--<p class="text-secondary mb-1">{{$register->job_category}}</p>-->
												<p class="text-muted font-size-sm">{{$viewid->city_name}}, {{$viewid->state_name}}</p>
												<p class="text-muted font-size-sm">{{$register->varan_id}}</p>

                                                <div class="verification-wrap mb-3">
                                                    <h6 class="text-uppercase small fw-bold text-muted mb-2">Live Verification Selfie</h6>
                                                    @if(isset($selfie) && $selfie->image_name)
                                                        <img src="{{ $mainUrl }}/{{$selfie->image_name}}" alt="Selfie" class="img-thumbnail" width="150" style="border: 3px solid #00c853;">
                                                        <div class="badge bg-success mt-1"><i class="bx bx-check-shield"></i> Live Captured</div>
                                                    @else
                                                        <div class="alert alert-light border small text-muted">
                                                            <i class="bx bx-camera-off"></i> No Selfie Available
                                                        </div>
                                                    @endif
                                                </div>

												<button class="btn btn-primary">
                                                    @if($register->member_shiptype == 1)
                                                        Premium Profile
                                                        @else
                                                        Regular Profile
                                                    @endif
                                                </button>
                                                @if ($register->status == '1')
                                                <button class="status btn btn-success" id="{{$register->varan_id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Approval</button>

                                            @elseif ($register->status == '2')
                                            <button class="status btn btn-danger" id="{{$register->varan_id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Reject</button>

                                        @else
                                        <button class="status btn btn-warning" id="{{$register->varan_id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Pending</button>

                                       @endif


											</div>
										</div>
										<hr class="my-4" />
										<ul class="list-group list-group-flush">
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0">Mobile No</h6>
												<span class="text-secondary">{{$register->mobile_no}}</span>
											</li>
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0">E-mail ID</h6>
												<span class="text-secondary">{{$register->email_id}}</span>
											</li>
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0">Whatsapp</h6>
												<span class="text-secondary">{{$register->whatsapp_no}}</span>
											</li>
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												@if($viewid->package_name)
    												@if($current_date <= $viewid->validity_date)
    												<h6 class="mb-0">Package Name</h6>
    												<span class="text-secondary">{{$viewid->package_name}}</span>
    												@else
    												<h6 class="mb-0">Package</h6>
    												<span class="text-secondary text-danger">Package Expired({{$viewid->package_name}})</span>
    												@endif
    											@else
    											<h6 class="mb-0">Package Name</h6>
    											<span class="text-secondary">Not Found</span>
    											@endif
											</li>
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
											    @if($viewid->package_name)
											        @if($current_date <= $viewid->validity_date)
        												<h6 class="mb-0">Balance Image Upload</h6>
        												@if($current_date <= $viewid->validity_date)
        												<span class="text-secondary">{{$result}}</span>
        												@else
        												<span class="text-secondary">0</span>
        												@endif
        											@endif
    											@endif
											</li>
										</ul>
									</div>
								</div>
								
								<!-- Horoscope view -->
								
								<div class="card" >
									<div class="card-body text-center">
									    <h5 class="text-center">Horoscope Image</h5>
									    @if($viewid->horo_title == 'Horoscope')
									    <img src="{{ $mainUrl }}/{{$viewid->horo_img}}" class="my-3" width="150">
									    @else
									    <h5 class="mb-4">Image Not Found</h5>
									    @endif
									    
									    @if ($viewid->video_name != '')
										<h5>Video : <a target="_blank" href="{{ $mainUrl }}/{{$viewid->video_name}}">Video Link</a></h5> 
										@else
										<h5>Video Not Found</h5> 
										@endif
									</div>
								</div>

                                <!-- Photo Gallery Section -->
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-center mb-3">Photo Gallery</h5>
                                        <div class="row g-2">
                                            @if(isset($all_images) && count($all_images) > 0)
                                                @foreach($all_images as $img)
                                                    <div class="col-6">
                                                        <div class="gallery-item-wrap text-center border rounded p-1">
                                                            <img src="{{ $mainUrl }}/{{ $img->image_name }}" class="img-fluid rounded" style="height: 100px; object-fit: cover; width: 100%;">
                                                            <span class="badge {{ $img->image_status == 'Main' ? 'bg-primary' : ($img->image_status == 'Selfie' ? 'bg-success' : 'bg-secondary') }} mt-1" style="font-size: 0.7rem;">
                                                                {{ $img->image_status }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-12 text-center text-muted py-3">No gallery images</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

								@if(Auth::user()->role == 1)
								    <div class="card" >
    									<div class="card-body text-center">
    									    <h5 class="text-center">Package Validity</h5>
    									   @if($viewid->validity_date != '' || $viewid->validity_date != null)
    									        @if($current_date <= $viewid->validity_date)
            										<h5 class="text-secondary mb-3">{{date('d-m-Y',strtotime($viewid->package_start))}} to {{date('d-m-Y',strtotime($viewid->validity_date))}}</h5>
    									        @endif
    									   @else
    									        <h6 class="mb-0">No Package Found</h6>
    									   @endif
    									   
    									   <h5 class="text-center">Biography Count</h5>
    									   <p>Total Count : {{ $totalycount }}</p>
    									   <p>Current Package Biography Count : {{ $bioviewcount }}</p>
    									   <p>Current Package Biography Viewed : {{ $totalbioviewed }}</p>
    									</div>
    								</div>
								    <div class="card">
								        <div class="card-body">
								            <h5 class="text-center">Broker ID and Name</h5>
								            <div class="text-center mt-4">
								                @if($viewid->brokerid != 0)
								                <h6>{{ $viewid->brokerid }} - {{ $viewid->brokername }}</h6>
								                @endif
								            </div>
								        </div>
								    </div>
								    
								    <div class="card">
								        <div class="card-body">
								            <h5 class="text-center">Profile Tracking</h5>
								            <div class="text-center mt-4">
								                <a href="/trackingprofile/{{ $register->varan_id }}" class="btn btn-success" style="width:250px;">View</a>
								            </div>
								        </div>
								    </div>
								@endif
							</div>
							<div class="col-lg-8">
								<div class="card">
									<div class="card-body">
									    <h5 class="mb-4">Basic Details</h5>
										    <div class="row">
											<div class="col-sm-3">
												<h6 class="mb-0">Full Name</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$register->Name}}" readonly/>
											</div>
											</div>
											<div class="row mb-3 mt-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Created For</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$register->created_for}}" readonly/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Gender</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$register->Gender}}" readonly/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Date Of Birth</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$register->dob}}" readonly/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Age</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$register->age}}" readonly/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Mother Tongue</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="@if($register->Monther_tongue == '1') Tamil @elseif($register->Monther_tongue == '2') English @elseif($register->Monther_tongue == '3') Kannadam @elseif($register->Monther_tongue == '4') Malayalam @elseif( $register->Monther_tongue == '5') Thelungu @endif" readonly/>
											</div>
											</div>
												<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Body Type</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->btype}}" readonly/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Physical Status</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->phy_name}}" readonly/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Complexion</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->com_name}}" readonly/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Height</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->height_name}}" readonly/>
											</div>
											</div>
											<div class="row mb-3">
    											<div class="col-sm-3">
    												<h6 class="mb-0">Marital Status</h6>
    											</div>
    											<div class="col-sm-9 text-secondary">
    												<input type="text" class="form-control" value="{{$viewid->matrial_name}}" readonly/>
    											</div>
											</div>

											<div class="row mb-3">
    											<div class="col-sm-3">
    												<h6 class="mb-0">Eating Habit</h6>
    											</div>
    											<div class="col-sm-9 text-secondary">
    												<input type="text" class="form-control" value="{{$viewid->eating_habit}}" readonly/>
    											</div>
											</div>

										</div>



									</div>

								<div class="card">
									<div class="card-body">
									    <h5 class="mb-4">Religion Details</h5>
										    <div class="row">
											<div class="col-sm-3">
												<h6 class="mb-0">Religion</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->religion_name}}" readonly/>
											</div>
											</div>
											<div class="row mb-3 mt-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Caste</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->Caste_name}}" readonly/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Sub Caste</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->subcategory_name}}" readonly/>
											</div>
											</div>



											</div>

										</div>

								<div class="card">
									<div class="card-body">
									    <h5 class="mb-4">Location Details</h5>
										    <div class="row">
											<div class="col-sm-3">
												<h6 class="mb-0">Address</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->com_address}}" readonly/>
											</div>
											</div>
											<div class="row mb-3 mt-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Country</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->country_name}}" readonly/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">State</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->state_name}}" readonly/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">District</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->city_name}}" readonly/>
											</div>
											</div>




											</div>

										</div>

								<div class="card">
									<div class="card-body">
									    <h5 class="mb-4">Professional Details</h5>
										    <div class="row">
											<div class="col-sm-3">
												<h6 class="mb-0">Education</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->eduname}}" readonly/>
											</div>
											</div>
											<div class="row mb-3 mt-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Education Detail</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->eduction_detail}}" readonly/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Job Category</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->name}}" readonly/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Job in Detail</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->job_detail}}" readonly/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Work Country</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->jobcountry}}" readonly/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Work State</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->jobstate}}" readonly/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Work City</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->jobcity}}" readonly/>
											</div>
											</div>
											<!--<div class="row mb-3">-->
											<!--<div class="col-sm-3">-->
											<!--	<h6 class="mb-0">Work City</h6>-->
											<!--</div>-->
											<!--<div class="col-sm-9 text-secondary">-->
											<!--	<input type="text" class="form-control" value="{{$viewid->city_name}}" readonly/>-->
											<!--</div>-->
											<!--</div>-->
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Annual Income</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->salary}}" readonly/>
											</div>
											</div>



											</div>

										</div>

								<div class="card">
									<div class="card-body">
									    <h5 class="mb-4">Family Details</h5>
										    <div class="row">
											<div class="col-sm-4">
												<h6 class="mb-0">Father Name</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->father_name}}" readonly/>
											</div>
											</div>
											<div class="row mb-3 mt-3">
											<div class="col-sm-4">
												<h6 class="mb-0">Father Job</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->father_occuption}}" readonly/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-4">
												<h6 class="mb-0">Mother Name</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->mother_name}}" readonly/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-4">
												<h6 class="mb-0">Mother Job</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->mother_occuption}}" readonly/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-4">
												<h6 class="mb-0">No Of Siblings</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->total_sibblings}}" readonly/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-4">
												<h6 class="mb-0">No of Elder Sister</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->elder_sister}}" readonly/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-4">
												<h6 class="mb-0">No of Younger Sister</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->younger_sister}}" readonly/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-4">
												<h6 class="mb-0">No of Elder Brother</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->elder_brother}}" readonly/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-4">
												<h6 class="mb-0">No of Younger Brother</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->younger_brother}}" readonly/>
											</div>
											</div>



											</div>

										</div>

								<div class="card">
									<div class="card-body">
									    <h5 class="mb-4">Horoscope Details</h5>
										    <div class="row">
											<div class="col-sm-4">
												<h6 class="mb-0">Zodiac</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->rasi}}" readonly/>
											</div>
											</div>
											<div class="row mb-3 mt-3">
											<div class="col-sm-4">
												<h6 class="mb-0">Laknam</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->lakna}}"  readonly/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-4">
												<h6 class="mb-0">Stars</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->star}}"  readonly/>
											</div>
											</div>

											<div class="row mb-3">
											<div class="col-sm-4">
												<h6 class="mb-0">Birth Time</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<input type="text" class="form-control" value="{{$viewid->birth_time}}"  readonly/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-4">
												<h6 class="mb-0">Dhosam</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<input type="text" class="form-control" value="{{ $viewid->dosam }}" readonly/>
											</div>
											</div>
											</div>

										</div>
										
										<div class="card">
    									    <div class="card-body">
    									    <h5 class="mb-4">Basic Preferences</h5>
    										    <div class="row">
    											<div class="col-sm-4">
    												<h6 class="mb-0">Age</h6>
    											</div>
    											<div class="col-sm-8 text-secondary">
    												<input type="text" class="form-control" value="From : {{$partners->age_from}} - To : {{$partners->age_to}}" readonly/>
    											</div>
    											</div>
    											<div class="row mb-3 mt-3">
    											<div class="col-sm-4">
    												<h6 class="mb-0">Height</h6>
    											</div>
    											<div class="col-sm-8 text-secondary">
    												<input type="text" class="form-control" value="From : {{$partners->height_from}} - To : {{$partners->height_to}}"  readonly/>
    											</div>
    											</div>
    											<div class="row mb-3">
    											<div class="col-sm-4">
    												<h6 class="mb-0">Body Type</h6>
    											</div>
    											<div class="col-sm-8 text-secondary">
    												<input type="text" class="form-control" value="{{$partners->preference_bodytypetext}}"  readonly/>
    											</div>
    											</div>
    
    											<div class="row mb-3">
    											<div class="col-sm-4">
    												<h6 class="mb-0">Complexion</h6>
    											</div>
    											<div class="col-sm-8 text-secondary">
    												<input type="text" class="form-control" value="{{$partners->preference_complexiontext}}"  readonly/>
    											</div>
    											</div>
    											<div class="row mb-3">
    											<div class="col-sm-4">
    												<h6 class="mb-0">Marital Status</h6>
    											</div>
    											<div class="col-sm-8 text-secondary">
    												<input type="text" class="form-control" value="{{ $partners->marital_statustext }}" readonly/>
    											</div>
    											</div>
    											<div class="row mb-3">
    											<div class="col-sm-4">
    												<h6 class="mb-0">Eating Habit</h6>
    											</div>
    											<div class="col-sm-8 text-secondary">
    												<input type="text" class="form-control" value="{{ $partners->preference_eating }}" readonly/>
    											</div>
    											</div>
    											<div class="row mb-3">
    											<div class="col-sm-4">
    												<h6 class="mb-0">Annual Income</h6>
    											</div>
    											<div class="col-sm-8 text-secondary">
    												<input type="text" class="form-control" value="{{ $partners->preference_income }}" readonly/>
    											</div>
    											</div>
											</div>

										</div>
										
										<div class="card">
    									    <div class="card-body">
    									    <h5 class="mb-4">Professional Preferences</h5>
    										    <div class="row">
    											<div class="col-sm-4">
    												<h6 class="mb-0">Education Category</h6>
    											</div>
    											<div class="col-sm-8 text-secondary">
    												<input type="text" class="form-control" value="{{$partners->preference_educattext}}" readonly/>
    											</div>
    											</div>
    											<div class="row mb-3 mt-3">
    											<div class="col-sm-4">
    												<h6 class="mb-0">Job Category</h6>
    											</div>
    											<div class="col-sm-8 text-secondary">
    												<input type="text" class="form-control" value="{{$partners->preference_jobcattext}}"  readonly/>
    											</div>
    											</div>
											</div>
										</div>
                                        <div class="card">
    									    <div class="card-body">
    									    <h5 class="mb-4">Religious Preference</h5>
    										    <div class="row">
    											<div class="col-sm-4">
    												<h6 class="mb-0">Religion</h6>
    											</div>
    											<div class="col-sm-8 text-secondary">
    												<input type="text" class="form-control" value="{{ $partners->preference_religion_name ?? $partners->preference_religiontext }}" readonly/>
    											</div>
    											</div>
    											<div class="row mb-3 mt-3">
    											<div class="col-sm-4">
    												<h6 class="mb-0">Caste</h6>
    											</div>
    											<div class="col-sm-8 text-secondary">
    												<input type="text" class="form-control" value="{{ $partners->preference_caste_name ?? $partners->preference_castetext }}"  readonly/>
    											</div>
    											</div>
    											<div class="row mb-3">
    											<div class="col-sm-4">
    												<h6 class="mb-0">Sub Caste</h6>
    											</div>
    											<div class="col-sm-8 text-secondary">
    												<input type="text" class="form-control" value="{{ $partners->preference_subcaste_name ?? $partners->preference_subcastetext }}"  readonly/>
    											</div>
    											</div>
											</div>
										</div>
										<div class="card">
    									    <div class="card-body">
    									    <h5 class="mb-4">Location Preference</h5>
    										    <div class="row">
    											<div class="col-sm-4">
    												<h6 class="mb-0">Country</h6>
    											</div>
    											<div class="col-sm-8 text-secondary">
    												<input type="text" class="form-control" value="{{$partners->preference_countrytext}}" readonly/>
    											</div>
    											</div>
    											<div class="row mb-3 mt-3">
    											<div class="col-sm-4">
    												<h6 class="mb-0">State</h6>
    											</div>
    											<div class="col-sm-8 text-secondary">
    												<input type="text" class="form-control" value="{{$partners->preference_statetext}}"  readonly/>
    											</div>
    											</div>
    											<div class="row mb-3">
    											<div class="col-sm-4">
    												<h6 class="mb-0">District</h6>
    											</div>
    											<div class="col-sm-8 text-secondary">
    												<input type="text" class="form-control" value="{{$partners->preference_districttext}}"  readonly/>
    											</div>
    											</div>
											</div>
										</div>
										
										
									</div>
							</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

@endsection

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Profile Approval Status</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <img src="{{ asset('images/logoeng.jpeg') }}" style="width:250px;background-color: #6d1140;padding: 20px;border-radius: 5px;" class="img-fluid m-auto d-block">
            <div  class="text-center mt-5">
                <form method="POST" action="/statusChange">
                    @csrf
                    <input type="hidden" name="status" class="approvestatus" value="1">
                    <input type="hidden" class="prid" name="prid">
                    <button type="submit" class="btn btn-success" style="width:250px">Approve</button>
                </form>
                <form method="POST" action="/statusChange">
                    @csrf
                    <input type="hidden" name="status" class="approvestatus" value="2">
                    <input type="hidden" class="prid" name="prid">
                    <button type="submit" class="btn btn-danger" style="width:250px">Reject</button>
                </form>
            </div>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Profile Block Status</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <img src="{{ asset('images/logoeng.jpeg') }}" style="width:250px;background-color: #6d1140;padding: 20px;border-radius: 5px;" class="img-fluid m-auto d-block">
            <div  class="text-center mt-5">
                <form method="POST" action="/Blockstatus">
                    @csrf
                    <input type="hidden" name="blockstatus" class="blockstatus" value="1">
                    <input type="hidden" class="prid" name="prid">
                    <button type="submit" class="btn btn-danger" style="width:250px">Block</button>
                </form>
                <form method="POST" action="/Blockstatus">
                    @csrf
                    <input type="hidden" name="blockstatus" class="blockstatus" value="2">
                    <input type="hidden" class="prid" name="prid">
                    <button type="submit" class="btn btn-success" style="width:250px">Unblock</button>
                </form>
            </div>
        </div>
      </div>
    </div>
</div>
