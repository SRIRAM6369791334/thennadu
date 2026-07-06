@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Dashboard')
@section('main-content')

    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Horoscope Images</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							{{-- <ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
								</li>

							</ol> --}}
						</nav>
                        <div class="text-right">
                            <a href="/approvehoroscopeimg" class="btn btn-success">Approved Images</a>
                            <a href="/pendinghoroscopeimg" class="btn btn-warning">Pending Images</a>
                            
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
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Image / PDF</th>
                                        <th class="text-center">Thennadu ID</th>
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <tr>
                                                <td class="text-center" style="vertical-align:middle"><img src="{{ env('MAIN_URL') }}uploads/{{$horoimg->img_name}}" width="100px"></td>
                                                <td class="text-center" style="vertical-align:middle">{{$horoimg->varan_id}}</td>

                                                    @if ($horoimg->approval_status == '1')
                                                    <td style="vertical-align:middle"><button  class="status btn btn-success btn-sm m-auto d-block" id="{{$horoimg->id}}" data-varanid="{{$horoimg->varan_id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Approval</button></td>
                                                        @elseif ($horoimg->approval_status == '2')
                                                    <td style="vertical-align:middle"><button  class="status btn btn-danger btn-sm m-auto d-block" id="{{$horoimg->id}}" data-varanid="{{$horoimg->varan_id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Reject</button></td>
                                                    @else
                                                    <td style="vertical-align:middle"><button  class="status btn btn-warning btn-sm m-auto d-block" id="{{$horoimg->id}}" data-varanid="{{$horoimg->varan_id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Pending</button></td>
                                                   @endif


                                            </tr> --}}
                                @if($horoscopeimages)
                                        @foreach ($horoscopeimages as $horoimg)
                                            <tr>
                                                @if($horoimg->title == "Horoscope")
                                                    <td class="text-center" style="vertical-align:middle"><img src="{{ env('MAIN_URL') }}uploads/{{$horoimg->img_name}}" width="100px"></td>
                                                @else
                                                    <td class="text-center" style="vertical-align:middle"><a href="{{ env('MAIN_URL') }}public/images/{{$horoimg->img_name}}" target="_blank">Click here</a></td>
                                                @endif
                                                
                       <td class="text-center" style="vertical-align:middle">{{$horoimg->varan_id}}</td>
                   <td class="text-center" style="vertical-align:middle">{{$horoimg->title}}</td>
                                                    @if ($horoimg->approval_status == '1')
                                                    <td style="vertical-align:middle"><button  class="status btn btn-success btn-sm m-auto d-block" id="{{$horoimg->id}}" data-varanid="{{$horoimg->varan_id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Approved</button></td>
                                                        @elseif ($horoimg->approval_status == '2')
                                                    <td style="vertical-align:middle"><button  class="status btn btn-danger btn-sm m-auto d-block" id="{{$horoimg->id}}" data-varanid="{{$horoimg->varan_id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Rejected</button></td>
                                                    @else
                                                    <td style="vertical-align:middle"><button  class="status btn btn-warning btn-sm m-auto d-block" id="{{$horoimg->id}}" data-varanid="{{$horoimg->varan_id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Pending</button></td>
                                                   @endif
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
          <h5 class="modal-title" id="exampleModalLabel">Image Approval Status</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{-- <img src="https://www.beddingtonphysio.com/images/testimonial-default.png" style="width:250px" class="img-fluid m-auto d-block"> --}}
            <div  class="text-center">
                <form method="POST" action="/horoscopeStatuschange">
                    @csrf

                    <input type="hidden" name="status" class="approvestatus" value="1">
                    <input type="hidden" class="prid" name="prid">
                    <input type="hidden" class="varanid" name="varanid">
                    <button type="submit" class="btn btn-success" style="width:250px">Approve</button>
                </form>
                <form method="POST" action="/horoscopeStatuschange">
                    @csrf
                    <input type="hidden" name="status" class="approvestatus" value="0">
                    <input type="hidden" class="prid" name="prid">
                    <input type="hidden" class="varanid" name="varanid">
                    <button type="submit" class="btn btn-warning" style="width:250px">Pending</button>
                </form>
                <form method="POST" action="/horoscopeStatuschange">
                    @csrf
                    <input type="hidden" name="status" class="approvestatus" value="2">
                    <input type="hidden" class="prid" name="prid">
                    <input type="hidden" class="varanid" name="varanid">
                    <button type="submit" class="btn btn-danger" style="width:250px">Reject</button>
                </form>

            </div>
        </div>
      </div>
    </div>
  </div>
@endsection






