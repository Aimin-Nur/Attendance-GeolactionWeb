@extends('layouts.absen')
@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
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
</style>

@section('content')
<div class="row" style="margin-top:70px">
    <div class="col">
        <input type="text" id="lokasi">
        <div class="webcam"></div>
    </div>
</div>
<div class="row">
    <div class="col">
        <button id="takeabsen" class="btn btn-primary btn-block">
            <ion-icon name="camera-outline"></ion-icon>
            Absen masuk
        </button>
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
    }

    function errorsCallback(){

    }


</script>
@endpush
