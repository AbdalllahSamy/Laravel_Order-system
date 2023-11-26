@extends('layouts.navbar')
@section('content-body')
<div class="card mb-3" id="customersTable" data-list="{&quot;valueNames&quot;:[&quot;name&quot;,&quot;email&quot;,&quot;phone&quot;,&quot;address&quot;,&quot;joined&quot;],&quot;page&quot;:10,&quot;pagination&quot;:true}">
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
          <div id="table-customers-replace-element"><button class="btn btn-falcon-default btn-sm" type="button"><span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span class="d-none d-sm-inline-block ms-1">New</span></button><button class="btn btn-falcon-default btn-sm mx-2" type="button"><span class="fas fa-filter" data-fa-transform="shrink-3 down-2"></span><span class="d-none d-sm-inline-block ms-1">Filter</span></button><button class="btn btn-falcon-default btn-sm" type="button"><span class="fas fa-external-link-alt" data-fa-transform="shrink-3 down-2"></span><span class="d-none d-sm-inline-block ms-1">Export</span></button></div>
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
              <th class="sort pe-1 align-middle white-space-nowrap" data-sort="phone">Phone</th>
              <th class="sort pe-1 align-middle white-space-nowrap ps-5" data-sort="address" style="min-width: 200px;">Billing Address</th>
              <th class="sort pe-1 align-middle white-space-nowrap" data-sort="joined">Joined</th>
              <th class="align-middle no-sort"></th>
            </tr>
          </thead>
          <tbody class="list" id="table-customers-body"><tr class="btn-reveal-trigger">
              <td class="align-middle py-2" style="width: 28px;">
                <div class="form-check fs-0 mb-0 d-flex align-items-center"><input class="form-check-input" type="checkbox" id="customer-0" data-bulk-select-row="data-bulk-select-row"></div>
              </td>
              <td class="name align-middle white-space-nowrap py-2"><a href="customer-details.html">
                  <div class="d-flex d-flex align-items-center">
                    <div class="avatar avatar-xl me-2">
                      <div class="avatar-name rounded-circle"><span>RA</span></div>
                    </div>
                    <div class="flex-1">
                      <h5 class="mb-0 fs--1">Ricky Antony</h5>
                    </div>
                  </div>
                </a></td>
              <td class="email align-middle py-2"><a href="mailto:ricky@example.com">ricky@example.com</a></td>
              <td class="phone align-middle white-space-nowrap py-2"><a href="tel:2012001851">(201) 200-1851</a></td>
              <td class="address align-middle white-space-nowrap ps-5 py-2">2392 Main Avenue, Penasauka, New Jersey 02139</td>
              <td class="joined align-middle py-2">30/03/2018</td>
              <td class="align-middle white-space-nowrap py-2 text-end">
                <div class="dropdown font-sans-serif position-static"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="customer-dropdown-0" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                  <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-0">
                    <div class="py-2"><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a></div>
                  </div>
                </div>
              </td>
            </tr><tr class="btn-reveal-trigger">
              <td class="align-middle py-2" style="width: 28px;">
                <div class="form-check fs-0 mb-0 d-flex align-items-center"><input class="form-check-input" type="checkbox" id="customer-1" data-bulk-select-row="data-bulk-select-row"></div>
              </td>
              <td class="name align-middle white-space-nowrap py-2"><a href="customer-details.html">
                  <div class="d-flex d-flex align-items-center">
                    <div class="avatar avatar-xl me-2">
                      <img class="rounded-circle" src="../../assets/img/team/2.jpg" alt="">
                    </div>
                    <div class="flex-1">
                      <h5 class="mb-0 fs--1">Emma Watson</h5>
                    </div>
                  </div>
                </a></td>
              <td class="email align-middle py-2"><a href="mailto:emma@example.com">emma@example.com</a></td>
              <td class="phone align-middle white-space-nowrap py-2"><a href="tel:2122288403">(212) 228-8403</a></td>
              <td class="address align-middle white-space-nowrap ps-5 py-2">2289 5th Avenue, New York, New York, 10037</td>
              <td class="joined align-middle py-2">11/07/2017</td>
              <td class="align-middle white-space-nowrap py-2 text-end">
                <div class="dropdown font-sans-serif position-static"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="customer-dropdown-1" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                  <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-1">
                    <div class="py-2"><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a></div>
                  </div>
                </div>
              </td>
            </tr><tr class="btn-reveal-trigger">
              <td class="align-middle py-2" style="width: 28px;">
                <div class="form-check fs-0 mb-0 d-flex align-items-center"><input class="form-check-input" type="checkbox" id="customer-2" data-bulk-select-row="data-bulk-select-row"></div>
              </td>
              <td class="name align-middle white-space-nowrap py-2"><a href="customer-details.html">
                  <div class="d-flex d-flex align-items-center">
                    <div class="avatar avatar-xl me-2">
                      <div class="avatar-name rounded-circle"><span>RA</span></div>
                    </div>
                    <div class="flex-1">
                      <h5 class="mb-0 fs--1">Rowen Atkinson</h5>
                    </div>
                  </div>
                </a></td>
              <td class="email align-middle py-2"><a href="mailto:rown@example.com">rown@example.com</a></td>
              <td class="phone align-middle white-space-nowrap py-2"><a href="tel:2012001851">(201) 200-1851</a></td>
              <td class="address align-middle white-space-nowrap ps-5 py-2">112 Bostwick Avenue, Jersey City, New Jersey, 0730</td>
              <td class="joined align-middle py-2">05/04/2016</td>
              <td class="align-middle white-space-nowrap py-2 text-end">
                <div class="dropdown font-sans-serif position-static"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="customer-dropdown-2" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                  <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-2">
                    <div class="py-2"><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a></div>
                  </div>
                </div>
              </td>
            </tr><tr class="btn-reveal-trigger">
              <td class="align-middle py-2" style="width: 28px;">
                <div class="form-check fs-0 mb-0 d-flex align-items-center"><input class="form-check-input" type="checkbox" id="customer-3" data-bulk-select-row="data-bulk-select-row"></div>
              </td>
              <td class="name align-middle white-space-nowrap py-2"><a href="customer-details.html">
                  <div class="d-flex d-flex align-items-center">
                    <div class="avatar avatar-xl me-2">
                      <img class="rounded-circle" src="../../assets/img/team/2.jpg" alt="">
                    </div>
                    <div class="flex-1">
                      <h5 class="mb-0 fs--1">Antony Hopkins</h5>
                    </div>
                  </div>
                </a></td>
              <td class="email align-middle py-2"><a href="mailto:antony@example.com">antony@example.com</a></td>
              <td class="phone align-middle white-space-nowrap py-2"><a href="tel:9013243127">(901) 324-3127</a></td>
              <td class="address align-middle white-space-nowrap ps-5 py-2">3448 Ile De France St #242, Fort Wainwright, Alaska, 99703</td>
              <td class="joined align-middle py-2">05/04/2018</td>
              <td class="align-middle white-space-nowrap py-2 text-end">
                <div class="dropdown font-sans-serif position-static"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="customer-dropdown-3" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                  <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-3">
                    <div class="py-2"><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a></div>
                  </div>
                </div>
              </td>
            </tr><tr class="btn-reveal-trigger">
              <td class="align-middle py-2" style="width: 28px;">
                <div class="form-check fs-0 mb-0 d-flex align-items-center"><input class="form-check-input" type="checkbox" id="customer-4" data-bulk-select-row="data-bulk-select-row"></div>
              </td>
              <td class="name align-middle white-space-nowrap py-2"><a href="customer-details.html">
                  <div class="d-flex d-flex align-items-center">
                    <div class="avatar avatar-xl me-2">
                      <img class="rounded-circle" src="../../assets/img/team/3.jpg" alt="">
                    </div>
                    <div class="flex-1">
                      <h5 class="mb-0 fs--1">Jennifer Schramm</h5>
                    </div>
                  </div>
                </a></td>
              <td class="email align-middle py-2"><a href="mailto:jennifer@example.com">jennifer@example.com</a></td>
              <td class="phone align-middle white-space-nowrap py-2"><a href="tel:8283829631">(828) 382-9631</a></td>
              <td class="address align-middle white-space-nowrap ps-5 py-2">659 Hannah Street, Charlotte, NC 28273</td>
              <td class="joined align-middle py-2">17/03/2016</td>
              <td class="align-middle white-space-nowrap py-2 text-end">
                <div class="dropdown font-sans-serif position-static"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="customer-dropdown-4" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                  <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-4">
                    <div class="py-2"><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a></div>
                  </div>
                </div>
              </td>
            </tr><tr class="btn-reveal-trigger">
              <td class="align-middle py-2" style="width: 28px;">
                <div class="form-check fs-0 mb-0 d-flex align-items-center"><input class="form-check-input" type="checkbox" id="customer-5" data-bulk-select-row="data-bulk-select-row"></div>
              </td>
              <td class="name align-middle white-space-nowrap py-2"><a href="customer-details.html">
                  <div class="d-flex d-flex align-items-center">
                    <div class="avatar avatar-xl me-2">
                      <div class="avatar-name rounded-circle"><span>RM</span></div>
                    </div>
                    <div class="flex-1">
                      <h5 class="mb-0 fs--1">Raymond Mims</h5>
                    </div>
                  </div>
                </a></td>
              <td class="email align-middle py-2"><a href="mailto:raymond@example.com">raymond@example.com</a></td>
              <td class="phone align-middle white-space-nowrap py-2"><a href="tel:5624685646">(562) 468-5646</a></td>
              <td class="address align-middle white-space-nowrap ps-5 py-2">2298 Locust Court, Artesia, CA 90701</td>
              <td class="joined align-middle py-2">12/07/2014</td>
              <td class="align-middle white-space-nowrap py-2 text-end">
                <div class="dropdown font-sans-serif position-static"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="customer-dropdown-5" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                  <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-5">
                    <div class="py-2"><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a></div>
                  </div>
                </div>
              </td>
            </tr><tr class="btn-reveal-trigger">
              <td class="align-middle py-2" style="width: 28px;">
                <div class="form-check fs-0 mb-0 d-flex align-items-center"><input class="form-check-input" type="checkbox" id="customer-6" data-bulk-select-row="data-bulk-select-row"></div>
              </td>
              <td class="name align-middle white-space-nowrap py-2"><a href="customer-details.html">
                  <div class="d-flex d-flex align-items-center">
                    <div class="avatar avatar-xl me-2">
                      <img class="rounded-circle" src="../../assets/img/team/4.jpg" alt="">
                    </div>
                    <div class="flex-1">
                      <h5 class="mb-0 fs--1">Michael Jenkins</h5>
                    </div>
                  </div>
                </a></td>
              <td class="email align-middle py-2"><a href="mailto:jenkins@example.com">jenkins@example.com</a></td>
              <td class="phone align-middle white-space-nowrap py-2"><a href="tel:3026138829">(302) 613-8829</a></td>
              <td class="address align-middle white-space-nowrap ps-5 py-2">4678 Maud Street, Philadelphia, DE 19103</td>
              <td class="joined align-middle py-2">15/06/2014</td>
              <td class="align-middle white-space-nowrap py-2 text-end">
                <div class="dropdown font-sans-serif position-static"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="customer-dropdown-6" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                  <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-6">
                    <div class="py-2"><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a></div>
                  </div>
                </div>
              </td>
            </tr><tr class="btn-reveal-trigger">
              <td class="align-middle py-2" style="width: 28px;">
                <div class="form-check fs-0 mb-0 d-flex align-items-center"><input class="form-check-input" type="checkbox" id="customer-7" data-bulk-select-row="data-bulk-select-row"></div>
              </td>
              <td class="name align-middle white-space-nowrap py-2"><a href="customer-details.html">
                  <div class="d-flex d-flex align-items-center">
                    <div class="avatar avatar-xl me-2">
                      <img class="rounded-circle" src="../../assets/img/team/13.jpg" alt="">
                    </div>
                    <div class="flex-1">
                      <h5 class="mb-0 fs--1">Kristine Cadena</h5>
                    </div>
                  </div>
                </a></td>
              <td class="email align-middle py-2"><a href="mailto:cadena@example.com">cadena@example.com</a></td>
              <td class="phone align-middle white-space-nowrap py-2"><a href="tel:3172737814">(317) 273-7814</a></td>
              <td class="address align-middle white-space-nowrap ps-5 py-2">3412 Crestview Manor, Indianapolis, IN 46234</td>
              <td class="joined align-middle py-2">15/04/2015</td>
              <td class="align-middle white-space-nowrap py-2 text-end">
                <div class="dropdown font-sans-serif position-static"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="customer-dropdown-7" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                  <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-7">
                    <div class="py-2"><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a></div>
                  </div>
                </div>
              </td>
            </tr><tr class="btn-reveal-trigger">
              <td class="align-middle py-2" style="width: 28px;">
                <div class="form-check fs-0 mb-0 d-flex align-items-center"><input class="form-check-input" type="checkbox" id="customer-8" data-bulk-select-row="data-bulk-select-row"></div>
              </td>
              <td class="name align-middle white-space-nowrap py-2"><a href="customer-details.html">
                  <div class="d-flex d-flex align-items-center">
                    <div class="avatar avatar-xl me-2">
                      <div class="avatar-name rounded-circle"><span>SM</span></div>
                    </div>
                    <div class="flex-1">
                      <h5 class="mb-0 fs--1">Suzanne Martinez</h5>
                    </div>
                  </div>
                </a></td>
              <td class="email align-middle py-2"><a href="mailto:suzanne@example.com">suzanne@example.com</a></td>
              <td class="phone align-middle white-space-nowrap py-2"><a href="tel:2123449983">(212) 344-9983</a></td>
              <td class="address align-middle white-space-nowrap ps-5 py-2">4895 Farnum Road, New York, NY 10004</td>
              <td class="joined align-middle py-2">15/04/2016</td>
              <td class="align-middle white-space-nowrap py-2 text-end">
                <div class="dropdown font-sans-serif position-static"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="customer-dropdown-8" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                  <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-8">
                    <div class="py-2"><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a></div>
                  </div>
                </div>
              </td>
            </tr><tr class="btn-reveal-trigger">
              <td class="align-middle py-2" style="width: 28px;">
                <div class="form-check fs-0 mb-0 d-flex align-items-center"><input class="form-check-input" type="checkbox" id="customer-9" data-bulk-select-row="data-bulk-select-row"></div>
              </td>
              <td class="name align-middle white-space-nowrap py-2"><a href="customer-details.html">
                  <div class="d-flex d-flex align-items-center">
                    <div class="avatar avatar-xl me-2">
                      <div class="avatar-name rounded-circle"><span>MC</span></div>
                    </div>
                    <div class="flex-1">
                      <h5 class="mb-0 fs--1">Marie Cohen</h5>
                    </div>
                  </div>
                </a></td>
              <td class="email align-middle py-2"><a href="mailto:cohen@example.com">cohen@example.com</a></td>
              <td class="phone align-middle white-space-nowrap py-2"><a href="tel:4806103481">(480) 610-3481</a></td>
              <td class="address align-middle white-space-nowrap ps-5 py-2">3291 Hillside Street, Mesa, AZ 85201</td>
              <td class="joined align-middle py-2">25/08/2016</td>
              <td class="align-middle white-space-nowrap py-2 text-end">
                <div class="dropdown font-sans-serif position-static"><button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="customer-dropdown-9" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs--1"></span></button>
                  <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="customer-dropdown-9">
                    <div class="py-2"><a class="dropdown-item" href="#!">Edit</a><a class="dropdown-item text-danger" href="#!">Delete</a></div>
                  </div>
                </div>
              </td>
            </tr></tbody>
        </table>
      </div>
    </div>
    <div class="card-footer d-flex align-items-center justify-content-center"><button class="btn btn-sm btn-falcon-default me-1 disabled" type="button" title="Previous" data-list-pagination="prev" disabled=""><span class="fas fa-chevron-left"></span></button>
      <ul class="pagination mb-0"><li class="active"><button class="page" type="button" data-i="1" data-page="10">1</button></li><li><button class="page" type="button" data-i="2" data-page="10">2</button></li><li><button class="page" type="button" data-i="3" data-page="10">3</button></li></ul><button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next"><span class="fas fa-chevron-right"></span></button>
    </div>
  </div>
@endsection