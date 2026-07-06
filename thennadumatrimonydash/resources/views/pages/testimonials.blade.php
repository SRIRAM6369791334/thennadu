@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Dashboard')
@section('main-content')

    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Testimonial's Details</div>
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
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add a Testimonials</button>


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

                                        <th class="text-center">Title</th>
                                        <th class="text-center">Image</th>
                                        <th class="text-center">Edit</th>
                                        <th class="text-center">Delete</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @if ($testimonials)

                                    @foreach ($testimonials as $testimonial)
                                        <tr>
                                            {{-- {{$username = $user->name}} --}}
                                            <td>{{$testimonial ->Title}}</td>
                                            <td>{{$testimonial->Image}}</td>
                                            <td class="text-center" style="vertical-align:middle"><a href="{{route('testimonials.edit',$testimonial->id)}}" class="btn btn-primary" style="padding:25px 15px 15px 15px;text-align:center"><i class="bx bx-pencil"></i></a></td>
                                               <td class="text-center" style="vertical-align:middle">
                                                <form method="POST" action="{{route('testimonials.destroy',$testimonial->id)}}" onsubmit="return confirm('Do You want Delete this Data?')">
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
        <h5 class="modal-title" id="exampleModalLabel">Add Testimonials</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" method="POST" action="{{route('testimonials.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="col-sm-12">
                <label for="inputFirstName" class="form-label">Title</label>
                <input type="text" class="form-control" id="inputFirstName" name="name" placeholder="Testimonial's Title" required>
            </div>
            <div class="col-sm-12">
                <label for="inputLastName" class="form-label">Image</label>
                <input type="file" class="form-control" id="inputLastName" name="image" placeholder="Mobile Number" required>
            </div>
            <div class="col-12">
                <label for="inputEmailAddress" class="form-label">Description</label>
                <textarea class="form-control" name="testidescription"></textarea>
            </div>



            <div class="col-12">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary"><i class='bx bx-user'></i>Save</button>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection





