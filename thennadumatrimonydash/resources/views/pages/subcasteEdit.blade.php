@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Dashboard')
@section('main-content')

    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Subcaste Tables</div>
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
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{route('subcaste.update',$subcaste->id)}}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Caste name</label>
                                        <select class="form-control" name="Caste_name" required>
                                            <option value="">-- Choose Option --</option>

                                        @if($caste)
                                                                    @foreach ($caste as $cast)
                                                                        <option value="{{$cast->id}}" {{ $cast->id == $subcaste->Category_name ? 'selected' : '' }}>{{$cast->Caste_name}}</option>

                                                                    @endforeach
                                                                @endif
                                                            </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">SubCaste name</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" name="subcaste_name" value="{{$subcaste->subcategory_name}}" placeholder="Enter Caste Name">
                                    </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                          </div>
                        </form>
                            </div>
                    </div>
                </div>

                </div>
				<!-- Section: Pricing table -->
			</div>
		</div>


@endsection




