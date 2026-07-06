@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Dashboard')
@section('main-content')

    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Banner Images</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
								</li>

							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add a Image</button>


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

                                        <th class="text-center">Banner Image</th>
                                        <th class="text-center">Delete</th>

                                    </tr>
                                </thead>
                                <tbody>
                                @if($banner)

                                        @foreach ($banner as $bannerimg)

                                            <tr>
                                                <td class="text-center" style="vertical-align:middle"><img src="{{asset('images/backend_images/'.$bannerimg->imgname)}}" width="100px"></td>

                                                <td class="text-center" style="vertical-align:middle">
                                                    <form method="POST" action="{{route('banner.destroy',$bannerimg->id)}}" onsubmit="return confirm('Do You want Delete this Data?')">
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
            <form method="POST" action="{{route('banner.store')}}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Image</label>
                    <input type="file" class="form-control" id="exampleFormControlInput1" name="img_name" placeholder="Enter Caste Name">
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




