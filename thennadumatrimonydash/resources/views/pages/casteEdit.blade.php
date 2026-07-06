@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Dashboard')
@section('main-content')

    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Caste Tables</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
								</li>

							</ol>
						</nav>
					</div>
					<!--<div class="ms-auto">-->
					<!--	<div class="btn-group">-->
					<!--		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Caste</button>-->


					<!--	</div>-->
					<!--</div>-->
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
                        <div class="card pb-3" >
                            <div class="card-body">
                                <form method="POST" action="{{route('caste.update',$caste->id)}}">
                                    @csrf
                                    @method('PATCH')

                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Religion</label>
                                        <select class="form-control" id="exampleFormControlInput1" name="religion" required>
                                            <option value="">Select Religion</option>
                                            @foreach ($religion as $relg)
                                                @if($caste->religion == $relg->id)
                                                    <option value="{{ $relg->id }}" selected>{{ $relg->religion_name }}</option>
                                                @else
                                                    <option value="{{ $relg->id }}">{{ $relg->religion_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        </div>
                                        
                                       <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Caste name</label>
                                        <!--<select class="form-control" name="Caste_name">-->
                                        <!--    <option>-- Choose Option --</option>-->

                                        <!--@if($caste)-->
                                        <!--                            @foreach ($caste as $cast)-->
                                        <!--        <option value="{{$caste->Caste_name}}" {{ $caste->Caste_name == $caste->Caste_name ? 'selected' : '' }}>{{$caste->Caste_name}}</option>-->

                                        <!--    @endforeach-->
                                        <!--@endif-->
                                        <!--</select>-->
                                        
                                        
                                        
                                        <input type="text" class="form-control" id="exampleFormControlInput1" name="Caste_name" value="{{$caste->Caste_name}}" placeholder="Enter Caste Name" required>
                                    </div>
                          </div>

                            <button type="submit" class="btn btn-primary" style="width:200px;margin:0 auto;display:block">Save changes</button>

                             </form>
                            </div>
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

    </div>
  </div>
</div>
@endsection




