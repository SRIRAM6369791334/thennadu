@extends('pages.layouts.default')
@section('title','Edit Success Story - Dashboard')
@section('main-content')

    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Edit Success Story</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
								</li>
                                <li class="breadcrumb-item"><a href="{{ route('success-stories.index') }}">Success Stories</a></li>
							</ol>
						</nav>
					</div>
				</div>
                @if(session()->get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session()->get('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
				<!--end breadcrumb-->

                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="card pb-3">
                            <div class="card-body">
                                <form method="POST" action="{{ route('success-stories.update', $story->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="male_name" class="form-label">Male Name</label>
                                            <input type="text" class="form-control" id="male_name" name="male_name" value="{{ $story->male_name }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="female_name" class="form-label">Female Name</label>
                                            <input type="text" class="form-control" id="female_name" name="female_name" value="{{ $story->female_name }}" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="married_date" class="form-label">Married Date</label>
                                        <input type="text" class="form-control" id="married_date" name="married_date" value="{{ $story->married_date }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image (640px x 640px)</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                        @if($story->image)
                                            <div class="mt-2">
                                                <img src="{{ asset('images/success_stories/'.$story->image) }}" width="150px" class="img-thumbnail">
                                            </div>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" name="description" rows="5" required>{{ $story->description }}</textarea>
                                    </div>

                                    <div class="d-grid mt-4">
                                        <button type="submit" class="btn btn-primary" style="width:200px;margin:0 auto;display:block">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        // Client-side Image Size Validation
        $('#image').on('change', function() {
            var file = this.files[0];
            if (file) {
                var img = new Image();
                img.src = window.URL.createObjectURL(file);
                img.onload = function() {
                    var width = img.naturalWidth;
                    var height = img.naturalHeight;
                    window.URL.revokeObjectURL(img.src);

                    if (width !== 640 || height !== 640) {
                        swal({
                            title: "Invalid Image Size!",
                            text: "The selected image is " + width + "x" + height + "px. It must be exactly 640x640px.",
                            icon: "error",
                            button: "OK",
                        });
                        $('#image').val(''); // Clear the input
                    }
                };
            }
        });

        // Server-side Error Display using SweetAlert
        @if ($errors->any())
            swal({
                title: "Validation Error",
                text: {!! json_encode(implode("\n", $errors->all())) !!},
                icon: "error",
                button: "Close"
            });
        @endif
    });
</script>
@endsection
