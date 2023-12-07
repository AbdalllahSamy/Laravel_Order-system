@extends('layouts.navbar')
@section('content-body')
    <div class="card mb-3" id="ordersTable"
        data-list="{&quot;valueNames&quot;:[&quot;order&quot;,&quot;date&quot;,&quot;address&quot;,&quot;status&quot;,&quot;amount&quot;],&quot;page&quot;:10,&quot;pagination&quot;:true}">
        <div class="card-header">
            <div class="row flex-between-center">
                <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                    <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">Orders</h5>
                </div>
                <div class="col-8 col-sm-auto ms-auto text-end ps-0">
                    <div class="d-none" id="orders-bulk-actions">
                        <div class="d-flex"><select class="form-select form-select-sm" aria-label="Bulk actions">
                                <option selected="">Bulk actions</option>
                                <option value="Refund">Refund</option>
                                <option value="Delete">Delete</option>
                                <option value="Archive">Archive</option>
                            </select><button class="btn btn-falcon-default btn-sm ms-2" type="button">Apply</button></div>
                    </div>
                    <div id="orders-actions"><button class="btn btn-falcon-default btn-sm mx-2" type="button"><span
                                class="fas fa-filter" data-fa-transform="shrink-3 down-2"></span><span
                                class="d-none d-sm-inline-block ms-1">Filter</span></button><button
                            class="btn btn-falcon-default btn-sm" type="button"><span class="fas fa-external-link-alt"
                                data-fa-transform="shrink-3 down-2"></span><span
                                class="d-none d-sm-inline-block ms-1">Export</span></button></div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive scrollbar">
                <table class="table table-sm table-striped fs--1 mb-0 overflow-hidden">
                    <thead class="bg-200 text-900">
                        <tr>
                            <th>
                                <div class="form-check fs-0 mb-0 d-flex align-items-center"><input class="form-check-input"
                                        id="checkbox-bulk-customers-select" type="checkbox"
                                        data-bulk-select="{&quot;body&quot;:&quot;table-orders-body&quot;,&quot;actions&quot;:&quot;orders-bulk-actions&quot;,&quot;replacedElement&quot;:&quot;orders-actions&quot;}">
                                </div>
                            </th>
                            <th class="sort pe-1 align-middle white-space-nowrap" data-sort="order">Order</th>
                            <th class="sort pe-1 align-middle white-space-nowrap" data-sort="date">Date</th>
                            <th class="sort pe-1 align-middle white-space-nowrap" data-sort="address"
                                style="min-width: 12.5rem;">Order info</th>
                            <th class="sort pe-1 align-middle white-space-nowrap text-center" data-sort="status">Status</th>
                            <th class="sort pe-1 align-middle white-space-nowrap text-end" data-sort="amount">Amount</th>
                            <th class="no-sort"></th>
                        </tr>
                    </thead>
                    <tbody class="list orders-body" id="table-orders-body">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex align-items-center justify-content-center"><button
                    class="btn btn-sm btn-falcon-default me-1 disabled" type="button" title="Previous"
                    data-list-pagination="prev" disabled=""><span class="fas fa-chevron-left"></span></button>
                <ul class="pagination mb-0">
                    <li class="active"><button class="page" type="button" data-i="1" data-page="10">1</button>
                    </li>
                    <li><button class="page" type="button" data-i="2" data-page="10">2</button></li>
                    <li><button class="page" type="button" data-i="3" data-page="10">3</button></li>
                </ul><button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next"
                    data-list-pagination="next"><span class="fas fa-chevron-right"></span></button>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function() {

            getUsersOrders()

            function getUsersOrders() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'GET',
                    dataType: 'json',
                    url: "/orders-action",
                    success: function(response) {
                        $('.orders-body').html('')

                        $.each(response.data, function(key, item) {
                            if (item.status == 'pending') {
                                var orderStatus =
                                    '<span class="badge badge rounded-pill d-block badge-soft-warning">Pending<span class="ms-1 fas fa-stream" data-fa-transform="shrink-2"></span></span>'
                            }else if(item.status == 'processing'){
                              var orderStatus = '<span class="badge badge rounded-pill d-block badge-soft-primary">Processing<span class="ms-1 fas fa-redo" data-fa-transform="shrink-2"></span></span>'
                            }else if(item.status == 'on hold'){
                              var orderStatus = '<span class="badge badge rounded-pill d-block badge-soft-secondary">On Hold<span class="ms-1 fas fa-ban" data-fa-transform="shrink-2"></span></span>'
                            }else{
                              var orderStatus = '<span class="badge badge rounded-pill d-block badge-soft-success">Completed<span class="ms-1 fas fa-check" data-fa-transform="shrink-2"></span></span>'
                            }

                            const originalDate = new Date(item.created_at);
                            const formattedDate = originalDate.toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit'
                            });
                            $('.orders-body').append('<tr class="btn-reveal-trigger">\
                                <td class="align-middle" style="width: 28px;">\
                                    <div class="form-check fs-0 mb-0 d-flex align-items-center"><input class="form-check-input"\
                                            type="checkbox" id="checkbox-0" data-bulk-select-row="data-bulk-select-row"></div>\
                                </td>\
                                <td class="order py-2 align-middle white-space-nowrap"><a href="order-details.html">\
                                        <strong>#' + item.id + '</strong></a> by <strong>' + item.user.name + '</strong><br><a\
                                        href="mailto:ricky@example.com">' + item.user.email + '</a></td>\
                                <td class="date py-2 align-middle">'+formattedDate+'</td>\
                                <td class="address py-2 align-middle white-space-nowrap">\
                                  <strong class="text-primary">#' + item.item.id + '</strong></a> ordered <strong>' + item
                                .item.name + '</strong>\
                                  <p class="mb-0 text-primary">' + item.item.desc + '</p>\
                                </td>\
                                <td class="status py-2 align-middle text-center fs-0 white-space-nowrap">' + orderStatus + '</td>\
                                <td class="amount py-2 align-middle text-end fs-0 fw-medium">$' + item.total_price + '</td>\
                                <td class="py-2 align-middle white-space-nowrap text-end">\
                                    <div class="dropdown font-sans-serif position-static"><button\
                                            class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button"\
                                            id="order-dropdown-0" data-bs-toggle="dropdown" data-boundary="viewport"\
                                            aria-haspopup="true" aria-expanded="false"><span\
                                                class="fas fa-ellipsis-h fs--1"></span></button>\
                                        <div class="dropdown-menu dropdown-menu-end border py-0"\
                                            aria-labelledby="order-dropdown-0">\
                                            <div class="py-2"><button class="update_order_status dropdown-item" value="completed,'+item.id+'">Completed</button><button\
                                                    class="update_order_status dropdown-item" value="processing,'+item.id+'">Processing</button><button class="update_order_status dropdown-item"\
                                                    value="on hold,'+item.id+'">On Hold</button><button class="update_order_status dropdown-item"\
                                                    value="pending,'+item.id+'">Pending</button>\
                                                <div class="dropdown-divider"></div><button class="delete_btn_item dropdown-item text-danger"\
                                                    value="'+item.id+'">Delete</button>\
                                            </div>\
                                        </div>\
                                    </div>\
                                </td>\
                            </tr>\
                            ')
                        });
                    }
                })
            }


            /* -------------------------------------------------------------------------- */
            /*                                 DeleteItem                                 */
            /* -------------------------------------------------------------------------- */

            $(document).on('click', '.update_order_status', function() {
                var order = $(this).val();
                var parts = order.split(',');
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'GET',
                    dataType: 'json',
                    url :"/orders-action/" + parts[1],
                    success: function(response) {
                        if (response.status == 404) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Sorry',
                                text: response.message,
                            })
                        } else {
                            const swalWithBootstrapButtons = Swal.mixin({
                                customClass: {
                                    confirmButton: 'btn btn-falcon-info  ',
                                    cancelButton: 'btn btn-falcon-danger'
                                },
                                buttonsStyling: false
                            })

                            swalWithBootstrapButtons.fire({
                                title: "You Want To Make This Order " + parts[0] + "!!?",
                                text: 'Make sure',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Yes',
                                cancelButtonText: 'No',
                                reverseButtons: true
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    update_status(parts[1], parts[0])
                                    swalWithBootstrapButtons.fire(
                                        'Deleted',
                                        'Status updated successfully',
                                        'success'
                                    )
                                } else if (
                                    /* Read more about handling dismissals below */
                                    result.dismiss === Swal.DismissReason.cancel
                                ) {
                                    swalWithBootstrapButtons.fire(
                                        'Cancelled',
                                        'Thanks',
                                        'error'
                                    )
                                }
                            })
                        }
                    }
                })
            });

            function update_status(order_id, status) {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'PUT',
                    dataType: 'json',
                    data: { status: status },
                    url :"/orders-action/" + order_id,
                    success: function(response) {
                      getUsersOrders()
                    }
                })
            }

            $(document).on('click', '.delete_btn_item', function() {
                var order_id = $(this).val();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'GET',
                    dataType: 'json',
                    url :"/orders-action/" + order_id,
                    success: function(response) {
                        if (response.status == 404) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Sorry',
                                text: response.message,
                            })
                        } else {
                            const swalWithBootstrapButtons = Swal.mixin({
                                customClass: {
                                    confirmButton: 'btn btn-falcon-info  ',
                                    cancelButton: 'btn btn-falcon-danger'
                                },
                                buttonsStyling: false
                            })

                            swalWithBootstrapButtons.fire({
                                title: 'You Want To Delete This Order!!?',
                                text: 'Make sure',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Yes',
                                cancelButtonText: 'No',
                                reverseButtons: true
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    detele_item(order_id)
                                    swalWithBootstrapButtons.fire(
                                        'Deleted',
                                        'Order Deleted Successfully',
                                        'success'
                                    )
                                } else if (
                                    /* Read more about handling dismissals below */
                                    result.dismiss === Swal.DismissReason.cancel
                                ) {
                                    swalWithBootstrapButtons.fire(
                                        'Cancelled',
                                        'Thanks',
                                        'error'
                                    )
                                }
                            })
                        }
                    }
                })
            });

            function detele_item(order_id) {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'DELETE',
                    dataType: 'json',
                    url :"/orders-action/" + order_id,
                    success: function(response) {
                      getUsersOrders()
                    }
                })
            }
        })
    </script>
@endsection
