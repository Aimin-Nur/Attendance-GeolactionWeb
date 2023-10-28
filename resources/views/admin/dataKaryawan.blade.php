@include('admin.layouts.header')
<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
      <div class="container-xl">
        <div class="row g-2 align-items-center">
          <div class="col">
            <h2 class="page-title">
              Data Karyawan
            </h2>
          </div>
          <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
              <span class="d-none d-sm-inline">
                <a href="#" class="btn">
                  New view
                </a>
              </span>
              <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                Tambah Karyawan
              </a>
              <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
      <div class="container-xl">
          <div class="col-12">
            <div class="card">
              <div class="table-responsive">
                <table
    class="table table-vcenter table-mobile-md card-table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Title</th>
                      <th>Role</th>
                      <th class="w-1"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($dataKaryawan as $karyawan )
                    <tr>
                      <td data-label="Name" >
                        <div class="d-flex py-1 align-items-center">
                            @if(!empty(Auth::guard('admin')->user()->foto))
                            @php
                                $path = Storage::url('uploads/karyawan/' .Auth::guard('admin')->user()->foto);
                            @endphp
                            <img src="{{url($path)}}" alt="avatar" class="avatar me-2">
                            @else
                            <img src="{{asset('assets/img/sample/avatar/avatar1.jpg')}}" alt="avatar" class="avatar me-2">
                            @endif
                          <div class="flex-fill">
                            <div class="font-weight-medium">{{$karyawan->nama_lengkap}}</div>
                            <div class="text-muted"><a href="#" class="text-reset">t{{$karyawan->no_hp}}</a></div>
                          </div>
                        </div>
                      </td>
                      <td data-label="Title" >
                        <div>{{$karyawan->jabatan}}</div>
                        <div class="text-muted">{{$karyawan->NIP}}</div>
                      </td>
                      <td class="text-muted" data-label="Role" >
                        User
                      </td>
                      <td>
                        <div class="btn-list flex-nowrap">
                          <a href="#" class="btn">
                            Edit
                          </a>
                          <div class="dropdown">
                            <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                              Actions
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                              <a class="dropdown-item" href="#">
                                Action
                              </a>
                              <a class="dropdown-item" href="#">
                                Another action
                              </a>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                    <tr>
                      <td data-label="Name" >
                        <div class="d-flex py-1 align-items-center">
                          <span class="avatar me-2" style="background-image: url(./static/avatars/005f.jpg)"></span>
                          <div class="flex-fill">
                            <div class="font-weight-medium">Dyann Escala</div>
                            <div class="text-muted"><a href="#" class="text-reset">descalag@usatoday.com</a></div>
                          </div>
                        </div>
                      </td>
                      <td data-label="Title" >
                        <div>Mechanical Systems Engineer</div>
                        <div class="text-muted">Sales</div>
                      </td>
                      <td class="text-muted" data-label="Role" >
                        Admin
                      </td>
                      <td>
                        <div class="btn-list flex-nowrap">
                          <a href="#" class="btn">
                            Edit
                          </a>
                          <div class="dropdown">
                            <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                              Actions
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                              <a class="dropdown-item" href="#">
                                Action
                              </a>
                              <a class="dropdown-item" href="#">
                                Another action
                              </a>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td data-label="Name" >
                        <div class="d-flex py-1 align-items-center">
                          <span class="avatar me-2" style="background-image: url(./static/avatars/006f.jpg)"></span>
                          <div class="flex-fill">
                            <div class="font-weight-medium">Avivah Mugleston</div>
                            <div class="text-muted"><a href="#" class="text-reset">amuglestonh@intel.com</a></div>
                          </div>
                        </div>
                      </td>
                      <td data-label="Title" >
                        <div>Actuary</div>
                        <div class="text-muted">Sales</div>
                      </td>
                      <td class="text-muted" data-label="Role" >
                        User
                      </td>
                      <td>
                        <div class="btn-list flex-nowrap">
                          <a href="#" class="btn">
                            Edit
                          </a>
                          <div class="dropdown">
                            <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                              Actions
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                              <a class="dropdown-item" href="#">
                                Action
                              </a>
                              <a class="dropdown-item" href="#">
                                Another action
                              </a>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td data-label="Name" >
                        <div class="d-flex py-1 align-items-center">
                          <span class="avatar me-2">AA</span>
                          <div class="flex-fill">
                            <div class="font-weight-medium">Arlie Armstead</div>
                            <div class="text-muted"><a href="#" class="text-reset">aarmsteadi@yellowpages.com</a></div>
                          </div>
                        </div>
                      </td>
                      <td data-label="Title" >
                        <div>VP Quality Control</div>
                        <div class="text-muted">Accounting</div>
                      </td>
                      <td class="text-muted" data-label="Role" >
                        Owner
                      </td>
                      <td>
                        <div class="btn-list flex-nowrap">
                          <a href="#" class="btn">
                            Edit
                          </a>
                          <div class="dropdown">
                            <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                              Actions
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                              <a class="dropdown-item" href="#">
                                Action
                              </a>
                              <a class="dropdown-item" href="#">
                                Another action
                              </a>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td data-label="Name" >
                        <div class="d-flex py-1 align-items-center">
                          <span class="avatar me-2" style="background-image: url(./static/avatars/008f.jpg)"></span>
                          <div class="flex-fill">
                            <div class="font-weight-medium">Tessie Curzon</div>
                            <div class="text-muted"><a href="#" class="text-reset">tcurzonj@hp.com</a></div>
                          </div>
                        </div>
                      </td>
                      <td data-label="Title" >
                        <div>Research Nurse</div>
                        <div class="text-muted">Product Management</div>
                      </td>
                      <td class="text-muted" data-label="Role" >
                        Admin
                      </td>
                      <td>
                        <div class="btn-list flex-nowrap">
                          <a href="#" class="btn">
                            Edit
                          </a>
                          <div class="dropdown">
                            <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                              Actions
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                              <a class="dropdown-item" href="#">
                                Action
                              </a>
                              <a class="dropdown-item" href="#">
                                Another action
                              </a>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@include('admin.layouts.footer')
@include('admin.layouts.script')