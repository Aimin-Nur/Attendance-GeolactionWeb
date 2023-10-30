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
          {{-- Notifikasi add karyawan berhasil --}}
          <?php
          $sukses = Session::get('success');
          if ($sukses) {
              echo '<div class="alert alert-success">' . $sukses . '</div>';
          }
          ?>
           <?php
           $sukses = Session::get('edit');
           if ($sukses) {
               echo '<div class="alert alert-info">' . $sukses . '</div>';
           }
           ?>
          <div class="col-12">
            <div class="card">
              <div class="table-responsive">
                <table
    class="table table-vcenter table-mobile-md card-table">
                  <thead>
                    <tr>
                      <th>Nama Karyawan</th>
                      <th>Jabatan & Nip</th>
                      <th>Alamat Email</th>
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
                            <div class="text-muted"><a href="#" class="text-reset">{{$karyawan->no_hp}}</a></div>
                          </div>
                        </div>
                      </td>
                      <td data-label="Title" >
                        <div>{{$karyawan->jabatan}}</div>
                        <div class="text-muted">{{$karyawan->NIP}}</div>
                      </td>
                      <td class="text-muted" data-label="Role" >
                        {{$karyawan->email}}
                      </td>
                      <td>
                        <div class="btn-list flex-nowrap">
                          <a href="#" data-bs-toggle="modal" data-bs-target="#modal-edit{{$karyawan->NIP}}" class="btn">
                            Edit
                          </a>
                          <a href="#" data-bs-toggle="modal" data-bs-target="#modal-hapus{{$karyawan->NIP}}" class="btn btn-danger">
                            Delete
                          </a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

{{-- Modal Edit data --}}
@foreach ($dataKaryawan as $karyawan )
<div class="modal modal-blur fade" id="modal-edit{{$karyawan->NIP}}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data Karyawan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/editKaryawan/{{$karyawan->NIP}}" method="POST" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">
        @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
        @endif
        <div class="mb-3">
          <label class="form-label">Nomor Induk Pegawai</label>
          <input name="NIP" value="{{ $karyawan->NIP }}" class="form-control" placeholder="S1321006" readonly>
          <small class="ms-1 mt-2 markdown text-muted">
            Nomor Induk Pegawai tidak dapat di edit.
          </small>
        </div>
        <div class="mb-3">
          <label class="form-label">Nama Lengkap</label>
          <input name="nama" value="{{ $karyawan->nama_lengkap }}" type="text" class="form-control" placeholder="Nama Lengkap">
        </div>
        <div class="row">
          <div class="col-lg-8">
            <div class="mb-3">
              <label class="form-label">Nomor Telpon</label>
              <div class="input-group input-group-flat">
                <span class="input-group-text">
                </span>
                <input value="{{$karyawan->no_hp}}" name="nomor_hp" type="number" placeholder="+62 8782-2231-232" class="form-control ps-0" autocomplete="off">
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="mb-3">
              <label class="form-label">Jabatan</label>
              <select value="{{$karyawan->jabatan}}" name="jabatan" class="form-select">
                <option value="Human Resource" selected>HR</option>
                <option value="Arsitek">Arsitek</option>
                <option value="Karyawan">Karyawan</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="mb-3">
              <label class="form-label">Alamat Email</label>
              <input value="{{$karyawan->email}}" name="email" type="text" placeholder="adminportal@gmail.com" class="form-control">
            </div>
          </div>
        </div>
        <small class="markdown text-muted">
          Password akun karyawan akan secara otomatis menjadi "portal".
          Hanya karyawan yang bersangkutan yang dapat melakukan perubahan kata sandi.
        </small>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
          Cancel
        </a>
        <button type="submit" class="btn btn-info ms-auto" data-bs-dismiss="modal">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
          Edit Data Karyawan
        </button>
      </div>
    </form>
    </div>
  </div>
  </div>
  @endforeach


@include('admin.layouts.footer')
@include('admin.layouts.script')