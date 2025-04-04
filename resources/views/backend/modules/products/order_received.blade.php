@extends('backend.layouts.master')
@section('main-content')
    <div class="main-content app-content">
        <div class="container-fluid">
            <div class="content-header row" style="margin-top: 20px;margin-bottom: 10px;">
                <div id="toasts" style="--default-text-color: #fff; margin-top: 50px; z-index:1200"></div>
                <div class="content-header-left col-12 mb-1 mt-1">
                    <div class="row breadcrumbs-top"style="margin-right: 8px;">
                        <div class="col-sm-12 col-md-8 d-none d-md-block">
                            <h5 class="content-header-title float-left pr-1 mb-0">Order Received</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="#">Products</a> </li>
                                    <li class="breadcrumb-item active">Order Received </li>
                                </ol>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <section class="users-type-wrapper">
                <div class="row">
                    <div class="col-md-12 col-12 data_detail">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table
                                            id="order_table_list"class="w-100 table table-striped table-bordered dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Item Name</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Total Price</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
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
        $(document).ready(function() {
            $('#order_table_list').DataTable({
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ route('order.orderReceivedList') }}',
                columns: [{
                        data: 'orderid',
                        name: 'orderid'
                    },
                    {
                        data: 'item_name',
                        name: 'item_name'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'total_price',
                        name: 'total_price'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                  "columnDefs": [{
                        "orderable": false,
                        "targets": [5, 6]
                    },
                    {
                        "orderable": true,
                        "targets": [0,1,2,3,4]
                    }
                ]

            });
        });

        function deleteOrder(x) {
            if (confirm('Are You Sure Want To Delete?') == true) {
                let url = "{{ route('admin-receivedOrder.destroy', ':delete_id') }}";
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
                            window.location.href = "{{ route('admin-receivedOrder.index') }}";
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
    </script>
@endsection
