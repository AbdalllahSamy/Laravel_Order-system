@extends('layouts.navbar')
@section('content-body')
    <div class="card mb-3">
        <div class="card-body">
            <div class="row flex-between-center">
                <div class="col-sm-auto mb-2 mb-sm-0">
                    <h6 class="mb-0">Showing 1-1 of {{ $itemCount }} Products</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                @foreach ($items as $item)
                    <div class="mb-4 col-md-6 col-lg-4">
                        <div class="border rounded-1 h-100 d-flex flex-column justify-content-between pb-3">
                            <div class="overflow-hidden">
                                <div class="position-relative rounded-top overflow-hidden"><a class="d-block"
                                        href="product-details.html"><img class="img-fluid rounded-top"
                                            src="{{ asset('/upload/menu/' . $item->img) }}" alt=""></a><span
                                        class="badge rounded-pill bg-success position-absolute mt-2 me-2 z-index-2 top-0 end-0">New</span>
                                </div>
                                <div class="p-3">
                                    <h5 class="fs-0"><a class="text-dark"
                                            href="product-details.html">{{ $item->name }}</a></h5>
                                    <p class="fs--1 mb-3"><a class="text-500" href="#!">{{ $item->desc }}</a></p>
                                    <h5 class="fs-md-2 text-warning mb-0 d-flex align-items-center mb-3">
                                        ${{ ($item->discount && auth()->user()->prime) ? $item->discount : $item->price }}
                                        <del class="ms-2 fs--1 text-500">
                                            @if ($item->discount && auth()->user()->prime)
                                                $ {{ $item->price }}
                                            @endif
                                        </del>
                                    </h5>
                                    <p class="fs--1 mb-1">Status: <strong
                                            class="text-success text-capitalize ">{{ $item->status }}</strong></p>
                                </div>
                            </div>
                            <div class="d-flex flex-between-center px-3">
                                <div class="input-group input-group-sm" data-quantity="data-quantity">
                                    <button class="btn btn-sm btn-outline-secondary border-300" data-field="input-quantity"
                                        data-type="minus">-</button>
                                    <input class="form-control text-center order-quantity input-spin-none" type="number"
                                        min="1" value="1" aria-label="Amount (to the nearest dollar)"
                                        style="max-width: 50px">
                                    <button class="btn btn-sm btn-outline-secondary border-300" data-field="input-quantity"
                                        data-type="plus">+</button>
                                </div>
                                <button class="btn btn-sm btn-falcon-default me-1 make_feedback_btn" value="{{ $item->id }}">Feedback</button>
                                <div>
                                    <button class="btn btn-sm btn-falcon-default add_my_bag" data-bs-toggle="tooltip"
                                        data-bs-placement="top" value="{{ $item->id }}" aria-label="Add to Cart"
                                        data-bs-original-title="Add to Cart"><span class="fas fa-cart-plus"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer bg-light d-flex justify-content-center">
            <div><button class="btn btn-falcon-default btn-sm me-2" type="button" disabled="disabled"
                    data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Prev" data-bs-original-title="Prev"><span
                        class="fas fa-chevron-left"></span></button><a
                    class="btn btn-sm btn-falcon-default text-primary me-2" href="#!">1</a><a
                    class="btn btn-sm btn-falcon-default me-2" href="#!">2</a><a
                    class="btn btn-sm btn-falcon-default me-2" href="#!"><span class="fas fa-ellipsis-h"></span></a><a
                    class="btn btn-sm btn-falcon-default me-2" href="#!">35</a><button
                    class="btn btn-falcon-default btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                    aria-label="Next" data-bs-original-title="Next"><span class="fas fa-chevron-right"></span></button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="make_feedback_model" tabindex="-1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg mt-6" role="document">
            <div class="modal-content border-0">
                <div class="modal-content position-relative">
                    <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                            <h4 class="mb-1" id="modalExampleDemoLabel">Add Item To Menu</h4>
                        </div>
                        <form action="#" method="POST" id ="add_form" enctype="multipart/form-data">
                            @csrf
                            <div class="p-4">
                                <div class="form-Roles mt-2">
                                    <label class="form-label">Feedback</label>
                                    <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <input type="hidden" value="" name="order_id" class="item_id">
                                </div>
                            </div>
                            <div class="modal-footer mt-3">
                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary add_menu" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            
            $(document).on('click', '.add_my_bag', function(e) {
                e.preventDefault();
                var item_id = $(this).val();
                var quantity = $('.order-quantity').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        menu_id: item_id,
                        quantity: quantity
                    },
                    url: "/users/bag-action",
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
                            getMyBagCount()
                        }
                    }
                })
            });

            getMyBagCount()

            function getMyBagCount() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'GET',
                    dataType: 'json',
                    url: "/users/myBagCount",
                    success: function(response) {
                        $('.notification-indicator-number').html(response.data)
                    }
                })
            }

            $(document).on('click', '.make_feedback_btn', function(e) {
                e.preventDefault();
                $('.item_id').val(this.value);
                $('#make_feedback_model').modal('show');
            });

            $('#add_form').submit(function(e) {
                e.preventDefault();
                var menuItem = new FormData(this);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    url: "/users/feedbacks-store",
                    dataType: "json",
                    data: menuItem,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == 404) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Please fill all data',
                            });
                        } else {
                            $('#make_feedback_model').modal('hide')
                            $('#add_form').find('input').val('')
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                            })

                        }
                    }
                });
            });
        })
    </script>
@endsection
