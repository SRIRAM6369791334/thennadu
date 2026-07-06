@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Dashboard')
@section('main-content')
@if($userlogview)
    @foreach ($userlogview as $logs)

    @endforeach
@endif
<div class="page-wrapper" style="margin-top:10px">
    <div class="page-content">
        <div class="container py-2">
            <h2 class="font-weight-light text-center text-muted py-3">{{$logs->user_id}}</h2>
            <!-- timeline item 1 -->
            <div class="row">
                <!-- timeline item 1 left dot -->

                <!-- timeline item 1 event content -->
                @foreach ($userlogview as $logs)
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
                                <div class="float-end text-primary" >Timing : {{$logs->created_at}}</div>
                                <h4 class="card-title" style="color:#6d1140">
                                    {{$logs->user_ip}}
                                </h4>


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
@endsection




