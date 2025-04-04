@php
$c_name = App\Models\CompanyProfile::where('id', 1)->get();
$logo = $c_name[0]->company_logo ?? '';
$name = $c_name[0]->company_name ?? '';
$primary_color = $c_name[0]->primary_color ?? '';
$name_color = $c_name[0]->company_name_color ?? '';
@endphp
<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" data-theme-mode="light"
    data-header-styles="light" data-menu-styles="light" data-toggled="close">

<head>
     <div id="toasts" style="--default-text-color: #fff; z-index:1200"></div>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $name }}</title>
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="bootstrap admin,dashboard panel,bootstrap template,html,admin dashboard,admin,html and css templates,admin panel template,dashboard,html bootstrap css,template dashboard,css,bootstrap 5 admin template">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="backend/assets/images/brand-logos/favicon.png">
    <link rel="stylesheet" href="backend/assets/css/toast.min.css">
    <script src="backend/assets/js/authentication-main.js"></script>
    <link id="style" href="backend/assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="backend/assets/css/styles.min.css" rel="stylesheet">
    <link href="backend/assets/css/icons.min.css" rel="stylesheet">
     <style>
          .btn-primary {
             border: none;
             background-color: {{ $primary_color }} !important;
         }
         .btn-primary:hover {
             background-color: {{ $primary_color }}bf !important;
         }
         .body{}
    </style>
</head>

<body>
    <div class="page main-signin-wrapper">
        <div id="toasts" style="--default-text-color: #fff;"></div>
        <div class="row text-center ps-0 pe-0 ms-0 me-0">
            <div class=" col-xl-3 col-lg-5 col-md-5 d-block mx-auto">
                @php
                $c_name = App\Models\CompanyProfile::where('id', 1)->where('company_name_status', 1)->get();
                $company_name = $c_name[0]->company_name ?? '';
                @endphp
                  <div class="text-center mb-2">
                    <a href="javascript:void(0)" class="custom-logo">
                        <img src="uploads/company_logo/{{ $logo }}" class="mb-2 " style="height: 3.6rem;width: auto;" />
                    </a>
                    <h5 class="text-center" style="color:{{ $name_color }}">{{ $company_name }}</h5>
                </div>
                <div class="card custom-card">
                    <div id=email_otp>
                        <div class="card-body pd-45">
                            <h6 class="text-center">Password Recovery</h6>
                            <form id="form-target" class="needs-validation" novalidate>
                                <div class="form-group text-start">
                                    <label>Email</label>
                                    <input class="form-control" placeholder="Enter your email" id="email"
                                        type="email" required>
                                    <div class="invalid-feedback">
                                        Enter Valid Email ID
                                    </div>
                                </div>
                                <button type="submit" class="btn ripple btn-primary btn-block login_btn1">Forget
                                    Password</button>
                            </form>
                            <div id="spinn1" style="display: none;">
                                <button class="btn ripple btn-primary btn-block" disabled type="button"><span
                                        class="spinner-border spinner-border-sm" role="status"></span> Please
                                    Wait...</button>
                            </div>
                        </div>
                    </div>
                    <div id="otp_enter" style="display:none;">
                        <div class="card-body pd-45">
                            <h6 class="text-center">Password Recovery</h6>
                            <form id="form-target2" class="needs-validation" novalidate>
                                <div class="form-group text-start">
                                    <label>OTP</label>
                                    <input class="form-control" placeholder="Enter OTP" id="otp"
                                        type="text"style="background-image: none;" required>
                                    <div class="invalid-feedback">
                                        Enter OTP sent on email
                                    </div>
                                </div>
                                <button type="submit"
                                    class="btn ripple btn-primary btn-block login_btn2">Submit</button>
                            </form>
                        </div>
                    </div>
                    <div id="otp_submit" style="display:none;">
                        <div class="card-body pd-45">
                            <h6 class="text-center">Password Recovery</h6>
                            <form id="form-target3" class="needs-validation" novalidate>
                                <div class="form-group text-start">
                                    <label>New Password</label>
                                    <input class="form-control" placeholder="Enter New Password" id="pass"
                                        type="password" style="background-image: none;" required>
                                    <div class="invalid-feedback">
                                        Enter New password
                                    </div>
                                </div>
                                <div class="form-group text-start">
                                    <label>Confirm New Password</label>
                                    <input class="form-control" placeholder="Confirm New Password" id="cpass"
                                        type="text" style="background-image: none;" required>
                                    <div class="invalid-feedback">
                                        Confirm New Password
                                    </div>
                                </div>
                                <button type="submit" class="btn ripple btn-primary btn-block login_btn3">Change
                                    Password</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"
    </script>
    <script src="backend/assets/js/toast.min.js"></script>
</body>

</html>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    $("#form-target").on("submit", function(event) {
        let email = $('#email').val();
        if (email == '') {
            $('#email').focus();
        } else {
            $.ajax({
                url: "{{ route('backend.sendmail') }}",
                method: "POST",
                data: {
                    email: email
                },
                success: function(data) {
                    console.log(data);
                    if (data.success) {
                        $('#email_otp').hide();
                        $('#otp_enter').show();
                        toastMsg('success', data.success);
                    } else if (data.errors_validation) {
                        toastMsg('warning', data.errors_validation);
                    } else {
                        toastMsg('error', data.errors_success);
                    }
                }
            });
        }
        event.preventDefault();

    });
    $("#form-target2").on("submit", function(e) {
        let email = $('#email').val();
        let otp = $('#otp').val();
        if (otp == '') {
            $('#otp').focus();
        } else {
            $.ajax({
                url: "{{ route('backend.verify_otp') }}",
                method: "POST",
                data: {
                    email: email,
                    otp: otp
                },
                success: function(data) {
                    console.log(data);
                    if (data.success) {
                        toastMsg('success', data.success);
                        $('#otp_enter').hide();
                        $('#otp_submit').show();
                    } else {
                        toastMsg('error', data.errors_success);
                    }
                }
            });
        }
        e.preventDefault();
    });

    $("#form-target3").on("submit", function(e) {
        let email = $('#email').val();
        let pass = $('#pass').val();
        let cpass = $('#cpass').val();
        if (pass == '') {
            $('#pass').focus();
        } else if (cpass == '') {
            $('#cpass').focus();
        } else {
            $.ajax({
                url: "{{ route('backend.update_pass') }}",
                method: "POST",
                data: {
                    email: email,
                    pass: pass,
                    cpass: cpass
                },
                success: function(data) {
                    console.log(data);
                    if (data.success) {
                        toastMsg('success', data.success);
                        setTimeout(function() {
                            window.location.href = "{{ route('index') }}";
                        }, 700);
                    } else {
                        toastMsg('error', data.errors_success);
                    }
                }
            });
        }
        e.preventDefault();
    });
</script>
