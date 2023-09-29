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
            </div>
        </div>

        <div class="section" id="menu-section">
            <div class="card">
                <div class="card-body text-center">
                    <div class="list-menu">
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
                    </div>
                </div>
            </div>
        </div>
        <div class="section mt-2" id="presence-section">
            <div class="todaypresence">
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
                                <ion-icon name="newspaper-outline" style="font-size:1.6rem;" class="text-success"></ion-icon>
                                <br>
                                <span style="font-size:0.9rem; font-weight:500">Izin</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 16px 12px !impoertant">
                                <ion-icon name="medkit-outline" style="font-size:1.6rem;" class="text-warning"></ion-icon>
                                <br>
                                <span style="font-size:0.9rem; font-weight:500">Sakit</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 16px 12px !impoertant">
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
                                Bulan Ini
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                                Leaderboard
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content mt-2" style="margin-bottom:100px;">
                    <div class="tab-pane fade show active" id="home" role="tabpanel">
                        <ul class="listview image-listview">
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="image-outline" role="img" class="md hydrated"
                                            aria-label="image outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        <div>Photos</div>
                                        <span class="badge badge-danger">10</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-secondary">
                                        <ion-icon name="videocam-outline" role="img" class="md hydrated"
                                            aria-label="videocam outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        <div>Videos</div>
                                        <span class="text-muted">None</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-danger">
                                        <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                            aria-label="musical notes outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        <div>Music</div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-danger">
                                        <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                            aria-label="musical notes outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        <div>Music</div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-danger">
                                        <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                            aria-label="musical notes outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        <div>Music</div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-danger">
                                        <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                            aria-label="musical notes outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        <div>Music</div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-danger">
                                        <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                            aria-label="musical notes outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        <div>Music</div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-danger">
                                        <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                            aria-label="musical notes outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        <div>Music</div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-danger">
                                        <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                            aria-label="musical notes outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        <div>Music</div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-danger">
                                        <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                            aria-label="musical notes outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        <div>Music</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel">
                        <ul class="listview image-listview">
                            <li>
                                <div class="item">
                                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                    <div class="in">
                                        <div>Edward Lindgren</div>
                                        <span class="text-muted">Designer</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item">
                                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                    <div class="in">
                                        <div>Emelda Scandroot</div>
                                        <span class="badge badge-primary">3</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item">
                                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                    <div class="in">
                                        <div>Henry Bove</div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item">
                                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                    <div class="in">
                                        <div>Henry Bove</div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item">
                                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                    <div class="in">
                                        <div>Henry Bove</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection