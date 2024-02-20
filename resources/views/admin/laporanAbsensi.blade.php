@include('admin.layouts.header')


<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
      <div class="container-xl">
        <div class="row g-2 align-items-center">
          <div class="col">
            <h2 class="page-title">
              Laporan Absensi Karyawan
            </h2>
          </div>
          <div class="col-auto ms-auto d-print-none">
          </div>
        </div>
      </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="card-title">Laporan Absensi Setiap Karyawan</h3>
                                </div>
                                <div class="col-12">
                                    <p class="card-subtitle">Laporan Absensi ini menampilkan rangkuman/summary dari setiap karyawan yang Anda pilih dalam periode 1 bulan.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('cetak.laporan')}}" target="_blank" method="POST">
                                @csrf
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select name="bulan" id="bulan" class="form-select">
                                                <option value="">Bulan</option>
                                                @for($i=1; $i < 13; $i++) <option value="{{ $i }}" {{date("m") == $i ? 'selected' : ''}}>{{$namaBulan[$i]}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select name="tahun" id="tahun" class="form-select">
                                                <option value="">Tahun</option>
                                                @php
                                                    $tahunMulai = 2022;
                                                    $tahunSkrng = date("Y");
                                                @endphp
                                                @for (
                                                    $tahun=$tahunMulai; $tahun <= $tahunSkrng; $tahun++
                                                ) <option value="{{$tahun}}" {{date("Y") == $tahun ? 'selected' : '' }}>{{$tahun}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select name="nip" id="nip" class="form-select" required>
                                                <option value="">Pilih Karyawan</option>
                                                @foreach ($karyawan as $pegawai )
                                                    <option value="{{$pegawai->NIP}}">{{$pegawai->nama_lengkap}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" name="cetak" id="btnCetakLaporan" class="btn btn-primary w-100"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /></svg>
                                                Cetak Laporan</button>
                                        </div>
                                    </div>
                                    {{-- <div class="col-6">
                                        <div class="form-group">
                                            <button type="submit" name="cetak" class="btn btn-success w-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 11l5 5l5 -5" /><path d="M12 4l0 12" /></svg>
                                                Export Excel</button>
                                        </div>
                                    </div> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="card-title">Rekap Seluruh Absen Karyawan</h3>
                                </div>
                                <div class="col-12">
                                    <p class="card-subtitle">Laporan Absensi ini menampilkan menampilkan seluruh data absensi karyawan dalam periode 1 bulan.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('cetak.rekapan')}}" target="_blank" method="POST">
                                @csrf
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select name="bulan" id="bulan" class="form-select">
                                                <option value="">Bulan</option>
                                                @for($i=1; $i < 13; $i++) <option value="{{ $i }}" {{date("m") == $i ? 'selected' : ''}}>{{$namaBulan[$i]}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <select name="tahun" id="tahun" class="form-select">
                                                <option value="">Tahun</option>
                                                @php
                                                    $tahunMulai = 2022;
                                                    $tahunSkrng = date("Y");
                                                @endphp
                                                @for (
                                                    $tahun=$tahunMulai; $tahun <= $tahunSkrng; $tahun++
                                                ) <option value="{{$tahun}}" {{date("Y") == $tahun ? 'selected' : '' }}>{{$tahun}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" name="test" id="btnCetakLaporan" class="btn btn-success w-100"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /></svg>
                                                Cetak Rekapan </button>
                                        </div>
                                    </div>
                                    {{-- <div class="col-6">
                                        <div class="form-group">
                                            <button type="submit" name="cetak" class="btn btn-success w-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 11l5 5l5 -5" /><path d="M12 4l0 12" /></svg>
                                                Export Excel</button>
                                        </div>
                                    </div> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    



@include('admin.layouts.footer')
@include('admin.layouts.script')