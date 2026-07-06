@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Services')
@section('main-content')

    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Wedding Services</div>
                <div class="ps-3">
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('services.create') }}" class="btn btn-primary">Add a Service</a>
                    </div>
                </div>
            </div>
            
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session()->get('success')}}
                <button type="button" class="btn-close" data-bs-alert="alert" aria-label="Close"></button>
              </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Tag</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td class="text-center" style="vertical-align:middle">{{ $loop->iteration }}</td>
                                        <td class="text-center" style="vertical-align:middle">
                                            <img src="{{ asset($service->image) }}" width="80" class="rounded shadow-sm">
                                        </td>
                                        <td class="text-center" style="vertical-align:middle">{{ $service->title }}</td>
                                        <td class="text-center" style="vertical-align:middle">{{ $service->tag }}</td>
                                        <td class="text-center" style="vertical-align:middle">
                                            @if($service->status)
                                                <span class="badge bg-success">Enabled</span>
                                            @else
                                                <span class="badge bg-danger">Disabled</span>
                                            @endif
                                        </td>
                                        <td class="text-center" style="vertical-align:middle">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('services.edit', $service->id) }}" class="btn btn-primary btn-sm"><i class="bx bx-pencil"></i></a>
                                                <form method="POST" action="{{ route('services.destroy', $service->id) }}" onsubmit="return confirm('Do you want to delete this service?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="bx bx-trash"></i></button>
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
@endsection
