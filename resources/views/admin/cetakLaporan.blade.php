<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>Rekap Bulanan Absensi Karyawan PT. Portal Indonesia Perkasa</title>

      <style>
        @page { size: A4 }

        .cd__main{
          background: linear-gradient(to right, #427D9D, #164863) !important;
        }
        body {
        background: #EEE;
        /* font-size:0.9em !important; */
        }

        .invoice {
        background: #fff;
        width: 970px !important;
        margin: 50px auto;
        }
        .invoice .invoice-header {
        padding: 25px 25px 15px;
        }
        .invoice .invoice-header h1 {
        margin: 0;
        }
        .invoice .invoice-header .media .media-body {
        font-size: 0.9em;
        margin: 0;
        }
        .invoice .invoice-body {
        border-radius: 10px;
        padding: 25px;
        background: #FFF;
        }
        .invoice .invoice-footer {
        padding: 15px;
        font-size: 0.9em;
        text-align: center;
        color: #999;
        }

        .logo {
        max-height: 70px;
        border-radius: 10px;
        }

        .dl-horizontal {
        margin: 0;
        }
        .dl-horizontal dt {
        float: left;
        width: 80px;
        overflow: hidden;
        clear: left;
        text-align: right;
        text-overflow: ellipsis;
        white-space: nowrap;
        }
        .dl-horizontal dd {
        margin-left: 90px;
        }

        .rowamount {
        padding-top: 15px !important;
        }

        .rowtotal {
        font-size: 1.3em;
        }

        .colfix {
        width: 12%;
        }

        .mono {
        font-family: monospace;
        }
      </style>


      <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto&display=swap');
        @import url('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        *{ margin: 0; padding: 0;}
        *, *::before, *::after {
          margin: 0;
          padding: 0;
          box-sizing: inherit;
        }

        body{
          min-height: 100vh;
          display: flex;
          justify-content: center;
          flex-wrap: wrap;
          align-content: flex-start;
            
          font-family: 'Roboto', sans-serif;
          font-style: normal;
          font-weight: 300;
          font-smoothing: antialiased;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
          font-size: 15px;
          background: #eee;
        }
        .cd__intro{
          padding: 60px 30px;
          margin-bottom: 15px;
                flex-direction: column;

        }
        .cd__intro,
        .cd__credit{
            display: flex;
            width: 100%;
            justify-content: center;
            align-items: center;
            background: #fff;
            color: #333;
            line-height: 1.5;
            text-align: center;
        }

        .cd__intro h1 {
          font-size: 18pt;
          padding-bottom: 15px;

        }
        .cd__intro p{
          font-size: 14px;
        }

        .cd__action{
          text-align: center;
          display: block;
          margin-top: 20px;
        }

        .cd__action a.cd__btn {
          text-decoration: none;
          color: #666;
          border: 2px solid #666;
          padding: 10px 15px;
          display: inline-block;
          margin-left: 5px;
        }
        .cd__action a.cd__btn:hover{
          background: #666;
          color: #fff;
            transition: .3s;
        -webkit-transition: .3s;
        }
        .cd__action .cd__btn:before{
          font-family: FontAwesome;
          font-weight: normal;
          margin-right: 10px;
        }
        .down:before{content: "\f019"}
        .back:before{content:"\f112"}

        .cd__credit{
            padding: 12px;
            font-size: 9pt;
            margin-top: 40px;

        }
        .cd__credit span:before{
          font-family: FontAwesome;
          color: #e41b17;
          content: "\f004";


        }
        .cd__credit a{
          color: #333;
          text-decoration: none;
        }
        .cd__credit a:hover{
          color: #1DBF73; 
        }
        .cd__credit a:hover:after{
            font-family: FontAwesome;
            content: "\f08e";
            font-size: 9pt;
            position: absolute;
            margin: 3px;
        }
        .cd__main{
          background: #fff;
          padding: 20px;
          flex-direction: row;
          flex-wrap: wrap;
          justify-content: center;
          
        }
        .cd__main{
            display: flex;
            width: 100%;
        }

        @media only screen and (min-width: 1360px){
            .cd__main{
              max-width: 1280px;
              margin-left: auto;
              margin-right: auto; 
              padding: 24px;
            }
        }
      </style>
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
  Rekap Absensi Karyawan diatas merupakan hasil Rekapan selama 1 Bulan.
  <br/> Pastikan Anda telah mencetak laporan bulanan setiap akhir bulan yang berjalan.
  <br/>
  <strong>~Thank You~</strong>
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
