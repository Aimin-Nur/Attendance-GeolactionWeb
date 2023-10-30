<footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
      <div class="row text-center align-items-center flex-row-reverse">
        <div class="col-lg-auto ms-lg-auto">
          <ul class="list-inline list-inline-dots mb-0">
            <li class="list-inline-item"><a href="/dashboardAdmin" target="_blank" class="link-secondary" rel="noopener">Home</a></li>
            <li class="list-inline-item"><a href="/dataKaryawan" class="link-secondary">Data Karyawan</a></li>
            <li class="list-inline-item"><a href="/" target="_blank" class="link-secondary" rel="noopener">Logout</a></li>
            <li class="list-inline-item">
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
        <input name="NIP" value="{{ old('NIP') }}" class="form-control" placeholder="S1321006">
      </div>
      <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input name="nama" value="{{ old('nama') }}" type="text" class="form-control" placeholder="Nama Lengkap">
      </div>
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
            <input name="password" value="$2y$10$LjgOlEWekYTfTR1miZDN9OPWTtA6PA/4Q48Vn0JQVN8ofx7X7z02e" type="hidden" class="form-control">
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
      <small class="markdown text-muted">
        Password akun karyawan akan secara otomatis menjadi "portal".
        Hanya karyawan yang bersangkutan yang dapat melakukan perubahan kata sandi.
      </small>
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
