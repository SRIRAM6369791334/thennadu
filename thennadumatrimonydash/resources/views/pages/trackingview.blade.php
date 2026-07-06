@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Dashboard')
@section('main-content')
@if (count($trackingview) != 0)
    <div class="page-wrapper" style="margin-top:10px">
        <div class="page-content">
            <div class="container py-2">
                <h2 class="font-weight-light text-center text-muted py-3">
                    @if($userProfileId)
                        <a href="{{ url('/profiles/'.$userProfileId) }}" style="color:inherit;text-decoration:none;" target="_blank">{{ $userName }}</a>
                    @else
                        {{ $userName }}
                    @endif
                    <small class="fs-6 text-muted">({{ $varanid }})</small>
                </h2>
                <!-- timeline item 1 -->
                <div class="row mb-3">
                    <div class="col-lg-3 col-md-6 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="text-center">Privacy Request Sent</h6>
                                <h5 class="text-center">{{ $requestsent }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="text-center">Sent Interest</h6>
                                <h5 class="text-center">{{ $sentinterest }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="text-center">Profile Viewer's</h6>
                                <h5 class="text-center">{{ $profileviewer }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="text-center">Profile Viewed</h6>
                                <h5 class="text-center">{{ $profileviewed }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="text-center">Sent Interest Accepted</h6>
                                <h5 class="text-center">{{ $sentinterestacc }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="text-center">Sent Interest Rejected</h6>
                                <h5 class="text-center">{{ $sentinterestrej }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- timeline item 1 left dot -->
    
                    <!-- timeline item 1 event content -->
                    @foreach ($trackingview as $track)
                    <div class="row">
                        <!-- timeline item 1 left dot -->
                        <div class="col-auto text-center flex-column d-none d-sm-flex">
                            <div class="row h-50">
                                <div class="col">&nbsp;</div>
                                <div class="col">&nbsp;</div>
                            </div>
                            <h5 class="m-2">
                            <span class="badge rounded-pill  border" style="background-color:#98803b">&nbsp;</span>
                        </h5>
                            <div class="row h-50">
                                <div class="col border-end">&nbsp;</div>
                                <div class="col">&nbsp;</div>
                            </div>
                        </div>
                        <!-- timeline item 1 event content -->
                        <div class="col py-2">
                            <div class="card radius-15">
                                <div class="card-body">
                                    <div class="float-end text-primary" >Timing : {{$track->created_at}}</div>
                                    <h4 class="card-title" style="color:#6d1140">
                                        @if ($track->purpose == 'Fav_Liked')
                                                Profile Liked
                                            @elseif ($track->purpose == 'Fav_Unliked')
                                                Profile Unliked
                                            @elseif ($track->purpose == 'Report_profile')
                                                Profile Report
                                            @elseif ($track->purpose == 'Req_send')
                                                Partner Request Send
                                            @elseif ($track->purpose == 'Package_purchase')
                                                Package Purchased
                                            @elseif ($track->purpose == 'Profile_update')
                                                Profile Updated
                                            @elseif ($track->purpose == 'Report')
                                                Report Profile
                                            @elseif ($track->purpose == 'Profile_Viewed' || $track->purpose == 'Profile View')
                                                Profile Viewed
                                        @else
                                                {{ $track->purpose }}
                                        @endif
                                    </h4>
                                    <h4 class="card-title" style="color:#98803b">
                                            @if($track->partner_varan_id != '')
                                                @php
                                                    $pName      = $partnerNames->get($track->partner_varan_id, $track->partner_varan_id);
                                                    $pProfileId = $partnerProfileIds->get($track->partner_varan_id);
                                                @endphp
                                                <p class="" style="font-size:15px">
                                                    Partner :
                                                    @if($pProfileId)
                                                        <a href="{{ url('/profiles/'.$pProfileId) }}" style="color:#98803b;text-decoration:underline;" target="_blank">{{ $pName }}</a>
                                                    @else
                                                        {{ $pName }}
                                                    @endif
                                                    <small class="text-muted" style="font-size:12px">({{ $track->partner_varan_id }})</small>
                                                </p>
                                            @endif
                                    </h4>
                                    <p class="card-text">
                                        @php
                                            $pName      = $partnerNames->get($track->partner_varan_id, $track->partner_varan_id);
                                            $pProfileId = $partnerProfileIds->get($track->partner_varan_id);
                                            $uLink = $userProfileId ? '<a href="'.url('/profiles/'.$userProfileId).'" style="color:#6d1140;font-weight:600;text-decoration:underline;" target="_blank">'.$userName.'</a>' : '<strong>'.$userName.'</strong>';
                                            $pLink = $pProfileId    ? '<a href="'.url('/profiles/'.$pProfileId).'" style="color:#6d1140;font-weight:600;text-decoration:underline;" target="_blank">'.$pName.'</a>'    : '<strong>'.$pName.'</strong>';
                                        @endphp
                                        @if ($track->purpose == 'Fav_Liked')
                                            {!! $uLink !!} Likes {!! $pLink !!}
                                            @elseif ($track->purpose == 'Fav_Unliked')
                                            {!! $uLink !!} Unliked {!! $pLink !!}
                                            @elseif ($track->purpose == 'Report_profile')
                                            {!! $uLink !!} Reported {!! $pLink !!}
                                            @elseif ($track->purpose == 'Req_send')
                                            {!! $uLink !!} sent Request to {!! $pLink !!}
                                            @elseif ($track->purpose == 'Package_purchase')
                                            {!! $uLink !!} purchased a Package
                                            @elseif ($track->purpose == 'Profile_update')
                                            {!! $uLink !!} updated their Profile
                                            @elseif ($track->purpose == 'Profile_Viewed' || $track->purpose == 'Profile View')
                                            {!! $uLink !!} viewed profile of {!! $pLink !!}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
    
                </div>
    
    
                <!--/row-->
            </div>
        </div>
    </div>
@elseif(count($trackingview) == 0)
    <div class="page-wrapper" style="margin-top:10px">
        <div class="page-content">
            <div class="container py-2">
                <h2 class="font-weight-light text-center text-muted py-3">
                    @if($userProfileId)
                        <a href="{{ url('/profiles/'.$userProfileId) }}" style="color:inherit;text-decoration:none;" target="_blank">{{ $userName }}</a>
                    @else
                        {{ $userName }}
                    @endif
                    <small class="fs-6 text-muted">({{ $varanid }})</small>
                </h2>
                <p class="text-center text-muted">No tracking activity found for this profile.</p>
                <!--/row-->
            </div>
        </div>
    </div>
    
@endif

@endsection




