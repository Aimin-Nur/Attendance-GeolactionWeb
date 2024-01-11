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
                                        <tr class="text-center">
                                            <th>NO</th>
                                            <th>NIP</th>
                                            <th>Nama Karyawan</th>
                                            <th>Jabatan</th>
                                            <th>Jam Masuk</th>
                                            <th>Lokasi Masuk</th>
                                            <th>Jam Pulang</th>
                                            <th>Lokasi Pulang</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>

                                    <tbody id="loadpresensi" class="text-center">
            
                                            @foreach ($presensi as $item)
                                    
                                            @php
                                                $foto_in = Storage::url('uploads/absensi/'.$item->foto_in);
                                                $foto_out = Storage::url('uploads/absensi/'.$item->foto_out);
                                            @endphp
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->NIP }}</td>
                                                <td>{{ $item->nama_lengkap }}</td>
                                                <td>{{ $item->jabatan}}</td>
                                                <td>{{ $item->jam_in}}</td>
                                                <td>{{ $item->location}}</td>
                                                {{-- <td><img src="{{ url($foto_in) }}" class="avatar" alt=""></td> --}}
                                                <td>{{ $item->jam_out}}</td>
                                                {{-- <td><img src="{{ url($foto_out) }}" class="avatar" alt=""></td> --}}
                                                <td>{{ $item->location_out}}</td>
                                                <td>  <a href="#" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#modal-large{{$item->id}}">
                                                    Selegkapnya
                                                  </a></td>
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
    </div>
</div>


{{-- Modal Detail --}}
@foreach ($presensi as $item)
<div class="modal modal-blur fade" id="modal-large{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <script  src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin="">
          </script>

          <h5 class="modal-title">Detail Absensi <b>{{$item->nama_lengkap}}</b> ->
            @if ($item->status == 'Tepat Waktu')
                <span class="badge bg-lime-lt">Tepat Waktu</span>
            @elseif ($item->status == 'Terlambat')
                <span class="badge bg-red-lt">Terlambat {{$item->keterlambatan}} Menit</span>
            @endif
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         <div class="container">
            <div class="row">
                <div class="col-lg-12">
                  <div id="map"></div>
                    <div class="card">
                      <div class="row row-0">
                        <div class="col-3 order-md-last">
                          <!-- Photo -->
                        
                         <img src="{{ url('storage/foto-absensi/' . $item->foto_in) }}" class="w-100 h-100 object-cover card-img-end" alt="Foto Absen Masuk"/>
                        </div>
                        <div class="col">
                          <div class="card-body">
                            <h3 class="card-title">Jam Masuk : {{$item->jam_in}}</h3>
                            <h3 class="card-title">Lokasi Absen Masuk : <a href="https://www.google.com/search?q={{$item->location}}" target=_blank> Lihat Disini</a> </h3>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-5">
                  <div id="mapPulang"></div>
                    <div class="card">
                      <div class="row row-0">
                        <div class="col-3 order-md-last">
                          <!-- Photo -->
                          <img src="{{ url('storage/foto-absensi/' . $item->foto_out) }}" class="w-100 h-100 object-cover card-img-end" alt="Foto Absen Pulang"/>
                        </div>
                        <div class="col">

                          <div class="card-body">
                           
                            <h3 class="card-title">Jam Pulang : {{$item->jam_out}}</h3>
                            <h3 class="card-title">Lokasi Absen Pulang : <a href="https://www.google.com/search?q={{$item->location_out}}" target=_blank> Lihat Disini</a> </h3>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    @php
                      $totalJam = DB::table('absen')->where('id', $item->id)
                                ->sum(DB::raw('TIME_TO_SEC(TIMEDIFF(jam_out, jam_in)) / 60'));
                    @endphp
                    <p class="text-center text-muted mt-4">Karyawan berada di tempat kerja selama <b>{{number_format($totalJam)}}</b> Menit</p>
                  </div>
            </div>
         </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>

<script>
    var lokasi = "{{$item->location}}";
    var lok = lokasi.split(",");
    var latitude = lok[0];
    var longitude = lok[1];
    var map = L.map('map').setView([latitude, longitude], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  }).addTo(map);
  var marker = L.marker([latitude, longitude]).addTo(map);
  </script>
  
  
  <script>
    var lokasiPulang = "{{$item->location_out}}";
    var lokPulang = lokasiPulang.split(",");
    var latitudePulang = lokPulang[0];  // Perbaikan: Gunakan lokPulang bukan lok
    var longitudePulang = lokPulang[1]; // Perbaikan: Gunakan lokPulang bukan lok
    var mapPulang = L.map('mapPulang').setView([latitudePulang, longitudePulang], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(mapPulang);
    var markerPulang = L.marker([latitudePulang, longitudePulang]).addTo(mapPulang);
  </script>

@endforeach

<style>
  #map { height: 180px; }
  #mapPulang { height: 180px; }
</style>


@include('admin.layouts.footer')
@include('admin.layouts.script')