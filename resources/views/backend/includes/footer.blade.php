@php
    $a_name = App\Models\CompanyProfile::where('id', 1)
        ->where('address_status', 1)
        ->get(['company_address']);
    $company_address = $a_name[0]->company_address ?? '';
    $e_name = App\Models\CompanyProfile::where('id', 1)
        ->where('email_status', 1)
        ->get(['company_email']);
    $company_email = $e_name[0]->company_email ?? '';
    $m_name = App\Models\CompanyProfile::where('id', 1)
        ->where('mobile_status', 1)
        ->get(['company_mobile']);
    $company_mobile = $m_name[0]->company_mobile ?? '';
    $c_name = App\Models\CompanyProfile::where('id', 1)
        ->where('company_name_status', 1)
        ->get(['company_name']);
    $company_name = $c_name[0]->company_name ?? '';
    $c_name = App\Models\CompanyProfile::where('id', 1)->get();
    $logo = $c_name[0]->company_logo ?? '';
    $primary_color = $c_name[0]->primary_color ?? '';
    $name_color = $c_name[0]->company_name_color ?? '';
@endphp
<footer class="main-footer mt-auto py-3 bg-white text-center">
     <div class="container">
         <span class=""> Copyright © <span id="year"></span> <a href="javascript:void(0);"
                 class="text-primary fw-semibold"></a>
             Designed with <span class="bi bi-heart-fill text-danger"></span> by <a href="javascript:void(0);">
                 <span class="fw-semibold" style="color:{{$primary_color}}">Techie Squad</span>
             </a> All
             rights
             reserved
         </span>
         @if (!empty($company_address))
         <p class="mb-0">
             <i class="fa fa-map-marker" aria-hidden="true"></i> {{ $company_address }}
         </p>
     @endif
     @if (!empty($company_email))
     <p class="mb-0">
         <i class="fa fa-envelope" aria-hidden="true"></i> {{ $company_email }}
     </p>
     @endif
     @if (!empty($company_mobile))
     <p class="mb-0">
         <i class="fa fa-mobile" aria-hidden="true"></i> {{ $company_mobile }}
     </p>
     @endif
     </div>
     
 </footer>
 <div class="scrollToTop">
     <span class="arrow"><i class="fe fe-arrow-up"></i></span>
 </div>
 <div id="responsive-overlay"></div>
