@extends('layouts.absen')
@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="/dashboard" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
    <div class="pageTitle">Absensi</div>
    <div class="right"></div>
</div>
    <!-- * App Header -->
@endsection

<style>
    .webcam,
    .webcam video{
        display : inline-block;
        width : 100% !important;
        margin : auto;
        height : auto !important;
        border-radius : 15px;
    }
    #map { height: 180px; }
</style>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
crossorigin=""/>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="sweetalert2.all.min.js"></script>
<script src="sweetalert2.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
crossorigin=""></script>
<link rel="stylesheet" href="sweetalert2.min.css">

@section('content')
<div class="row" style="margin-top:70px">
    <div class="col">
        <input type="hidden" id="lokasi">
        <div class="webcam"></div>
    </div>
</div>
<div class="row">
    <div class="col">
        @if ($cek > 0)
            <button id="takeabsen" style="margin-top: 10px" class="btn btn-danger btn-block">
                <ion-icon name="camera-outline"></ion-icon>
                Absen pulang
            </button>    
        @else
            <button id="takeabsen" style="margin-top: 10px" class="btn btn-primary btn-block">
                <ion-icon name="camera-outline"></ion-icon>
                Absen masuk
            </button>   
        @endif
    </div>
</div>

<div class="row mt-2">
    <div class="col">
        <div id="map"></div>
    </div>
</div>
@endsection

@push('webscript')
<script>
    Webcam.set({
        height : 480,
        width : 640,
        image_format : 'jpeg',
        jpeg_quality : 80
    });

    Webcam.attach('.webcam')

    var lokasi = document.getElementById('lokasi');
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(successCallback, errorsCallback);
    }

    function successCallback(position){
        lokasi.value = position.coords.latitude+","+position.coords.longitude;
        var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
        var circle = L.circle([-5.183721, 119.422279], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 50
        }).addTo(map);

    }

    function getCurrentTimeFormatted() {
        const currentTime = new Date();
        const hours = currentTime.getHours().toString().padStart(2, '0');
        const minutes = currentTime.getMinutes().toString().padStart(2, '0');
        const seconds = currentTime.getSeconds().toString().padStart(2, '0');
        return `${hours}:${minutes}:${seconds}`;
    }

    // Menggunakan fungsi tersebut untuk mendapatkan waktu dalam format yang sesuai
    const formattedTime = getCurrentTimeFormatted();

    function errorsCallback(){

    }

    $('#takeabsen').click(function(e){
        Webcam.snap(function(uri) {
            image = uri;
        });
        var lokasi = $('#lokasi').val();
        $.ajax({
            type : 'POST',
            url : '/absen/saveAbsen/',
            data : {
                _token: "{{ csrf_token() }}",
                image: image,
                lokasi: lokasi,
                formattedTime: formattedTime
            },
            cache: false,
            success: function(response){
                if(response.success){
                    var message = 'Absen Berhasil! Terima kasih dan Selamat Bekerja';
                    if (response.type === 'out') {
                        message = 'Absen Pulang Berhasil! Terima kasih dan Selamat Pulang';
                    }
                    Swal.fire({
                        title: 'Notifikasi',
                        text: message,
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                    setTimeout(function(){
                        location.href = '/dashboard';
                    }, 3000);
                } else {
                    Swal.fire({
                        title: 'Absen Gagal!',
                        text: 'Silahkan coba beberapa saat lagi.',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                }
            },
        });
    });



</script>
@endpush
