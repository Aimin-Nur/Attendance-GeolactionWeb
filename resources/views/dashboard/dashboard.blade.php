@extends('layouts.absen')
@section('content')
<div id="appCapsule">
        <div class="section" id="user-section">
            <div id="user-detail">
                <div class="avatar">
                    @if(!empty(Auth::guard('karyawan')->user()->foto))
                    @php
                        $path = Storage::url('uploads/karyawan/' .Auth::guard('karyawan')->user()->foto);
                    @endphp
                    <img src="{{url($path)}}" alt="avatar" class="imaged w64 rounded">
                    @else
                    <img src="{{asset('assets/img/sample/avatar/avatar1.jpg')}}" alt="avatar" class="imaged w64 rounded">
                    @endif
                </div>
                <div id="user-info">
                    <h2 id="user-name">{{$karyawan->nama_lengkap}}</h2>
                    <span id="user-role">{{$karyawan->jabatan}}</span>
                </div>
                <div id="user-info">
                   <a href="/LogoutKaryawan"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="55" height="55" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" /><path d="M9 12h12l-3 -3" /><path d="M18 15l3 -3" /></svg></a>
                </div>
            </div>
        </div>

        <div class="section" id="menu-section">
            <div class="card">
                <div class="card-body text-center">
                    <div class="row">
                        <div class="container">
                            <div class="col-12">
                                <h2>Hi, Selamat Datang</h2>
                            </div>
                            <div class="col-12">
                                <h6>Pastikan Anda melakukan absensi sebelum pukul 09:00.</h6>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="list-menu">
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="/editProfile" class="green" style="font-size: 40px;">
                                    <ion-icon name="person-sharp"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Profil</span>
                            </div>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="" class="danger" style="font-size: 40px;">
                                    <ion-icon name="calendar-number"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Cuti</span>
                            </div>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="" class="warning" style="font-size: 40px;">
                                    <ion-icon name="document-text"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Histori</span>
                            </div>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="" class="orange" style="font-size: 40px;">
                                    <ion-icon name="location"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                Lokasi
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="section mt-2" id="presence-section">
            <div class="todaypresence">
                <h4 style="margin-top: 90px">Absensi Hari ini {{ $dayName}}, {{date('d-m-Y')}}</h4>
                <div class="row">
                    <div class="col-6">
                        <div class="card gradasigreen">
                            <div class="card-body">
                                <div class="presencecontent">
                                    <div class="iconpresence">
                                        <ion-icon name="camera"></ion-icon>
                                    </div>
                                    <div class="presencedetail">
                                        <h4 class="presencetitle">Masuk</h4>
                                        <span>{{ $presensiToday != null ? $presensiToday->jam_in : 'Belum Absen'}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card gradasired">
                            <div class="card-body">
                                <div class="presencecontent">
                                    <div class="iconpresence">
                                        <ion-icon name="camera"></ion-icon>
                                    </div>
                                    <div class="presencedetail">
                                        <h4 class="presencetitle">Pulang</h4>
                                        <span>{{ $presensiToday != null && $presensiToday->jam_out != null ? $presensiToday->jam_out : 'Belum Absen'}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="rekapAbsensi">
                <h4>Rekap Absensi Bulan {{ $namaBulan[$bulanini]}} {{$tahunini}}</h4>
                <div class="row">
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 16px 12px !impoertant">
                                <span class="badge bg-danger" style="position:absolute; top:5px; right:10px; font-size:0.6rem; 
                                z-index:999">{{ $rekapPresensi->jml_hadir }}</span>
                                <ion-icon name="body-outline" style="font-size:1.6rem;" class="text-primary"></ion-icon>
                                <br>
                                <span style="font-size:0.9rem; font-weight:500">Hadir</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 16px 12px !impoertant">
                                <span class="badge bg-danger" style="position:absolute; top:5px; right:10px; font-size:0.6rem; 
                                z-index:999">{{ $rekapIzin->jmlhIzin }}</span>
                                <ion-icon name="newspaper-outline" style="font-size:1.6rem;" class="text-success"></ion-icon>
                                <br>
                                <span style="font-size:0.9rem; font-weight:500">Izin</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 16px 12px !impoertant">
                                <span class="badge bg-danger" style="position:absolute; top:5px; right:10px; font-size:0.6rem; 
                                z-index:999">{{ $rekapIzin->jmlhSakit }}</span>
                                <ion-icon name="medkit-outline" style="font-size:1.6rem;" class="text-warning"></ion-icon>
                                <br>
                                <span style="font-size:0.9rem; font-weight:500">Sakit</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 16px 12px !impoertant">
                                <span class="badge bg-danger" style="position:absolute; top:5px; right:10px; font-size:0.6rem; 
                                z-index:999">{{ $telat->jml_telat }}</span>
                                <ion-icon name="timer-outline" style="font-size:1.6rem;" class="text-danger"></ion-icon>
                                <br>
                                <span style="font-size:0.9rem; font-weight:500">Telat</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="presencetab mt-2">
                <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                    <ul class="nav nav-tabs style1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                                Absensi Hari ini
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                                Absensi Bulan ini
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content mt-2" style="margin-bottom:100px;">
                    <div class="tab-pane fade show active" id="home" role="tabpanel">
                        <ul class="listview image-listview">
                            @if ($historyKedatanganHarian != NULL)
                            @foreach ($historyKedatanganHarian as $datang )
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="archive-outline" role="img" class="md hydrated"
                                            aria-label="archive outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        <div>
                                            <b>Berhasil Absen Datang {{$datang->jam_in}}</b><br>
                                            <small class="text-muted">{{$datang->tgl_absen}}</small>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach 
                            @endif
                            @if ($historyKepulanganHarian != NULL)
                            @foreach ($historyKepulanganHarian as $pulang )
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-secondary">
                                        <ion-icon name="arrow-undo-circle-outline" role="img" class="md hydrated"
                                            aria-label="arrow-undo-circle-outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        <div>
                                            <b>Berhasil Absen Pulang {{$pulang->jam_out}}</b><br>
                                            <small class="text-muted">{{$pulang->tgl_absen}}</small>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach 
                            @endif
                           @if ($cekAbsenToday == 0)
                           <li>
                                <div class="item">
                                    <div class="in">
                                        <div>
                                            <b class="text-center" style="margin-left:70px">Anda Belum Absen Hari ini</b><br>
                                        </div>
                                    </div>
                                </div>
                            </li>  
                           @endif 
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel">
                        <ul class="listview image-listview">
                            @if ($historyBulaiIni != NULL)
                            @foreach ($historyBulaiIni as $bulan )
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-secondary">
                                        <ion-icon name="clipboard-outline" role="img" class="md hydrated"
                                            aria-label="clipboard outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        <div>
                                            <b>Absensi {{$bulan->tgl_absen}} </b><br>
                                            <small class="text-muted">Jam Absen Masuk : {{$bulan->jam_in}}</small> <br>
                                            <small class="text-muted">Jam Absen Pulang : {{$bulan->jam_out}}</small>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach 
                            @endif
                            @if ($cekHistoryBulaiIni == 0)
                            <li>
                                <div class="item">
                                    <div class="in">
                                        <div>
                                            <b style="margin-left:40px">Anda Belum Absen Selama Bulan ini </b><br>
                                            <small class="text-muted"></small>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection