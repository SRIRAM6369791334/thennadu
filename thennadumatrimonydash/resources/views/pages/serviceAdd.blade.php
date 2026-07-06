@extends('pages.layouts.default')
@section('title', isset($service) ? 'Edit Service' : 'Add Service')

@section('main-content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Wedding Services</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('services.index') }}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ isset($service) ? 'Edit Service' : 'Add Service' }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">{{ isset($service) ? 'Edit Service' : 'Add New Service' }}</h5>
                <hr/>
                <form action="{{ isset($service) ? route('services.update', $service->id) : route('services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($service))
                        @method('PUT')
                    @endif

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Service Title</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter service title" value="{{ old('title', $service->title ?? '') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tag" class="form-label">Service Tag (Optional)</label>
                                        <input type="text" class="form-control" id="tag" name="tag" placeholder="e.g. Traditional & Modern" value="{{ old('tag', $service->tag ?? '') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="details" class="form-label">Service Details</label>
                                        <textarea class="form-control" id="summernote" name="details" rows="10" required>{{ old('details', $service->details ?? '') }}</textarea>
                                        <div class="mt-2">
                                            <small class="text-muted">Character count: <span id="charCount">0</span>. (Recommended for preview: ~150 chars)</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="image" class="form-label">Service Image</label>
                                            <input type="file" class="form-control" id="image" name="image" {{ isset($service) ? '' : 'required' }}>
                                            @if(isset($service) && $service->image)
                                                <div class="mt-2">
                                                    <img src="{{ asset($service->image) }}" class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" id="status" name="status">
                                                <option value="1" {{ (old('status', $service->status ?? 1) == 1) ? 'selected' : '' }}>Enabled</option>
                                                <option value="0" {{ (old('status', $service->status ?? 1) == 0) ? 'selected' : '' }}>Disabled</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">Save Service</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end row-->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- Summernote CSS/JS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Write service details here...',
            tabsize: 2,
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    updateCharCount(contents);
                }
            }
        });

        // Initialize char count
        updateCharCount($('#summernote').val());

        function updateCharCount(content) {
            // Strip HTML tags to count text characters
            var text = content.replace(/<[^>]*>/g, '');
            $('#charCount').text(text.length);
        }
    });
</script>
@endsection
