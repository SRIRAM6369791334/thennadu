@extends('pages.layouts.default')
@section('title', 'Thennadu Matrimony - Dashboard')
@section('main-content')


    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Permission Details</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
                            </li>

                        </ol>
                    </nav>
                </div>

                <div class="">
                    <div class="btn-group">
                        {{-- <button type="submit" class="btn btn-primary" >Save Permission</button> --}}


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

                                    <th class="text-center">Main Menu</th>
                                    <th class="text-center">Menu Type</th>
                                    <th class="text-center">Menu</th>
                                    <th class="text-center">Status</th>

                                </tr>
                            </thead>
                            <tbody>


                                @if ($users)

                                    @foreach ($users as $user)
                                        <tr>
                                            {{-- {{$username = $user->name}} --}}
                                            <td>{{ $user->mainmenu }}</td>
                                            <td>{{ $user->menu_type }}</td>
                                            <td>{{ $user->menu }}</td>
                                            <td>

                                                @if ($user->username == 0)
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <span class="p-2 text-success font-weight-bold">
                                                            Visible
                                                        </span>

                                                        <button type="button" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal" data-id="{{ $user->id }}"
                                                            data-userId="{{ $userId }}" data-user={{ $name }}
                                                            data-view="0"
                                                            class="btn btn-success viewbtn hideModalBtn pl-3">Change</button>
                                                    </div>
                                                @else
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <span class="p-2 text-danger font-weight-bold">
                                                            Hidden
                                                        </span>
                                                        <button type="button" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal" data-id="{{ $user->id }}"
                                                            data-userId="{{ $userId }}" data-user={{ $name }}
                                                            data-view="1" class="btn btn-danger viewbtn hideModalBtn "
                                                            id="hideModalBtn">Change</button>
                                                    </div>
                                                @endif
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach

                                @endif
                                {{-- <button type="submit" class="btn btn-primary" >Save Permission</button> --}}
                                </form>

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
            <!-- Section: Pricing table -->
        </div>
    </div>

@endsection
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('permission.update', $name) }}" id="viewModal">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="userid" class="userid">
                    <input type="hidden" name="username" class="username">
                    <input type="hidden" name="viewpermission" value="0">
                    <input type="hidden" name="userId" value="{{ $userId }}" id="userViewIdInput">

                    <button class="btn btn-success" style="width:200px;margin:0 auto;display:block">View</button>
                </form>
                <form method="POST" action="{{ route('permission.update', $name) }}" id="hideModal">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="userid" class="userid">
                    <input type="hidden" name="username" class="username">
                    <input type="hidden" name="viewpermission" value="1">
                    <input type="hidden" name="userId" value="{{ $userId }}" id="userHideIdInput">

                    <button class="btn btn-warning" style="width:200px;margin:0 auto;display:block">Hide</button>
                </form>
            </div>

        </div>
    </div>
</div>



@if (Session::has('message'))
    <script defer>
        window.addEventListener("load", function() {

            alert("{{ Session::get('message') }}");
        })
    </script>
@endif


<script>
    window.addEventListener("load", function() {

        $(".viewbtn").on("click", function() {

            const value = $(this).attr("data-view");
            console.log(this);
            console.log(value);

            if (value == 0) {
                $("#viewModal").hide();
            } else {
                $("#hideModal").hide();
            }



        });


    })
</script>




