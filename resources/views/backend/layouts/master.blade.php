 <!DOCTYPE html>
 <html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
     data-menu-styles="light" data-toggled="close">
 @php
     $c_name = App\Models\CompanyProfile::where('id', 1)->get();
     $logo = $c_name[0]->company_logo ?? '';
     $name = $c_name[0]->company_name ?? '';
     $primary_color = $c_name[0]->primary_color ?? '';
 @endphp

 <head>
     <meta charset="UTF-8">
     <meta name='viewport' content='width=device-width, initial-scale=1.0'>
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <title>{{ $name }}</title>
     <link rel="icon" type="image/x-icon" href="uploads/company_logo/{{ $logo }}">
     <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
     <meta name="Author" content="Spruko Technologies Private Limited">
     <meta name="keywords"
         content="bootstrap admin,dashboard panel,bootstrap template,html,admin dashboard,admin,html and css templates,admin panel template,dashboard,html bootstrap css,template dashboard,css,bootstrap 5 admin template">
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <link rel="icon" href="backend/assets/images/brand-logos/favicon.ico" type="image/x-icon">
     <!-- Choices JS -->
     <script src="backend/assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>
     <!-- Main Theme Js -->
     <script src="backend/assets/js/main.js"></script>
     <!-- Bootstrap Css -->
     <link id="style" href="backend/assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
     <!-- Style Css -->
     <link href="backend/assets/css/styles.min.css" rel="stylesheet">
     <!-- Icons Css -->
     <link href="backend/assets/css/icons.css" rel="stylesheet">
     <!-- Node Waves Css -->
     <link href="backend/assets/libs/node-waves/waves.min.css" rel="stylesheet">
     <!-- Simplebar Css -->
     <link href="backend/assets/libs/simplebar/simplebar.min.css" rel="stylesheet">
     <!-- Color Picker Css -->
     <link rel="stylesheet" href="backend/assets/libs/flatpickr/flatpickr.min.css">
     <link rel="stylesheet" href="backend/assets/libs/@simonwep/pickr/themes/nano.min.css">
     <!-- Choices Css -->
     <link rel="stylesheet" href="backend/assets/libs/choices.js/public/assets/styles/choices.min.css">
     <!-- Prism CSS -->
     <link rel="stylesheet" href="backend/assets/libs/prismjs/themes/prism-coy.min.css">
     <link rel="stylesheet" href="backend/assets/css/toast.min.css">
     <link rel="stylesheet" href="//cdn.datatables.net/2.1.5/css/dataTables.dataTables.min.css">
     <link href="backend/assets/css/customs.css" rel="stylesheet">
     <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
     <link rel="stylesheet" href="/resources/demos/style.css">
     <style>
         #sortable {
             list-style-type: none;
             margin: 0;
             padding: 0;
             width: 60%;
         }

         #sortable li {
             margin: 0 5px 5px 5px;
             padding: 5px;
             font-size: 1.2em;
             height: 1.5em;
         }

         html>body #sortable li {
             height: 1.5em;
             line-height: 1.2em;
         }

         .ui-state-highlight {
             height: 1.5em;
             line-height: 1.2em;
         }
     </style>
     <style>
         /* .preloader {
             position: fixed;
             top: 0;
             left: 0;
             width: 100%;
             height: 100%;
             background-color: rgba(0, 0, 0, 0.8);
             display: flex;
             justify-content: center;
             align-items: center;
             z-index: 9999;
         }

         .loader {
             border: 5px solid #3498db;
             border-top: 5px solid transparent;
             border-radius: 50%;
             width: 50px;
             height: 50px;
             animation: spin 2s linear infinite;
         } */
         #loading-wrapper {
             position: fixed;
             top: 0;
             left: 0;
             width: 100%;
             height: 100vh;
             z-index: 5000;
             background: rgba(0, 0, 0, 0.788);
             display: flex;
             align-items: center;
             justify-content: center;
         }

         #loading-wrapper .spinner-border {
             width: 5rem;
             height: 5rem;
            color: {{ $primary_color }};
         }

         #loder {
             position: fixed;
             top: 0;
             left: 0;
             width: 100%;
             height: 100vh;
             background: rgba(0, 0, 0, 0.95);
         }

         /* -------------------- */
         .offcanvaswidth {
             width: 50% !important;
         }

         @media only screen and (max-width: 800px) {
             .offcanvaswidth {
                 width: 100% !important;
             }
         }

         @keyframes spin {
             0% {
                 transform: rotate(0deg);
             }

             100% {
                 transform: rotate(360deg);
             }
         }
     </style>
     <style>
         .border {
             border-color: {{ $primary_color }}33 !important;
         }

         .close {
             margin-left: 0.5rem;
         }

         /* .dot_class:hover{
            color:white !important;
         } */
         .btn-primary {
             border: none;
             background-color: {{ $primary_color }} !important;
             /* .dot_class {
                 color: white !important;
             } */
         }

         .btn-primary:hover {
             background-color: {{ $primary_color }}bf !important;
         }

         .form-check-input:checked {
             background-color: {{ $primary_color }} !important;
             border-color: {{ $primary_color }} !important;
         }

         .btn-outline-primary:hover {
             background-color: {{ $primary_color }}66 !important;
             border-color: {{ $primary_color }}bf !important;
         }

         .btn-outline-primary {
             color: {{ $primary_color }} !important;
             border-color: {{ $primary_color }} !important;
         }

         .breadcrumb .breadcrumb-item.active {
             color: {{ $primary_color }};
         }

         .dropdown-item:hover {
             color: {{ $primary_color }} !important;
             background-color: {{ $primary_color }}1a !important;
         }
            button.btn.btn-outline-primary.rounded.show {
             background-color: transparent;
         }
         .dropdown-item:active button.btn.btn-outline-primary.rounded.show {
             background-color: transparent;
         }
           .btn-outline-primary:focus {
             color: #fff;
             background-color: {{ $primary_color }}66 !important;
             border-color: {{ $primary_color }};
         }
     </style>
     @yield('extra-css')
     <style>
         [data-menu-styles=light] .app-sidebar .side-menu__item.active .side-menu__icon,
         [data-menu-styles=light] .app-sidebar .side-menu__item.active .side-menu__label,
         [data-menu-styles=light] .app-sidebar .side-menu__item:hover .side-menu__icon,
         [data-menu-styles=light] .app-sidebar .side-menu__item:hover .side-menu__label {
             color: {{ $primary_color }} !important;
         }

         .body {}
     </style>
     {{-- <div id="page_loader">
         <div class="preloader">
             <div class="loader"></div>
         </div>
     </div> --}}
     <!-- Loading starts -->
     <div id="loading-wrapper">
         <div class="spinner-border" role="status">
             <span class="sr-only">Loading...</span>
         </div>
     </div>
     <!-- Loading ends -->

 </head>

 <body>
     @include('backend.includes.header')
     @yield('main-content')
     @include('backend.includes.footer')
     <!----Jquery CDN----->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
     <!---toast-->
     {{-- <script src="backend/assets/js/toast.min.js"></script> --}}
     <!---no autoDismiss toast-->
     <script src="backend/assets/js/toast_nodismiss.min.js"></script>
     <!------------------------>
     <script src="backend/assets/libs/@popperjs/core/umd/popper.min.js"></script>
     <!-- Bootstrap JS -->
     <script src="backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
     <!-- Defaultmenu JS -->
     <script src="backend/assets/js/defaultmenu.min.js"></script>
     <!-- Node Waves JS-->
     <script src="backend/assets/libs/node-waves/waves.min.js"></script>
     <!-- Sticky JS -->
     <script src="backend/assets/js/sticky.js"></script>
     <!-- Simplebar JS -->
     <script src="backend/assets/libs/simplebar/simplebar.min.js"></script>
     <script src="backend/assets/js/simplebar.js"></script>
     <!-- Color Picker JS -->
     <script src="backend/assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>
     <!-- Custom-Switcher JS -->
     <script src="backend/assets/js/custom-switcher.min.js"></script>
     <!-- Prism JS -->
     <script src="backend/assets/libs/prismjs/prism.js"></script>
     <script src="backend/assets/js/prism-custom.js"></script>
     <!-- Custom JS -->
     <script src="backend/assets/js/custom.js"></script>
     <!---datatable cdn---->
     <script src="https://cdn.datatables.net/2.1.5/js/dataTables.min.js"></script>
     <!----jQuery Sortable CDN------>
     <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>

     @yield('extra-js')
     <script>
         setTimeout(function() {
             $(document).ready(function() {
                //  $('#page_loader').hide();
                 $("#loading-wrapper").fadeOut(500);
             });
         }, 100);
     </script>
   
     <script>
         $(document).ready(function() {
             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });
         });

         function formShow() {
             $('.form_insert').show();
             $('.form_show').hide();
             $('.form_close').show();
             $('.data_detail').removeClass('col-md-12');
             $('.data_detail').addClass('col-md-8');
         }

         function formClose() {
             $('.form_insert').hide();
             $('.form_close').hide();
             $('.form_show').show();
             $('.data_detail').addClass('col-md-12');
             $('.data_detail').removeClass('col-md-8');
         }

         function getitemimage(x) {
             $('.viewitemImage').html('<img src="' + x + '" height="" width="100%">');
         }

         function getlabelimage(x) {
             $('.viewlabelImage').html('<img src="' + x + '" height="" width="100%">');
         }

         function getlogoimage(x) {
             $('.viewlogoImage').html('<img src="' + x + '" height="" width="">');
         }
     </script>
 </body>

 </html>
