@php
$c_name = App\Models\CompanyProfile::where('id', 1)->get();
$logo = $c_name[0]->company_logo ?? '';
$name = $c_name[0]->company_name ?? '';
$primary_color = $c_name[0]->primary_color ?? '';
$name_color = $c_name[0]->company_name_color ?? '';
@endphp
<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggled="close">

<head>
 <div id="toasts" style="--default-text-color: #fff; z-index:1200"></div>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $name }}</title>
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
	<meta name="keywords" content="bootstrap admin,dashboard panel,bootstrap template,html,admin dashboard,admin,html and css templates,admin panel template,dashboard,html bootstrap css,template dashboard,css,bootstrap 5 admin template">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Favicon -->
    <link rel="icon" href="backend/assets/images/brand-logos/favicon.png">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
   
    <link rel="stylesheet" href="backend/assets/css/toast.min.css">
 

    <!-- Main Theme Js -->
    <script src="backend/assets/js/authentication-main.js"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="backend/assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" >

    <!-- Style Css -->
    <link href="backend/assets/css/styles.min.css" rel="stylesheet" >

    <!-- Icons Css -->
    <link href="backend/assets/css/icons.min.css" rel="stylesheet" >
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
    <!------Login Page----->
    <div class="page main-signin-wrapper login_page">
       
        <!-- Row -->
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
                   
                    <div class="card-body pd-45">
                        <h6 class="text-center">Signin to Your Account</h6>
                        <form action="" id="target" class="needs-validation" novalidate>
                            <div class="form-group text-start">
                                <label for="email" class="form-label">Email</label>
                                <input class="form-control" placeholder="Enter your email"  id="email" type="email" required>
                                <div class="invalid-feedback">
                                    Enter Valid Email ID
                                  </div>
                            </div>
                            <div class="form-group text-start">
                                <label for="password" class="form-label">Password</label>
                                <input class="form-control" placeholder="Enter your password" id="password" type="password" required style="background-image: none;">
                                <div class="invalid-feedback">
                                    Enter Valid Password
                                  </div>
                            </div>
                            <button type="submit" name="Submit" class="btn ripple btn-primary btn-block login_btn">Login</button>
                            <div id="spinn" style="display: none;">
                                <button class="btn ripple btn-primary btn-block" disabled type="button"><span
                                        class="spinner-border spinner-border-sm"
                                        role="status"></span> Please Wait...</button>
                             </div>
                        </form>
                        <div class="mt-3 text-center">
                            <p class="mb-1"><a href="{{route('backend.forgetpass')}}">Forgot password?</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

    </div>



    <!-- Bootstrap JS -->
    <script src="backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"</script>
    <!-- jtoast Js -->
    <script src="backend/assets/js/toast.min.js"></script>
</body>
</html>
 <script>

(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
           event.preventDefault();
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();


     $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });


    $( "#target" ).on( "submit", function( event ) {
        let email = $('#email').val();
       let password = $('#password').val();
       if(email == ''){
           $('#email').focus();
          //  toastMsg('warning','Email id required');
        }
        else if(password == ''){
           $('#password').focus();
        }
        else{
           $.ajax({
                url: "{{route('backend.login')}}",
                method: "POST",
                data:{email:email,password:password},
                success:function(data){
                    console.log(data);
                   
                    if(data.success){
                        $('.login_btn').hide();
                        $('#spinn').show();
                        window.location.href = "{{route('dashboard.dashboard')}}";
                    }
                    else if(data.errors_validation){
                        toastMsg('warning',data.errors_validation);
                    }
                    else{ 
                        toastMsg('error',data.error_success);
                    }
                }
            });
        }
 
  event.preventDefault();
});


 </script>