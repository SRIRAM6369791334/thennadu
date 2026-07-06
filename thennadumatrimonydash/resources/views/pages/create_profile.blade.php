@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Dashboard')
@section('main-content')

<div class="page-wrapper" style="margin-top:0px">
			<div class="page-content" style="padding-top:60px;background-image:url('');background-size:cover;background-attachment:fixed;background-repeat:no-repeat">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Create Profiles</div>
					<div class="ps-3">
						<!--<nav aria-label="breadcrumb">-->
						<!--	<ol class="breadcrumb mb-0 p-0">-->
						<!--		<li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>-->
						<!--		</li>-->
						<!--		<li class="breadcrumb-item active" aria-current="page">User Profile</li>-->
						<!--	</ol>-->
						<!--</nav>-->
					</div>

				</div>
				
                
				@if(session()->get('mobile_error'))
                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    {{session()->get('mobile_error')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
				<div class="container">
					<div class="main-body">
					    @if($errors->any())
				            @foreach($errors->all() as $error)
        					    <div class="row">
                				    <div class="col-lg-12">
                				        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $error }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                				    </div>
                				</div>
        				    @endforeach
                        @endif
						<div class="row">
						    <!--@if(Auth::user()->broker_id == '')-->
						    <!--    <div class="alert alert-danger alert-dismissible fade show" role="alert">-->
          <!--              Broker only profile create option available, not a admin-->
          <!--          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>-->
          <!--        </div>-->
          <!--          @else-->
                    
						    <!--@endif-->
						    
							<form method="POST" action="{{route('broker.store')}}" enctype="multipart/form-data" id="brokerRegistrationForm">
									@csrf

							<div class="col-lg-8 offset-lg-2">
								<div class="card">
									<div class="card-body">
									    <h5 class="mb-4">Basic Details<span style="font-size:16px;color:red"> (All the fields are required to be filled)</span></h5>
										    <div class="row">
											<div class="col-sm-3">
												<h6 class="mb-0">Full Name</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" name="fullname" required/ value="{{old('fullname')}}">
											</div>
											</div>
											<div class="row mb-3 mt-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Created by</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<select class="form-control" name="createdfor" required>
                                                    <option value="">-- Choose Created For --</option>
                                                    <option value="Self">Self</option>
                                                    <option value="Parent">Parent</option>
                                                    <option value="Sibling">Sibling</option>
                                                    <option value="Friend">Friend</option>
                                                    <option value="Relative">Relative</option>
                                                </select>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Gender</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<select class="form-control" name="gender" required>
                                                    <option value="">-- Choose Gender --</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Date Of Birth</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="date" class="form-control" name="dob" required/>
											</div>
											</div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">E-mail ID</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="email" class="form-control" name="email" required/>
                                                </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Mobile Number</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="text" class="form-control" name="mobile_no" required/>
                                                    </div>
                                                    </div>
                                                <!--<div class="row mb-3">-->
                                                <!--    <div class="col-sm-3">-->
                                                <!--        <h6 class="mb-0">Aadhaar Number</h6>-->
                                                <!--    </div>-->
                                                <!--    <div class="col-sm-9 text-secondary">-->
                                                <!--        <input type="text" class="form-control" name="aadhaar_number" required/>-->
                                                <!--    </div>-->
                                                <!--    </div>-->

											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Mother Tongue</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<select class="form-control single-select" name="mothertongue" required>
                                                    <option value="">-- Choose Mother Tongue --</option>
                                                    <option value="1">Tamil</option>
                                                    <option value="2">English</option>
                                                    <option value="3">Kannadam</option>
                                                    <option value="4">Malayalam</option>
                                                    <option value="5">Thelungu</option>
                                                    {{-- @if($mor_ton)
                                                        @foreach ($mor_ton as $mor_to)
                                                         <option value="{{$mor_to->id}}">{{$mor_to->mor_name}}</option>
                                                        @endforeach
                                                    @endif --}}

                                                </select>
											</div>
											</div>
												<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Body Type</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<select class="form-control single-select" name="bodytype" required>
                                                    <option value="">-- Choose Body Type --</option>
                                                    @if($btype_tb)
                                                    @foreach ($btype_tb as $btype)
                                                     <option value="{{$btype->id}}">{{$btype->btype}}</option>
                                                    @endforeach
                                                @endif
                                                </select>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Physical Status</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<select class="form-control single-select" name="physicalstatus" required>
                                                    <option value="">-- Choose Physical Status --</option>
                                                    @if($phy_tb)
                                                    @foreach ($phy_tb as $phy_tb1)
                                                     <option value="{{$phy_tb1->id}}">{{$phy_tb1->phy_name}}</option>
                                                    @endforeach
                                                @endif
                                                </select>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Complexion</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<select class="form-control single-select" name="complexion" required>
                                                    <option value="">-- Choose Complexion --</option>
                                                    @if($complexion)
                                                    @foreach ($complexion as $complexion_val)
                                                     <option value="{{$complexion_val->id}}">{{$complexion_val->com_name}}</option>
                                                    @endforeach
                                                @endif
                                                </select>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Height</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<select class="form-control" name="height" id="height_select" required style="width: 100% !important; z-index: 1000 !important;">
                                                    <option value="">-- Choose Height --</option>
                                                    @if($height)
                                                    @foreach ($height as $ht)
                                                     <option value="{{$ht->id}}">{{$ht->height_name}}</option>
                                                    @endforeach
                                                @endif
                                                </select>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Marital Status</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<select class="form-control single-select" name="maritalstatus" required>
                                                    <option value="">-- Choose Marital Status --</option>
                                                    @if($matrial_tb)
                                                    @foreach ($matrial_tb as $marital)
                                                     <option value="{{$marital->id}}">{{$marital->matrial_name}}</option>
                                                    @endforeach
                                                @endif
                                                </select>
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
												<select class="form-control single-select religion" name="religion" required>
                                                    <option value="">-- Choose Religion --</option>
                                                    @if($regli_tb)
                                                    @foreach ($regli_tb as $religion)
                                                     <option value="{{$religion->id}}">{{$religion->religion_name}}</option>
                                                    @endforeach
                                                @endif
                                                </select>
											</div>
											</div>
											<div class="row mb-3 mt-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Caste</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<select class="form-control single-select castes" name="caste" required>
                                                    <option value="">-- Choose Caste --</option>
                                                    {{-- @if($caste)
                                                        @foreach ($caste as $cast)
                                                         <option value="{{$cast->id}}">{{$cast->Caste_name}}</option>
                                                        @endforeach
                                                    @endif --}}

                                                </select>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Sub Caste</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<select class="form-control single-select subcaste" name="subcaste" required>
                                                    <option value="">-- Choose Subcaste --</option>
                                                    {{-- @if($subcaste)
                                                        @foreach ($subcaste as $sub)
                                                         <option value="{{$sub->id}}">{{$sub->subcategory_name}}</option>
                                                        @endforeach
                                                    @endif --}}

                                                </select>
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
												<input type="text" class="form-control" name="address" required/>
											</div>
											</div>
											<div class="row mb-3 mt-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Country</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<select class="form-control single-select ccountry" name="country" required>
                                                    <option value="">-- Choose Country --</option>
                                                    @if($country)
                                                        @foreach ($country as $countr)
                                                         <option value="{{$countr->country_id}}">{{$countr->country_name}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">State</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<select class="form-control single-select sstate" name="state" required>
                                                    <option value="">-- Choose State --</option>
                                                    @if($states)
                                                        @foreach ($states as $state)
                                                         <option value="{{$state->state_id}}">{{$state->state_name}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">City</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<select class="form-control single-select ccities" name="city" required>
                                                    <option value="">-- Choose City --</option>
                                                    @if($city)
                                                        @foreach ($city as $district)
                                                         <option value="{{$district->city_id}}">{{$district->city_name}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
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
												<select class="form-control single-select" name="education" required>
                                                    <option value="">-- Choose Education --</option>
                                                    @if($education)
                                                        @foreach ($education as $educations)
                                                         <option value="{{$educations->id}}">{{$educations->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
											</div>
											</div>
											<div class="row mb-3 mt-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Education Detail</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" name="educationdetail" required/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Job Category</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<select class="form-control single-select" name="jobs" required>
                                                    <option value="">-- Choose Job Category --</option>
                                                    @if($job)
                                                        @foreach ($job as $jobs)
                                                         <option value="{{$jobs->id}}">{{$jobs->name}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Job in Detail</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" name="jobdetail" required />
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Work Country</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<select class="form-control single-select ccountry1" name="jobcountry" required>
                                                    <option value="">-- Choose Country --</option>
                                                    @if($work_count)
                                                        @foreach ($work_count as $work_countr)
                                                         <option value="{{$work_countr->country_id}}">{{$work_countr->country_name}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Work State</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<select class="form-control single-select sstate1" name="jobstate" required>
                                                    <option value="">-- Choose State --</option>
                                                    @if($work_state)
                                                        @foreach ($work_state as $work_states)
                                                         <option value="{{$work_states->state_id}}">{{$work_states->state_name}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
											</div>
											</div>

											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Work City</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<select class="form-control single-select ccities1" name="jobcity" required>
                                                    <option value="">-- Choose City --</option>
                                                    @if($work_city)
                                                        @foreach ($work_city as $work_citys)
                                                         <option value="{{$work_citys->job_city_id}}">{{$work_citys->job_city_name}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Annual Income</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<select class="form-control single-select" name="annalincone" required>
                                                    <option value="">-- Choose Income --</option>
                                                    @if($income_tb)
                                                        @foreach ($income_tb as $income)
                                                            <option value="{{$income->id}}">{{$income->salary}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
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
												<input type="text" class="form-control" name="fathername" required />
											</div>
											</div>
											<div class="row mb-3 mt-3">
											<div class="col-sm-4">
												<h6 class="mb-0">Father Job</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<input type="text" class="form-control" name="fatherjob" required />
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-4">
												<h6 class="mb-0">Mother Name</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<input type="text" class="form-control" name="mothername" required />
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-4">
												<h6 class="mb-0">Mother Job</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<input type="text" class="form-control" name="motherjob" required />
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-4">
												<h6 class="mb-0">No Of Siblings</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<input type="number" class="form-control" name="noofsibling" id="tArea" oninput="limitChar(this)" maxlength="20"  required />
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-4">
												<h6 class="mb-0">No of Elder Sister</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<input type="number" class="form-control" name="noofeldersister" id="tArea1" oninput="limitChar(this)" maxlength="20" required />
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-4">
												<h6 class="mb-0">No of Younger Sister</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<input type="number" class="form-control" name="noofyoungersister" id="tArea2" oninput="limitChar(this)" maxlength="20" required />
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-4">
												<h6 class="mb-0">No of Elder Brother</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<input type="number" class="form-control" name="noofelderbrother" id="tArea3" oninput="limitChar(this)" maxlength="20" required />
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-4">
												<h6 class="mb-0">No of Younger Brother</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<input type="number" class="form-control" name="noofyoungerbrother" id="tArea4" oninput="limitChar(this)" maxlength="20" required />
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
												{{-- <input type="text" class="form-control" name="zodiac"/> --}}
                                                <select class="form-control single-select" name="zodiac" required>
                                                    <option value="">-- Choose Zodiac --</option>
                                                    @if($rasi_tb)
                                                        @foreach ($rasi_tb as $rasi)
                                                         <option value="{{$rasi->id}}">{{$rasi->name}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
											</div>
											</div>
											<div class="row mb-3 mt-3">
											<div class="col-sm-4">
												<h6 class="mb-0">Laknam</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<select class="form-control single-select" name="laknam" required />
												    <option value="">-- Choose Laknam --</option>
												     @if($rasi_tb)
                                                        @foreach ($rasi_tb as $rasi)
                                                         <option value="{{$rasi->id}}">{{$rasi->name}}</option>
                                                        @endforeach
                                                    @endif
												</select>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-4">
												<h6 class="mb-0">Stars</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												{{-- <input type="text" class="form-control" name="stars" /> --}}
                                                <select class="form-control single-select" name="stars" required>
                                                    <option value="">-- Choose Rasi --</option>
                                                    @if($star_db)
                                                        @foreach ($star_db as $star)
                                                         <option value="{{$star->id}}">{{$star->name}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
											</div>
											</div>

											<div class="row mb-3">
											<div class="col-sm-4">
												<h6 class="mb-0">Birth Time</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<input type="time" class="form-control"  name="birthtime" required/>
											</div>
											</div>
											<div class="row mb-3">
											<div class="col-sm-4">
												<h6 class="mb-0">Dhosam</h6>
											</div>
											<div class="col-sm-8 text-secondary">
												<select type="text" class="form-control" name="dhosam" required />
												    <option value="">Select Dhosam</option>
												    <option value="Yes">Yes</option>
												    <option value="No">No</option>
												</select>
											</div>
											</div>
                                            <div class="row mb-3">
                                                <div class="col-sm-4">
                                                    <h6 class="mb-0">Profile Image</h6>
                                                </div>
                                                <div class="col-sm-8 text-secondary">
                                                    <input type="file" class="form-control" name="profile_image" required />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-4">
                                                    <h6 class="mb-0">Password</h6>
                                                </div>
                                                <div class="col-sm-8 text-secondary">
                                                    <input type="text" class="form-control" name="password" required />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <input type="hidden" name="brokerid" value="{{Auth::user()->broker_id}}">
                                                <input type="submit" class="btn btn-success" value="Create Account" style="width: 100%; padding: 10px; font-weight: bold;">
                                            </div>



                                        </form>
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

@section('script')
<script>
$(document).ready(function() {
    // Separate Select2 init for height to ensure it is clickable and visible
    if ($.fn.select2) {
        $('#height_select').select2({
            theme: 'bootstrap4',
            width: '100%',
            dropdownParent: $('#height_select').parent()
        });

        // Also init all other single-selects
        $('.single-select').not('#height_select').select2({
            theme: 'bootstrap4',
            width: '100%'
        });
    }

    // Form validation via SweetAlert
    $('#brokerRegistrationForm').on('submit', function(e) {
        var form = this;
        var $form = $(this);
        var missingFields = [];
        
        $form.find('[required]').each(function() {
            var $el = $(this);
            if (!$el.val() || $el.val().trim() === "") {
                var label = $el.closest('.row').find('h6').text().trim() || $el.attr('placeholder') || $el.attr('name');
                if (label) missingFields.push(label);
            }
        });

        if (missingFields.length > 0) {
            e.preventDefault();
            if (window.swal) {
                swal({
                    title: "Missing Information",
                    text: "The following fields are required:\n\n• " + missingFields.join("\n• "),
                    icon: "warning",
                    dangerMode: true,
                });
            } else {
                alert("Please fill: " + missingFields.join(", "));
            }
            return false;
        }
        
        // Final confirmation before submission
        e.preventDefault();
        if (window.swal) {
            swal({
                title: "Ready to Create Account?",
                text: "Confirming will submit the profile to the system.",
                icon: "info",
                buttons: ["Wait, go back", "Yes, Create Account"],
            }).then((willSubmit) => {
                if (willSubmit) {
                    // Use native submit to bypass the jQuery listener and submit the form
                    form.submit();
                }
            });
        } else {
            if (confirm("Create this account?")) {
                form.submit();
            }
        }
    });

    // Religion -> Caste
    $('.religion').on('change', function() {
        var id = $(this).val();
        if(!id) return;
        $.get("{{ url('get-cast') }}/" + id, function(data) {
            var options = '<option value="">-- Choose Caste --</option>';
            $.each(data, function(i, item) {
                options += '<option value="' + item.id + '">' + item.name + '</option>';
            });
            $('.castes').html(options);
        });
    });

    // Caste -> Subcaste
    $('.castes').on('change', function() {
        var id = $(this).val();
        if(!id) return;
        $.get("{{ url('get-subcast') }}/" + id, function(data) {
            var options = '<option value="">-- Choose Subcaste --</option>';
            $.each(data, function(i, item) {
                options += '<option value="' + item.id + '">' + item.name + '</option>';
            });
            $('.subcaste').html(options);
        });
    });

    // Country -> State (Location)
    $('.ccountry').on('change', function() {
        var id = $(this).val();
        if(!id) return;
        $.get("{{ url('get-state') }}/" + id, function(data) {
            var options = '<option value="">-- Choose State --</option>';
            $.each(data, function(i, item) {
                options += '<option value="' + item.id + '">' + item.name + '</option>';
            });
            $('.sstate').html(options);
        });
    });

    // State -> City (Location)
    $('.sstate').on('change', function() {
        var id = $(this).val();
        if(!id) return;
        $.get("{{ url('get-city') }}/" + id, function(data) {
            var options = '<option value="">-- Choose City --</option>';
            $.each(data, function(i, item) {
                options += '<option value="' + item.id + '">' + item.name + '</option>';
            });
            $('.ccities').html(options);
        });
    });

    // Job Country -> State
    $('.ccountry1').on('change', function() {
        var id = $(this).val();
        if(!id) return;
        $.get("{{ url('get-state') }}/" + id, function(data) {
            var options = '<option value="">-- Choose State --</option>';
            $.each(data, function(i, item) {
                options += '<option value="' + item.id + '">' + item.name + '</option>';
            });
            $('.sstate1').html(options);
        });
    });

    // Job State -> City
    $('.sstate1').on('change', function() {
        var id = $(this).val();
        if(!id) return;
        $.get("{{ url('get-city') }}/" + id, function(data) {
            var options = '<option value="">-- Choose City --</option>';
            $.each(data, function(i, item) {
                options += '<option value="' + item.id + '">' + item.name + '</option>';
            });
            $('.ccities1').html(options);
        });
    });

    // Rasi -> Stars
    $('select[name="zodiac"]').on('change', function() {
        var id = $(this).val();
        if(!id) {
            $('select[name="stars"]').html('<option value="">-- Choose Star --</option>');
            return;
        }
        $.get("{{ url('get-stars') }}/" + id, function(data) {
            var options = '<option value="">-- Choose Star --</option>';
            $.each(data, function(i, item) {
                options += '<option value="' + item.id + '">' + item.name + '</option>';
            });
            $('select[name="stars"]').html(options);
        });
    });
});
</script>
@endsection




