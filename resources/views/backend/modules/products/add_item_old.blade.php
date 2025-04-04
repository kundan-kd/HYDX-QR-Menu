@extends('backend.layouts.master')
@section('main-content')
    <div class="main-content app-content">
        <div id="toasts" style="--default-text-color: #fff; z-index:1200"></div>
        <div class="container-fluid">
            <div class="content-header row" style="margin-top: 20px;margin-bottom: 10px;">
                <div class="content-header-left col-12 mb-1 mt-1">
                    <div class="row breadcrumbs-top"style="margin-right: 8px;">
                        <div class="col-sm-12 col-md-8 d-none d-md-block">
                            <h5 class="content-header-title float-left pr-1 mb-0">Items</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="#">Products</a> </li>
                                    <li class="breadcrumb-item active">Items </li>
                                </ol>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <h5 class="float-left pr-1 mb-0 d-sm-block d-md-none"> Category</h5>
                            <a href="javascript:;" class="btn btn-primary glow mr-0 mb-0 float-end float-right form_show"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                <i class="ri-add-line"></i> <span class="align-middle ml-25">Add</span> </a>
                            <a href="javascript:;"
                                class="btn btn-primary glow mr-0 mb-0 float-end float-right form_show_update"
                                style="display: none;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                aria-controls="offcanvasRight">
                                <i class="ri-add-line"></i> <span class="align-middle ml-25">Update</span> </a>
                        </div>
                    </div>
                </div>
            </div>
            <section class="users-type-wrapper">
                <div class="row">
                    <div class="offcanvas offcanvas-end offcanvaswidth" tabindex="-1" id="offcanvasRight"
                        aria-labelledby="offcanvasRightLabel" style="background-color:#f0f1f7">
                        <div id="toasts" style="--default-text-color: #fff; z-index:1200"></div>
                        <div class="offcanvas-body ">

                            <div class="card custom-card">
                                <div class="card-header justify-content-between">
                                    <div class="card-title head_name">Add Item</div>
                                    <button type="button" class=" btn ion-close-round" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" id="id" class="form-control" name="id"
                                                placeholder="">
                                            <div class="mb-3">
                                                <label for="form-text" class="form-label fs-14 text-dark">Select
                                                    Category</label>
                                                <select class="form-control" id="categoryid" name=""
                                                    onchange="getsubcat(this.value)">
                                                    <option value="" selected>
                                                        Select
                                                    </option>
                                                    @foreach ($category_d as $category)
                                                        <option value="{{ $category->id }}">{{ $category->category }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="form-text" class="form-label fs-14 text-dark">Select Sub
                                                    Category</label>
                                                <select class="form-control" name="" id="subcategoryid">
                                                    <option value="" selected>
                                                        Select
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="form-text" class="form-label fs-14 text-dark">Item
                                                    Name</label>
                                                <input type="text" class="form-control"
                                                    id="item_name"placeholder="Enter Item Name">
                                            </div>




                                            <div class="mb-3">
                                                <label for="form-text" class="form-label fs-14 text-dark">Labels</label>

                                                <div class="d-flex flex-wrap">
                                                    {{-- <div><h6><a href="#">{{ $label_setting->name }}</a></h6></div> --}}
                                                    @foreach ($labels as $label_setting)
                                                        @php
                                                            $icon_name = App\Models\LabelSetting::where(
                                                                'id',
                                                                $label_setting->id,
                                                            )->get(['label_icon']);
                                                            $label_icon = $icon_name[0]->label_icon;
                                                        @endphp

                                                        <div onclick="getlabels({{ $label_setting->id }})"
                                                            class="label_data" id="labelID{{ $label_setting->id }}">
                                                            <img src="uploads/label_icon/{{ $label_icon }}"
                                                                width="15px" />
                                                            <span>{{ $label_setting->name }}</span>
                                                        </div>
                                                    @endforeach
                                                    {{-- <h3 onclick="getlabels( {{$label_setting->id}})">{{ $label_setting->name }}</h3> --}}
                                                </div>

                                                <div id="mylabel" style="display: none;"></div>
                                                {{-- <option value={{ $label_setting->id }}>{{ $label_setting->name }}
                                                        </option> --}}

                                                {{-- </select> --}}

                                            </div>


                                            <div id="show_label_id"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="form-text" class="form-label fs-14 text-dark">Food
                                                    Category</label>
                                                <div class="d-flex align-items-center justify-content-between w-50 mt-1">
                                                    <div class="form-check">
                                                        <input type="radio" name ="fcategory" id="mycal1"
                                                            value="1" checked> Veg
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" name ="fcategory" id="mycat2"
                                                            value="2"> Non Veg
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="form-text" class="form-label fs-14 text-dark">Price</label>
                                                <input type="number" class="form-control" id="mrp"
                                                    placeholder="Enter Price">
                                            </div>

                                            <div class="mb-3">
                                                <label for="form-text" class="form-label fs-14 text-dark">Offer
                                                    Price</label>
                                                <input type="number" class="form-control" id="offer_price"
                                                    placeholder="Enter Offer Price">
                                            </div>

                                            <div class="mb-3">
                                                <label for="form-text" class="form-label fs-14 text-dark">Image
                                                    Upload</label>
                                                <input class="form-control" type="file" id="item_image">
                                            </div>

                                            <div class="mb-3">
                                                <label for="form-text"
                                                    class="form-label fs-14 text-dark">Description</label>
                                                <textarea type="text" class="form-control" id="desc" placeholder="Enter Item Description"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div id="add_section">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-primary" onclick="addItems()">
                                                    <span>Submit</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="spinn" style="display: none;">
                                            <button class="btn ripple btn-primary" disabled type="button"><span
                                                    class="spinner-border spinner-border-sm" role="status"></span>
                                                Please Wait...</button>
                                        </div>
                                        <div class="form-group update_section" style="display:none;">
                                            <button type="button" class="btn btn-primary" onclick="updateItem()">
                                                <span>Update</span>
                                            </button>
                                        </div>
                                        <div class="form-group close_section" style="display:none;">
                                            <button type="button" class="btn btn-danger" onclick="closeItem()">
                                                <span>Close</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body viewitemImage p-0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-12 data_detail">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table
                                            id="head_table_list"class="w-100 table table-striped table-bordered dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>SL.No</th>
                                                    <th><span style="display: none;">Category</span></th>
                                                    <th><span style="display: none;">Sub Category</span></th>
                                                    <th><span style="display: none;">Item Name</span></th>
                                                    <th><span style="display: none;">Food Category</span></th>
                                                    <th>Labels<br></th>
                                                    <th>MRP</th>
                                                    <th>Offer Price</th>
                                                    <th>Description</th>
                                                    <th>Image</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="item_sortable">
                                                @php
                                                    $i = 1;
                                                   // dd($items);
                                                @endphp
                                                @foreach ($items as $item)
                                                    @php
                                                 
                                                        $Itemlabel = $item->labels;

                                                        $numberArray = explode(',', $Itemlabel);
                                                        $labels_name = '';
                                                    @endphp
                                                    <tr data-id="{{ $item->id }}">
                                                        <th>{{ $i }}</th>
                                                        <th>{{ $item->category->category }}</th>
                                                        <th>{{ $item->subcategory->subcategory }}</th>
                                                        <th>{{ $item->item_name }}</th>
                                                        <th>{{ $item->foodcategory->name }}</th>

                                                        @foreach ($numberArray as $number)
                                                            @php

                                                                $labelName = App\Models\LabelSetting::where(
                                                                    'id',
                                                                    $number,
                                                                )->get('name');
                                                                $labels_name .= $labelName[0]->name . ',';

                                                                //

                                                            @endphp
                                                        @endforeach
                                                        <th> {{ rtrim($labels_name, ',') }}</th>
                                                        <th>{{ $item->mrp }}</th>
                                                        <th>{{ $item->offer_price }}</th>
                                                        <th>{{ $item->desc }}</th>
                                                        <th>
                                                            <img src="uploads/items/{{ $item->item_image }}"
                                                                height="50px" width="50px"data-bs-toggle="modal"
                                                                data-bs-target="#itemModal"
                                                                onclick="getitemimage(this.src)">
                                                        </th>
                                                        <th>
                                                            @if ($item->status == 0)
                                                                <button type="button"
                                                                    class="btn btn-outline-success rounded-pill btn-wave waves-effect waves-light"
                                                                    onclick="changestatus({{ $item->status }},{{ $item->id }})">Active</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-outline-danger rounded-pill btn-wave waves-effect waves-light"
                                                                    onclick="changestatus({{ $item->status }},{{ $item->id }})">Hidden</button>
                                                            @endif
                                                        </th>
                                                        <th>
                                                            <div class="btn-group">
                                                                <button type="button"
                                                                    class="btn btn-outline-primary rounded"
                                                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                        class="fe fe-more-vertical fs-16"></i></button>
                                                                <ul class="dropdown-menu">
                                                                    <a class="dropdown-item" href="javascript:;"
                                                                        onclick="editItem({{ $item->id }})"
                                                                        class="btn btn-success glow mr-0 mb-0 float-end float-right"
                                                                        data-bs-toggle="offcanvas"
                                                                        data-bs-target="#offcanvasRight"
                                                                        aria-controls="offcanvasRight">
                                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                                        <span class="align-middle ml-25">Edit</span> </a>
                                                                    <a class="dropdown-item" href="javascript:;"
                                                                        onclick="deleteItem({{ $item->id }})"><i
                                                                            class="bx bx-trash mr-1 text-danger"></i>
                                                                        Delete</a>
                                                                </ul>
                                                            </div>
                                                        </th>



                                                    </tr>
                                                    @php
                                                        $i = $i + 1;
                                                    @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('extra-js')
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

        function getsubcat(x) {
            let catid = x;
            if (catid == '') {
                toastMsg('warning', 'Choose Category');
            } else {
                $.ajax({
                    url: "{{ route('product.getsubcategory') }}",
                    method: "POST",
                    data: {
                        catid: catid
                    },
                    cache: false,
                    dataType: "json",
                    success: function(data) {
                        $('#subcategoryid').html(data.subcat);
                    }
                });
            }
        }
        let label_id = [];
        let labelMenuID = [];
        let oldlabaldata = [];

        function getlabels(x) {
            $('#mylabel').html(x);
            label_id.push(x);
            add_labels();
        }

        function add_labels() {

            let currLabelid = $('#mylabel').html();

            function addOrRemoveElement(arr, element) {
                const index = labelMenuID.indexOf(element);
                if (index !== -1) {
                    labelMenuID.splice(index, 1);
                    $('#labelID' + element).css("background-color", "");
                } else {
                    labelMenuID.push(element);
                    $('#labelID' + element).css("background-color", "LightGreen");
                }
            }

            addOrRemoveElement(label_id, currLabelid);

        }
        $(document).ready(function() {
            var table = $('#head_table_list').DataTable({
                initComplete: function(d) {
                    this.api().columns([1, 2, 3, 4]).every(function() {
                        var column = this;
                        let inx = this[0][0];
                        var Jobs = $("#head_table_list th").eq([d]).text();
                        let data = d.aoColumns[inx].ariaTitle;
                        var select = $(
                                ' <select class="drop-down"><option value="">'+data+'</option></select>'
                            )
                            .appendTo($(column.header()))
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append(' <option value="' + d + '">' + d +
                                '</option>')
                        });
                    });
                },
                "columnDefs": [{
                        "orderable": false,
                        "targets": [1, 2, 3, 4, 5, 8, 9, 10, 11]
                    },
                    {
                        "orderable": true,
                        "targets": [0, 6, 7]
                    }
                ]

            });
            $('#item_sortable').sortable({
                // placeholder: "highlight",
                items: 'tr',
                cursor: 'move',
                axis: 'y',
                update: function(event, ui) {
                    var sortedData = [];
                    $('#item_sortable tr').each(function(index) {
                        var rowId = $(this).data('id');
                        var page = table.page(); // Current page index
                        var pageSize = table.page.info().length; // Number of rows per page
                        sortedData.push({
                            id: rowId,
                            position: page * pageSize + index
                        });
                    });
                    //console.log(sortedData);
                    // var order = $(this).sortable('toArray', {
                    //     attribute: 'id'
                    // });
                    // order.forEach(function(item, index) {
                    //     console.log("Item ID: " + item + ", Position: " + (index + 1));
                    // });
                    // console.log(order);
                    $.ajax({
                        url: '{{ route('product.itemsPositionUpdate') }}',
                        method: 'POST',
                        data: {
                            order: sortedData,
                        },
                        success: function(data) {
                            if (data.success) {
                                toastMsg('success', data.success);
                                setTimeout(function() {
                                    window.location.href =
                                        "{{ route('product.items') }}";
                                }, 1000);
                            } else if (data.error_success) {
                                toastMsg('warning', data.error_success);

                            } else {
                                toastMsg('error', 'something went wrong');
                            }
                        }
                    });
                }
            });
            $("#sortable").disableSelection();
        });

        function addItems() {
            let catid = $('#categoryid').val();
            let subcatid = $('#subcategoryid').val();
            let item_name = $('#item_name').val();
            let f_category = $('input[name="fcategory"]:checked').val();
            //   alert(f_category);
            let mrp = $('#mrp').val();
            let offer_price = $('#offer_price').val();
            let desc = $('#desc').val();
            let label_id1 = label_id;
            let item_image = $('#item_image').prop('files')[0];

            if (catid == '') {
                toastMsg('warning', 'Category required');
                $('#category').focus();
            } else if (subcatid == '') {
                toastMsg('warning', 'Sub Category required');
                $('#subcategoryid').focus();
            } else if (item_name == '') {
                toastMsg('warning', 'Item Name required');
                $('#item_name').focus();

            } else if (mrp == '') {
                toastMsg('warning', 'MRP required');
                $('#mrp').focus();
            } else if (offer_price == '') {
                toastMsg('warning', 'Offer Price required');
                $('#offer_price').focus();
            } else if (desc == '') {
                toastMsg('warning', 'Description required');
                $('#desc').focus();
            } else if (label_id1 == '') {
                toastMsg('warning', 'Choose Labels');
            } else if (!item_image) {
                toastMsg('warning', 'Image required');
                $('#item_image').focus();
            } else {
                $('#add_section').hide();
                $('#spinn').show();
                let formData = new FormData();
                formData.append('catid', catid);
                formData.append('subcatid', subcatid);
                formData.append('item_name', item_name);
                formData.append('f_category', f_category);
                formData.append('mrp', mrp);
                formData.append('offer_price', offer_price);
                formData.append('desc', desc);
                formData.append('label_id', label_id1);
                formData.append('item_image', item_image);
                $.ajax({
                    url: "{{ route('product.additem') }}",
                    method: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.success) {
                            toastMsg('success', data.success);
                            $('#add_section').hide();
                            $('#spinn').show();
                            setTimeout(function() {
                                window.location.href = "{{ route('product.items') }}";
                            }, 1000);
                        } else if (data.errors_success) {
                            toastMsg('error', data.error_success);
                        } else {
                            toastMsg('error', 'something went wrong');
                        }
                    }
                });
            }
        }

        function changestatus(status, id) {
            $.ajax({
                url: "{{ route('product.status') }}",
                method: "POST",
                data: {
                    id: id,
                    status: status
                },
                success: function(data) {
                    if (data.success) {
                        toastMsg('success', data.success);
                        setTimeout(function() {
                            window.location.href = "{{ route('product.items') }}";
                        }, 1000);
                    } else {
                        toastMsg('error', 'something went wrong');
                    }
                }
            });
        }


        function editItem(x) {
            $.ajax({
                url: "{{ route('getItemData') }}",
                method: "POST",
                data: {
                    id: x
                },
                success: function(data) {
                    console.log(data);
                    id = data.id;
                    categoryid = data.categoryid;
                    subcategory = data.subcategoryid;
                    item_name = data.item_name;
                    fcategory = data.f_category;
                    mrp = data.mrp;
                    offer_price = data.offer_price;
                    desc = data.desc;
                    labelid = data.labelidArray;
                    $('.label_data').css("background-color", "");
                    $.each(labelid, function(index, value) {
                        $('#labelID'+value).css("background-color", "Gainsboro");
                    });
                    item_image = data.item_image;
                    $('#id').val(id);
                    $("#categoryid option").each(function() {
                        if ($(this).val() == categoryid) {
                            $(this).attr("selected", "selected");
                        }
                    });
                    getsubcat(categoryid);
                    $('#item_name').val(item_name);
                    $('input[name="fcategory"][value="' + fcategory + '"]').prop('checked', true);
                    $('#mrp').val(mrp);
                    $('#offer_price').val(offer_price);
                    $('#desc').val(desc);
                    oldlabaldata = [];
                    oldlabaldata.push(label_id);
                    $('#add_section').hide();
                    $('.update_section').show();
                    $('.close_section').show();
                    $('.form_show').hide();
                    $('.head_name').html('Update Item');
                    $('.form_show_update').show();
                }
            });
        }

        function updateItem() {
            let id = $('#id').val();
            let catid = $('#categoryid').val();
            let subcatid = $('#subcategoryid').val();
            let item_name = $('#item_name').val();
            let f_category = $('input[name="fcategory"]:checked').val();
            let mrp = $('#mrp').val();
            let offer_price = $('#offer_price').val();
            let desc = $('#desc').val();
            let label_id1 = oldlabaldata;
            let item_image = $('#item_image').prop('files')[0];
            if (catid == '') {
                toastMsg('warning', 'Category required');
                $('#categoryid').focus();
            } else if (subcatid == '') {
                toastMsg('warning', 'Sub Category required');
                $('#subcategoryid').focus();
            } else if (item_name == '') {
                toastMsg('warning', 'Item Name required');
                $('#item_name').focus();
            } else if (f_category == '') {
                toastMsg('warning', 'Food Category required');
                $('#fcategory').focus();
            } else if (mrp == '') {
                toastMsg('warning', 'MRP required');
                $('#mrp').focus();
            } else if (offer_price == '') {
                toastMsg('warning', 'Offer Price required');
                $('#offer_price').focus();
            // } else if (label_id1 == '') {
            //     toastMsg('warning', 'Choose Labels');
            } else if (desc == '') {
                toastMsg('warning', 'Description required');
                $('#desc').focus();

            } else {
                $('.update_section').hide();
                $('#spinn').show();
                let formData = new FormData();
                formData.append('id', id);
                formData.append('catid', catid);
                formData.append('subcatid', subcatid);
                formData.append('item_name', item_name);
                formData.append('f_category', f_category);
                formData.append('mrp', mrp);
                formData.append('offer_price', offer_price);
                formData.append('desc', desc);
                formData.append('label_id', label_id1);
                formData.append('item_image', item_image);
                $.ajax({
                    url: "{{ route('product.updateitem') }}",
                    method: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.success) {
                            toastMsg('success', data.success);
                            $('.update_section').hide();
                            $('#spinn').show();
                            setTimeout(function() {
                                window.location.href = "{{ route('product.items') }}";
                            }, 1000);
                        } else if (data.error_success) {
                            toastMsg('error', data.error_success);
                        } else if (data.error_validation) {
                            let html = '';
                            for (let count = 0; count < data.error_validation
                                .length; count++) {
                                html += '<p>' + data.error_validation[count] + '</p>';
                            }
                            toastMsg('warning', html);
                        } else {
                            toastMsg('error', 'something went wrong');
                        }
                    }
                });
            }
        }
     
        function deleteItem(x) {
            if (confirm('Are You Sure Want To Delete?') == true) {
                let url = "{{ route('product.itemdelete', ':delete_id') }}";
                url = url.replace(':delete_id', x);
                $.ajax({
                    url: url,
                    type: "DELETE",
                    data: {},
                    cache: false,
                    dataType: "json",
                    success: function(data) {
                        if (data.success) {
                            toastMsg('success', data.success);
                            setTimeout(function() {
                                window.location.href = "{{ route('product.items') }}";
                            }, 1000);
                        } else if (data.errors) {
                            toastMsg('warning', data.error_success);
                        } else {
                            toastMsg('error', 'Something Went Wrong');
                        }
                    }
                });
            } else {
                toastMsg('warning', 'Cancelled');
            }
        }
        function closeItem(){
            $('.form_show_update').hide();
            $('.form_show').show();
            $('#id').val('');
            $('#categoryid').prop('selectedIndex',0);
            $('#subcategoryid').prop('selectedIndex',0);
            $('#item_name').val('');
            $('input[name="fcategory"]:checked').val();
            $('#top_pics').prop('selectedIndex',0);
            $('#dietary_prefences').prop('selectedIndex',0);
            $('#mrp').val('');
            $('#offer_price').val('');
            $('#desc').val('');
            $('#item_image').val('');
        }
    </script>
@endsection
