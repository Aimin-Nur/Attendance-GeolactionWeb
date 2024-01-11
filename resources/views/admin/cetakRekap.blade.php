<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>Rekap Bulanan Absensi Seluruh Karyawan PT. Portal Indonesia Perkasa</title>
      <!-- Style CSS -->
      <link rel="stylesheet" href="{{asset('laporan')}}/styleRekapan.css">
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
      <h4 class="text-muted">Rekap Bulanan Seluruh Absensi Karyawan <br>PT. Portal Indonesia Perkasa </h4>
    </div>
  </div>
</div>
<div class="invoice-body">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Rekap Absesi Kehadiran Bulan
         @if ($bulan == 1)
           Januari
        @elseif ($bulan == 2)
          Februari
        @elseif ($bulan == 3)
          Maret
        @elseif ($bulan == 4)
          April
        @elseif ($bulan == 5)
          Mei
          @elseif ($bulan == 6)
          Juni
          @elseif ($bulan == 7)
          Juli
          @elseif ($bulan == 8)
          Agustus
          @elseif ($bulan == 9)
          September
          @elseif ($bulan == 10)
          Oktober
          @elseif ($bulan == 11)
          November
          @elseif ($bulan == 12)
          Desember
         @endif
         {{$tahun}}</h3>
    </div>
    <table style="font-size: 11px" class="table table-bordered table-condensed">
      <thead>
        <tr>
          <th class="text-center colfix" rowspan="2">NIP</th>
          <th class="text-center colfix" rowspan="2">Nama Karyawan</th>
          <th class="text-center colfix" colspan="31">Tanggal Presensi</th>
        </tr>
        <tr>
          <?php
          for($i=1; $i<32; $i++){
          ?>
          <th>{{$i}}</th>
          <?php
          }  
          ?>
        </tr>
      </thead>
      <tbody>
        @foreach ($rekap as $absen)
        <tr>
          <th>{{$absen->NIP}}</th>
          <th>{{$absen->nama_lengkap}}</th>
          <th>{{$absen->Tgl_1 ?? '0'}}</th>
          <th>{{$absen->Tgl_2 ?? '0'}}</th>
          <th>{{$absen->Tgl_3 ?? '0'}}</th>
          <th>{{$absen->Tgl_4 ?? '0'}}</th>
          <th>{{$absen->Tgl_5 ?? '0'}}</th>
          <th>{{$absen->Tgl_6 ?? '0'}}</th>
          <th>{{$absen->Tgl_7 ?? '0'}}</th>
          <th>{{$absen->Tgl_8 ?? '0'}}</th>
          <th>{{$absen->Tgl_9 ?? '0'}}</th>
          <th>{{$absen->Tgl_10 ?? '0'}}</th>
          <th>{{$absen->Tgl_11 ?? '0'}}</th>
          <th>{{$absen->Tgl_12 ?? '0'}}</th>
          <th>{{$absen->Tgl_13 ?? '0'}}</th>
          <th>{{$absen->Tgl_14 ?? '0'}}</th>
          <th>{{$absen->Tgl_15 ?? '0'}}</th>
          <th>{{$absen->Tgl_16 ?? '0'}}</th>
          <th>{{$absen->Tgl_17 ?? '0'}}</th>
          <th>{{$absen->Tgl_18 ?? '0'}}</th>
          <th>{{$absen->Tgl_19 ?? '0'}}</th>
          <th>{{$absen->Tgl_20 ?? '0'}}</th>
          <th>{{$absen->Tgl_21 ?? '0'}}</th>
          <th>{{$absen->Tgl_22 ?? '0'}}</th>
          <th>{{$absen->Tgl_23 ?? '0'}}</th>
          <th>{{$absen->Tgl_24 ?? '0'}}</th>
          <th>{{$absen->Tgl_25 ?? '0'}}</th>
          <th>{{$absen->Tgl_26 ?? '0'}}</th>
          <th>{{$absen->Tgl_27 ?? '0'}}</th>
          <th>{{$absen->Tgl_28 ?? '0'}}</th>
          <th>{{$absen->Tgl_29 ?? '0'}}</th>
          <th>{{$absen->Tgl_30 ?? '0'}}</th>
          <th>{{$absen->Tgl_31 ?? '0'}}</th>
       </tr>
       @endforeach
      </tbody>
    </table>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Rekap Absesi Perizinan Bulan
         @if ($bulan == 1)
           Januari
        @elseif ($bulan == 2)
          Februari
        @elseif ($bulan == 3)
          Maret
        @elseif ($bulan == 4)
          April
        @elseif ($bulan == 5)
          Mei
          @elseif ($bulan == 6)
          Juni
          @elseif ($bulan == 7)
          Juli
          @elseif ($bulan == 8)
          Agustus
          @elseif ($bulan == 9)
          September
          @elseif ($bulan == 10)
          Oktober
          @elseif ($bulan == 11)
          November
          @elseif ($bulan == 12)
          Desember
         @endif
         {{$tahun}}</h3>
    </div>
    <table style="font-size: 11px" class="table table-bordered table-condensed">
      <thead>
        <tr>
          <th class="text-center colfix" rowspan="2">NIP</th>
          <th class="text-center colfix" rowspan="2">Nama Karyawan</th>
          <th class="text-center colfix" colspan="31">Tanggal Presensi</th>
        </tr>
        <tr>
          <?php
          for($i=1; $i<32; $i++){
          ?>
          <th>{{$i}}</th>
          <?php
          }  
          ?>
        </tr>
      </thead>
      <tbody>
        @foreach ($Rekapizin as $izin)
        <tr>
          <th>{{$izin->NIP}}</th>
          <th>{{$izin->nama_lengkap}}</th>
          <th>
            @if (isset($izin->tgl_1))
                @if ($izin->tgl_1 == 'Sakit')
                    S
                @elseif ($izin->tgl_1 == 'Izin')
                    I
                @else
                    0
                @endif
            @else
                0
            @endif
          </th>
          <th>
           {{$izin->Tgl_2}}
          </th>
          <th>{{$izin->Tgl_3 ?? '0'}}</th>
          <th>{{$izin->Tgl_4 ?? '0'}}</th>
          <th>{{$izin->Tgl_5 ?? '0'}}</th>
          <th>{{$izin->Tgl_6 ?? '0'}}</th>
          <th>{{$izin->Tgl_7 ?? '0'}}</th>
          <th>{{$izin->Tgl_8 ?? '0'}}</th>
          <th>{{$izin->Tgl_9 ?? '0'}}</th>
          <th>{{$izin->Tgl_10 ?? '0'}}</th>
          <th>{{$izin->Tgl_11 ?? '0'}}</th>
          <th>{{$izin->Tgl_12 ?? '0'}}</th>
          <th>{{$izin->Tgl_13 ?? '0'}}</th>
          <th>{{$izin->Tgl_14 ?? '0'}}</th>
          <th>{{$izin->Tgl_15 ?? '0'}}</th>
          <th>{{$izin->Tgl_16 ?? '0'}}</th>
          <th>{{$izin->Tgl_17 ?? '0'}}</th>
          <th>{{$izin->Tgl_18 ?? '0'}}</th>
          <th>{{$izin->Tgl_19 ?? '0'}}</th>
          <th>{{$izin->Tgl_20 ?? '0'}}</th>
          <th>{{$izin->Tgl_21 ?? '0'}}</th>
          <th>{{$izin->Tgl_22 ?? '0'}}</th>
          <th>{{$izin->Tgl_23 ?? '0'}}</th>
          <th>{{$izin->Tgl_24 ?? '0'}}</th>
          <th>{{$izin->Tgl_25 ?? '0'}}</th>
          <th>{{$izin->Tgl_26 ?? '0'}}</th>
          <th>{{$izin->Tgl_27 ?? '0'}}</th>
          <th>{{$izin->Tgl_28 ?? '0'}}</th>
          <th>{{$izin->Tgl_29 ?? '0'}}</th>
          <th>{{$izin->Tgl_30 ?? '0'}}</th>
          <th>{{$izin->Tgl_31 ?? '0'}}</th>
       </tr>
       @endforeach
      </tbody>
    </table>
  </div>
  <div class="panel panel-default">
    <table class="table table-bordered table-condensed">
      <thead>
        <tr>
          <td class="text-center col-xs-1">Pegawai Paling Sering Terlambat</td>
          <td class="text-center col-xs-1">Pegawai Paling Sering Izin</td>
          <td class="text-center col-xs-1">Pegawai Paling Sering Sakit</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th class="text-center rowtotal mono">{{$pegawaiTerlambat->nama_lengkap}}</th>
          <th class="text-center rowtotal mono">{{$pegawaiIzin->nama_lengkap ?? 'Tidak Ada'}}</th>
          <th class="text-center rowtotal mono">{{$pegawaiSakit->nama_lengkap}}</th>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<div class="invoice-footer">
  Rekap Absensi Karyawan diatas merupakan hasil Rekapan selama 1 Bulan.
  <br/> Pastikan Anda telah mencetak laporan bulanan setiap akhir bulan yang berjalan.
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
