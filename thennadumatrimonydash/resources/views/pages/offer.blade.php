@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Dashboard')
@section('main-content')

    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Offer Tables</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Offer Tables</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Offer</button>


						</div>
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

                        <div class="table-responsive">

                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>

                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Offer Name</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">From Date</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">To Date</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Offer Status</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Validity</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">No of Images</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">No of Biography Views</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Chat Option</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Call Option</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Video Upload Option</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Advance Search</th>

                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Edit</th>
                                        <th class="text-center">Delete</th>

                                    </tr>
                                </thead>
                                <tbody>
                                @if($offers)

                                        @foreach ($offers as $offer)

                                            <tr>
                                                <td class="text-center" style="vertical-align:middle">{{$offer->offer_name}}</td>
                                                <td class="text-center" style="vertical-align:middle">{{$offer->from_date}}</td>
                                                <td class="text-center" style="vertical-align:middle">{{$offer->to_date}}</td>
                                                <td class="text-center" style="vertical-align:middle">{{$offer->offer_status}}</td>
                                                <td class="text-center" style="vertical-align:middle">{{$offer->validity}}</td>
                                                <td class="text-center" style="vertical-align:middle">{{$offer->no_of_images}}</td>
                                                <td class="text-center" style="vertical-align:middle">{{$offer->noofmblno}}</td>
                                                <td class="text-center" style="vertical-align:middle;text-transform: capitalize;">{{$offer->specification_3}}</td>
                                                <td class="text-center" style="vertical-align:middle;text-transform: capitalize;">{{$offer->specification_4}}</td>
                                                <td class="text-center" style="vertical-align:middle;text-transform: capitalize;">@if($offer->no_of_videos == 1) yes @else no @endif</td>
                                                <td class="text-center" style="vertical-align:middle;text-transform: capitalize;">{{$offer->specification_5}}</td>
                                                <td class="text-center" style="vertical-align:middle"><a href="{{route('offer.edit',$offer->id)}}" class="btn btn-primary" style="padding:10px;text-align:center"><i class="bx bx-pencil"></i></a></td>
                                                <td class="text-center" style="vertical-align:middle">
                                                    <form method="POST" action="{{route('offer.destroy',$offer->id)}}" onsubmit="return confirm('Do You want Delete this Data?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger button">Delete</button>
                                                    </form>
                                                   </td>

                                            </tr>
                                        @endforeach
                                @endif


                                </tbody>

                            </table>
                        </div>

						<!-- Plus Tier -->

						<!-- Pro Tier -->

					</div>
					<!--end row-->


					<!--end row-->
				</div>
				<!-- Section: Pricing table -->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mt-5 mb-3">
					<div class="breadcrumb-title pe-3">Offer Banner Image</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
								</li>
							</ol>
						</nav>
					</div>
				</div>
				<hr/>
				<form method="post" action="/bannupd" enctype="multipart/form-data">
				        @csrf
				<div class="row">
				    <div class="col-7">
				        <img src="/assets/banner/{{$banner->image}}" style="width:70%;">
				    </div>
				    <div class="col-5">
				        <input type="hidden" value="{{$banner->id}}" name="id">
				        <input type="file" class="form-control" name="bannimg" required>
				        
				        <div style="display: flex;">
				            <button type="submit" class="btn btn-primary m-2">Update</button>
				            @if($banner->status == '1')
				            <a href="/offerbanenable/2" class="btn btn-danger m-2">Disable</a>
				            @elseif($banner->status == '2')
				            <a href="/offerbanenable/1" class="btn btn-success m-2">Enable</a>
				            @endif
				        </div>
				        
				    </div>
				</div>
				</form>
			</div>
		</div>

		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Package</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form method="POST" action="{{route('offer.store')}}">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Offer name</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="offer_name" placeholder="Enter Offer name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">From Date</label>
                            <input type="date" class="form-control" id="exampleFormControlInput1" name="fromdate" placeholder="Package Price">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">To Date</label>
                            <input type="date" class="form-control" id="exampleFormControlInput1" name="todate" placeholder="To Date">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Validity (in Days)</label>
                            <input type="number" class="form-control" id="exampleFormControlInput1" name="validity" placeholder="Validity">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">No of Biography Views</label>
                            <input type="number" class="form-control" id="exampleFormControlInput1" name="noofmbl" placeholder="No of Biography Views">
                        </div>
                        <!--<div class="mb-3">-->
                        <!--    <label for="exampleFormControlInput1" class="form-label">No of Videos</label>-->
                        <!--    <input type="number" class="form-control" id="exampleFormControlInput1" name="noofvideos" placeholder="No of Videos">-->
                        <!--</div>-->
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">No of Images</label>
                            <input type="number" class="form-control" id="exampleFormControlInput1" name="noofimages" placeholder="No of Images">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <!--<div class="mb-3">-->
                        <!--    <label for="exampleFormControlInput1" class="form-label">Validity (Days)</label>-->
                        <!--    <input type="number" class="form-control" id="exampleFormControlInput1" name="validity" placeholder="Validity">-->
                        <!--</div>-->
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Package Specification</label>

                            <div class="form-check">
                                <input class="form-check-input" name="specification_3" type="checkbox" value="yes" id="flexCheckChecked3" >
                                <label class="form-check-label" for="flexCheckChecked3">
                                  Chat Option
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="specification_6" type="checkbox" value="yes" id="flexCheckChecked4" >
                                <label class="form-check-label" for="flexCheckChecked4">
                                  Call Option
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="specification_1" type="checkbox" value="1" id="flexCheckChecked5" >
                                <label class="form-check-label" for="flexCheckChecked5">
                                  Video Upload
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="specification_5" type="checkbox" value="yes" id="flexCheckChecked5" >
                                <label class="form-check-label" for="flexCheckChecked5">
                                  Advanced Search
                                </label>
                            </div>

                        </div>
                    </div>
                </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>
@endsection




