@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Dashboard')
@section('main-content')

    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Broker Details</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
								</li>

							</ol>
						</nav>
					</div>
					{{-- <div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add User</button>


						</div>
					</div> --}}
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

                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">User Name</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Broker ID</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">E-mail</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Phone Number</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Role</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Percentage value</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Target value</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">View Details</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Action</th>
                                        <th class="text-center" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">Approval Status</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @if ($brokers)

                                    @foreach ($brokers as $user)
                                        <tr>
                                            {{-- {{$username = $user->name}} --}}
                                            <td class="text-center">{{$username = $user->name}}</td>
                                            <td class="text-center">{{$user->broker_id}}</td>
                                            <td class="text-center">{{$user->email}}</td>
                                            <td class="text-center">{{$user->mblno}}</td>
                                            <td class="text-center">
                                                @if ($user->role == 1)
                                                    Admin
                                                    @elseif ($user->role == 2)
                                                    Office Staff
                                                    @else
                                                    Broker
                                                @endif

                                            </td>
                                            <td>{{$user->user_payment_percentage}}</td>
                                            <td>{{$user->target_value}}</td>
                                            <td><a href="{{route('broker.show',$user->id)}}" class="btn btn-primary" style="padding:25px 15px 15px 15px;text-align:center"><i class="bx bx-user-circle"></i></a></td>
                                            <td><button class="brokerstatus btn btn-success m-auto d-block" id="{{$user->broker_id}}" data-bs-toggle="modal" data-bs-target="#exampleModal2">Add</button>

                                            </td>
                                            @if ($user->broker_approval_status == '1')
                                            <td><button style="width:150px" class="status btn btn-success btn-sm m-auto d-block" id="{{$user->broker_id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Approved</button></td>
                                                @elseif ($user->broker_approval_status == '2')
                                            <td><button style="width:150px" class="status btn btn-danger btn-sm m-auto d-block" id="{{$user->broker_id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Reject</button></td>
                                            @else
                                            <td><button style="width:150px" class="status btn btn-warning btn-sm m-auto d-block" id="{{$user->broker_id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Pending</button></td>
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
                  <h5 class="modal-title" id="exampleModalLabel">Profile Approval Status</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('images/logoeng.jpeg') }}" style="width:250px;background-color: #6d1140;padding: 20px;border-radius: 5px;" class="img-fluid m-auto d-block">
                    <div  class="text-center mt-5">
                        <form method="POST" action="/brokerStatusChange" style="margin-bottom: 10px;">
                            @csrf

                            <input type="hidden" name="status" class="approvestatus" value="1">
                            <input type="hidden" class="prid" name="prid">
                            <button type="submit" class="btn btn-success" style="width:250px">Approve</button>
                        </form>
                        <form method="POST" action="/brokerStatusChange" style="margin-bottom: 10px;">
                            @csrf
                            <input type="hidden" name="status" class="approvestatus" value="0">
                            <input type="hidden" class="prid" name="prid">
                            <button type="submit" class="btn btn-warning" style="width:250px">Pending</button>
                        </form>
                        <form method="POST" action="/brokerStatusChange" style="margin-bottom: 10px;">
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

          <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Percentage & Target Value</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                        <form method="POST" action="/brokerPercentage">
                            @csrf
                            <div class="form-group">
                                <label>Enter Percentage (User Payment Percentage)</label>
                                <input type="number" class="form-control mt-2" name="percentage">
                            </div>
                            <div class="form-group mt-3">
                                <label>Target Value</label>
                            <input type="number" class="form-control mt-2" name="targetvalue">
                            </div>
                            <input type="hidden" class="form-control getbrokerid" name="brokerid">
                            <input type="submit" class="btn btn-warning mt-3" style="width:100%" value="Save">
                        </form>
                </div>
              </div>
            </div>
          </div>


@endsection





