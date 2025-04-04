@extends('backend.layouts.master')
@section('main-content')
    <div class="main-content app-content">
        <div id="toasts" style="--default-text-color: #fff; z-index:1200"></div>
        <div class="container-fluid">
            <div class="content-header row" style="margin-bottom: 10px;">
                <div class="content-header-left col-12 mb-1 mt-1">
                    <div class="row breadcrumbs-top"style="margin-right: 8px;">
                        <div class="col-sm-12 col-md-8 d-none d-md-block">
                            <h5 class="content-header-title float-left pr-1 mb-0"> Category</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="#">Products</a> </li>
                                    <li class="breadcrumb-item active">Create Category </li>
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
                                                <h5>Create Category</h5>
                                                <hr class="mt-0">
                                            </div>
                                            <form action="" id="cat_form" class="needs-validation" novalidate>
                                                <div class="col-12">
                                                    <input type="hidden" id="id" class="form-control" name="id"
                                                        placeholder="">
                                                    <div class="form-label-group mb-3">
                                                        <label for="form-text" class="form-label fs-14 text-dark">Category
                                                            Name*</label>
                                                        <input type="text" id="category" class="form-control"
                                                            name="category" placeholder="Enter category Name"
                                                            style="background-image: none;" required>
                                                        <div class="invalid-feedback">
                                                            Enter Category Name
                                                        </div>
                                                    </div>
                                                    <div class="form-label-group">
                                                        <label for="form-text"
                                                            class="form-label fs-14 text-dark">Description*
                                                        </label>
                                                        <input type="text" id="desc" class="form-control"
                                                            name="desc"
                                                            placeholder="Enter Description"style="background-image: none;"
                                                            required>
                                                        <div class="invalid-feedback">
                                                            Enter Description
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
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
                                                            onclick="updateCategory()">
                                                            <span>Update</span>
                                                        </button>
                                                        <button type="button" class="btn btn-danger" style="margin-left: 0px;margin-top: 20px;" onclick="resetcat()">
                                                            <span>Reset</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
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
                                        <table id="head_table"
                                            class="w-100 table table-striped table-bordered dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>SL.No.</th>
                                                    <th>Category</th>
                                                    <th>Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            @php
                                                $i = 1;
                                            @endphp
                                            <tbody id="sortable">
                                                @foreach ($category_data as $cat_data)
                                                    <tr data-id="{{ $cat_data->id }}">
                                                        <td style="text-align: left;">{{ $i }}</td>
                                                        <td>{{ $cat_data->category }}</td>
                                                        <td>{{ $cat_data->desc }}</td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button"
                                                                    class="btn btn-outline-primary rounded"
                                                                    data-bs-toggle="dropdown" aria-expanded="false"><span class="dot_class"><i
                                                                        class="fe fe-more-vertical fs-16"></span></i></button>
                                                                <ul class="dropdown-menu">
                                                                    <a class="dropdown-item"
                                                                        onclick="getcatData({{ $cat_data->id }})"><i
                                                                            class="fa fa-pencil" aria-hidden="true"></i>
                                                                        Edit</a>
                                                                    <a class="dropdown-item" href="javascript:;"
                                                                        onclick="deletecat({{ $cat_data->id }})"><i
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
        </div>
        </section>
    </div>
    </div>
@endsection
@section('extra-js')
    {{-- <script>
        $(function() {
            $("#sortable").sortable({
                placeholder: "ui-state-highlight"
            });
            $("#sortable").disableSelection();
        });
    </script> --}}

    <script>
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
            var table = $('#head_table').DataTable({
                "columnDefs": [{
                        "orderable": false,
                        "targets": [1, 2, 3]
                    },
                    {
                        "orderable": true,
                        "targets": [0]
                    }
                ],
                columns: [{
                        width: '30%'
                    },
                    {
                        width: '30%'
                    },
                    null
                ]
            });

            $('#sortable').sortable({
                placeholder: "ui-state-highlight",
                items: 'tr',
                cursor: 'move',
                axis: 'y',
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
                        url: '{{ route('category.catPositionUpdate') }}',
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
        $('#cat_form').on('submit', function(event) {
            let cat = $('#category').val();
            let des = $('#desc').val();
            if (cat == '') {
                $('#category').focus();
            } else if (des == '') {
                $('#desc').focus();
            } else {
                $.ajax({
                    url: "{{ route('category.addCategory') }}",
                    method: "POST",
                    data: {
                        category: cat,
                        desc: des
                    },
                    success: function(data) {
                        if (data.success) {
                            toastMsg('success', data.success);
                            setTimeout(function() {
                                window.location.href =
                                    "{{ route('category.index') }}";
                            }, 1000);
                        } else if (data.alreadyfound_error) {
                            toastMsg('warning', data.alreadyfound_error);
                        } else if (data.error_success) {
                            toastMsg('warning', data.error_success);
                        } else {
                            toastMsg('error', 'something went wrong!')
                        }
                    }
                });
            }
            event.preventDefault();
        });

        function getcatData(x) {
            $.ajax({
                url: "{{ route('category.getcatData') }}",
                method: "POST",
                data: {
                    id: x
                },
                success: function(data) {
                    catid = data.id;
                    cat_name = data.cat_name;
                    desc = data.desc;
                    $('#id').val(catid);
                    $('#category').val(cat_name);
                    $('#desc').val(desc);
                    $('.add_section').hide();
                    $('.update_section').show();

                }
            });
        }

        function updateCategory() {
            let id = $('#id').val();
            let category = $('#category').val();
            let desc = $('#desc').val();
            if (category == '') {
                toastMsg('warning', 'Category Required');
                $('#category').focus();
            } else if (desc == '') {
                toastMsg('warning', 'Description Required');
                $('#desc').focus();
            } else {
                $('.update_section').hide();
                $('#spinn').show();
                $.ajax({
                    url: "{{ route('category.updateCat') }}",
                    method: "POST",
                    data: {
                        id: id,
                        category: category,
                        desc: desc
                    },
                    success: function(data) {
                        if (data.success) {
                            console.log(data);
                            toastMsg('success', data.success);
                            $('.update_section').hide();
                            $('#spinn').show();
                            setTimeout(function() {
                                window.location.href = "{{ route('category.index') }}";
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


        function deletecat(x) {
            if (confirm('Are You Sure Want To Delete?') == true) {
                let url = "{{ route('category.catdelete', ':delete_id') }}";
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
                                window.location.href = "{{ route('category.index') }}";
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
        function resetcat() {
            $('.update_section').hide();
            $('.add_section').show();
            $('#id').val('');
            $('#category').val('');
            $('#desc').val('');
        }
    </script>
@endsection
