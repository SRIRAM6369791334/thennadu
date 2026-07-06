@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Dashboard')
@section('main-content')

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Premium Profile Details</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
                        </li>

                    </ol>
                </nav>
            </div>

        </div>
        @if(session()->get('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{session()->get('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <!--end breadcrumb-->
        <!--<h6 class="mb-0 text-uppercase">Profile Details</h6>-->
        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Mobile Number</th>
                                <th class="text-center">E-mail</th>
                                <th class="text-center">Gender</th>
                                <th class="text-center">View Profile</th>
                                <th class="text-center">Approval Status</th>

                            </tr>
                        </thead>
                        <tbody>
                        @if($data)

                                @foreach ($data as $profiles)

                                    <tr>
                                        <td>{{$profiles->varan_id}}</td>
                                        <td>{{$profiles->Name}}</td>
                                        <td>{{$profiles->mobile_no}}</td>
                                        <td>{{$profiles->email_id}}</td>
                                        <td>
                                            @if($profiles->Gender == 1)
                                            Male
                                            @elseif ($profiles->Gender == 2)
                                            Female
                                            @else
                                            {{$profiles->Gender}}
                                            @endif
                                        </td>
                                       <td><a href="{{route('profiles.show',$profiles->id)}}" class="btn btn-primary" style="padding:25px 15px 15px 15px;text-align:center"><i class="bx bx-user-circle"></i></a></td>
                                       @if ($profiles->status == '1')
                                        <td><button style="width:150px" class="status btn btn-success btn-sm m-auto d-block" id="{{$profiles->varan_id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Approved</button></td>
                                            @elseif ($profiles->status == '2')
                                        <td><button style="width:150px" class="status btn btn-danger btn-sm m-auto d-block" id="{{$profiles->varan_id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Reject</button></td>
                                        @else
                                        <td><button style="width:150px" class="status btn btn-warning btn-sm m-auto d-block" id="{{$profiles->varan_id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Pending</button></td>
                                       @endif
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

@endsection

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Profile Approval Status</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <img src="{{ asset('images/logoeng.jpeg') }}" style="width:250px;background-color: #6d1140;padding: 20px;border-radius: 5px;" class="img-fluid m-auto d-block">
            <div  class="text-center mt-5">
                <form method="POST" action="/statusChange">
                    @csrf

                    <input type="hidden" name="status" class="approvestatus" value="1">
                    <input type="hidden" class="prid" name="prid">
                    <button type="submit" class="btn btn-success" style="width:250px">Approve</button>
                </form>
                <!--<form method="POST" action="/statusChange">-->
                <!--    @csrf-->
                <!--    <input type="hidden" name="status" class="approvestatus" value="0">-->
                <!--    <input type="hidden" class="prid" name="prid">-->
                <!--    <button type="submit" class="btn btn-warning" style="width:250px">Pending</button>-->
                <!--</form>-->
                <form method="POST" action="/statusChange">
                    @csrf
                    <input type="hidden" name="status" class="approvestatus" value="2">
                    <input type="hidden" class="prid" name="prid">
                    <button type="submit" class="btn btn-danger" style="width:250px">Reject</button>
                </form>

            </div>
        </div>


      </div>
    </div>
  </div>





