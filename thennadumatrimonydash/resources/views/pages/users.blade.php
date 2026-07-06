@extends('pages.layouts.default')
@section('title', 'Thennadu Matrimony - Dashboard')
@section('main-content')

    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Users Details</div>
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Add User</button>


                    </div>
                </div>
            </div>
            @if (session()->get('success'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
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

                                    <th class="text-center">User Name</th>
                                    <th class="text-center">E-mail</th>
                                    <th class="text-center">Phone Number</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Permission</th>

                                </tr>
                            </thead>
                            <tbody>

                                @if ($users)

                                    @foreach ($users as $user)
                                        <tr>
                                            {{-- {{$username = $user->name}} --}}
                                            <td>{{ $username = $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->mblno }}</td>
                                            <td>
                                                @if ($user->role == 1)
                                                    Admin
                                                @elseif ($user->role == 2)
                                                    Office Staff
                                                @else
                                                    Broker
                                                @endif

                                            </td>
                                            <td><a href="/datacheck/{{ $user->name }}/{{ $user->user_ID }}"
                                                    class="btn btn-success m-auto d-block getid">Add Permission</a></td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" method="POST" action="/store">
                        @csrf
                        <div class="col-sm-6">
                            <label for="inputFirstName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="inputFirstName" name="name"
                                placeholder="Name">
                        </div>
                        <div class="col-sm-6">
                            <label for="inputLastName" class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" id="inputLastName" name="mblnum" id="tArea5"
                                oninput="limitChar1(this)" placeholder="Mobile Number">
                        </div>
                        <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="inputEmailAddress" name="email"
                                placeholder="example@user.com">
                        </div>
                        <div class="col-12">
                            <label for="inputChoosePassword" class="form-label">Password</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" class="form-control border-end-0" name="password"
                                    id="inputChoosePassword" value="12345678" placeholder="Enter Password"> <a
                                    href="javascript:;" class="input-group-text bg-transparent"><i
                                        class='bx bx-hide'></i></a>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="inputSelectCountry" class="form-label">Role</label>
                            <select class="form-select" id="inputSelectCountry" name="role"
                                aria-label="Default select example">
                                <option value="1">Admin</option>
                                <option value="2">Office Staff</option>
                                <option value="3">Broker</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary"><i class='bx bx-user'></i>Sign up</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection




