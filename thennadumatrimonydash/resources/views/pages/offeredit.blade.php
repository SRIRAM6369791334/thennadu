@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Dashboard')
@section('main-content')

    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Offer</div>
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
                            <form method="POST" action="{{route('offer.update',$offer->id)}}">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Offer name</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1" name="offer_name" value="{{ $offer->offer_name }}" placeholder="Enter Offer name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">From Date</label>
                                            <input type="date" class="form-control" id="exampleFormControlInput1" value="{{ $offer->from_date }}" name="fromdate" placeholder="Package Price">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">To Date</label>
                                            <input type="date" class="form-control" id="exampleFormControlInput1" value="{{ $offer->to_date }}" name="todate" placeholder="Validity">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">No of Biography Views</label>
                                            <input type="number" class="form-control" id="exampleFormControlInput1" value="{{ $offer->noofmblno }}" name="noofmbl" placeholder="No of Biography Views">
                                        </div>
                                        <!--<div class="mb-3">-->
                                        <!--    <label for="exampleFormControlInput1" class="form-label">No of Videos</label>-->
                                        <!--    <input type="number" class="form-control" id="exampleFormControlInput1" name="noofvideos" placeholder="No of Videos">-->
                                        <!--</div>-->
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">No of Images</label>
                                            <input type="number" class="form-control" id="exampleFormControlInput1" value="{{ $offer->no_of_images }}" name="noofimages" placeholder="No of Images">
                                        </div>
                                    </div>
                
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Validity (in Days)</label>
                                            <input type="number" class="form-control" id="exampleFormControlInput1" name="validity" value="{{ $offer->validity }}" placeholder="Validity">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Package Specification</label>
                
                                            <div class="form-check">
                                                <input class="form-check-input" name="specification_3" @if($offer->specification_3 == 'yes') checked @endif type="checkbox" value="yes" id="flexCheckChecked3" >
                                                <label class="form-check-label" for="flexCheckChecked3">
                                                  Chat Option
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="specification_6" @if($offer->specification_4 == 'yes') checked @endif type="checkbox" value="yes" id="flexCheckChecked4" >
                                                <label class="form-check-label" for="flexCheckChecked4">
                                                  Call Option
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="specification_1" @if($offer->no_of_videos == 1) checked @endif type="checkbox" value="1" id="flexCheckChecked5" >
                                                <label class="form-check-label" for="flexCheckChecked5">
                                                  Video Upload
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="specification_5" @if($offer->specification_5 == 'yes') checked @endif type="checkbox" value="yes" id="flexCheckChecked5" >
                                                <label class="form-check-label" for="flexCheckChecked5">
                                                  Advanced Search
                                                </label>
                                            </div>
                
                                        </div>
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




