@extends('pages.layouts.default')
@section('title','Success Stories - Dashboard')
@section('main-content')

    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Success Stories</div>
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
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSuccessStoryModal">Add Success Story</button>
						</div>
					</div> 
				</div>
                @if(session()->get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session()->get('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
				<!--end breadcrumb-->
				
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Image</th>
                                        <th class="text-center">Couple Names</th>
                                        <th class="text-center">Married Date</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center">Edit</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($stories)
                                    @foreach ($stories as $story)
                                        <tr>
                                            <td class="text-center">
                                                @if($story->image)
                                                    <img src="{{ asset('images/success_stories/'.$story->image) }}" alt="" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            <td>{{ $story->male_name }} & {{ $story->female_name }}</td>
                                            <td>{{ $story->married_date }}</td>
                                            <td>{{ Str::limit($story->description, 50) }}</td>
                                            <td class="text-center" style="vertical-align:middle">
                                                <a href="{{ route('success-stories.edit', $story->id) }}" class="btn btn-primary btn-sm"><i class="bx bx-pencil"></i></a>
                                            </td>
                                            <td class="text-center" style="vertical-align:middle">
                                                <form method="POST" action="{{ route('success-stories.destroy', $story->id) }}" onsubmit="return confirm('Do You want Delete this Data?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
			</div>
		</div>

		<div class="modal fade" id="addSuccessStoryModal" tabindex="-1" aria-labelledby="addSuccessStoryModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSuccessStoryModalLabel">Add Success Story</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" method="POST" action="{{ route('success-stories.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-sm-6">
                                <label for="male_name" class="form-label">Male Name</label>
                                <input type="text" class="form-control" id="male_name" name="male_name" placeholder="Vijay" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="female_name" class="form-label">Female Name</label>
                                <input type="text" class="form-control" id="female_name" name="female_name" placeholder="Ananya" required>
                            </div>
                            <div class="col-sm-12">
                                <label for="married_date" class="form-label">Married Date</label>
                                <input type="text" class="form-control" id="married_date" name="married_date" placeholder="Dec 22, 2023" required>
                            </div>
                            <div class="col-sm-12">
                                <label for="image" class="form-label">Image (640px x 640px)</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="3" required></textarea>
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Save Success Story</button>
                                </div>
                            </div>
                        </form>
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
