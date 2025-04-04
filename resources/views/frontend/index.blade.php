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
@section('extra-css')
    <style>
        .border {
            border-color: {{ $primary_color }}33 !important;
        }

        .badge_color {
            background-color: {{ $primary_color }} !important;
        }

        .btn-menu:hover {
            background-color: {{ $primary_color }}bf !important;
        }

        .cart_button:hover {
            background-color: {{ $primary_color }}33 !important;
        }

        .filter-item:hover,
        .filtermenu:hover {
            border-color: {{ $primary_color }}bf !important;
        }

        .add-btn {
            color: {{ $primary_color }};
            border: 1px solid {{ $primary_color }}33;
        }

        .qty-controls {
            color: {{ $primary_color }};
            border: 1px solid {{ $primary_color }}66;
        }

        .filter_data:hover, .decrement:hover, .increment:hover {
            background-color: {{ $primary_color }}bf !important;
            color: #fff;
        }

        .filter_clear_data:hover {
            background-color: {{ $primary_color }}33 !important;
        }

        .add-btn:hover {
            background-color: #eaeded;
        }

        .add-item-btn {
            background: {{ $primary_color }};
        }

        .btn-theme {
            background: {{ $primary_color }};
        }

        .btn-theme-light {
            border: 1px solid {{ $primary_color }};
        }

        .filter-item {
            border-color: {{ $primary_color }}33;
        }

        #label_close {
            color: white;
        }

        .toggle-icon,
        .badge_color {
            background-color: {{ $primary_color }}33;
        }

        .toggle-icon {
            color: {{ $primary_color }};
        }

        .menu-description li a:hover {
            color: {{ $primary_color }};
        }

        .main-footer {
            font-size: 13px !important;
        }

        .item-summary {
            background-color: {{ $primary_color }};
        }

        #cartModel .filter-title h5 {
            color: {{ $primary_color }};
        }
        .cart_class:hover {
            color: #000000 !important;
            cursor: pointer;
        }
    </style>
@endsection
@extends('frontend.layouts.master')
@section('main-content')
    <div id="toasts" style="--default-text-color: #fff; z-index:1200"></div>
    <section>
        <div class="container px-0">
            <div class="row">
                <div class="col-12 text-center mt-3">
                    <img src="uploads/company_logo/{{ $logo }}" class="mb-2 " style="height: 3.6rem;width: auto;" />
                    <h4 class="text-center mb-3" style="color:{{ $name_color }}">{{ $company_name }}</h4>
                </div>
                @php
                @endphp
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-wrap flex-grow-1 bd-highlight">
                            <div class="filter-item mb-0 filtermenu" data-bs-toggle="modal"
                                data-bs-target="#itemFilterModal">
                                <img src="frontend/assets/images/filter.png" width="20px" />
                                <span>Filter</span><span class="ms-2"><i class="fa-solid fa-sort-down icon"></i></span>
                            </div>
                        </div>
                        @php
                            $totalItems = 0;
                        @endphp
                        @foreach ($cart as $id => $details)
                            @php
                                $totalItems += $details['quantity'];
                            @endphp
                        @endforeach
                        <div class="bd-highlight">
                            <div data-bs-toggle="modal" data-bs-target="#cartModel" class=" bd-highlight">
                                <button class="btn position-relative me-3 m-1 cart_button" style="padding: 5px;">
                                    <i class="fa fa-shopping-bag" aria-hidden="true"
                                        style="color: {{ $primary_color }};"></i><span class="text fs-18"></span>
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill badge_color"
                                        id="added_items">
                                        {{ $totalItems }}
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div data-bs-toggle="modal" data-bs-target="#menuModal" class=" bd-highlight">
                            <button class="btn btn-menu"
                                style="margin-top: 2px; background-color:{{ $primary_color }}"><span class="me-2">
                                    <i class="fa fa-cutlery" aria-hidden="true"></i></span>Menu</button>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap">
                        <div class="filter-item veg-menu label_menu mb-2" id="labelID1" onclick="showItem(1,this.id)">
                            <img src="frontend/assets/images/veg.png" width="15px" />
                            <span id="label_text1">Veg</span>
                        </div>
                        <div class="filter-item nonveg-menu label_menu mb-2" id="labelID2" onclick="showItem(2,this.id)">
                            <img src="frontend/assets/images/nonveg.png" width="15px" />
                            <span id="label_text2">Non Veg</span>
                        </div>
                        <div class="d-flex flex-wrap">
                            @foreach ($labels as $label_setting)
                                @php
                                    $icon_name = App\Models\LabelSetting::where('id', $label_setting->id)->get([
                                        'label_icon',
                                    ]);
                                    $label_icon = $icon_name[0]->label_icon;
                                @endphp
                                <div onclick="filter({{ $label_setting->id }}), loadhomedata();" class="filter-item"
                                    id="label_hiddenID{{ $label_setting->id }}" style="display: none;">
                                    <img src="uploads/label_icon/{{ $label_icon }}" width="15px" />
                                    <span id="hidden_label_name{{ $label_setting->id }}">{{ $label_setting->name }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div id="mylabel" style="display:none;"></div>
                    </div>
                    <!----------Menu Model---------->
                    <div class="modal fade modal-right" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                        class="fa-solid fa-xmark"></i></button>
                                <div class="modal-body">
                                    <div class="menu-description mb-3">
                                        <ul>
                                            @foreach ($category_data as $category)
                                                @php
                                                    $cat_name = $category->category;
                                                    $subcategory_data = App\Models\SubCategory::where(
                                                        'categoryid',
                                                        $category->id,
                                                    )->get(['subcategory', 'id']);
                                                    $item_data = App\Models\Item::where(
                                                        'categoryid',
                                                        $category->id,
                                                    )->get('id');
                                                    $count_item = count($item_data);
                                                @endphp

                                                <li class="menu-item has-submenu">
                                                    <a href="#cat_menu{{ $category->id }}">{{ $category->category }}<span
                                                            class="toggle-icon ms-2"><i
                                                                class="fa-solid fa-plus"></i></span><span
                                                            class="float-end">{{ $count_item }}</span></a>
                                                    <ul class="submenu">
                                                        @foreach ($subcategory_data as $subcat)
                                                            @php
                                                                $item_data_details = App\Models\item::where(
                                                                    'subcategoryid',
                                                                    $subcat->id,
                                                                )->get('id');
                                                                $count_item_details = count($item_data_details);

                                                            @endphp
                                                            @if ($subcat->subcategory != $cat_name)
                                                                <li><a href="#subcat_menu{{ $subcat->id }} ">{{ $subcat->subcategory }}
                                                                        <span
                                                                            class="float-end">{{ $count_item_details }}</span></a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Filter Modal start -->
                    <div class="modal fade" id="itemFilterModal" tabindex="-1" aria-labelledby="itemFilterModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                        class="fa-solid fa-xmark"></i></button>
                                <div class="modal-body">
                                    <div class="filter-title mb-3 pt-3">
                                        <h5>Filters and Sorting</h5>
                                    </div>
                                    <div class="filter-description">
                                        <h6 class="mb-3">Labels</h6>


                                        <div class="d-flex align-items-center mt-2">
                                            <div class="d-flex flex-wrap">
                                                @foreach ($labels as $label_setting)
                                                    @php
                                                        $icon_name = App\Models\LabelSetting::where(
                                                            'id',
                                                            $label_setting->id,
                                                        )->get(['label_icon']);
                                                        $label_icon = $icon_name[0]->label_icon;
                                                    @endphp
                                                    <div onclick="filter({{ $label_setting->id }})" class="filter-item"
                                                        id="labelID{{ $label_setting->id }}">
                                                        <img src="uploads/label_icon/{{ $label_icon }}"
                                                            width="15px" />
                                                        <span
                                                            id="hidden_filter_label{{ $label_setting->id }}">{{ $label_setting->name }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="summary-counter d-flex align-items-center">
                                        <div class="btn-theme-light  text-center w-100 filter_clear_data"
                                            onclick="reset()" style="border-color:{{ $primary_color }}"><button
                                                class="btn m-0">Clear All</button>
                                        </div>
                                        <div class="add-item-btn btn-theme ms-3 w-50 filter_data"
                                            style="background-color:{{ $primary_color }}"
                                            onclick="loadhomedata(),modelClose()">
                                            <button class="btn text-white m-0">Apply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Filter Modal end -->
                    <div class="append_index_data">
                        <!----------------Data Appended Using Ajax----------------------->
                    </div>
                </div>
    </section>
    <section>
        <div class="container-fluid gx-0">
            <div class="row">
                <div class="col-12 position-relative">
                    <div id="itemsummary" class="item-summary" style="display: none;">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-0 d-inline" style="margin-left: 20px;"><span id="summaryqty"></span> item added
                            </h6>
                            <a data-bs-toggle="modal" data-bs-target="#cartModel" class=" bd-highlight cart_class"
                                style="text-decoration: none; color:#fff">
                                <h6 class="mb-0 d-inline fs-6" style="margin-right: 20px;"><span
                                        id=""></span>VIEW CART<span> &nbsp;<i class="fa fa-shopping-bag"
                                            aria-hidden="true"></i></span></h6>
                            </a>
                        </div>
                        {{-- <p class="mb-0">Yay! You have unlocked free delivery</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Summary Modal start -->
    <div class="modal fade" id="itemSummaryModal" tabindex="-1" aria-labelledby="itemSummaryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa-solid fa-xmark"></i></button>
                <div class="modal-body">
                    <div class="summary-title mb-3">
                        <div class="d-flex align-items-center">
                            <div class="viewmodelImage px-0 py-0">
                            </div>
                            <h5 class="item_id d-none"></h5>
                            <h5 class="item_name px-2"></h5>
                        </div>
                    </div>
                    <div class="summary-title mb-3">
                        <div class="summary-description">
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <p class="mb-2">Quantity</p>
                                <p class="mb-2 qty_count">1</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <p class="mb-2">Price</p>
                                <p class="mb-2 order_price">₹ <span class="ms-2"><input type="radio"></span></p>
                            </div>
                        </div>
                        <div class="summary-counter d-flex align-items-center mb-0">
                            <div
                                class="btn-theme-light w-25 d-flex align-items-center justify-content-between count_value">
                                <span id="decrementBtn">-</span>
                                <input type="text" id="counterValue" value="1" readonly>
                                <span id="incrementBtn">+</span>
                            </div>
                            <div class="add-item-btn ms-3 w-75 addbtn">
                                <button class="btn btn-theme m-0" onclick="itemAdd()">Add To Cart</button>
                            </div>
                            <div class="add-item-btn ms-3 w-75 waitbtn" style="display:none;">
                                <button class="btn btn-theme m-0">Adding To Cart...</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--View Cart Modal start -->

    <div class="modal fade" id="cartModel" tabindex="-1" aria-labelledby="cartModelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <div class="modal-body">
                    <div class="filter-title mb-3 pt-3">
                        <h5>Your Cart Items</h5>
                    </div>
                    <div class="summary-title mb-3 nocart_txt">
                        @if (count($cart) == 0)
                            <p>Cart is empty!</p>
                        @else
                            @foreach ($cart as $item)
                                <li>
                                    @if (isset($item['f_category']) && $item['f_category'] == 1)
                                        <img src="frontend/assets/images/veg.png" alt="veg"
                                            width="20"height="20" />
                                    @else
                                        <img src="frontend/assets/images/nonveg.png" alt="veg"
                                            width="20"height="20" />
                                    @endif
                                    <strong>{{ $item['name'] }} -</strong>
                                    Qty: {{ $item['quantity'] }}
                                    <span><i class="fa fa-inr light-inr" aria-hidden="true"></i>
                                        {{ $item['price'] }}</span>
                                    <span>
                                        <div class="qty-controls" style="margin-top: -7px;margin-bottom: -7px;" data-item-id="{{ $item['id'] }}">
                                            <span class="decrement"
                                                onclick="adjustQuantity({{ $item['id'] }},{{ $item['price'] }},-1)">-</span>
                                            <span class="qty"style="margin-top: 6px;!important">{{ $item['quantity'] }}</span>
                                            <span class="increment"
                                                onclick="adjustQuantity({{ $item['id'] }},{{ $item['price'] }},1)">+</span>
                                        </div>
                                    </span>
                                    {{-- &nbsp;<i class="fa fa-trash" aria-hidden="true"
                                        onclick="removeCartItems({{ $item['id'] }})"></i> --}}
                                </li>
                            @endforeach
                        @endif
                    </div>
                    <div class="summary-counter d-flex align-items-center mb-0">
                        <div class="w-75 clrcart">
                            <button type="submit" class="btn btn-danger" onclick="clearcart()"
                                style="width: -webkit-fill-available;">Clear Cart</button>
                        </div>
                        <div class="w-75 clrcart_wait" style="display:none;">
                            <button class="btn btn-danger">Processing...</button>
                        </div>
                        <div class="add-item-btn ms-3 w-100 orderplace_btn">
                            <button class="btn btn-theme m-0" onclick="order_place()" disabled>Place Order</button>
                        </div>
                        <div class="add-item-btn ms-3 w-100 orderplace_wait" style="display:none;">
                            <button class="btn btn-theme m-0">Order Sending To Restaurant...</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('extra-js')
    <script>
        let VNmenuId = [];
        let labelMenuID = [];
        var primaryColor = "{{ $primary_color }}";
        loadhomedata();

        function showItem(x) {
            if (VNmenuId.includes(x)) {
                let index = VNmenuId.indexOf(x);
                VNmenuId.splice(index, 1);
                $('#labelID' + x).css("background-color", "").css("border-color", "");
                $('#label_text' + x).css("color", "#1c1c1c");
                $('#labelID' + x + ' .close').remove();
            } else {
                VNmenuId.push(x);
                $('#labelID' + x).css("background-color", primaryColor).css("border-color", "white");
                $('#label_text' + x).css("color", "white");
                $('#labelID' + x).append("<span id='label_close' class='close'>&times;</span>");
            }
            loadhomedata();
        }

        function showItemfilter(x) {
            filter(x)
            loadhomedata();
        }

        function loadhomedata() {
            $.ajax({
                url: "{{ route('frontend.filterdata') }}",
                method: "POST",
                data: {
                    VNmenuId: VNmenuId,
                    labelMenuID: labelMenuID
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('.append_index_data').html(data.output);
                }
            });
        }

        function filter(x) {
            function addOrRemoveElement(element) {
                const index = labelMenuID.indexOf(element);
                if (index !== -1) {
                    labelMenuID.splice(index, 1);
                    $('#labelID' + x).css("background-color", "").css("border-color", "");
                    $('#hidden_filter_label' + x).css("color", "#1c1c1c");
                    $('#labelID' + x + ' .close').remove();
                    $('#hidden_label_name' + element).css("color", "#1c1c1c");
                    $('#label_hiddenID' + element + ' .close').remove();
                    $('#label_hiddenID' + element).hide();
                } else {
                    labelMenuID.push(element);
                    $('#labelID' + x).css("background-color", primaryColor).css("border-color", "white");
                    $('#hidden_filter_label' + x).css("color", "white");
                    $('#labelID' + x).append("<span id='label_close' class='close'>&times;</span>");
                    $('#label_hiddenID' + element).css("background-color", primaryColor).css("border-color", "white");
                    $('#hidden_label_name' + element).css("color", "white");
                    $('#label_hiddenID' + element).append("<span id='label_close' class='close'>&times;</span>");
                    $('#label_hiddenID' + element).show();
                }
                console.log(labelMenuID);
            }
            addOrRemoveElement(x);
        }

        function reset() {
            VNmenuId = [];
            labelMenuID = [];
            loadhomedata();
            $('#itemFilterModal').modal('hide');
            window.location.href = "{{ route('frontend.index') }}";
        }

        function removetab(x, y, types) {
            filtermenu1 = y.slice(0, -4);
            $('#' + y).hide();
            $('#' + filtermenu1).css("background-color", "");
            if (types == 'toppicks') {

                if (filtermenutype.includes(x)) {
                    let index = filtermenutype.indexOf(x);
                    filtermenutype.splice(index, 1);
                } else {
                    filtermenutype.push(x);
                }
            } else {
                if (filtermenuID.includes(x)) {
                    let index = filtermenuID.indexOf(x);
                    filtermenuID.splice(index, 1);
                } else {
                    filtermenuID.push(x);
                }
            }
            loadhomedata();
        }

        function addItemToCart(item_id, price) {
            let qnty = 1;

            $.ajax({
                url: "{{ route('frontend.addToCart') }}",
                method: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: item_id,
                    quantity: qnty,
                    offer_price: price
                },
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                        return;
                    }
                    $(`div.qty-controls[data-item-id='${item_id}']`).show();
                    updateCart(response.cart);
                }
            });
        }

        function adjustQuantity(item_id, price, adjustment) {
            let qnty = $(`div.qty-controls[data-item-id='${item_id}'] .qty`).text();
            qnty = parseInt(qnty, 10) + adjustment;
            if (qnty < 1) {
                qnty = 1;
            }
            $.ajax({
                url: "{{ route('frontend.addToCart') }}",
                method: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: item_id,
                    quantity: adjustment,
                    offer_price: price
                },
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                        return;
                    }
                    $(`div.qty-controls[data-item-id='${item_id}'] .qty`).text(qnty);
                    updateCart(response.cart);
                }
            });
        }

        function updateCart(cart) {
            let cartItemsHtml = '';
            let totalQuantity = 0;
            cart.forEach(item => {
                cartItemsHtml += `<li>`
                if (item.f_category == 1) {
                    cartItemsHtml += `<img src="frontend/assets/images/veg.png" alt="veg" width="20"height="20"/>`
                } else {
                    cartItemsHtml +=
                        `<img src="frontend/assets/images/nonveg.png" alt="veg" width="20"height="20"/>`
                }
                cartItemsHtml += `<strong>${item.name} -</strong>
                    Qty: ${item.quantity}
                  <span><i class="fa fa-inr light-inr" aria-hidden="true"></i> ${item.price}</span>
                    <span>
                         <div class="qty-controls" style="margin-top: -7px;margin-bottom: -7px;" data-item-id="${item.id}">
                             <span class="decrement" onclick="adjustQuantity(${item.id},${item.price},-1)">-</span>
                             <span class="qty" style="margin-top: 6px;!important">${item.quantity}</span>
                            <span class="increment" onclick="adjustQuantity(${item.id},${item.price},1)">+</span>
                        </div>
                   </span>
                 </li>`;
                totalQuantity += item.quantity;
            });

            $('#cartModel .summary-title').html(cartItemsHtml);
            $('#added_items').html(totalQuantity);
            $('#summaryqty').text(totalQuantity);
            if (totalQuantity == 0) {
                $('.nocart_txt').text("Cart is empity!");
                $('#cartModel').modal('hide');
                $('#itemsummary').hide();
                $('.qty-controls').hide();
                $('.add-btn').show();
            }
        }

        function order_place() {
            let item_id = $('.item_id').html();
            let order_price = $('.order_price').html();
            let quantity = $('#counterValue').val();
            $('.clrcart').hide();
            $('.clrcart_wait').hide();
            $('.orderplace_btn').hide();
            $('.orderplace_wait').show();
            setTimeout(function() {
                $(document).ready(function() {
                    window.location.href = "{{ route('frontend.index') }}";
                });
            }, 1000);
        }

        function removeCartItems(cart_id) {
            $.ajax({
                url: "{{ route('frontend.clearCartItems') }}",
                method: "POST",
                data: {
                    id: cart_id
                },
                success: function(data) {
                    if (data.success) {
                        console.log(data);
                        updateCart(data.cart);
                        toastMsg('success', data.success);
                    } else if (data.error_success) {
                        toastMsg('warning', data.error_success);
                    } else {
                        toastMsg('error', 'something went wrong');
                    }
                }
            });
        }

        function clearcart() {
            $.ajax({
                url: "{{ route('frontend.clearCart') }}",
                method: "POST",
                success: function(data) {
                    if (data.success) {
                        console.log(data);
                        toastMsg('success', data.success);
                        $('.clrcart').hide();
                        $('.clrcart_wait').show();
                        setTimeout(function() {
                            window.location.href = "{{ route('frontend.index') }}";
                        }, 2000);
                    } else if (data.error_success) {
                        toastMsg('warning', data.error_success);
                    } else {
                        toastMsg('error', 'something went wrong');
                    }
                }
            });
        }

        function longDescription(x) {
            $('#strlimit' + x).toggle();
            $('#dots' + x).toggle();
            $('#more' + x).toggle();
            $('#myBtn' + x).toggle();
            $('#myBtn2' + x).toggle();
        }

        function modelClose() {
            $('#itemFilterModal').modal('hide');
        }
    </script>
@endsection
