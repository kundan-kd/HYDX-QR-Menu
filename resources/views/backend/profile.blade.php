@extends('backend.layouts.master')
@section('main-content')
    <div class="main-content app-content">
        <div class="container-fluid">
            <div class="d-md-flex d-block align-items-center justify-content-between my-4">
                <div>
                    <h4 class="main-content-title text-default mb-1">Profile</h4>
                    <ol class="breadcrumb mb-sm-0 mb-2">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Pages</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Profile
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-body text-center">
                            <div class="main-profile-overview widget-user-image text-center">
                                <img src="backend/assets/images/brand-logos/user.png" alt="img" width="30"
                                    height="30" class="rounded-circle">
                            </div>
                            <div class="item-user pro-user">
                                <h4 class="pro-user-username text-dark mt-2 mb-0">{{ Auth::user()->name }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card custom-card">
                        <div class="card-header custom-card-header rounded-bottom-0">
                            <div>
                                <h6 class="card-title mb-0">Contact Information</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="main-profile-contact-list main-profile-work-list">
                                <div class="media mt-0">
                                    <div class="media-logo bg-light text-dark">
                                        <i class="fe fe-phone"></i>
                                    </div>
                                    <div class="media-body">
                                        <span>Mobile</span>
                                        <div>
                                            (+91) 123 4567 890
                                        </div>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-logo bg-light text-dark">
                                        <i class="fe fe-message-square"></i>
                                    </div>
                                    <div class="media-body">
                                        <span>Slack</span>
                                        <div>
                                            @techie.s
                                        </div>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-logo bg-light text-dark">
                                        <i class="fe fe-map-pin"></i>
                                    </div>
                                    <div class="media-body">
                                        <span>Current Address</span>
                                        <div>
                                            Patna, India
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
