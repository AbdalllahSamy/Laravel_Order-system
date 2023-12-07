@extends('layouts.navbar')
@section('content-body')
<div class="card mb-3" id="customersTable" data-list="{&quot;valueNames&quot;:[&quot;name&quot;,&quot;email&quot;,&quot;joined&quot;],&quot;page&quot;:10,&quot;pagination&quot;:true}">
    <div class="card-header">
      <div class="row flex-between-center">
        <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
          <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">Customers</h5>
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
          <div id="table-customers-replace-element"><button class="btn btn-falcon-default btn-sm add_user_button" type="button"><span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span class="d-none d-sm-inline-block ms-1">New</span></button></div>
        </div>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive scrollbar">
        <table class="table table-sm table-striped fs--1 mb-0 overflow-hidden">
          <thead class="bg-200 text-900">
            <tr>
              <th>
                <div class="form-check fs-0 mb-0 d-flex align-items-center"><input class="form-check-input" id="checkbox-bulk-customers-select" type="checkbox" data-bulk-select="{&quot;body&quot;:&quot;table-customers-body&quot;,&quot;actions&quot;:&quot;table-customers-actions&quot;,&quot;replacedElement&quot;:&quot;table-customers-replace-element&quot;}"></div>
              </th>
              <th class="sort pe-1 align-middle white-space-nowrap" data-sort="name">Name</th>
              <th class="sort pe-1 align-middle white-space-nowrap" data-sort="email">Email</th>
              <th class="sort pe-1 align-middle white-space-nowrap" data-sort="joined">Joined</th>
              <th class="align-middle no-sort"></th>
            </tr>
          </thead>
          <tbody class="list users-table" id="table-customers-body">
            
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer d-flex align-items-center justify-content-center"><button class="btn btn-sm btn-falcon-default me-1 disabled" type="button" title="Previous" data-list-pagination="prev" disabled=""><span class="fas fa-chevron-left"></span></button>
      <ul class="pagination mb-0"><li class="active"><button class="page" type="button" data-i="1" data-page="10">1</button></li><li><button class="page" type="button" data-i="2" data-page="10">2</button></li><li><button class="page" type="button" data-i="3" data-page="10">3</button></li></ul><button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next"><span class="fas fa-chevron-right"></span></button>
    </div>
  </div>
  <div class="modal fade" id="add_user_model" tabindex="-1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg mt-6" role="document">
        <div class="modal-content border-0">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1" id="modalExampleDemoLabel">Add User</h4>
                    </div>
                    <form action="#" method="POST" id ="add_form" enctype="multipart/form-data">
                        @csrf
                        <div class="p-4">
                            <div class="row" style="justify-content:space-evenly">
                                <div class="col-lg-6 form-Roles">
                                    <label class="form-label">Name*</label>
                                    <input type="text" name="name" class="form-control name_en">
                                </div>

                                <div class=" col-lg-6 form-Roles">
                                    <label class="form-label">Email*</label>
                                    <input type="email" name="email" class="form-control name_ar">
                                </div>
                                <div class=" col-lg-12 form-Roles mt-2">
                                    <label class="form-label">Password*</label>
                                    <input type="password" name="password" class="form-control name_ar">
                                </div>
                                <div class=" col-lg-12 form-Roles mt-2">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="img" class="form-control value">
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
  <script>
    $(document).ready(function() {

      getUsers()

      function getUsers() {
          $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: 'GET',
              dataType: 'json',
              url: "/users-action",
              success: function(response) {
                  $('.users-table').html('')
                  $.each(response.data, function(key, item) {
                            const originalDate = new Date(item.created_at);
                            const formattedDate = originalDate.toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit'
                            });
                      if (item.profile_photo_path) {
                          var user_img = '{{ asset('upload/user') }}/' + item.profile_photo_path
                      } else {
                          var user_img = '{{ asset('assets/img/user.png') }}'
                      }
                      $('.users-table').append('<tr class="btn-reveal-trigger">\
                    <td class="align-middle py-2" style="width: 28px;">\
                      <div class="form-check fs-0 mb-0 d-flex align-items-center"><input class="form-check-input" type="checkbox" id="customer-0" data-bulk-select-row="data-bulk-select-row"></div>\
                    </td>\
                    <td class="name align-middle white-space-nowrap py-2"><a href="customer-details.html">\
                        <div class="d-flex d-flex align-items-center">\
                          <div class="avatar avatar-xl me-2">\
                            <img class="rounded-circle" src="'+user_img+'" alt="">\
                          </div>\
                          <div class="flex-1">\
                            <h5 class="mb-0 fs--1">'+item.name+'</h5>\
                          </div>\
                        </div>\
                      </a></td>\
                    <td class="email align-middle py-2"><a href="mailto:ricky@example.com">'+item.email+'</a></td>\
                    <td class="joined align-middle py-2">'+formattedDate+'</td>\
                    <td class="align-middle white-space-nowrap py-2 text-end">\
                      <div class="dropdown font-sans-serif position-static"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="customer-dropdown-0" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>\
                        <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-0">\
                          <div class="py-2"><button class="dropdown-item" value="'+item.id+'">Edit</button><button class="dropdown-item text-danger delete_btn_item" value="'+item.id+'">Delete</button></div>\
                        </div>\
                      </div>\
                    </td>\
                  </tr>\
                  ')
                  });
              }
          })
          
      }


      $(document).on('click', '.add_user_button', function(e) {
          e.preventDefault();
          $('#add_user_model').modal('show');
      });

      $('#add_form').submit(function(e) {
          e.preventDefault();
          var menuItem = new FormData(this);
          $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: "post",
              url: "/users-action",
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
                      $('#add_user_model').modal('hide')
                      $('#add_form').find('input').val('')
                      getUsers()
                      Swal.fire({
                          icon: 'success',
                          title: response.message,
                      })
                  }
              }
          });
      });


      $(document).on('click', '.delete_btn_item', function() {
                var user_id = $(this).val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'GET',
                    dataType: 'json',
                    url: "/users-action/" + user_id,
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

            function detele_item(user_id) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'DELETE',
                    dataType: 'json',
                    url: "/users-action/" + user_id,
                    success: function(response) {
                      getUsers()
                    }
                })
            }
    })
  </script>
@endsection