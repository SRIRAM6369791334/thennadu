@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Dashboard')
@section('main-content')

<div class="page-wrapper" style="margin-top:0px">
			<div class="page-content" style="padding-top:60px;background-image:url('');background-size:cover;background-attachment:fixed;background-repeat:no-repeat">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Broker Details</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">User Profile</li>
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
				<div class="container">
					<div class="main-body">
						<div class="row">
							<div class="col-lg-4">
								<div class="card" >
									<div class="card-body">
										<div class="d-flex flex-column align-items-center text-center">
                                            {{-- <img src="{{asset('public/images/'.$register->job_category)}}" class="rounded-circle p-1 bg-primary" width="110"> --}}
											{{-- <img src="../assets/images/avatars/avatar-2.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110"> --}}
											<div class="mt-3">
												<h4>{{$data->name}}</h4>
												<p class="text-secondary mb-1">{{$data->job_category}}</p>
												<button class="btn btn-primary mt-4">{{$data->broker_id}}</button>

											</div>
										</div>
										<hr class="my-4" />
										<ul class="list-group list-group-flush">
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0">Mobile No</h6>
												<span class="text-secondary">{{$data->mblno}}</span>
											</li>
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0">E-mail ID</h6>
												<span class="text-secondary">{{$data->email}}</span>
											</li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0">Password</h6>
												<span class="text-secondary">{{$data->showpasswd}}</span>
											</li>


										</ul>
									</div>
								</div>
							</div>
							<div class="col-lg-8">
								<div class="card">
									<div class="card-body">
									    <h5 class="mb-4">Basic Details</h5>
										    <div class="row">
											<div class="col-sm-5">
												<h6 class="mb-0">Broker Percentage (%)</h6>
											</div>
											<div class="col-sm-7 text-secondary">
												<input type="text" class="form-control" value="{{$data->user_payment_percentage}}" readonly/>
											</div>
											</div>
                                            <div class="row mt-3">
                                                <div class="col-sm-5">
                                                    <h6 class="mb-0">Target Value</h6>
                                                </div>
                                                <div class="col-sm-7 text-secondary">
                                                    <input type="text" class="form-control" value="{{$data->target_value}}" readonly/>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-sm-5">
                                                    <h6 class="mb-0">Users Paid Amount</h6>
                                                </div>

                                                <div class="col-sm-7 text-secondary">
                                                    <input type="text" class="form-control" value="{{$payments->totalamt}}" readonly/>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-sm-5">
                                                    <h6 class="mb-0">Earned Amount</h6>
                                                </div>

                                                <div class="col-sm-7 text-secondary">
                                                    <input type="text" class="form-control" value="{{round($payments->totalamt/$data->user_payment_percentage,2)}}" readonly/>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-sm-5">
                                                    <h6 class="mb-0">Target Status</h6>
                                                </div>
                                                <div class="col-sm-7 text-secondary">
                                                    @if($data->target_value < $payments->totalamt/$data->user_payment_percentage)

                                                        <button class="btn btn-info btn-sm">Target Achieved</button>

                                                    @else

                                                    <button class="btn btn-danger btn-sm">Target Not Achieved</button>
                                                    @endif
                                                </div>
                                            </div>
                                            @if(auth()->user()->role == 3)
                                            <div class="row mt-3">


                                                <button class="btn btn-success getearnamt" data-brokerid="{{$data->broker_id}}" data-earnamt="{{round($payments->totalamt/$data->user_payment_percentage,2)}}" data-bs-toggle="modal" data-bs-target="#exampleModal"

                                                    @if($data->target_value < $payments->totalamt/$data->user_payment_percentage)

                                                        @else

                                                        disabled
                                                        @endif

                                                    >Send Payment Request</button>

                                        </div>
                                            @endif


											</div>

										</div>



									</div>
                                    <div class="card">
                                        <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>

                                                    <th>Earned Amount</th>
                                                    <th>Amount Request Date</th>
                                                    <th>Amount Paid Status</th>
                                                    <th>Amount Paid Date</th>
                                                    @if (auth()->user()->role == 3)

                                                        @else
                                                        <th>Status Update</th>
                                                    @endif

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($paymenthistory)

                                                    @foreach ($paymenthistory as $history)
                                                        <tr>
                                                            <td>{{$history->earned_amt}}</td>
                                                            <td>{{$history->req_date}}</td>
                                                            <td>
                                                                @if ($history->earned_amt_status == "1")
                                                                        <button class="btn btn-info btn-sm">Paid</button>
                                                                    @else
                                                                    <button class="btn btn-warning btn-sm">Pending</button>
                                                                @endif

                                                            </td>
                                                            <td>{{$history->amt_paid_date}}</td>
                                                            @if (auth()->user()->role == 3)

                                                        @else
                                                        <td>
                                                            <button class="btn btn-primary btn-sm getamt" data-amt="{{$history->earned_amt}}" data-bs-toggle="modal" data-bs-target="#exampleModal3">Update</button>
                                                        </td>
                                                    @endif

                                                        </tr>
                                                    @endforeach

                                                @endif
                                                <tr>
                                                    <td></td>
                                                </tr>
                                            </tbody>


                                        </table>
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
			</div>
		</div>

@endsection
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Send Payment Request</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <img src="../images/602.9-send-message-icon-iconbunny.jpg" style="width:200px;margin:0 auto;display:block" class="img-fluid">
            <h5 class="text-center text-success mt-3">Congratulations..!!</h5>
            <h6 class="text-center ">You Earned {{round($payments->totalamt/$data->user_payment_percentage,2)}} Amount</h6>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <form method="POST" action="/sendpaymentreq">
            @csrf
            <input type="hidden" value="{{$data->broker_id}}" name="brokerid" >
            <input type="hidden" value="{{round($payments->totalamt/$data->user_payment_percentage,2)}}" name="earnedamt" >
            <button type="submit" class="btn btn-primary">Send Request</button>
          </form>

        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Paid Status</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">


                <form method="POST" action="/paidstatuschange">
                    @csrf
                    <div class="form-group">
                        <label>Amount Paid Status</label>
                        <select class="form-control" name="paidstatus" required>
                            <option value="">-- Choose paid Status --</option>
                            <option value="1">Paid</option>
                            <option value="0">Pending</option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label>Paid Date</label>
                    <input type="date" class="form-control mt-2" name="paiddate" required>
                    </div>
                    <input type="hidden" class="form-control" name="brokerid" value="{{$data->broker_id}}">
                    <input type="hidden" class="form-control amt" name="amt">
                    <input type="submit" class="btn btn-warning mt-3" style="width:100%" value="Save Data">
                </form>



        </div>


      </div>
    </div>
  </div>




