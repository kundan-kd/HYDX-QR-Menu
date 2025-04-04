@php
    $c_name = App\Models\CompanyProfile::where('id', 1)->get();
    $primary_color = $c_name[0]->primary_color ?? '';
@endphp
@section('extra-css')
    <style>
        .nav.nav-style-4 .nav-link:hover {
            background-color: {{ $primary_color }}59;
            color: #fff;
            border-radius: 0px;
        }

        .nav.nav-style-4 .nav-link.active {
            background-color: {{ $primary_color }}bf !important;
            color: #fff !important;
            border: none;
        }

        @media screen and (max-width: 800px) {
            .companyPro {
                height: auto !important;
            }
        }

        .nav.nav-style-4 .nav-link {
            color: #334151;
        }

  
    </style>
@endsection
@extends('backend.layouts.master')
@section('main-content')
    <div class="main-content app-content ">
        <div id="toasts" style="--default-text-color: #fff; z-index:1200"></div>
        <div class="container-fluid">
            <!-- start -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-0 mb-2">
                <div>
                    <h5 class="main-content-title text-default mb-1 fw-normal">Company Profile</h5>
                    <ol class="breadcrumb mb-sm-0 fw-normal mb-1">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Company </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Profile
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row gx-2 companyPro gap-3">
                <div class="col-md-2  border-end bg-white gx-0">
                    <ul class="nav nav-tabs flex-column nav-style-4" role="tablist">
                        <li class="nav-item mx-0 ">
                            <a class="nav-link  active rounded-0 fs-13 fw-normal mb-0 py-2" data-bs-toggle="tab"
                                role="tab" aria-current="page" href="#general-details" aria-selected="true">General</a>
                        </li>
                        <li class="nav-item mx-0 ">
                            <a class="nav-link  rounded-0 fs-13 fw-normal mb-0 py-2" data-bs-toggle="tab" role="tab"
                                aria-current="page" href="#logo-img" aria-selected="true">Company Logo</a>
                        </li>
                        <li class="nav-item mx-0 ">
                            <a class="nav-link rounded-0 fs-13 fw-normal mb-0 py-2" data-bs-toggle="tab" role="tab"
                                aria-current="page" href="#color-picker" aria-selected="true">Primary Color</a>
                        </li>

                    </ul>
                </div>
                <div class="col-md-8  px-0 ">
                    <div class="tab-content">
                        <div class=""></div>
                        <div class="tab-pane text-muted p-0 show active " id="general-details" role="tabpanel">
                            <div class="card custom-card border rounded-0 mb-0">
                                <div class="card-header justify-content-between">
                                    <div class="card-title fw-normal">
                                        Company Profile
                                    </div>
                                </div>
                                <div class="card-body row py-3 pb-0">
                                    <div class="col-md-6">
                                        <div class=" mb-3">
                                            <label for="form-text" class="form-label fs-13 text-dark"> Company
                                                Name*</label>
                                            <div class=" position-relative">
                                                <input type="text" class="form-control" id="company_name"
                                                    value="{{ $company[0]->company_name }}" required>
                                                @php
                                                    $name_status = $company[0]->company_name_status;
                                                @endphp
                                                <div class="form-check form-switch position-absolute "
                                                    style="top: 7px;right: 0px;">
                                                    @if ($name_status == 1)
                                                        <input class="form-check-input" checked type="checkbox"
                                                            role="switch" id="togBtn"
                                                            value="{{ $company[0]->company_name_status }}">
                                                    @else
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            id="togBtn" value="{{ $company[0]->company_name_status }}">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" mb-0">
                                            <label for="form-text" class="form-label fs-13 text-dark"> Company
                                                Address*</label>
                                            <span class="mx-2"> Manual</span>
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                data-bs-toggle="collapse" data-bs-target="#manualAddress">
                                            <div class=" position-relative">
                                                <input type="text" id="company_address" class="form-control"
                                                    value="{{ $company[0]->company_address }}">
                                                @php
                                                    $address_status = $company[0]->address_status;
                                                @endphp
                                                <div class="form-check form-switch position-absolute "
                                                    style="top: 7px;right: 0px;">
                                                    @if ($address_status == 1)
                                                        <input class="form-check-input" checked type="checkbox"
                                                            role="switch" id="address_togBtn"
                                                            value="{{ $address_status }}">
                                                    @else
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            id="address_togBtn" value="{{ $address_status }}">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse" id="manualAddress">
                                            <div class=" mb-3 row p-3">
                                                <div class="col-md-6">
                                                    <div class="mb-2">
                                                        <label for="form-text" class="form-label fs-13 text-dark">
                                                            Street</label>
                                                        <input type="text" class="form-control" id="street"
                                                            placeholder="Enter Street" required="">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="form-text" class="form-label fs-13 text-dark">State
                                                        </label>
                                                        <input type="text" class="form-control" id="state"
                                                            placeholder="Enter State" required="">
                                                    </div>
                                                    <div class="">
                                                        <label for="form-text" class="form-label fs-13 text-dark"> Zip
                                                            code</label>
                                                        <input type="text" class="form-control" id="zipcode"
                                                            placeholder="Enter Zip" required="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-2">
                                                        <label for="form-text" class="form-label fs-13 text-dark">
                                                            City</label>
                                                        <input type="text" class="form-control" id="city"
                                                            placeholder="Enter City" required="">
                                                    </div>
                                                    <div class="">
                                                        <label for="form-text" class="form-label fs-13 text-dark">
                                                            Country</label>
                                                        <input type="text" class="form-control" id="country"
                                                            placeholder="Enter Country" required="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class=" mb-3">
                                            <label for="form-text" class="form-label fs-13 text-dark"> Company
                                                Email*</label>
                                            <div class=" position-relative">
                                                <input type="text" id="company_email" class="form-control"
                                                    value="{{ $company[0]->company_email }}">
                                                @php
                                                    $email_status = $company[0]->email_status;
                                                @endphp
                                                <div class="form-check form-switch position-absolute "
                                                    style="top: 7px;right: 0px;">
                                                    @if ($email_status == 1)
                                                        <input class="form-check-input" checked type="checkbox"
                                                            role="switch" id="email_togBtn" value="{{ $email_status }}">
                                                    @else
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            id="email_togBtn" value="{{ $email_status }}">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" mb-3">
                                            <label for="form-text" class="form-label fs-13 text-dark"> Phone No*</label>
                                            <div class=" position-relative">
                                                <input type="text" id="company_mobile" class="form-control"
                                                    value="{{ $company[0]->company_mobile }}">
                                                @php
                                                    $mobile_status = $company[0]->mobile_status;
                                                @endphp
                                                <div class="form-check form-switch position-absolute "
                                                    style="top: 7px;right: 0px;">
                                                    @if ($mobile_status == 1)
                                                        <input class="form-check-input" checked type="checkbox"
                                                            role="switch" id="mobile_togBtn"
                                                            value="{{ $mobile_status }}">
                                                    @else
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            id="mobile_togBtn" value="{{ $mobile_status }}">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer border-0 py-2">
                                    <div class="form-group add_section mb-0">
                                        <button type="button" class="btn btn-primary" onclick="addname()">
                                            <span>Submit</span>
                                        </button>
                                    </div>
                                    <div id="spinn" style="display: none;">
                                        <button class="btn ripple btn-primary" disabled type="button"><span
                                                class="spinner-border spinner-border-sm" role="status"></span>
                                            Please Wait...</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane text-muted p-0" id="logo-img" role="tabpanel">
                            <div class="card custom-card rounded-0 mb-0">
                                <div class="card-header justify-content-between">
                                    <div class="card-title fw-normal">
                                        Logo Image
                                    </div>
                                </div>
                                <div class="card-body py-3">
                                    <div class="">
                                        <input type="hidden" id="id" class="form-control" name="id"
                                            placeholder="">

                                        <div class="form-label-group">
                                            <label for="form-text" class="form-label fs-14 text-dark">Upload
                                                Logo*</label>
                                            <input type="file" id="logo" class="form-control" name="logo"
                                                required>
                                        </div>
                                        <br>
                                        <div class="form-label-group img_class">
                                            <img src = "uploads/company_logo/{{ $company[0]->company_logo }}"
                                                height="40px" width="25" data-bs-toggle="modal"
                                                data-bs-target="#logoModal" onclick="getlogoimage(this.src)">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer border-0 py-0 pb-3">
                                    <div class="form-group addlogo_section mb-0">
                                        <button type="button" class="btn btn-primary" onclick="uploadlogo()">
                                            <span>Submit</span>
                                        </button>
                                    </div>
                                    <div id="logo_spinn" style="display: none;">
                                        <button class="btn ripple btn-primary" disabled type="button"><span
                                                class="spinner-border spinner-border-sm" role="status"></span>
                                            Please Wait...</button>
                                    </div>
                                    <div class="form-group update_section" style="display:none;">
                                        <button type="button" class="btn btn-primary" onclick="updateLabel()">
                                            <span>Update</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane text-muted p-0" id="color-picker" role="tabpanel">
                            <div class="card custom-card rounded-0 mb-0">
                                <div class="card-header justify-content-between">
                                    <div class="card-title fw-normal">
                                        Primary Color
                                    </div>
                                </div>
                                <div class="card-body py-2">
                                    <div class="mb-2">
                                        <label for="form-text" class="form-label fs-13 text-dark">Company Primary Color*</label>
                                        <input type="color" id="primarycolor" name="mycolor" value="{{ $company[0]->primary_color }}" style="pointer-events: none;">
                                    </div>
                                </div>
                                <div class=" d-flex align-items-center justify-content-center">
                                    @php
                                        $color_history = $company[0]->primary_color_history;
                                        $array_color = json_decode($color_history); //convert color_history stringtype array to actual array
                                    @endphp
                                    @foreach ($array_color as $colors)
                                        <input
                                            class="form-control form-input-color rounded-1 color-box-primary color-input"
                                            type="color" name="mycolor" style="width:40px;height:15px;" value="{{ $colors }}"
                                            data-color="{{ $colors }}">
                                    @endforeach
                                    &nbsp; <div onclick="document.getElementById('primarycolor').click()"><span><i class="fa-solid fa-palette fa-2x"></i></span></div>

                                </div>
                                <div class="card-footer border-0 py-0 pb-3">
                                    <div class="form-group addprimarycolor_section mb-0">
                                        <button type="button" class="btn btn-primary" onclick="addPrimaryColor()">
                                            <span>Submit</span>
                                        </button>
                                    </div>
                                    <div id="primarycolor_spinn" style="display: none;">
                                        <button class="btn ripple btn-primary" disabled type="button"><span
                                                class="spinner-border spinner-border-sm" role="status"></span>
                                            Please Wait...</button>
                                    </div>
                                </div>
                                <div class="card-body py-2">
                                    <label for="form-text" class="form-label fs-13 text-dark"> Company Name
                                        Color*</label>
                                    <div class=" position-relative">
                                        <input type="color" id="namecolor" name="mycolor"
                                            value="{{ $company[0]->company_name_color }}" style="pointer-events: none;">
                                    </div>
                                </div>
                                <div class=" d-flex align-items-center justify-content-center">
                                    @php
                                        $name_color_history = $company[0]->company_name_color_history;
                                        $array_name_color = json_decode($name_color_history); //convert color_history stringtype array to actual array
                                    @endphp
                                    @foreach ($array_name_color as $name_colors)
                                        <input class="form-control form-input-color rounded-1 color-box-name color-input"
                                            type="color" name="mycolor" style="width:40px;height:15px;" value="{{ $name_colors }}"
                                            data-color="{{ $name_colors }}">
                                    @endforeach
                                    &nbsp; <div onclick="document.getElementById('namecolor').click()"><span><i class="fa-solid fa-palette fa-2x"></i></span></div>
                                </div>

                                <div class="card-footer border-0 py-0 pb-3">
                                    <div class="form-group addnamecolor_section mb-0">
                                        <button type="button" class="btn btn-primary" onclick="addNameColor()">
                                            <span>Submit</span>
                                        </button>
                                    </div>
                                    <div id="namecolor_spinn" style="display: none;">
                                        <button class="btn ripple btn-primary" disabled type="button"><span
                                                class="spinner-border spinner-border-sm" role="status"></span>
                                            Please Wait...</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('extra-js')
    <!---no autoDismiss toast-->
    <script src="backend/assets/js/toast_nodismiss.min.js"></script>
    <script>
        (function() {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
        $(document).ready(function() {
            $('.color-box-primary').on('click', function() {
                var color = $(this).data('color');
                $('#primarycolor').val(color);
            });
            $('.color-box-name').on('click', function() {
                var color = $(this).data('color');
                $('#namecolor').val(color);
            });
        });

        $(document).ready(function() {
            $("#togBtn").on('change', function() {
                if ($(this).is(':checked')) {
                    $(this).attr('value', 1);
                } else {
                    $(this).attr('value', 0);
                }
            });
            $("#address_togBtn").on('change', function() {
                if ($(this).is(':checked')) {
                    $(this).attr('value', 1);
                } else {
                    $(this).attr('value', 0);
                }
            });
            $("#email_togBtn").on('change', function() {
                if ($(this).is(':checked')) {
                    $(this).attr('value', 1);
                } else {
                    $(this).attr('value', 0);
                }
            });
            $("#mobile_togBtn").on('change', function() {
                if ($(this).is(':checked')) {
                    $(this).attr('value', 1);
                } else {
                    $(this).attr('value', 0);
                }
            });
        });

        function addPrimaryColor() {
            let primary_color = $('#primarycolor').val();
            $.ajax({
                url: "{{ route('company.primaryColor') }}",
                method: 'POST',
                data: {
                    primary_color: primary_color
                },
                success: function(data) {
                    if (data.success) {
                        toastMsg('success', data.success);
                        $('.addprimarycolor_section').hide();
                        $('#primarycolor_spinn').show();
                        setTimeout(function() {
                            window.location.href = "{{ route('company.index') }}";
                        }, 1000);
                    } else if (data.error_success) {
                        toastMsg('warning', data.error_success);
                    } else {
                        toastMsg('error', 'something error found');
                    }
                }
            });
        }

        function addNameColor() {
            let name_color = $('#namecolor').val();
            $.ajax({
                url: "{{ route('company.nameColor') }}",
                method: 'POST',
                data: {
                    name_color: name_color
                },
                success: function(data) {
                    if (data.success) {
                        toastMsg('success', data.success);
                        $('.addnamecolor_section').hide();
                        $('#namecolor_spinn').show();
                        setTimeout(function() {
                            window.location.href = "{{ route('company.index') }}";
                        }, 1000);
                    } else if (data.error_success) {
                        toastMsg('warning', data.error_success);
                    } else {
                        toastMsg('error', 'something error found');
                    }
                }
            });
        }

        function uploadlogo() {
            let logo = $('#logo').prop('files')[0];
            if (!logo) {
                toastMsg('warning', 'Logo required');
                $('#logo').focus();
            } else {
                let formData = new FormData();
                formData.append('logo', logo);
                $.ajax({
                    url: "{{ route('company.uploadlogo') }}",
                    method: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.success) {
                            toastMsg('success', data.success);
                            $('.addlogo_section').hide();
                            $('#logo_spinn').show();
                            setTimeout(function() {
                                window.location.href = "{{ route('company.index') }}";
                            }, 1000);
                        } else if (data.error_success) {
                            toastMsg('warning', data.error_success);
                        } else {
                            toastMsg('error', 'something error found');
                        }
                    }

                });
            }
        }

        function addname() {
            let name = $('#company_name').val();
            let name_status = $('#togBtn').val();
            let company_address = $('#company_address').val();
            let address_status = $('#address_togBtn').val();
            let company_email = $('#company_email').val();
            let email_status = $('#email_togBtn').val();
            let company_mobile = $('#company_mobile').val();
            let mobile_status = $('#mobile_togBtn').val();
            if (name == '') {
                toastMsg('warning', 'Company Name Required');
                $('#company_name').focus();
            } else if (company_address == '') {
                toastMsg('warning', 'Company Address Required');
                $('#company_address').focus();
            } else if (company_email == '') {
                toastMsg('warning', 'Company Email Id Required');
                $('#company_email').focus();
            } else if (company_mobile == '') {
                toastMsg('warning', 'Company Contact No. Required');
                $('#company_mobile').focus();
            } else {
                $.ajax({
                    url: "{{ route('company.nameUpdate') }}",
                    method: 'POST',
                    data: {
                        name: name,
                        name_status: name_status,
                        company_address: company_address,
                        address_status: address_status,
                        company_email: company_email,
                        email_status: email_status,
                        company_mobile: company_mobile,
                        mobile_status: mobile_status
                    },
                    success: function(data) {
                        if (data.success) {
                            toastMsg('success', data.success);
                            $('.add_section').hide();
                            $('#spinn').show();
                            setTimeout(function() {
                                window.location.href = "{{ route('company.index') }}";
                            }, 1000);
                        } else if (data.error_success) {
                            toastMsg('warning', data.error_success);
                        } else {
                            toastMsg('error', 'something error found');
                        }
                    }
                });
            }
        }
    </script>
@endsection
