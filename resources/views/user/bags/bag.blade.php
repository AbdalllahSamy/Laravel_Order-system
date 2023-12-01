@extends('layouts.navbar')
@section('content-body')
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-md-auto">
                    <h5 class="mb-3 mb-md-0">Shopping Cart (<span class="bag-count"></span>)</h5>
                </div>
                <div class="col-md-auto"><a class="btn btn-sm btn-outline-secondary border-300 me-2 shadow-none"
                        href="{{ route('orders') }}"><span class="fas fa-chevron-left me-1" data-fa-transform="shrink-4"></span>Continue
                        Shopping</a><button class="check-out btn btn-sm btn-primary">Checkout</button></div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="row gx-card mx-0 bg-200 text-900 fs--1 fw-semi-bold">
                <div class="col-9 col-md-8 py-2">Name</div>
                <div class="col-3 col-md-4">
                    <div class="row">
                        <div class="col-md-8 py-2 d-none d-md-block text-center">Quantity</div>
                        <div class="col-12 col-md-4 text-end py-2">Price</div>
                    </div>
                </div>
            </div>
            <div class="bag-items">
                
            </div>
            <div class="row fw-bold gx-card mx-0">
                <div class="col-9 col-md-8 py-2 text-end text-900">Total</div>
                <div class="col px-0">
                    <div class="row gx-card mx-0">
                        <div class="col-md-8 py-2 d-none bag-count d-md-block text-center"></div>
                        <div class="col-12 col-md-4 text-end py-2 total-price"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-light d-flex justify-content-end">
            <form class="me-3">
                <div class="input-group input-group-sm"><input class="form-control" type="text"
                        placeholder="Promocode"><button class="btn btn-outline-secondary border-300 btn-sm shadow-none"
                        type="submit">Apply</button></div>
            </form><a class="check-out btn btn-sm btn-primary">Checkout</a>
        </div>
    </div>
    
    <script>
        $(document).ready(function() {

            getBagItems()

            function getBagItems() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'GET',
                    dataType: 'json',
                    url: "/users/bag-action",
                    success: function(response) {
                        $('.bag-count').html(response.data.length + " items")
                        $('.bag-items').html('')
                        let total_price = 0;
                        $.each(response.data, function(key, item) {
                            if (item.menu.img) {
                                var menu_img = '{{ asset('upload/menu') }}/' + item.menu.img
                            } else {
                                var menu_img = '{{ asset('assets/img/user.png') }}'
                            }
                            if (item.menu.discount) {
                                var price = item.menu.discount * item.quantity
                            } else {
                                var price = item.menu.price * item.quantity
                            }
                            total_price += price;
                            $('.bag-items').append('<div class="row gx-card mx-0 align-items-center border-bottom border-200">\
                    <div class="col-8 py-3">\
                        <div class="d-flex align-items-center"><img\
                                    class="img-fluid rounded-1 me-3 d-none d-md-block" src="'+menu_img+'"\
                                    alt="" width="60">\
                            <div class="flex-1">\
                                <h5 class="fs-0">'+item.menu.name+'</h5>\
                                <div class="fs--2 fs-md--1"><button value="'+item.id+'" class="delete_btn_item bg-transparent border-0 text-danger">Remove</button>\</div>\
                            </div>\
                        </div>\
                    </div>\
                    <div class="col-4 py-3">\
                        <div class="row align-items-center">\
                            <div class="col-md-8 d-flex justify-content-end justify-content-md-center order-1 order-md-0">\
                                <div>\
                                    <div class="input-group input-group-sm flex-nowrap" data-quantity="data-quantity"><button\
                                            class="btn btn-sm btn-outline-secondary border-300 px-2 shadow-none"\
                                            data-type="minus">-</button><input\
                                            class="form-control text-center px-2 input-spin-none" type="number" min="'+item.quantity+'"\
                                            value="'+item.quantity+'" aria-label="Amount (to the nearest dollar)"\
                                            style="width: 50px"><button\
                                            class="btn btn-sm btn-outline-secondary border-300 px-2 shadow-none"\
                                            data-type="plus">+</button></div>\
                                </div>\
                            </div>\
                            <div class="col-md-4 text-end ps-0 order-0 order-md-1 mb-2 mb-md-0 text-600">$'+price+'</div>\
                        </div>\
                    </div>\
                </div>\
                                ')
                            });
                            $('.total-price').html("$" + total_price)
                            let button = document.querySelectorAll('.delete_btn_item')
                            $(document).on('click', '.check-out', function() {
                                sendBagItem(button, total_price);
                            })
                    }
                })
            }

            function sendBagItem(buttons, total_price){
                let items = [];
                buttons.forEach(element => {
                    items.push(element.value);
                });
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        items: items,
                        total_price: total_price
                    },
                    url: "/users/orders",
                    success: function(response) {
                        if (response.status == 400) {
                            Swal.fire({
                                icon: 'error',
                                title: response.message,
                            });
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                showCancelButton: false,
                                confirmButtonText: 'Okay',
                                customClass: {
                                    confirmButton: 'btn btn-falcon-info'
                                },
                                buttonsStyling: false
                            });
                            getBagItems()
                        }
                    }
                })
            }
            

            /* -------------------------------------------------------------------------- */
            /*                                 Delete Item                                */
            /* -------------------------------------------------------------------------- */

            $(document).on('click', '.delete_btn_item', function() {
                var item_id = $(this).val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'GET',
                    dataType: 'json',
                    url: "/users/bag-action/" + item_id,
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
                                title: 'You want to delete ' + response.data.menu.name +
                                    ' !!?',
                                text: 'Make sure',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Yes',
                                cancelButtonText: 'No',
                                reverseButtons: true
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    detele_item(response.data.id)
                                    swalWithBootstrapButtons.fire(
                                        'Deleted file',
                                        'Item deleted successfully',
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

            function detele_item(item_id) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'DELETE',
                    dataType: 'json',
                    url: "/users/bag-action/" + item_id,
                    success: function(response) {
                        getBagItems()
                    }
                })
            }
        })
    </script>
@endsection
