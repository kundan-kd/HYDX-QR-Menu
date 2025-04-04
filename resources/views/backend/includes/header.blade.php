@php
    $c_name = App\Models\CompanyProfile::where('id', 1)->get();
    $logo = $c_name[0]->company_logo ?? '';
    $primary_color = $c_name[0]->primary_color ?? '';
    $name_color = $c_name[0]->company_name_color ?? '';
@endphp
@section('extra-css')
 
@endsection
<div class="page">
    <header class="app-header">
        @php
            $c_name = App\Models\CompanyProfile::where('id', 1)->get();
            $logo = $c_name[0]->company_logo ?? '';
        @endphp
        <div class="main-header-container container-fluid">
            <div class="header-content-left">
                <div class="header-element  d-flex align-items-center">
                    <div class="horizontal-logo">
                        <a href="javascript:void(0)" class="header-logo">
                            <img src="uploads/company_logo/{{ $logo }}" alt="logo" class="desktop-logo">
                        </a>
                    </div>
                </div>
                <div class="header-element">
                    <a aria-label="Hide Sidebar"
                        class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle"
                        data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
                </div>
            </div>
            <div class="header-content-right">
                <div class="header-element">
                    <a href="javascript:void(0);" class="header-link  dropdown-toggle" id="mainHeaderProfile"
                        data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <div>
                                <img src="backend/assets/images/brand-logos/user.png" alt="img" width="30"
                                    height="30" class="rounded-circle">
                            </div>
                    </a>
                    <div class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                        aria-labelledby="mainHeaderProfile">
                        <div class="header-navheading">
                            <h6 class="main-notification-title">{{ Auth::user()->name }}</h6>
                        </div>
                        <a class="dropdown-item fs-13 border-top text-wrap" href="{{ route('dashboard.profile') }}">
                            <i class="fe fe-user fs-15 me-2 d-inline-flex"></i> My Profile
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                            <i class="fe fe-power fs-15 me-2 d-inline-flex"></i> Sign Out
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <aside class="app-sidebar sticky" id="sidebar">
        <div class="main-sidebar-header">
            <a href="javascript:void(0)" class="header-logo">
                <img src="uploads/company_logo/{{ $logo }}" alt="logo" class="desktop-logo">
            </a>&nbsp;&nbsp;&nbsp;&nbsp;
            @php
                $c_name = App\Models\CompanyProfile::where('id', 1)->where('company_name_status', 1)->get();
                $company_name = $c_name[0]->company_name ?? '';
            @endphp
            <h6 class="text-center fs-15" style="color:{{$name_color}}">{{ $company_name }}</h6>
        </div>
        <div class="main-sidebar" id="sidebar-scroll">
            <nav class="main-menu-container nav nav-pills flex-column sub-open">
                <div class="slide-left" id="slide-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                    </svg>
                </div>
                <ul class="main-menu">
                    <li class="slide__category"><span class="category-name">Dashboard</span></li>
                    <li class="slide">
                        <a href="{{ route('dashboard.dashboard') }}" class="side-menu__item">
                            <i class="fe fe-airplay side-menu__icon"></i>
                            <span class="side-menu__label">Dashboard</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a href="{{ route('category.index') }}" class="side-menu__item">
                            <i class="fa-solid fa-list side-menu__icon"></i>
                            <span class="side-menu__label">Category</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a href="{{ route('product.subcategory') }}" class="side-menu__item">
                            <i class="fa-solid fa-list side-menu__icon"></i>
                            <span class="side-menu__label">Sub Category</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a href="{{ route('product.items') }}" class="side-menu__item">
                            <i class="fa-solid fa-list side-menu__icon"></i>
                            <span class="side-menu__label">Items</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a href="{{ route('product.labelsettings') }}" class="side-menu__item">
                            <i class="fa-solid fa-gear side-menu__icon"></i>
                            <span class="side-menu__label">Label Settings</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a href="{{ route('company.index') }}" class="side-menu__item">
                            <i class="fa fa-paint-brush side-menu__icon"></i>
                            <span class="side-menu__label">Company Profile</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a href="{{ route('admin-receivedOrder.index') }}" class="side-menu__item">
                            <i class="fa fa-list-alt side-menu__icon"></i>
                            <span class="side-menu__label">Order Received</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a target="_blank" href="{{ route('frontend.index') }}" class="side-menu__item">
                            <i class="fa fa-home side-menu__icon"></i>
                            <span class="side-menu__label">Go To Home Page</span>
                        </a>
                    </li>
                    <li class="slide">
                        <a target="_blank" href="{{ route('api_data') }}" class="side-menu__item">
                            <i class="fa fa-home side-menu__icon"></i>
                            <span class="side-menu__label">Uptime Robot</span>
                        </a>
                        {{-- <form action="/get-monitors" method="POST">
                            @csrf
                            <button type="submit">Get Monitors</button>
                        </form> --}}
                    </li>
                </ul>
                <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                    </svg></div>
            </nav>
        </div>
    </aside>
