<footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
      <div class="row text-center align-items-center flex-row-reverse">
        <div class="col-lg-auto ms-lg-auto">
          <ul class="list-inline list-inline-dots mb-0">
            <li class="list-inline-item"><a href="https://tabler.io/docs" target="_blank" class="link-secondary" rel="noopener">Documentation</a></li>
            <li class="list-inline-item"><a href="./license.html" class="link-secondary">License</a></li>
            <li class="list-inline-item"><a href="https://github.com/tabler/tabler" target="_blank" class="link-secondary" rel="noopener">Source code</a></li>
            <li class="list-inline-item">
              <a href="https://github.com/sponsors/codecalm" target="_blank" class="link-secondary" rel="noopener">
                <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-pink icon-filled icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                Sponsor
              </a>
            </li>
          </ul>
        </div>
        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
          <ul class="list-inline list-inline-dots mb-0">
            <li class="list-inline-item">
              Copyright &copy; 2023
              <a href="." class="link-secondary">Tabler</a>.
              All rights reserved.
            </li>
            <li class="list-inline-item">
              <a href="{{asset('demo')}}/./changelog.html" class="link-secondary" rel="noopener">
                v1.0.0-beta19
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
</div>
</div>
<div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Data Karyawan Baru</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="/addKaryawan" method="POST" enctype="multipart/form-data">
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
        <input name="NIP" value="{{ old('NIP') }}" class="form-control" name="example-text-input" placeholder="S1321006">
      </div>
      <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input name="nama" value="{{ old('nama') }}" type="text" class="form-control" name="example-text-input" placeholder="Nama Lengkap">
      </div>
      {{-- <label class="form-label">Report type</label>
      <div class="form-selectgroup-boxes row mb-3">
        <div class="col-lg-6">
          <label class="form-selectgroup-item">
            <input type="radio" name="report-type" value="1" class="form-selectgroup-input" checked>
            <span class="form-selectgroup-label d-flex align-items-center p-3">
              <span class="me-3">
                <span class="form-selectgroup-check"></span>
              </span>
              <span class="form-selectgroup-label-content">
                <span class="form-selectgroup-title strong mb-1">Simple</span>
                <span class="d-block text-muted">Provide only basic data needed for the report</span>
              </span>
            </span>
          </label>
        </div>
        <div class="col-lg-6">
          <label class="form-selectgroup-item">
            <input type="radio" name="report-type" value="1" class="form-selectgroup-input">
            <span class="form-selectgroup-label d-flex align-items-center p-3">
              <span class="me-3">
                <span class="form-selectgroup-check"></span>
              </span>
              <span class="form-selectgroup-label-content">
                <span class="form-selectgroup-title strong mb-1">Advanced</span>
                <span class="d-block text-muted">Insert charts and additional advanced analyses to be inserted in the report</span>
              </span>
            </span>
          </label>
        </div>
      </div> --}}
      <div class="row">
        <div class="col-lg-8">
          <div class="mb-3">
            <label class="form-label">Nomor Telpon</label>
            <div class="input-group input-group-flat">
              <span class="input-group-text">
              </span>
              <input value="{{old('nomor_hp')}}" name="nomor_hp" type="number" placeholder="+62 8782-2231-232" class="form-control ps-0" autocomplete="off">
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <select value="{{old('jabatan')}}" name="jabatan" class="form-select">
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
            <input value="{{old('email')}}" name="email" type="text" placeholder="adminportal@gmail.com" class="form-control">
          </div>
        </div>
        {{-- <div class="col-lg-6">
          <div class="mb-3">
            <label class="form-label">Reporting period</label>
            <input type="date" class="form-control">
          </div>
        </div>
        <div class="col-lg-12">
          <div>
            <label class="form-label">Additional information</label>
            <textarea class="form-control" rows="3"></textarea>
          </div>
        </div> --}}
      </div>
    </div>
    <div class="modal-footer">
      <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
        Cancel
      </a>
      <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
        Tambah Data Karyawan
      </button>
    </div>
  </form>
  </div>
</div>
</div>

{{-- Logic agar ketika pesan diterima, modal tetap tampil --}}
<script>
  @if ($errors->any())
      document.addEventListener('DOMContentLoaded', function () {
          var modal = new bootstrap.Modal(document.getElementById('modal-report'));
          modal.show();
      });
  @endif
</script>
