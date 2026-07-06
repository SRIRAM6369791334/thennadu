@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Dashboard')
@section('main-content')

    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Profile Tracking</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
								</li>

							</ol>
						</nav>
					</div>
				</div>

				<!--end breadcrumb-->
				<!-- Section: Pricing table -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>

                                        <th class="text-center">User Thennadu ID</th>
                                        <th class="text-center">Purpose</th>
                                        <th class="text-center">View Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($tracking)
                                        @foreach ($tracking as $track)
                                            <tr>
                                                <td class="text-center">{{$track->user_name ?? 'Unknown'}} ({{$track->user_varan_id}})</td>
                                                <td class="text-center">{{$track->purpose}}</td>
                                                <td class="text-center"><a href="{{route('tracking.show',$track->id)}}" class="btn btn-primary">View</a></td>
                                            </tr>
                                        @endforeach
                                    @endif


                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
				<!-- Section: Pricing table -->
			</div>
		</div>

		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Caste</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form method="POST" action="{{route('subcaste.store')}}">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Caste name</label>
                    <select class="form-control" name="Caste_name">
                        <option>-- Choose Option --</option>


                                        </select>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">SubCaste name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="subcaste_name" placeholder="Enter Caste Name">
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




