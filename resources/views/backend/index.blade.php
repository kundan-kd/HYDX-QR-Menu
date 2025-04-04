@extends('backend.layouts.master')
@section('main-content')
    <div class="main-content app-content">
        <div class="container-fluid">
            <div class="d-md-flex d-block align-items-center justify-content-between my-4">
                <div>
                    <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Welcome To Hotel Yuvraj Dashboard</h5>
                    <ol class="breadcrumb mb-sm-0 mb-4">
                        <li class="breadcrumb-item"><a href="javascript:void(0);" class="fs-14">Home</a></li>
                        <li class="breadcrumb-item active fs-14" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div>
            <div class="responsive-background">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="advanced-search br-3">
                        <div class="row align-items-center">
                            <div class="col-md-12 col-xl-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-lg-0">
                                            <label>From :</label>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <i class="fe fe-calendar lh--9 op-6"></i>
                                                </div> <input type="text" class="form-control" id="date1"
                                                    placeholder="01/07/2024">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-lg-0">
                                            <label>To :</label>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <i class="fe fe-calendar lh--9 op-6"></i>
                                                </div><input type="text" class="form-control" id="date2"
                                                    placeholder="01/07/2024">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="row row-sm">
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card custom-card">
                        <a href="{{ route('product.items') }}">
                            <div class="card-body dash1">
                                <div class="d-flex">
                                    <p class="mb-1 tx-inverse">Items</p>
                                    <div class="ms-auto">
                                        <i class="fa fa-chart-line fs-20 text-success"></i>
                                    </div>
                                </div>
                                @php
                                    $item_data = App\Models\Item::where('id', '>=', 1)->get('id');
                                    $count_item_data = count($item_data);
                                @endphp
                                <div>
                                    <h3 class="dash-25">{{ $count_item_data }}</h3>
                                </div>
                                <div class="progress progress-xs  mb-1" role="progressbar" aria-label="Basic example"
                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-success" style="width: 40%"></div>
                                </div>
                                <div class="expansion-label d-flex text-muted">
                                    <span class="text-muted">Total Items</span>
                                    <span class="ms-auto"><i
                                            class="fa fa-caret-up me-1 text-success"></i>{{ $count_item_data }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card custom-card">
                        <a href="{{ route('product.subcategory') }}">
                            <div class="card-body dash1">
                                <div class="d-flex">
                                    <p class="mb-1 tx-inverse">Sub Category</p>
                                    <div class="ms-auto">
                                        <i class="fa fa-chart-line fs-20 text-secondary"></i>
                                    </div>
                                </div>
                                @php
                                    $subcategory_data = App\Models\SubCategory::where('id', '>=', 1)->get('id');
                                    $count_subcategory = count($subcategory_data);
                                @endphp
                                <div>
                                    <h3 class="dash-25">{{ $count_subcategory }}</h3>
                                </div>
                                <div class="progress progress-xs  mb-1" role="progressbar" aria-label="Basic example"
                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-secondary" style="width: 40%"></div>
                                </div>
                                <div class="expansion-label d-flex">
                                    <span class="text-muted">Total Sub Category</span>
                                    <span class="ms-auto"><i
                                            class="fa fa-caret-up me-1 text-danger"></i>{{ $count_subcategory }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card custom-card">
                        <a href="{{ route('product.subcategory') }}">
                            <div class="card-body dash1">
                                <div class="d-flex">
                                    <p class="mb-1 tx-inverse">Category</p>
                                    <div class="ms-auto">
                                        <i class="fa fa-chart-line fs-20 text-primary"></i>
                                    </div>
                                </div>
                                @php
                                    $category_data = App\Models\Category::where('id', '>=', 1)->get('id');
                                    $count_category = count($category_data);
                                @endphp
                                <div>
                                    <h3 class="dash-25">{{ $count_category }}</h3>
                                </div>
                                <div class="progress progress-xs  mb-1" role="progressbar" aria-label="Basic example"
                                    aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar" style="width: 30%"></div>
                                </div>
                                <div class="expansion-label d-flex">
                                    <span class="text-muted">Total Category</span>
                                    <span class="ms-auto"><i
                                            class="fa fa-caret-up me-1 text-success"></i>{{ $count_category }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card custom-card">
                        <a href="{{ route('admin-receivedOrder.index') }}">
                            <div class="card-body dash1">
                                <div class="d-flex">
                                    <p class="mb-1 tx-inverse">Order Received</p>
                                    <div class="ms-auto">
                                        <i class="fa fa-chart-line fs-20 text-info"></i>
                                    </div>
                                </div>
                                @php
                                    $order_data = App\Models\Order::where('id', '>=', 1)->get('id');
                                    $count_order = count($order_data);
                                @endphp
                                <div>
                                    <h3 class="dash-25">{{ $count_order }}</h3>
                                </div>
                                <div class="progress progress-xs  mb-1" role="progressbar" aria-label="Basic example"
                                    aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-info" style="width: 40%"></div>
                                </div>
                                <div class="expansion-label d-flex text-muted">
                                    <span class="text-muted">Total Order Received</span>
                                    <span class="ms-auto"><i
                                            class="fa fa-caret-up me-1 text-info"></i>{{ $count_order }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
