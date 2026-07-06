@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Dashboard')
@section('main-content')

    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Report Profiles</div>
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
                                        <th class="text-center">Report Thennadu ID</th>
                                        <th class="text-center">Remarks</th>
                                        {{-- <th class="text-center">View Report Profile</th> --}}
                                        <th class="text-center">Report Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($report)
                                        @foreach ($report as $reportdetails)
                                            <tr>
                                                <td class="text-center">{{$reportdetails->user_varan_id}}</td>
                                                <td class="text-center">{{$reportdetails->report_varan_id}}</td>
                                                <td class="text-center">{{$reportdetails->remarks}}</td>
                                                {{-- <td class="text-center"><a href="{{route('report.show',$reportdetails->report_varan_id)}}" class="btn btn-primary">View</a></td> --}}
                                                <td class="text-center">
                                                    @if($reportdetails->status == 0)
                                                    <button class="btn btn-warning status btn-sm" id="{{$reportdetails->id}}" data-varanid="{{$reportdetails->report_varan_id}}" data-bs-toggle="modal" data-bs-target="#exampleModal" style="width:200px">Pending</button>
                                                        @elseif ($reportdetails->status == 2)

                                                        <button class="btn btn-danger status btn-sm" id="{{$reportdetails->id}}" data-varanid="{{$reportdetails->report_varan_id}}" data-bs-toggle="modal" data-bs-target="#exampleModal" style="width:200px">Block</button>
                                                        @elseif($reportdetails->status == 1)
                                                        <button class="btn btn-success status btn-sm" id="{{$reportdetails->id}}" data-varanid="{{$reportdetails->report_varan_id}}" data-bs-toggle="modal" data-bs-target="#exampleModal" style="width:200px">Unblock</button>
                                                        @endif
                                                </td>
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
                  <h5 class="modal-title" id="exampleModalLabel">Profile Approval Status</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('images/logoeng.jpeg') }}" style="width:250px;background-color: #6d1140;padding: 20px;border-radius: 5px;" class="img-fluid m-auto d-block">
                    <div  class="text-center mt-5">
                        <form method="POST" action="/reportstatusChange">
                            @csrf

                            <input type="hidden" name="status" class="approvestatus" value="1">
                            <input type="hidden" class="prid" name="prid">
                            <input type="hidden" class="varanid" name="varanid">
                            <button type="submit" class="btn btn-success" style="width:250px">Unblock</button>
                        </form>
                        <form method="POST" action="/reportstatusChange">
                            @csrf
                            <input type="hidden" name="status" class="approvestatus" value="0">
                            <input type="hidden" class="prid" name="prid">
                            <input type="hidden" class="varanid" name="varanid">
                            <button type="submit" class="btn btn-warning" style="width:250px">Pending</button>
                        </form>
                        <form method="POST" action="/reportstatusChange">
                            @csrf
                            <input type="hidden" name="status" class="approvestatus" value="2">
                            <input type="hidden" class="prid" name="prid">
                            <input type="hidden" class="varanid" name="varanid">
                            <button type="submit" class="btn btn-danger" style="width:250px">Block</button>
                        </form>

                    </div>
                </div>


              </div>
            </div>
          </div>

@endsection




