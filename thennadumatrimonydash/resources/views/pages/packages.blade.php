@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Dashboard')
@section('main-content')

    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Pricing Table</div>
					<div class="ps-3">
						<!--<nav aria-label="breadcrumb">-->
						<!--	<ol class="breadcrumb mb-0 p-0">-->
						<!--		<li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>-->
						<!--		</li>-->
						<!--		<li class="breadcrumb-item active" aria-current="page">Pricing Tables</li>-->
						<!--	</ol>-->
						<!--</nav>-->
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add a Package</button>


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

                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Package Name</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Price</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">No of Images</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Validity (in Days)</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">No of Biography View</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Chat Option</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Call Option</th>
                                        <!-- <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Video Upload Option</th> -->
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Advanced Search</th>
                                        <!--<th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Specification 6</th>-->
                                        <!--<th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Specification 7</th>-->
                                        <!--<th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Specification 8</th>-->
                                        <!--<th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Specification 9</th>-->
                                        <!--<th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Specification 10</th>-->
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Enable/Disable</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Edit</th>
                                        <th class="text-center">Delete</th>

                                    </tr>
                                </thead>
                                <tbody>
                                @if($package)

                                        @foreach ($package as $pack)

                                            <tr>
                                                <td class="text-center" style="vertical-align:middle">{{$pack->package_name}}</td>
                                                <td class="text-center" style="vertical-align:middle">{{$pack->package_price}}</td>
                                                <td class="text-center" style="vertical-align:middle">{{$pack->no_of_images}}</td>
                                                <td class="text-center" style="vertical-align:middle">{{$pack->validity}}</td>
                                                <td class="text-center" style="vertical-align:middle">{{$pack->noofmblno}}</td>
                                                <td class="text-center" style="vertical-align:middle;text-transform: capitalize;">{{$pack->specification_3}}</td>
                                                <td class="text-center" style="vertical-align:middle;text-transform: capitalize">{{$pack->specification_6}}</td>
                                                <!-- <td class="text-center" style="vertical-align:middle;text-transform: capitalize">@if($pack->no_of_videos == 1) yes @else no @endif</td> -->
                                                <td class="text-center" style="vertical-align:middle;text-transform: capitalize">{{$pack->specification_5}}</td>
                                                <td class="text-center" style="vertical-align:middle">
                                                    @if($pack->package_status == 0)
                                                        <a href="/enadis/{{ $pack->id }}/1" class="btn btn-success" style="padding:10px 20px;text-align:center">Enable</a>
                                                    @elseif($pack->package_status == 1)
                                                        <a href="/enadis/{{ $pack->id }}/0" class="btn btn-danger" style="padding:10px 20px;text-align:center">Disable</a>
                                                    @endif
                                                </td>
                                                <td class="text-center" style="vertical-align:middle"><a href="{{route('packages.edit',$pack->id)}}" class="btn btn-primary" style="padding:10px;text-align:center"><i class="bx bx-pencil"></i></a></td>
                                                <td class="text-center" style="vertical-align:middle">
                                                    <form method="POST" action="{{route('packages.destroy',$pack->id)}}" onsubmit="return confirm('Do you want to delete this data?')">
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
			</div>
		</div>

		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Package</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form method="POST" action="{{route('packages.store')}}">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Package Name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="package_name" placeholder="Enter Package Name" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Package Price</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="package_price" placeholder="Package Price" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Validity (in Days)</label>
                    <input type="number" class="form-control" id="exampleFormControlInput1" name="validity" placeholder="Validity in Days" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">No of Biography View</label>
                    <input type="number" class="form-control" id="exampleFormControlInput1" name="noofmbl" placeholder="No of Biography View">
                </div>
               
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">No of Images</label>
                    <input type="number" class="form-control" id="exampleFormControlInput1" name="specification_2" placeholder="No of Images">
                </div>
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>
@endsection




