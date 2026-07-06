@extends('pages.layouts.default')

@section('main-content')
<div class="page-wrapper">
    <div class="page-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Admin</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Chat Management</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form action="{{ route('admin.chat.index') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label fw-bold">User</label>
                        <select name="user_id" class="form-select select2">
                            <option value="">All Users</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Date</label>
                        <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                    </div>
                    <div class="col-md-3">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="flagged" value="1" id="flaggedCheck" {{ request('flagged') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="flaggedCheck">
                                Flagged Messages Only
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bx bx-search-alt-2"></i> Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Conversations List -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Participants</th>
                                <th>Last Message</th>
                                <th>Date</th>
                                <th>Moderation</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($conversations as $conv)
                                <tr>
                                    <td>#{{ $conv->id }}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold">{{ $conv->userOne->name }} ({{ $conv->userOne->user_ID }})</span>
                                            <span class="text-muted small">&</span>
                                            <span class="fw-bold">{{ $conv->userTwo->name }} ({{ $conv->userTwo->user_ID }})</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-truncate" style="max-width: 250px;">
                                            {{ $conv->lastMessage ? $conv->lastMessage->message : 'No messages' }}
                                        </div>
                                    </td>
                                    <td>{{ $conv->updated_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        @if($conv->messages()->where('flagged_by_admin', true)->exists())
                                            <span class="badge bg-danger">Flagged Messages Found</span>
                                        @else
                                            <span class="badge bg-success">Clean</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a href="{{ route('admin.chat.show', $conv->id) }}" class="text-primary bg-light-primary border-0 me-3" title="View History"><i class='bx bxs-show'></i></a>
                                            <form action="{{ route('admin.chat.delete', $conv->id) }}" method="POST" onsubmit="return confirm('Archive/Delete this conversation?');">
                                                @csrf
                                                <button type="submit" class="text-danger bg-light-danger border-0" title="Delete"><i class='bx bxs-trash'></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted font-italic">No conversations found matching filters.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="mt-4">
                    {{ $conversations->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
