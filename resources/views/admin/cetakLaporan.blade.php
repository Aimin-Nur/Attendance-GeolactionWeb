<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>Rekap Bulanan Absensi Karyawan PT. Portal Indonesia Perkasa</title>
      <!-- Style CSS -->
      <link rel="stylesheet" href="{{asset('laporan')}}/style.css">
      <link rel="stylesheet" href="{{asset('laporan')}}/demo.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
      <link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
   </head>
   <body>
    
    <main class="cd__main">
       <div class="container invoice">
<div class="invoice-header">
  <div class="row">
    <div class="col-xs-8">
        <img src="{{asset('demo')}}/./static/portal-color.png" width="110" height="32" alt="Tabler" class="navbar-brand-image">
      <h4 class="text-muted">Laporan Absensi Karyawan <br>PT. Portal Indonesia Perkasa </h4>
    </div>
    <div class="col-xs-4">
      <div class="media">
        <div class="media-left">
            @php
            $path = Storage::url('uploads/karyawan/'. $karyawan->foto)
        @endphp
        <img src="{{url($path)}}" alt="" width="60px" height="70px">
        </div>
        <ul class="media-body list-unstyled">
          <li><strong>{{$karyawan->nama_lengkap}}</strong></li>
          <li>{{$karyawan->NIP}}</li>
          <li>{{$karyawan->jabatan}}</li>
          <li>{{$karyawan->email}}</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="invoice-body">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Rekap Absesi Kehadiran Bulanan</h3>
    </div>
    <table class="table table-bordered table-condensed">
      <thead>
        <tr>
          <th class="text-center colfix">No</th>
          <th>Tanggal Absensi</th>
          <th class="text-center colfix">Jam Masuk</th>
          <th class="text-center colfix">Foto Masuk</th>
          <th class="text-center colfix">Lokasi Masuk</th>
          <th class="text-center colfix">Jam Pulang</th>
          <th class="text-center colfix">Foto Pulang</th>
          <th class="text-center colfix">Lokasi Pulang</th>
          <th class="text-center colfix">Keterangan</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($absen as $n )
        <tr>
            <td class="text-center">
                <span class="mono">{{$loop->iteration}}</span>
            </td>
          <td>
            <small class="text-center">{{date("d-m-Y", strtotime($n->tgl_absen))}}</small>
          </td>
          <td class="text-center">
            <small class="mono">{{$n->jam_in}}</small>
          </td>
          <td class="text-center">
            <small class="mono">{{$n->foto_in}}</small>
          </td>
          <td class="text-center">
            <small class="mono">{{$n->location}}</small>
          </td>
          <td class="text-center">
            <span class="mono">{{$n->jam_out}}</span>
          </td>
          <td class="text-center">
            <small class="mono">{{$n->foto_out}}</small>
          </td>
          <td class="text-center">
            <small class="mono">{{$n->location_out}}</small>
          </td>
          <td class="text-center">
            <strong class="mono">{{$n->status}}</strong>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @if ($cekIzin > 0)
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Rekap Absesi Perizinan/Sakit</h3>
    </div>
    <table class="table table-bordered table-condensed">
      <thead>
        <tr>
          <th class="text-center colfix">No</th>
          <th class="text-center colfix">Tanggal Izin</th>
          <th class="text-center colfix">Status Izin</th>
          <th class="text-center colfix">Keterangan Perizinan</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($dataPerizinan as $d )
        <tr>
            <td class="text-center">
                <span class="mono">{{$loop->iteration}}</span>
            </td>
          <td class="text-center">
            <span class="mono">{{date("d-m-Y", strtotime($d->tgl_izin))}}</span>
          </td>
          <td class="text-center">
            <small class="mono">{{$d->status}}</small>
          </td>
          <td class="text-center">
            <small class="mono">{{$d->keterangan}}</small>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @endif
  <div class="panel panel-default">
    <table class="table table-bordered table-condensed">
      <thead>
        <tr>
          <td class="text-center col-xs-1">Jumlah Kehadiran</td>
          <td class="text-center col-xs-1">Izin</td>
          <td class="text-center col-xs-1">Sakit</td>
          <td class="text-center col-xs-1">Terlambat</td>
          <td class="text-center col-xs-1">Tepat Waktu</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th class="text-center rowtotal mono">{{$hadir}}</th>
          <th class="text-center rowtotal mono">{{$jumlahIzin ?? 0 }}</th>
          <th class="text-center rowtotal mono">{{$jumlahSakit ?? 0 }}</th>
          <th class="text-center rowtotal mono">{{$jumlahTelat ?? 0 }}</th>
          <th class="text-center rowtotal mono">{{$jumlahOntime ?? 0}}</th>
        </tr>
      </tbody>
    </table>
  </div>

</div>
<div class="invoice-footer">
  Thank you for choosing our services.
  <br/> We hope to see you again soon
  <br/>
  <strong>~El-Wazir~</strong>
</div>
</div>
       <!-- END EDMO HTML (Happy Coding!)-->
    </main>
    <footer class="cd__credit">
     PT. Portal Perkasa Indonesia
    </footer>
    
   
 </body>
</html>



<script type="text/javascript">
  window.print()
</script>
