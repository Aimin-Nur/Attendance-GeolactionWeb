@extends('layouts.absen')

@section('header')
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="{{'dashboard'}}" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
        <div class="pageTitle">Form Perizinan</div>
        <div class="right"></div>
    </div>
</div>
@endsection

@section('content')
<div class="row" style="margin-top:70px">
    <div class="col">
        <form action="/absen/saveIzin" method="POST" id="formIzin">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="date" name="tgl_izin" id="tgl_izin" class="form-control" placeholder="Tanggal Izin">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="input-field">
                        <select name="status" id="status" class="form-control">
                            <option value="">Izin / Sakit</option>
                            <option value="Izin">Izin</option>
                            <option value="Sakit">Sakit</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top:20px">
                <div class="col">
                    <div class="form-group">
                        <textarea name="keterangan" placeholder="Keterangan Izin/Sakit" id="keterangan" cols="20" rows="5" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary w-100" id="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

<script>
    $('formIzin').submit(function(){
        var tgl_izin = $('#tgl_izin').val();
        var status = $('#status').val();
        var keterang = $('#keterangan').val();
        if (tgl_izin == ""){
            alert("Tanggal Izin Harus diisi");
            return false;
        } else if(status == ""){
            alert("Status Izin Harus Diisi");
            return false;
        }else if(keterangan == ""){
            alert("Keterangan Perizinan Harus Diisi");
            return false;
        }
    })
</script>


