@extends('pages.layouts.default')
@section('title','Thennadu Matrimony - Dashboard')
@section('main-content')

<div class="page-wrapper">




    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Search Matches</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
                        </li>
                    </ol>
                </nav>
            </div>

        </div>
        <div class="card">
            <div class="card-body">
        <div class="container">
            <form method="POST" action="/filterData">
                @csrf
            <div class="row">
                <div class="col">
                    <label class="mb-3">Partner Age*</label>
                    <select class="form-control mt-2 single-select" name="partneragefrom" id="partneragefrom" required>
                        <option value="" disable hidden>-- From --</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                        <option value="32">32</option>
                        <option value="33">33</option>
                        <option value="34">34</option>
                        <option value="35">35</option>
                    </select>
                </div>
                <div class="col">
                    <label class="mb-3">Partner Age* &nbsp;&nbsp;&nbsp;&nbsp;<span id="error" class="text-danger" style="font-weight:bold"></span></label>
                    <select class="form-control mt-2 single-select" name="partnerageto" id="partnerageto" required>
                        <option value="" disable hidden>-- To --</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                        <option value="32">32</option>
                        <option value="33">33</option>
                        <option value="34">34</option>
                        <option value="35">35</option>
                    </select>
                </div>

              </div>
              <div class="row mt-4">
                <div class="col">
                    <label class="mb-3">Partner Height</label>
                    <select class="form-control mt-2" name="partnerhtfrom" id="partnerhtfrom">
                        <option value="" disable hidden>-- Choose Height --</option>
                        @if($height)
                            @foreach ($height as $ht)
                                <option value="{{$ht->id}}">{{$ht->height_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col">
                    <label class="mb-3">Partner Height</label>
                    <select class="form-control mt-2" name="partnergtto" id="partnergtto">
                        <option value="" disable hidden>-- Choose Height --</option>
                        @if($height)
                            @foreach ($height as $ht)
                                <option value="{{$ht->id}}">{{$ht->height_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col">
                    <label class="mb-3">Gender*</label>
                    <select class="multiple-select form-control mt-2" multiple="multiple" name="gender[]" id="gender_select" required>
                        <option value="" disabled hidden>-- Choose Gender --</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
              </div>

              <div class="row mt-4">
                <div class="col">
                    <label class="mb-3">Body Type</label>
                    <div class="float-end">
                        <input type="checkbox"  id="checkbox" > Select All
                    </div>
                    <select class="multiple-select bodytype form-control" style="width:100%;height:50px;border:1px solid #ced4da" id="bodytype" data-placeholder="Choose anything" multiple="multiple" name="bodytype[]">
                        <!--<option value="" disable hidden>-- Choose Body Type --</option>-->
                        @if($btype_tb)
                            @foreach ($btype_tb as $btype)
                                <option value="{{$btype->id}}">{{$btype->btype}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col">
                    <label class="mb-3">Complexion</label>
                    <div class="float-end">
                        <input type="checkbox"  id="checkbox2" > Select All
                    </div>
                    <select class="multiple-select complexion" style="width:100%;height:50px;border:1px solid #ced4da" data-placeholder="Choose anything" multiple="multiple" name="complexion[]">
                        <!--<option value="" disable hidden>-- Choose Complexion --</option>-->
                        @if($complexion)
                            @foreach ($complexion as $complexion_val)
                                <option value="{{$complexion_val->id}}">{{$complexion_val->com_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="col">
                    <label class="mb-3">Marital Status</label>
                    <div class="float-end">
                        <input type="checkbox"  id="checkbox3" > Select All
                    </div>
                    <select class="multiple-select maritalstatus" style="width:100%;height:50px;border:1px solid #ced4da" data-placeholder="Choose anything" multiple="multiple" name="maritalstatus[]">
                        <!--<option value="" disable hidden>-- Choose Marital Status --</option>-->
                        @if($matrial_tb)
                            @foreach ($matrial_tb as $marital)
                                <option value="{{$marital->id}}">{{$marital->matrial_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

              </div>

              <div class="row mt-4">
                <div class="col">
                    <label class="mb-2">Education Category</label>

                        <select class="multiple-select" data-placeholder="Choose anything" multiple="multiple" name="education[]">
                        <!--<option value="" disable hidden>-- Choose Education --</option>-->
                        @if($education)
                            @foreach ($education as $educations)
                                <option value="{{$educations->id}}">{{$educations->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col">
                    <label class="mb-2">Job Category</label>

                    <select class="multiple-select" data-placeholder="Choose anything" multiple="multiple" name="jobcategory[]">
                        <!--<option value="" disable hidden>-- Choose Job Category --</option>-->
                        @if($job)
                            @foreach ($job as $jobs)
                                <option value="{{$jobs->id}}">{{$jobs->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
              </div>
              <div class="row mt-4">
                <div class="col">
                    <label class="mb-2">Religion*</label>
                    <div class="float-end">
                        <input type="checkbox"  id="checkbox4" > Select All
                    </div>
                    <select class="multiple-select religion1" style="width:100%;height:50px;border:1px solid #ced4da" data-placeholder="Choose anything" multiple="multiple" name="religion[]" required>
                    {{-- <select class="form-control single-select " name="religion"> --}}
                        <!--<option value="" disable hidden>-- Choose Religion --</option>-->
                        @if($regli_tb)
                            @foreach ($regli_tb as $religion)
                                <option value="{{$religion->id}}">{{$religion->religion_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col">
                    <label class="mb-2">Caste*</label>
                    <div class="float-end">
                        <input type="checkbox"  id="checkbox5" > Select All
                    </div>
                    <select class="multiple-select caste" style="width:100%;height:50px;border:1px solid #ced4da" data-placeholder="Choose anything" multiple="multiple" name="caste[]" required>
                        <!--<option value="" disable hidden>-- Choose Caste --</option>-->
                        @if($caste)
                            @foreach ($caste as $cast)
                                <option value="{{$cast->id}}">{{$cast->Caste_name}}</option>
                            @endforeach
                        @endif
                    </select>

                </div>
                <div class="col">
                    <label class="mb-2">Subcaste</label>
                    <div class="float-end">
                        <input type="checkbox"  id="checkbox6" > Select All
                    </div>
                    <select class="multiple-select subcaste" style="width:100%;height:50px;border:1px solid #ced4da" data-placeholder="Choose anything" multiple="multiple" name="subcaste[]">
                        <!--<option value="" disable hidden>-- Choose Subcaste --</option>-->
                        @if($subcaste)
                            @foreach ($subcaste as $sub)
                                <option value="{{$sub->id}}">{{$sub->subcategory_name}}</option>
                            @endforeach
                        @endif
                    </select>

                </div>
              </div>
              <div class="row mt-4">
                <div class="col">
                    <label class="mb-2">Star</label>
                    <div class="float-end">
                        <input type="checkbox"  id="checkbox7" > Select All
                    </div>
                        <select class="multiple-select star" style="width:100%;height:50px;border:1px solid #ced4da" data-placeholder="Choose anything" multiple="multiple" name="star[]">
                            <!--<option value="" disable hidden>-- Choose Star --</option>-->
                        @if($star_db)
                            @foreach ($star_db as $star)
                                <option value="{{$star->id}}">{{$star->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col">
                    <label class="mb-2">Dosham</label>

                        <select class="multiple-select" data-placeholder="Choose anything" multiple="multiple" name="dhosam[]">
                        <option value="" disable hidden>-- Choose Dosham --</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="col">
                    <label class="mb-2">Annual Income</label>
                    <select class="form-control multiple-select" name="annalincone[]" multiple="multiple">
                        <!--<option value="" disable hidden>-- Choose Income --</option>-->
                        @if($income_tb)
                            @foreach ($income_tb as $income)
                                <option value="{{$income->id}}">{{$income->salary}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

              </div>
              <div class="row mt-4">
                <div class="col">
                    <label class="mb-2">Country</label>
                        <select class="multiple-select" data-placeholder="Choose anything" multiple="multiple" name="country[]">
                        <!--<option value="" disable hidden>-- Choose Country --</option>-->
                        @if($country)
                            @foreach ($country as $countr)
                                <option value="{{$countr->country_id}}">{{$countr->country_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col">
                    <label class="mb-2">State</label>
                    <select class="multiple-select" data-placeholder="Choose anything" multiple="multiple" name="state[]">
                        <!--<option value="" disable hidden>-- Choose State --</option>-->
                        @if($states)
                            @foreach ($states as $state)
                                <option value="{{$state->state_id}}">{{$state->state_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col">
                    <label class="mb-2">City</label>
                    <select class="multiple-select" data-placeholder="Choose anything" multiple="multiple" name="city[]">
                        <!--<option value="" disable hidden>-- Choose City --</option>-->
                        @if($city)
                            @foreach ($city as $district)
                                <option value="{{$district->city_id}}">{{$district->city_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

              </div>
              <button type="submit" class="btn btn-success" style="width:250px;margin:20px auto;display:block">Find Match</button>
            </form>
        </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Fix for multiple select "Select All" functionality
        function setupSelectAll(checkboxId, selectClass) {
            $("#" + checkboxId).click(function() {
                if ($("#" + checkboxId).is(':checked')) {
                    $("." + selectClass + " > option").prop("selected", "selected");
                    $("." + selectClass).trigger("change");
                } else {
                    $("." + selectClass + " > option").removeAttr("selected");
                    $("." + selectClass).trigger("change");
                }
            });
        }

        // Setup for each filter
        setupSelectAll("checkbox", "bodytype");
        setupSelectAll("checkbox2", "complexion");
        setupSelectAll("checkbox3", "maritalstatus");
        setupSelectAll("checkbox4", "religion1");
        setupSelectAll("checkbox5", "caste");
        setupSelectAll("checkbox6", "subcaste");
        setupSelectAll("checkbox7", "star");

        // Validate Partner Age range
        $('#partneragefrom, #partnerageto').on('change', function() {
            var from = parseInt($('#partneragefrom').val());
            var to = parseInt($('#partnerageto').val());
            if (from && to && from > to) {
                $('#error').text(' To age should be greater than From age');
                $('button[type="submit"]').attr('disabled', 'disabled');
            } else {
                $('#error').text('');
                $('button[type="submit"]').removeAttr('disabled');
            }
        });
    });
</script>
@endpush




