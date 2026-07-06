@extends('pages.layouts.default')
@section('title','Manage Banners - Thennadu Matrimony')
@section('main-content')

    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Dynamic Banners</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a></li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBannerModal">Add New Banner</button>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Subtitle</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banners as $banner)
                                    <tr>
                                        <td><img src="{{ asset($banner->image) }}" width="150" alt="Banner" class="border p-1"></td>
                                        <td>{!! $banner->title !!}</td>
                                        <td>{{ Str::limit($banner->subtitle, 50) }}</td>
                                        <td>
                                            <span class="badge {{ $banner->status ? 'bg-success' : 'bg-danger' }}">
                                                {{ $banner->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <button type="button" class="btn btn-warning btn-sm" onclick="openEditModal({{ json_encode($banner) }})">Edit</button>
                                                <form method="POST" action="{{ route('banners.destroy', $banner->id) }}" onsubmit="return confirm('Delete this banner?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addBannerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Banner Image (1920x700 px) <span class="text-danger">*</span></label>
                                <input type="file" name="image" class="form-control" required>
                                <small class="text-muted">Required size: 1920 × 700 px (exact)</small>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Use {word} for gold highlight">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Subtitle</label>
                                <textarea name="subtitle" class="form-control" rows="3" placeholder="Short description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Banner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editBannerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editBannerForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12 text-center">
                                <label class="form-label d-block">Current Image</label>
                                <img id="edit_image_preview" src="" width="300" class="mb-2 border p-1" alt="Preview">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Change Image (1920x700 px)</label>
                                <input type="file" name="image" class="form-control">
                                <small class="text-muted">Leave empty to keep current.</small>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" id="edit_title" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Subtitle</label>
                                <textarea name="subtitle" id="edit_subtitle" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Banner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openEditModal(banner) {
            const form = document.getElementById('editBannerForm');
            form.action = `/banners/${banner.id}`;
            
            document.getElementById('edit_title').value = banner.title;
            document.getElementById('edit_subtitle').value = banner.subtitle;
            document.getElementById('edit_image_preview').src = `/${banner.image}`;
            
            var myModal = new bootstrap.Modal(document.getElementById('editBannerModal'));
            myModal.show();
        }
    </script>

@endsection
