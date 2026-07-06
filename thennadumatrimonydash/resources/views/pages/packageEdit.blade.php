@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Dashboard')
@section('main-content')

    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Packages</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
								</li>

							</ol>
						</nav>
					</div>

				</div>
                @if(session()->get('success'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{session()->get('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
				<!--end breadcrumb-->
				<!-- Section: Pricing table -->
				<div class="pricing-table">

					<hr/>
					<div class="row ">
						<!-- Free Tier -->
                        <div class=" col-lg-8 offset-lg-2">
                            <form method="POST" action="{{route('packages.update',$package->id)}}">
                                @csrf
                                @method('PATCH')
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Package name</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="package_name" placeholder="Enter Package name" value="{{$package->package_name}}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Package Price</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="package_price" placeholder="Package Price" value="{{$package->package_price}}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Validity (Days)</label>
                                    <input type="number" class="form-control" id="exampleFormControlInput1" name="validity" placeholder="Validity" value="{{ $package->validity }}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">No of Biography View</label>
                                    <input type="number" class="form-control" id="exampleFormControlInput1" name="noofmbl" placeholder="No of Biography View" value="{{ $package->noofmblno }}">
                                </div>
                               
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">No of Images</label>
                                    <input type="number" class="form-control" id="exampleFormControlInput1" name="specification_2" placeholder="No of Images" value="{{ $package->no_of_images }}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Package Specification</label>
                
                                      <div class="form-check">
                                        <input class="form-check-input" name="specification_3" type="checkbox" value="yes" id="flexCheckChecked3" @if($package->specification_3 == 'yes') checked @else @endif>
                                        <label class="form-check-label" for="flexCheckChecked3">
                                          Chat Option
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" name="specification_6" type="checkbox" value="yes" id="flexCheckChecked4" @if($package->specification_6 == 'yes') checked @else @endif>
                                        <label class="form-check-label" for="flexCheckChecked4">
                                          Call Option
                                        </label>
                                      </div>
                                       <div class="form-check">
                                        <input class="form-check-input" name="specification_1" type="checkbox" value="1" id="flexCheckChecked5" @if($package->no_of_videos == '1') checked @else @endif>
                                        <label class="form-check-label" for="flexCheckChecked5">
                                          Video Upload
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" name="specification_5" type="checkbox" value="yes" id="flexCheckChecked5" @if($package->specification_5 == 'yes') checked @else @endif>
                                        <label class="form-check-label" for="flexCheckChecked5">
                                          Advanced Search
                                        </label>
                                      </div>
                                </div>

                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                        </div>


						<!-- Plus Tier -->

						<!-- Pro Tier -->

					</div>
					<!--end row-->


					<!--end row-->
				</div>
				<!-- Section: Pricing table -->
			</div>
		</div>

		
@endsection




