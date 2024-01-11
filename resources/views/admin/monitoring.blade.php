@include('admin.layouts.header')

<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
      <div class="container-xl">
        <div class="row g-2 align-items-center">
          <div class="col">
            <h2 class="page-title">
              Monitoring Absensi Karyawan
            </h2>
          </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-11">
                                <div class="input-icon mb-3">
                                    <form action="/getMonitoring/absen" method="POST">
                                        @csrf
                                        <span class="input-icon-addon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="28" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h2v2h-2z" /></svg>
                                        </span>
                                        <input type="date" name="search" id="tanggal" value="" class="form-control" placeholder="Tanggal Absesni">
                                   
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="input-group">
                                    <button type="submit" class="btn btn-outline-info">
                                       Cari
                                    </button>
                                </div>
                            </div>
                        </form>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NIP</th>
                                            <th>Nama Karyawan</th>
                                            <th>Jabatan</th>
                                            <th>Jam Masuk</th>
                                            <th>Foto</th>
                                            <th>Jam Pulang</th>
                                            <th>Foto</th>
                                            <th>Lokasi</th>
                                        </tr>
                                    </thead>
                                </table>
                                <p class="text-muted text-center">Silahkan Masukkan tanggal absensi yang akan Anda lihat.</p>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@include('admin.layouts.footer')
@include('admin.layouts.script')