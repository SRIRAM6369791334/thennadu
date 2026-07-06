@extends('pages.layouts.default')
@section('title','Edit Banner - Thennadu Matrimony')
@section('main-content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Edit Banner</div>
                <div class="ms-auto">
                    <a href="{{ route('banners.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Banner Details</h5>
                    <hr/>
                    <form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Current Banner Image</label><br>
                                <img src="{{ asset($banner->image) }}" width="300" class="mb-2" alt="Current Banner" style="border: 2px solid #ddd; padding: 5px;"><br>
                                <label class="form-label">Change Image (1920x700 px)</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                <small class="text-muted">Required size: 1920 × 700 px (exact). Leave empty to keep current.</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $banner->title }}" placeholder="Use {word} for gold highlight">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Subtitle</label>
                                <textarea name="subtitle" class="form-control" rows="3">{{ $banner->subtitle }}</textarea>
                            </div>
                            <div class="col-12 mt-4 text-muted border-top pt-3">
                                <small>Note: Buttons (Register/Browse) and Order are now fixed as static.</small>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary px-5">Update Banner</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
