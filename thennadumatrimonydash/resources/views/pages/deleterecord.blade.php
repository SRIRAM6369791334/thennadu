@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Dashboard')
@section('main-content')

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Profile Details</div>
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
                                <th class="text-center">Thennadu ID</th>
                                <th class="text-center">Delete Request</th>
                                <th class="text-center">Delete Reason</th>
                                <th class="text-center">Approval Status</th>

                            </tr>
                        </thead>
                        <tbody>
                        @if($deleterecord)

                                @foreach ($deleterecord as $profiles)

                                    <tr>
                                        <td class="text-center">{{$profiles->varan_id}}</td>
                                        <td class="text-center">{{$profiles->delete_setting}}</td>
                                        <td class="text-center">{{$profiles->delete_reason}}</td>



                                       @if ($profiles->delete_setting == 'Approve')
                                        <td><button style="width:150px" class="status btn btn-success btn-sm m-auto d-block" id="{{$profiles->varan_id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">Approval</button></td>
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
            <img src="https://www.beddingtonphysio.com/images/testimonial-default.png" style="width:250px" class="img-fluid m-auto d-block">
            <div  class="text-center mt-5">
                <form method="POST" action="/deletestatuschange">
                    @csrf

                    <input type="hidden" name="status" class="approvestatus" value="Approve">
                    <input type="hidden" class="prid" name="prid">
                    <button type="submit" class="btn btn-success" style="width:250px">Approve</button>
                </form>
                <form method="POST" action="/deletestatuschange">
                    @csrf
                    <input type="hidden" name="status" class="approvestatus" value="Pending">
                    <input type="hidden" class="prid" name="prid">
                    <button type="submit" class="btn btn-warning" style="width:250px">Pending</button>
                </form>


            </div>
        </div>


      </div>
    </div>
  </div>





