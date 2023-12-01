@extends('layouts.navbar')
@section('content-body')
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card"
            style="background-image:url({{ asset('assets/img/icons/spot-illustrations/corner-4.png') }});">
        </div>
        <div class="card-body position-relative m-3">
            <div class="row flex-between">
                <div class="col-lg-12">
                    <h3>Menu</h3>
                </div>

            </div>

        </div>
    </div>

    <div id="tableExample3" class="card mb-3 mt-3 p-3">
        <div class="row justify-content-between align-items-center my-3">

            <div class="col-auto">
                <button class="add_menu_btn btn btn-falcon-info   ">Add Items</button>
            </div>
        </div>
        <div class="table-responsive scrollbar">
            <table class="table mb-0 data-table fs--1" id="myTable">
                <thead class="bg-200 text-900">
                    <tr>
                        <th class="text-center">#ID</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Description</th>
                        <th class=" text-center">Price</th>
                        <th class=" text-center">Discount</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Control</th>
                    </tr>
                </thead>
                <tbody class="list menu_table">

                </tbody>
            </table>

        </div>

    </div>

    <div class="modal fade" id="add_menu_model" tabindex="-1" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <div class="row" style="justify-content:space-evenly">
                                    <div class="col-lg-6 form-Roles">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control name_en">
                                    </div>

                                    <div class=" col-lg-6 form-Roles">
                                        <label class="form-label">Price</label>
                                        <input type="text" name="price" class="form-control name_ar">
                                    </div>
                                    <div class="col-lg-6 form-Roles mt-2">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" name="status" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="public">Public</option>
                                            <option value="private">Private</option>
                                        </select>
                                    </div>

                                    <div class=" col-lg-6 form-Roles mt-2">
                                        <label class="form-label">Discount</label>
                                        <input type="text" name="discount" class="form-control name_ar">
                                    </div>
                                    <div class=" col-lg-12 form-Roles mt-2">
                                        <label class="form-label">Image</label>
                                        <input type="file" name="img" class="form-control value">
                                    </div>
                                    <div class=" col-lg-12 form-Roles mt-2">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
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

    {{-- <div class="modal fade"  id="item_modal_update"  tabindex="-1"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg mt-6" role="document">
        <div class="modal-content border-0">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1" id="modalExampleDemoLabel"> {{__('edit_room_category')}}   </h4>
                    </div>
                    <div class="p-4">

                        <div class="row mt-3" style="justify-content:space-evenly">
                            <div class="col-lg-6 form-Roles">
                                <label class="form-label">{{__('validation.Descreption_en')}}</label>
                                <input type="text" class="form-control " id="name_en" >
                                <input type="hidden" class="item_id">
                            </div>

                            <div class=" col-lg-6 form-Roles" >
                                <label class="form-label">{{__('validation.Descreption_ar')}}</label>
                                <input type="text" class="form-control name_ar" id="name_ar" >
                            </div>

                            <div class=" col-lg-12 form-Roles" >
                                <label class="form-label">{{__('validation.Value')}}</label>
                                <input type="text" class="form-control " id="value" >
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">{{__('validation.cancel')}} </button>
                    <button class="btn btn-primary Update_item" type="button">{{__('validation.save')}}  </button>
                </div>
            </div>
        </div>
    </div>
</div> --}}

    <script>
        $(document).ready(function() {

            getMenu()

            function getMenu() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'GET',
                    dataType: 'json',
                    url: "/menu-actions",
                    success: function(response) {
                        $('.menu_table').html('')
                        $.each(response.data, function(key, item) {
                            if (item.img) {
                                var menu_img = '{{ asset('upload/menu') }}/' + item.img
                            } else {
                                var menu_img = '{{ asset('assets/img/user.png') }}'
                            }
                            $('.menu_table').append('<tr >\
                                        <td class="pt-3 text-center">\
                                            <span class="h6">#' + item.id + '</span>\
                                        </td>\
                                        <td class="align-middle name  text-center  min-w-100">\
                                            <div class="avatar avatar-3xl">\
                                                <img class="rounded-circle" src=" ' + menu_img + '" alt="" />\
                                            </div>\
                                        </td>\
                                        <td class="align-middle type  text-center  min-w-100">\
                                            <h6>' + item.name + '  </h6> \
                                        </td>\
                                        <td class="align-middle min-w-100 Hours text-center">\
                                            <h6>' + item.desc + ' </h6> \
                                        </td>\
                                        <td class="align-middle min-w-100 diamonds text-center">\
                                            <h6>' + item.price + ' </h6> \
                                        </td>\
                                        <td class="align-middle min-w-100 Days text-center">\
                                            <h6>' + item.discount + '</h6> \
                                        </td>\
                                        <td class="align-middle min-w-100  Agency_Share text-center">\
                                            <h6>' + item.status + '</h6> \
                                        </td>\
                                        <td class="align-middle min-w-100">\
                                            <div class="d-flex">\
                                                <button class="btn btn-falcon-info   w-100 me-3 update_btn_item" value="' +
                                item.id + '"> Update </button>\
                                                <button class="btn btn-falcon-danger w-100 delete_btn_item" value="' + item
                                .id + '"> Delete</button>\
                                            </div>\
                                        </td>\
                                    </tr>\
                                ')
                        });
                    }
                })
            }


            /* -------------------------------------------------------------------------- */
            /*                                  Add to DB                                 */
            /* -------------------------------------------------------------------------- */
            $(document).on('click', '.add_menu_btn', function(e) {
                e.preventDefault();
                $('#add_menu_model').modal('show');
            });

            $('#add_form').submit(function(e) {
                e.preventDefault();
                var menuItem = new FormData(this);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    url: "/menu-actions",
                    dataType: "json",
                    data: menuItem,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == 400) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Please fill all data',
                            });
                        } else {
                            $('#add_menu_model').modal('hide')
                            $('#add_form').find('input').val('')
                            getMenu()
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                            })

                        }
                    }
                });
            });

            /* -------------------------------------------------------------------------- */
            /*                                   Delete                                   */
            /* -------------------------------------------------------------------------- */

            $(document).on('click', '.delete_btn_item', function() {
                var item_id = $(this).val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'GET',
                    dataType: 'json',
                    url: "/menu-actions/" + item_id,
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
                                title: 'You want to delete ' + response.data.name +
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
                    url: "/menu-actions/" + item_id,
                    success: function(response) {
                        getMenu()
                    }
                })
            }
        })
    </script>
@endsection
