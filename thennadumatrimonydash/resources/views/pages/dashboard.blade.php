@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Dashboard')
@section('main-content')
<div class="page-wrapper">
    <div class="page-content">

@if(Auth::user()->role == 3)
        <div class="card radius-10">
            <div class="card-body">
                <div class="container">
                    <div class="row row-group row-cols-1 row-cols-xl-4">
                        <div class="col" style="border:1px solid #ccc">
                            <a href="#">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-dark"><b>Total Profiles</b></p>
                                            <h4 class="mt-4 text-primary">{{$totalcount->count()}}</h4>
                                        </div>
                                        <div class="ms-auto"><i class="bx bx-user text-primary" style="font-size:65px"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@elseif(Auth::user()->role == 1)
    <div class="card radius-10">
            <div class="card-body">
                <div class="container">
                    <div class="row row-group row-cols-1 row-cols-xl-4">
                        <div class="col" style="border:1px solid #ccc">
                            <a href="/profiles">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-dark"><b>Total Profiles</b></p>
                                            <h4 class="mt-4 text-primary">{{$totalcount->count()}}</h4>
                                        </div>
                                        <div class="ms-auto"><i class="bx bx-user text-primary" style="font-size:65px"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col" style="border:1px solid #ccc">
                            <a href="/profilefilter/1">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-dark"><b>Approved Profiles</b></p>
                                            <h4 class="mt-4 text-danger">{{$newprofilescount->count()}}</h4>
                                        </div>
                                        <div class="ms-auto"><i class="bx bx-wallet text-danger" style="font-size:65px"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col" style="border:1px solid #ccc">
                            <a href="/profilefilter/2">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-dark"><b>Pending Profiles</b></p>
                                            <h4 class="mt-4 text-success">{{$pendingprofilescount->count()}}</h4>
                                        </div>
                                        <div class="ms-auto"><i class="bx bx-line-chart-down text-success" style="font-size:65px"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col" style="border:1px solid #ccc">
                            <a href="/profilefilter/3">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-dark"><b>Blocked Profiles</b></p>
                                            <h4 class="mt-4 text-secondary">{{$blockedprofilescount->count()}}</h4>
                                        </div>
                                        <div class="ms-auto"><i class="bx bx-block font-35 text-secondary" style="font-size:65px"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col" style="border:1px solid #ccc">
                            <a href="/approveprofileimg">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-dark"><b>Approved Images</b></p>
                                            <h4 class="mt-4 text-info">{{$imageapprovalcount->count()}}</h4>
                                        </div>
                                        <div class="ms-auto"><i class="bx bx-image font-35 text-info" style="font-size:65px"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- <div class="col" style="border:1px solid #ccc">
                            <a href="/pendingprofileimg">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-dark"><b>Approval Pending Images</b></p>
                                            <h4 class="mt-4 text-primary">{{$imageapprovalpendingcount->count()}}</h4>
                                        </div>
                                        <div class="ms-auto"><i class="bx bx-image font-35 text-primary" style="font-size:65px"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div> -->
                        <!-- <div class="col" style="border:1px solid #ccc">
                            <a href="/packages">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-dark"><b>Packages Count</b></p>
                                            <h4 class="mt-4 text-danger">{{$packagecount->count()}}</h4>
                                        </div>
                                        <div class="ms-auto"><i class="bx bx-package font-35 text-danger" style="font-size:65px"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div> -->
                        <!-- <div class="col" style="border:1px solid #ccc">
                            <a href="/brokers">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-dark"><b>Marriage Matcher Count</b></p>
                                            <h4 class="mt-4 text-warning">{{$brokercount->count()}}</h4>
                                        </div>
                                        <div class="ms-auto"><i class="bx bx-group font-35 text-warning" style="font-size:65px"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div> -->
                        <!-- <div class="col" style="border:1px solid #ccc">
                            <a href="/approvehoroscopeimg">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-dark"><b>Horoscope Approved</b></p>
                                            <h4 class="mt-4 text-danger">{{$horoscopeapproved->count()}}</h4>
                                        </div>
                                        <div class="ms-auto"><i class="bx bx-star font-35 text-danger" style="font-size:65px"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div> -->
    
                        <!-- <div class="col" style="border:1px solid #ccc">
                            <a href="/pendinghoroscopeimg">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-dark"><b>Approval Pending Horoscope</b></p>
                                            <h4 class="mt-4 text-success">{{$horoscopepending->count()}}</h4>
                                        </div>
                                        <div class="ms-auto"><i class="bx bx-badge font-35 text-success" style="font-size:65px"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div> -->
    
                        <!-- <div class="col" style="border:1px solid #ccc">
                            <a href="/approvedvideofil">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-dark"><b>Approved Video</b></p>
                                            <h4 class="mt-4 text-primary">{{$approvedvideos->count()}}</h4>
                                        </div>
                                        <div class="ms-auto"><i class="bx bx-video font-35 text-primary" style="font-size:65px"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div> -->
    
                        <!-- <div class="col" style="border:1px solid #ccc">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-dark"><b>Vendors Count</b></p>
                                        <h4 class="mt-4 text-secondary">{{$vendorcount->count()}}</h4>
                                    </div>
                                    <div class="ms-auto"><i class="bx bx-group font-35 text-secondary" style="font-size:65px"></i>
                                    </div>
                                </div>
    
                            </div>
                        </div> -->
    
                    </div>
                </div>
            </div>
        </div>


      <!--end row-->

        <!-- <div class="row">
            <div class="col-12 col-lg-6">
                <div class="card radius-10">
                    <div class="card-body" style="height:400px">
                     <div class="align-items-center">
                         <div>
                             <h6 class="mb-0">Banner Images</h6>
                         </div>

                     </div>
                     <div class="chart-container-1 mt-4">
                        <div class="table-responsive mt-4">
                            <table class="table table-bordered">
                                   <thead>
                                       <tr>
                                           <th class="text-center">ID</th>
                                           <th class="text-center">Image </th>
                                           <th class="text-center">View</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                       @if ($bannerimg)

                                            @foreach ($bannerimg as $banner)
                                            <tr>
                                                <td class="text-center" style="vertical-align:middle">{{ $loop->iteration }}</td>
                                                <td class="text-center" style="vertical-align:middle"><img src="{{asset('images/backend_images/'.$banner->imgname)}}" width="30px"></td>
                                                <td class="text-center" style="vertical-align:middle"><a href="/banner" class="btn btn-success btn-sm">View</a></td>
                                            </tr>
                                            @endforeach
                                       @endif

                                   </tbody>
                            </table>
                        </div>
                       </div>
                    </div>
                </div>
            </div> -->
            <div class="col-12 col-lg-6">
                <div class="card radius-10">
                    <div class="card-body" style="height:400px">
                     <div class="d-flex align-items-center">
                         <div>
                             <h6 class="mb-0">Package Details</h6>
                         </div>

                     </div>
                     <div class="chart-container-1 mt-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Package Name </th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($package)

                                     @foreach ($package as $packagedata)
                                     <tr>
                                         <td style="vertical-align:middle" class="text-center">{{$loop->iteration}}</td>
                                         <td style="vertical-align:middle" class="text-center">{{$packagedata->package_name}}</td>
                                         <td style="vertical-align:middle" class="text-center">{{$packagedata->package_price}}</td>
                                         <td style="vertical-align:middle" class="text-center"><a href="/packages" class="btn btn-success btn-sm">View</a></td>
                                     </tr>
                                     @endforeach
                                @endif

                            </tbody>
                     </table>
                       </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-12 col-lg-6">
                <div class="card radius-10">
                    <div class="card-body" style="height:400px">
                     <div class="d-flex align-items-center">
                         <div>
                             <h6 class="mb-0">Users Details</h6>
                         </div>

                     </div>
                     <div class="chart-container-1 mt-4">
                        <table class="table table-bordered" >
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">User Name </th>
                                    <th class="text-center">Mobile Number</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($users)

                                     @foreach ($users as $user)
                                     @if($user->role == 4) @continue @endif
                                     <tr>
                                         <td style="vertical-align:middle" class="text-center">{{$loop->iteration}}</td>
                                         <td style="vertical-align:middle" class="text-center">{{$user->name}}</td>
                                         <td style="vertical-align:middle" class="text-center">{{$user->mblno}}</td>
                                         <td style="vertical-align:middle" class="text-center">
                                             @if($user->role == 1) Admin
                                             @elseif($user->role == 2) Office Staff
                                             @elseif($user->role == 3) Broker
                                             @else {{ $user->role }} @endif
                                         </td>
                                         <td style="vertical-align:middle" class="text-center"><a href="/users" class="btn btn-success btn-sm">View</a></td>
                                     </tr>
                                     @endforeach
                                @endif

                            </tbody>
                     </table>
                       </div>
                    </div>
                </div>
            </div> -->
            <div class="col-12 col-lg-6">
                <div class="card radius-10">
                    <div class="card-body">
                     <div class="d-flex align-items-center">
                         <div>
                             <h6 class="mb-0">Profile Report Request</h6>
                         </div>

                     </div>
                     <div class="chart-container-1 mt-4">
                        <table class="table table-bordered" >
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">User Thennadu ID </th>
                                    <th class="text-center">Report Thennadu ID</th>
                                    <th class="text-center">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($reportcount)

                                     @foreach ($reportcount as $user)
                                     <tr>
                                         <td style="vertical-align:middle" class="text-center">{{$loop->iteration}}</td>
                                         <td style="vertical-align:middle" class="text-center">{{$user->user_varan_id}}</td>
                                         <td style="vertical-align:middle" class="text-center">{{$user->report_varan_id}}</td>

                                         <td style="vertical-align:middle" class="text-center"><a href="/report" class="btn btn-success btn-sm">View</a></td>
                                     </tr>
                                     @endforeach
                                @endif

                            </tbody>
                     </table>
                       </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->

         <div class="card radius-10">
                 <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Approval Pending Profiles</h6>
                        </div>

                    </div>
                 <div class="table-responsive mt-4">
                   <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light">
                     <tr>
                       <th class="text-center">Thennadu ID</th>
                       <th class="text-center">Name</th>
                       <th class="text-center">Mobile No</th>
                       <th class="text-center">E-mail</th>
                       <th class="text-center">Gender</th>
                       <th class="text-center">Approval Status</th>
                       <th class="text-center">Action</th>
                     </tr>
                     </thead>
                     <tbody>
                        @if ($profilesdetails)
                            @foreach ($profilesdetails as $profile)
                                <tr>
                                    <td class="text-center" style="padding:10px 5px">{{$profile->varan_id}}</td>
                                    <td class="text-center" style="padding:10px 5px">{{$profile->Name}}</td>
                                    <td class="text-center" style="padding:10px 5px">{{$profile->mobile_no}}</td>
                                    <td class="text-center" style="padding:10px 5px">{{$profile->email_id}}</td>
                                    <td class="text-center" style="padding:10px 5px">{{$profile->Gender}}</td>
                                    @if ($profile->status == '1')
                                    <td><button style="width:150px" class="status btn btn-success btn-sm m-auto d-block" >Approval</button></td>
                                        @elseif ($profile->status == '2')
                                    <td><button style="width:150px" class="status btn btn-danger btn-sm m-auto d-block" >Reject</button></td>
                                    @else
                                    <td><button style="width:150px" class="status btn btn-warning btn-sm m-auto d-block" >Pending</button></td>
                                   @endif
                                   <td class="text-center"><a href="{{ route('profiles.show', $profile->id) }}" class="btn btn-primary btn-sm">View</a></td>
                                </tr>
                            @endforeach
                        @endif
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                  </table>
                  </div>
                 </div>
            </div>
@elseif(Auth::user()->role == 2)


@endif

        

            <!--end row-->


            <!--end row-->

    </div>
</div>
@endsection




