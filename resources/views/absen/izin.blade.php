@extends('layouts.absen')

@section('header')
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="{{'dashboard'}}" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
        <div class="pageTitle">Data Izin Absensi</div>
        <div class="right"></div>
    </div>
</div>
@endsection

@section('content')
<div class="row" style="margin-top:70px">
    <div class="col">
        @php
        $messagesuccess = Session::get('success');
        $messageerrors= Session::get('error');
        @endphp
        @if(Session::get('success'))
        <div class="alert alert-success">
            {{ $messagesuccess }}
        </div>
        @endif
        @if(Session::get('error'))
        <div class="alert alert-danger">
            {{ $messageerrors }}
        </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col">
        @if (count($izin) > 0)
            @foreach ($izin as $dataIzin )
                <ul class="listview image-listview">
                    <li>
                        <div class="item">
                            <div class="in">
                                <div>
                                    <b>{{ date("d-m-Y", strtotime($dataIzin->tgl_izin))}} ({{$dataIzin->status}})</b><br>
                                    <small class="text-muted">{{$dataIzin->keterangan}}</small>
                                </div>
                                @if ($dataIzin->status_approved == NULL)
                                    <span class="badge bg-info">Menunggu Validasi</span>
                                @elseif($dataIzin->status_approved != NULL)
                                    <span class="badge bg-success">Tervalidasi</span>
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            @endforeach
        @else
        <div class="form-group text-center">
            <h6 class="text-muted" style="margin-top: 20px">Anda Belum Pernah Izin/Sakit.</h6>
        </div>
        @endif
    </div>
</div>

<div class="fab-button bottom-right" style="margin-bottom:70px">
    <a href="/absen/formizin" class="fab">
        <ion-icon name="add-outline"></ion-icon>
    </a>
</div>
@endsection

