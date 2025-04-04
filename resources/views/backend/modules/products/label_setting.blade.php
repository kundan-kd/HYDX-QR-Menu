@section('extra-css')
    <style>
       .scrollable-content {
           max-height: 58px; /* Set the max height for the content */
           overflow-y: auto; /* Add vertical scroll */
       }
    </style>
@endsection
@extends('backend.layouts.master')
@section('main-content')
    <div class="main-content app-content">
        <div id="toasts" style="--default-text-color: #fff; z-index:1200"></div>
        <div class="container-fluid">

            <div class="content-header row" style="margin-top: 20px;margin-bottom: 10px;">
                <div class="content-header-left col-12 mb-1 mt-1">
                    <div class="row breadcrumbs-top"style="margin-right: 8px;">
                        <div class="col-sm-12 col-md-8 d-none d-md-block">
                            <h5 class="content-header-title float-left pr-1 mb-0">Label Settings</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="#">Products</a> </li>
                                    <li class="breadcrumb-item active">Label Settings </li>
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
                                                <h5>Create New Label</h5>
                                                <hr class="mt-0">
                                            </div>
                                            <form action="" id="label_target" class="needs-validation" novalidate>
                                                <div class="col-12">
                                                    <input type="hidden" id="id" class="form-control" name="id"
                                                        placeholder="">

                                                    <div class="form-label-group mb-3">
                                                        <label for="form-text" class="form-label fs-14 text-dark">Label
                                                            Name*</label>
                                                        <input type="text" id="label" class="form-control"
                                                            name="label" placeholder="Enter Label name"
                                                            style="background-image: none;" required>
                                                        <div class="invalid-feedback">
                                                            Enter Label Name
                                                        </div>
                                                    </div>

                                                    <div class="form-label-group">
                                                        <label for="form-text" class="form-label fs-14 text-dark">Label
                                                            Icon*</label>
                                                        <input class="form-control" type="file" id="label_icon"
                                                            style="background-image: none;" required>
                                                        <div class="invalid-feedback">
                                                            Choose any Image Icon
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="form-label-group img_class" style="display:none;">
                                                        <img class="img_data" height="40px"
                                                            width="40px"data-bs-toggle="modal"
                                                            data-bs-target="#labelModal" onclick="getlabelimage(this.src)">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group add_section mb-0">
                                                        <button type="submit" name="Submit" class="btn btn-primary m-0">
                                                            <span>Submit</span></button>
                                                    </div>
                                                    <div id="spinn" style="display: none;">
                                                        <button class="btn ripple btn-primary" disabled type="button"><span
                                                                class="spinner-border spinner-border-sm"
                                                                role="status"></span>
                                                            Please Wait...</button>
                                                    </div>
                                                    <div class="form-group update_section" style="display:none;">
                                                        <button type="button" class="btn btn-primary"
                                                            onclick="updateLabel()">
                                                            <span>Update</span>
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
                    <div class="modal fade" id="labelModal" tabindex="-1" aria-labelledby="labelModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body viewlabelImage p-0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table id="label_table"
                                            class="w-100 table table-striped table-bordered dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>SL.No.</th>
                                                    <th>Label</th>
                                                    <th>Icon Image</th>
                                                    <th>Items Label</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            @php
                                                $i = 1;
                                            @endphp
                                            <tbody id="sortable">
                                                @foreach ($labelsetting as $labels)
                                                    <tr>
                                                        <td style="text-align: left;">{{ $i }}</td>
                                                        <td>{{ $labels->name }}</td>
                                                        <td>
                                                            <img src="uploads/label_icon/{{ $labels->label_icon }}"
                                                                height="40px" width="40px"data-bs-toggle="modal"
                                                                data-bs-target="#labelModal"
                                                                onclick="getlabelimage(this.src)">
                                                        </td>
                                                        @php
                                                            $item = '';
                                                            $item_data = [];
                                                            $items_ids = App\Models\ItemLabel::where(
                                                                'label_id',
                                                                $labels->id,
                                                            )->get();
                                                            // $items_id = $items_ids[0]->item_name;

                                                            //  dd($items_ids);
                                                        @endphp
                                                        @foreach ($items_ids as $iitms)
                                                            @php
                                                                $item_name = $iitms->item_name;
                                                                array_push($item_data, $item_name);
                                                            @endphp
                                                        @endforeach
                                                        <td>
                                                            <div class="scrollable-content">
                                                            @foreach ($item_data as $item)
                                                                {{ $item }}<br>
                                                            @endforeach
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button"
                                                                    class="btn btn-outline-primary rounded"
                                                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                        class="fe fe-more-vertical fs-16"></i></button>
                                                                <ul class="dropdown-menu">
                                                                    <a class="dropdown-item"
                                                                        onclick="editlabel( {{ $labels->id }} , `{{ $labels->name }}`,`{{ $labels->label_icon }}`)"><i
                                                                            class="fa fa-pencil" aria-hidden="true"></i>
                                                                        Edit</a>
                                                                    <a class="dropdown-item" href="javascript:;"
                                                                        onclick="deletelabel( {{ $labels->id }} )"><i
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

        $(document).ready(function() {
            $('#label_table').DataTable({
                "columnDefs": [{
                        "orderable": false,
                        "targets": [2, 3]
                    },
                    {
                        "orderable": true,
                        "targets": [0, 1]
                    }
                ]
            });
            //  $('#sortable').sortable();
        });

        $('form').on('submit', function(event) {
            let label = $('#label').val();
            let label_icon = $('#label_icon').prop('files')[0];
            if (label == '') {
                // toastMsg('warning', 'Label Name required');
                $('#label').focus();
            } else if (!label_icon) {
                // toastMsg('warning', 'Label Icon required');
                $('#label_icon').focus();
            } else {
                // $('#spinn').show();
                let formData = new FormData();
                formData.append('label', label);
                formData.append('label_icon', label_icon);

                $.ajax({
                    url: "{{ route('product.addlabel') }}",
                    method: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.success) {
                            toastMsg('success', data.success);
                            $('.add_section').hide();
                            $('#spinn').show();
                            setTimeout(function() {
                                window.location.href = "{{ route('product.labelsettings') }}";
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

        function editlabel(x, name, label_icon) {
            $('#id').val(x);
            $('#label').val(name);
            let source = "uploads/label_icon/" + label_icon;
            $('.img_data').attr("src", source);
            $('.img_class').show();
            $('.add_section').hide();
            $('.update_section').show();
        }

        function updateLabel() {
            let id = $('#id').val();
            let name = $('#label').val();
            let label_icon = $('#label_icon').prop('files')[0];

            if (name == '') {
                toastMsg('warning', 'Label Name required');
                $('#label').focus();

            } else {
                let formData = new FormData();
                formData.append('id', id);
                formData.append('name', name);
                formData.append('label_icon', label_icon);
                $('.update_section').hide();
                $('#spinn').show();
                $.ajax({
                    url: "{{ route('product.updateLabel') }}",
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
                                window.location.href = "{{ route('product.labelsettings') }}";
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

        function deletelabel(x) {
            if (confirm('Are You Sure Want To Delete?') == true) {
                let url = "{{ route('product.deleteLabel', ':delete_id') }}";
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
                                window.location.href = "{{ route('product.labelsettings') }}";
                            }, 1000);
                        } else if (data.errors) {
                            toastMsg('warning', data.error_success);
                        } else {
                            toastMsg('error', 'Something Went Wrong');
                        }
                    }
                });
            } else {
                //  toastMsg('warning', 'Cancelled');
            }
        }

        function closeLabel() {
            $('.update_section').hide();
            $('.add_section').show();
            $('#id').val('');
            $('#label').val('');
        }
    </script>
@endsection
