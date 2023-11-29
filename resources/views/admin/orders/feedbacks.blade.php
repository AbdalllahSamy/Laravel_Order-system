@extends('layouts.navbar')
@section('content-body')
    <div class="card mb-3" id="customersTable"
        data-list="{&quot;valueNames&quot;:[&quot;name&quot;,&quot;email&quot;,&quot;phone&quot;,&quot;address&quot;,&quot;joined&quot;],&quot;page&quot;:10,&quot;pagination&quot;:true}">
        <div class="card-header">
            <div class="row flex-between-center">
                <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                    <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">Feedbacks</h5>
                </div>
                <div class="col-8 col-sm-auto text-end ps-2">
                    <div class="d-none" id="table-customers-actions">
                        <div class="d-flex"><select class="form-select form-select-sm" aria-label="Bulk actions">
                                <option selected="">Bulk actions</option>
                                <option value="Refund">Refund</option>
                                <option value="Delete">Delete</option>
                                <option value="Archive">Archive</option>
                            </select><button class="btn btn-falcon-default btn-sm ms-2" type="button">Apply</button></div>
                    </div>
                    
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
                                        data-bulk-select="{&quot;body&quot;:&quot;table-customers-body&quot;,&quot;actions&quot;:&quot;table-customers-actions&quot;,&quot;replacedElement&quot;:&quot;table-customers-replace-element&quot;}">
                                </div>
                            </th>
                            <th class="sort pe-1 align-middle white-space-nowrap" data-sort="name">User Info</th>
                            <th class="sort pe-1 align-middle white-space-nowrap" data-sort="email">Order Info</th>
                            <th class="sort pe-1 align-middle white-space-nowrap" data-sort="phone">Comment</th>
                            <th class="sort pe-1 align-middle white-space-nowrap" data-sort="joined">Created At</th>
                            <th class="align-middle no-sort"></th>
                        </tr>
                    </thead>
                    <tbody class="list" id="table-feedback-body">
                        <tr class="btn-reveal-trigger">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-center"><button
                class="btn btn-sm btn-falcon-default me-1 disabled" type="button" title="Previous"
                data-list-pagination="prev" disabled=""><span class="fas fa-chevron-left"></span></button>
            <ul class="pagination mb-0">
                <li class="active"><button class="page" type="button" data-i="1" data-page="10">1</button></li>
                <li><button class="page" type="button" data-i="2" data-page="10">2</button></li>
                <li><button class="page" type="button" data-i="3" data-page="10">3</button></li>
            </ul><button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next"
                data-list-pagination="next"><span class="fas fa-chevron-right"></span></button>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            getFeedback()

            function getFeedback() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'GET',
                    dataType: 'json',
                    url: "/feedbacks-actions",
                    success: function(response) {
                        $('#table-feedback-body').html('')
                        $.each(response.data, function(key, item) {
                            const originalDate = new Date(item.created_at);
                            const formattedDate = originalDate.toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit'
                            });
                            if (item.menu.img) {
                                var menu_img = '{{ asset('upload/menu') }}/' + item.menu.img
                            } else {
                                var menu_img = '{{ asset('assets/img/user.png') }}'
                            }
                            if (item.menu.profile_photo_path) {
                                var user_img = '{{ asset('upload/menu') }}/' + item.menu.profile_photo_path
                            } else {
                                var user_img = '{{ asset('assets/img/user.png') }}'
                            }
                            $('#table-feedback-body').append('\
                            <tr>\
                      <td class="align-middle py-2" style="width: 28px;">\
                        <div class="form-check fs-0 mb-0 d-flex align-items-center"><input class="form-check-input" type="checkbox" id="customer-0" data-bulk-select-row="data-bulk-select-row"></div>\
                      </td>\
                      <td class="name align-middle white-space-nowrap py-2"><a href="customer-details.html">\
                          <div class="d-flex d-flex align-items-center">\
                            <div class="avatar avatar-xl me-2">\
                              <div class="rounded-circle"><img class="rounded-circle" src="'+user_img+'" alt"UserImage"" /></div>\
                            </div>\
                            <div class="flex-1">\
                              <h5 class="mb-0 fs--1">' + item.user.name + '</h5>\
                            </div>\
                          </div>\
                        </a></td>\
                      <td class="email align-middle py-2">\
                        <div class="d-flex d-flex align-items-center">\
                            <div class="avatar avatar-xl me-2">\
                              <div class="avatar-name rounded-circle"><img class="rounded-circle" src="'+menu_img+'" alt"UserImage"" /></div>\
                            </div>\
                            <div class="flex-1">\
                              <h5 class="mb-0 fs--1">' + item.menu.name + '</h5>\
                            </div>\
                          </div>\
                        </a>\
                      </td>\
                      <td class="phone align-middle white-space-nowrap py-2">' + item.comment + '</td>\
                      <td class="joined align-middle py-2">' + formattedDate + '</td>\
                      <td class="align-middle white-space-nowrap py-2 text-end">\
                        <div class="dropdown font-sans-serif position-static"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="customer-dropdown-0" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>\
                          <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-0">\
                            <div class="py-2">\
                                <button class="dropdown-item text-danger delete_btn_item" value="'+item.id+'">Delete</button>\
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

            $(document).on('click', '.delete_btn_item', function() {
                var feedback_id = $(this).val();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'GET',
                    dataType: 'json',
                    url :"/feedbacks-actions/" + feedback_id,
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
                                title: 'You Want To Delete Feedback!!?',
                                text: 'Make sure',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Yes',
                                cancelButtonText: 'No',
                                reverseButtons: true
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    detele_item(feedback_id)
                                    swalWithBootstrapButtons.fire(
                                        'Deleted',
                                        'Feedback Deleted Successfully',
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

            function detele_item(feedback_id) {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'DELETE',
                    dataType: 'json',
                    url :"/feedbacks-actions/" + feedback_id,
                    success: function(response) {
                      getFeedback()
                    }
                })
            }
        });
    </script>
@endsection
