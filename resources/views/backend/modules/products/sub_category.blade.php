@extends('backend.layouts.master')
@section('main-content')
    <div class="main-content app-content">
        <div id="toasts" style="--default-text-color: #fff; z-index:1200"></div>
        <div class="container-fluid">
            <div class="content-header row" style="margin-top: 20px;margin-bottom: 10px;">
                <div class="content-header-left col-12 mb-1 mt-1">
                    <div class="row breadcrumbs-top"style="margin-right: 8px;">
                        <div class="col-sm-12 col-md-8 d-none d-md-block">
                            <h5 class="content-header-title float-left pr-1 mb-0"> Sub Category</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="#">Products</a> </li>
                                    <li class="breadcrumb-item active">Sub Category </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section class="users-type-wrapper">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="users-type-table">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-12 mb-1">
                                                <h5>Create Sub Category</h5>
                                                <hr class="mt-0">
                                            </div>
                                            <div class="col-12">
                                                <form action="" id="subcat_target" class="needs-validation" novalidate>
                                                    <input type="hidden" id="id" class="form-control" name="id"
                                                        placeholder="">
                                                    <label for="catid" class="form-label fs-14 text-dark">Select
                                                        Category*</label>
                                                    <select name="catid" id="catid" class="form-control"
                                                        style="background-image: none;"required>
                                                        <option value="">Select</option>
                                                        @foreach ($category_data as $category_item)
                                                            <option value="{{ $category_item['id'] }}">
                                                                {{ $category_item['category'] }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Choose any category
                                                    </div>
                                                    <br>
                                                    <div class="form-label-group">
                                                        <label for="subcategory" class="form-label fs-14 text-dark">Sub
                                                            Category*</label>
                                                        <input type="text" id="subcategory" class="form-control"
                                                            style="background-image: none;" name="subcategory"
                                                            placeholder="Enter Sub category" required>
                                                        <div class="invalid-feedback">
                                                            Enter Sub Category Name
                                                        </div>
                                                    </div>
                                                    <div class="form-group add_section mb-0">
                                                        <button type="submit" name="Submit" class="btn btn-primary"
                                                            style="margin-left: 0px;margin-top: 20px;">
                                                            <span>Submit</span></button>
                                                    </div>
                                                    <div id="spinn" style="display: none;">
                                                        <button class="btn ripple btn-primary" style="margin-left: 0px;margin-top: 20px;" disabled type="button"><span
                                                                class="spinner-border spinner-border-sm"
                                                                role="status"></span>
                                                            Please Wait...</button>
                                                    </div>
                                                    <div class="form-group update_section mb-0" style="display:none;">
                                                        <button type="button" class="btn btn-primary" style="margin-left: 0px;margin-top: 20px;"
                                                            onclick="updateSubcat()">
                                                            <span>Update</span>
                                                        </button>
                                                        <button type="button" class="btn btn-danger" style="margin-left: 0px;margin-top: 20px;" onclick="resetsubcat()">
                                                            <span>Reset</span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="head_table_sub"
                                            class="w-100 table table-striped table-bordered dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>SL.No.</th>
                                                    <th>Sub Category</th>
                                                    <th><span style="display: none;">Category</span></th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            @php
                                                $i = 1;
                                            @endphp
                                            <tbody id="sortable">
                                                @foreach ($subcategory_data as $subcat_data)
                                                    @php
                                                        $subcatname = $subcat_data->subcategory;
                                                        $catname = $subcat_data->category_name;
                                                    @endphp
                                                    @if ($subcatname == $catname)
                                                        @php
                                                            $category_name = 'Parent';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $category_name = $catname;
                                                        @endphp
                                                    @endif
                                                    @php
                                                        $desc = App\Models\Category::where(
                                                            'id',
                                                            $subcat_data->categoryid,
                                                        )->get(['desc']);
                                                        $desc_data = $desc[0]->desc;
                                                    @endphp

                                                    <tr data-id="{{ $subcat_data->id }}">
                                                        <td style="text-align: left;">{{ $i }}</td>
                                                        <td class="dt-left">{{ $subcat_data->subcategory }}</td>
                                                        <td class="dt-left">{{ $category_name }}</td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button"
                                                                    class="btn btn-outline-primary rounded"
                                                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                        class="fe fe-more-vertical fs-16"></i></button>
                                                                <ul class="dropdown-menu">
                                                                    <a class="dropdown-item"
                                                                        onclick="getSubcatData({{ $subcat_data->id }})"><i
                                                                            class="fa fa-pencil" aria-hidden="true"></i>
                                                                        Edit</a>
                                                                    <a class="dropdown-item" href="javascript:;"
                                                                        onclick="deleteSubcat({{ $subcat_data->id }})"><i
                                                                            class="bx bx-trash mr-1 text-danger"></i>
                                                                        Delete</a>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $i++;
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
    <!---no autoDismiss toast-->
    <script src="backend/assets/js/toast_nodismiss.min.js"></script>
    <script>
        function opendesc(x) {
            if (x == 'Parent') {
                $('#desc_field').show();
            } else {
                $('#desc_field').hide();
            }
        }

        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
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

        $(document).ready(function() {
            var table = $('#head_table_sub').DataTable({
                initComplete: function(d) {
                    this.api().columns([2]).every(function() {
                        var column = this;
                        let inx = this[0][0];
                        var Jobs = $("#head_table_sub th").eq([d]).text();
                        let data = d.aoColumns[inx].ariaTitle;
                        var select = $('<select class="drop-down"><option value="">' + data +
                                '</option></select>')
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
                            select.append('<option value="' + d + '">' + d +
                                '</option>')
                        });
                    });
                },
                "columnDefs": [{
                        "orderable": false,
                        "targets": [1, 2, 3]
                    },
                    {
                        "orderable": true,
                        "targets": [0]
                    }
                ]
            });


            $('#sortable').sortable({
                items: 'tr',
                cursor: 'move',
                axis: 'y',
                placeholder: "ui-state-highlight",
                update: function(event, ui) {
                    var sortedData = [];
                    $('#sortable tr').each(function(index) {
                        var rowId = $(this).data('id');
                        var page = table.page();
                        var pageSize = table.page.info().length;
                        sortedData.push({
                            id: rowId,
                            position: page * pageSize + index
                        });
                    });
                    $.ajax({
                        url: '{{ route('product.subcatPositionUpdate') }}',
                        method: 'POST',
                        data: {
                            order: sortedData,
                        },
                        success: function(data) {
                            if (data.success) {
                                toastMsg('success', data.success);
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


        $('#subcat_target').on('submit', function(event) {
            let catid = $('#catid').val();
            let subcategory = $('#subcategory').val();
            if (catid == '') {
                $('#catid').focus();
            } else if (subcategory == '') {
                $('#subcategory').focus();
            } else {
                $.ajax({
                    url: "{{ route('product.addsubcategory') }}",
                    method: "POST",
                    data: {
                        catid: catid,
                        subcategory: subcategory
                    },
                    success: function(data) {
                        if (data.success) {
                            toastMsg('success', data.success);
                            $('.add_section').hide();
                            $('#spinn').show();
                            setTimeout(function() {
                                window.location.href =
                                    "{{ route('product.subcategory') }}";
                            }, 1000);
                        } else if (data.alreadyfound_error) {
                            toastMsg('warning', data.alreadyfound_error);
                        } else if (data.errors_success) {
                            toastMsg('warning', data.error_success);
                        } else if (data.errors_validation) {
                            let html = '';
                            for (let count = 0; count < data.errors_validation
                                .length; count++) {
                                html += '<p>' + data.errors_validation[count] + '</p>';
                            }
                            toastMsg('warning', html);
                        } else {
                            toastMsg('error', 'something went wrong');
                        }
                    }
                });
            }
            event.preventDefault();
        });

        function getSubcatData(x) {
            $.ajax({
                url: "{{ route('getSubcatData') }}",
                method: "POST",
                data: {
                    id: x
                },
                success: function(data) {
                    id = data.id;
                    catid = data.catid;
                    category_name = data.catname;
                    subcategory = data.subcatname;
                    desc = data.desc;
                    $('#id').val(id);
                    $("#catid option").each(function() {
                        if ($(this).val() == catid) {
                            $(this).attr("selected", "selected");
                        }
                    });
                    $('#subcategory').val(subcategory);
                    $('.add_section').hide();
                    $('.update_section').show();

                }
            });
        }

        function updateSubcat() {
            let id = $('#id').val();
            let catid = $('#catid').val();
            let subcat = $('#subcategory').val();
            if (catid == '') {
                toastMsg('warning', 'Category required');
                $('#category').focus();
            } else if (subcat == '') {
                toastMsg('warning', 'Sub Category required');
                $('#category').focus();
            } else {
                let formData = new FormData();
                formData.append('id', id);
                formData.append('catid', catid);
                formData.append('subcat', subcat);
                 $('.update_section').hide();
                 $('#spinn').show();
                $.ajax({
                    url: "{{ route('product.updateSubcat') }}",
                    method: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.success) {
                            console.log(data);
                            toastMsg('success', data.success);
                            $('.update_section').hide();
                            $('#spinn').show();
                            setTimeout(function() {
                                window.location.href =
                                    "{{ route('product.subcategory') }}";
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
                        } else if (data.parent_success) {
                            toastMsg('warning', data.parent_success);
                        } else {
                            toastMsg('error', 'something went wrong');
                        }
                    }
                });
            }
        }

        function deleteSubcat(x) {
            if (confirm('Are You Sure Want To Delete?') == true) {
                let url = "{{ route('product.subcatdelete', ':delete_id') }}";
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
                                window.location.href =
                                    "{{ route('product.subcategory') }}";
                            }, 1000);
                        } else if (data.error_success) {
                            toastMsg('error', data.error_success);
                        } else {
                            toastMsg('error', 'Something Went Wrong');
                        }
                    }
                });
            } else {}
        }

        function resetsubcat() {
            $('.update_section').hide();
            $('.add_section').show();
            $('#id').val('');
            $('#catid').prop('selectedIndex', 0);
            $('#subcategory').val('');
        }
    </script>
@endsection
