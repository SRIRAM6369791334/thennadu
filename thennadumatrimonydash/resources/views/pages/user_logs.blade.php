@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Dashboard')
@section('main-content')

    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">User Logs</div>
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
				<!-- Section: User logs table -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">User Name</th>
                                        <th class="text-center">Thennadu ID</th>
                                        <th class="text-center">IP Address</th>
                                        <th class="text-center">Total Logins</th>
                                        <th class="text-center">Last Login</th>
                                        <th class="text-center">View All</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($userlogs && count($userlogs) > 0)
                                        @foreach ($userlogs as $i => $logs)
                                            <tr>
                                                <td class="text-center">{{ $i + 1 }}</td>
                                                <td class="text-center fw-semibold">{{ $logs->user_name ?? '—' }}</td>
                                                <td class="text-center">
                                                    <span class="badge" style="background:#8B0000;color:#fff;padding:5px 10px;border-radius:6px;">
                                                        {{ $logs->user_id }}
                                                    </span>
                                                </td>
                                                <td class="text-center">{{ $logs->user_ip }}</td>
                                                <td class="text-center">
                                                    <span class="badge bg-success" style="font-size:13px;padding:5px 12px;">{{ $logs->login_count }}</span>
                                                </td>
                                                <td class="text-center" style="font-size:13px;color:#555;">{{ $logs->last_login }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('user-logs.show', $logs->user_id) }}" class="btn btn-primary btn-sm">
                                                        <i class="bx bx-list-ul"></i> View
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                No login logs found. Logs will appear here after users log in.
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
				<!-- Section: User logs table -->
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




