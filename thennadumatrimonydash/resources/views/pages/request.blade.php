@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Dashboard')
@section('main-content')

    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Profile Requests</div>
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
                                        <th class="text-center">Partner Thennadu ID</th>
                                        <th class="text-center">Request Date</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($requests)
                                        @foreach ($requests as $profilerequest)
                                            <tr>
                                                <td class="text-center">{{$profilerequest->user_varan_id}}</td>
                                                <td class="text-center">{{$profilerequest->partner_varan_id}}</td>
                                                <td class="text-center">{{$profilerequest->created_at}}</td>
                                                {{-- <td class="text-center"><a href="{{route('report.show',$reportdetails->report_varan_id)}}" class="btn btn-primary">View</a></td> --}}

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



@endsection




