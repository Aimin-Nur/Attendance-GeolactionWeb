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
            <?php
            $sukses = Session::get('delete');
            if ($sukses) {
                echo '<div class="alert alert-danger">' . $sukses . '</div>';
            }
            ?>
          <div class="col-12">
            <form action="/dataKaryawan" methof="GET">
              @csrf
            <div class="card">
              <div class="card-body">
                <div class="row me-auto">
                  <div class="col-4">
                    <div class="form-group">
                      <input type="text" name="nama_karyawan" id="nama_karyawan" placeholder="Nama Karyawan" class="form-control">
                    </div>
                  </div>
                  <div class="col-2">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h1.5" /><path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M20.2 20.2l1.8 1.8" /></svg> Cari Karyawan
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
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
                          <a href="#" data-bs-toggle="modal" data-bs-target="#modal-danger{{$karyawan->NIP}}" class="btn btn-danger">
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
        <button type="button" class="btn-close" aria-label="Close"></button>
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


  {{-- Modal Hapus Data Karyawan --}}
  @foreach ($dataKaryawan as $karyawan )
  <div class="modal modal-blur fade" id="modal-danger{{$karyawan->NIP}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-status bg-danger"></div>
        <form action="/deleteKaryawan/{{$karyawan->NIP}}" method="POST" enctype="multipart/form-data">
          @csrf
        <div class="modal-body text-center py-4">
          <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" /><path d="M12 9v4" /><path d="M12 17h.01" /></svg>
          <h3>Apakah Anda Yakin?</h3>
          <div class="text-muted">Tindakan ini akan menghapus data karyawan atas nama <b>{{$karyawan->nama_lengkap}}</b>, penghapusan data ini akan bersifat permanen.</div>
        </div>
        <div class="modal-footer">
          <div class="w-100">
            <div class="row">
              <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                  Cancel
                </a></div>
              <div class="col"><button type="submit" href="#" class="btn btn-danger w-100" data-bs-dismiss="modal">
                  Ya, Saya Yakin
                </button></div>
            </div>
          </div>
        </div>
      </div>
    </form>
    </div>
  </div>
  @endforeach


@include('admin.layouts.footer')
@include('admin.layouts.script')