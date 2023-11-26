@extends('layouts.navbar')
@section('content-body')
<div class="card mb-3">
    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url({{asset('assets/img/icons/spot-illustrations/corner-4.png')}});">
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
            <button class="add_Room_Cat_btn btn btn-falcon-info   ">Add Items</button>
        </div>
      </div>
    <div class="table-responsive scrollbar">
      <table class="table mb-0 data-table fs--1" id="myTable">
        <thead class="bg-200 text-900">
          <tr>
            <th class="text-center" >#ID</th>
            <th class="text-center" >Image</th>
            <th class="text-center" >Name</th>
            <th class="text-center" >Description</th>
            <th class=" text-center">Price</th>
            <th class=" text-center">Discount</th>
            <th class="text-center" >Status</th>
          </tr>
        </thead>
        <tbody class="list menu_table">

        </tbody>
      </table>

    </div>

</div>

<div class="modal fade"  id="Add_Room_Cat_model"  tabindex="-1"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg mt-6" role="document">
        <div class="modal-content border-0">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                         <h4 class="mb-1" id="modalExampleDemoLabel">Add Item To Menu</h4>
                    </div>
                    <div class="p-4">
                        <div class="row" style="justify-content:space-evenly">
                                <div class="col-lg-6 form-Roles">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control name_en" >
                                </div>

                                <div class=" col-lg-6 form-Roles" >
                                    <label class="form-label">Price</label>
                                    <input type="text" class="form-control name_ar" >
                                </div>
                                <div class="col-lg-6 form-Roles mt-2">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="public">Public</option>
                                        <option value="private">Private</option>
                                      </select>
                                </div>

                                <div class=" col-lg-6 form-Roles mt-2" >
                                    <label class="form-label">Discount</label>
                                    <input type="text" class="form-control name_ar" >
                                </div>
                                <div class=" col-lg-12 form-Roles mt-2" >
                                    <label class="form-label">Image</label>
                                    <input type="file" class="form-control value" >
                                </div>
                                <div class=" col-lg-12 form-Roles mt-2" >
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer mt-3">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary add_Room_Cat" type="button">Save</button>
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
    $(document).ready(function(){
        $(document).on('click' ,'.add_Room_Cat_btn' , function(e){
            e.preventDefault();
            $('#Add_Room_Cat_model').modal('show');
        });
})
</script>

@endsection