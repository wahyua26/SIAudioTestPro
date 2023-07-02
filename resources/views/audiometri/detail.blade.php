 
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <title>Detail Hasil Audiometri</title>
    @include('layouts.head')
    <style>
      th {
        text-align: center;
      }
    </style>
</head>
<body class="hold-transition sidebar-mini">
            @if(Session::has('success'))
              <script type="text/javascript">
                  swal({
                      title:'Success!',
                      text:"{{Session::get('success')}}",
                      timer:5000,
                      type:'success',
                      icon: 'success'
                  }).then((value) => {
                    //location.reload();
                  }).catch(swal.noop);
              </script>
            @endif
            @if(Session::has('error'))
              <script type="text/javascript">
                  swal({
                      title:'Error!',
                      text:"{{Session::get('error')}}",
                      timer:5000,
                      type:'error',
                      icon: 'error'
                  }).then((value) => {
                    //location.reload();
                  }).catch(swal.noop);
              </script>
            @endif
            @if(isset($errors) && $errors->any())
              @foreach($errors->all() as $error)
                <script type="text/javascript">
                  swal({
                      title:'Error!',
                      text:"{{ $error }}",
                      timer:5000,
                      type:'error',
                      icon: 'error'
                  }).then((value) => {
                    //location.reload();
                  }).catch(swal.noop);
                </script>
              @endforeach
            @endif
<div class="wrapper ">

  <!-- Navbar -->
  @include('layouts.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts.side')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm">
            <h1 class="m-0 font-weight-bold">DETAIL HASIL AUDIOMETRI</h1>
          </div><!-- /.col -->
          <div class="col-sm">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Daftar Karyawan</li>
            </ol> --}}
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section>
        <div class="container-fluid h-custom">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="card text-center">
                <div class="card-body">
                    <div class="row font-weight-bold h3">
                        <div class="col">ID: {{ $detail->id }}</div>
                        <div class="col">{{ $detail->name }}</div>
                        <div class="col">{{ $detail->tanggal }} {{ $detail->waktu }}</div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="font-weight-bold h4">Telinga Kiri</div>
                                <div class="card-body">
                                    <div>
                                        <canvas id="ChartKiri"></canvas>
                                        <input type="hidden" id="kiri1" name="kiri1" placeholder="" value="{{ $kiri1 }}">
                                        <input type="hidden" id="kiri2" name="kiri2" placeholder="" value="{{ $kiri2 }}">
                                        <input type="hidden" id="kiri3" name="kiri3" placeholder="" value="{{ $kiri3 }}">
                                        <input type="hidden" id="kiri4" name="kiri4" placeholder="" value="{{ $kiri4 }}">
                                        <input type="hidden" id="kiri5" name="kiri5" placeholder="" value="{{ $kiri5 }}">
                                    </div>
                                    <br>
                                    <div class="card">
                                        <div class="h5 font-weight-bold">Hasil Tes</div>
                                        <div class="card-body">
                                            <p id="imgKiri"></p><br>
                                            <input type="hidden" id="hasilKiri" name="hasilKiri" placeholder="" value="{{ $detail->hasilKiri }}">
                                            <div class="text-center h5 font-weight-bold">{{ $detail->hasilKiri }}% ({{ $detail->keteranganKiri }})</div>
                                            <div class="text-center font-weight-bold">Telinga anda dalam keadaan baik, tetap jaga selalu kesehatan telinga anda</div><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="font-weight-bold h4">Telinga Kanan</div>
                                <div class="card-body">
                                    <div>
                                        <canvas id="ChartKanan"></canvas>
                                        <input type="hidden" id="kanan1" name="kanan1" placeholder="" value="{{ $kanan1 }}">
                                        <input type="hidden" id="kanan2" name="kanan2" placeholder="" value="{{ $kanan2 }}">
                                        <input type="hidden" id="kanan3" name="kanan3" placeholder="" value="{{ $kanan3 }}">
                                        <input type="hidden" id="kanan4" name="kanan4" placeholder="" value="{{ $kanan4 }}">
                                        <input type="hidden" id="kanan5" name="kanan5" placeholder="" value="{{ $kanan5 }}">
                                    </div>
                                    <br>
                                    <div class="card">
                                        <div class="h5 font-weight-bold">Hasil Tes</div>
                                        <div class="card-body">
                                          <p id="imgKanan"></p><br>
                                          <input type="hidden" id="hasilKanan" name="hasilKanan" placeholder="" value="{{ $detail->hasilKanan }}">
                                          <div class="text-center h5 font-weight-bold">{{ $detail->hasilKanan }}% ({{ $detail->keteranganKanan }})</div>
                                          <div class="text-center font-weight-bold">Telinga anda dalam keadaan baik, tetap jaga selalu kesehatan telinga anda</div><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="card">
                            <div class="font-weight-bold h4">Hasil Keseluruhan</div>
                            <div class="card-body">
                              <p id="img"></p><br>
                              <input type="hidden" id="hasil" name="hasil" placeholder="" value="{{ $detail->hasil }}">
                                <div class="text-center h5 font-weight-bold">{{ $detail->hasil }}% ({{ $detail->keterangan }})</div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                       {{-- <a href="/cetak-detail-audiometri/{{ $detail->id }}" class="btn btn-info my-2"><i class="fas fa-file-pdf"></i> Cetak Detail</a> --}}
                       <button onclick="window.print()" class="btn btn-info my-2"><i class="fas fa-file-pdf"></i> Cetak Detail</button>
                     </div>
                </div>
              </div>
          </div>
        </div>
      </section>
      
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
    @include('layouts.footer')  
<!-- ./wrapper -->

</div>
<!-- REQUIRED SCRIPTS -->
<script>
    const hasilKiri = parseInt(document.getElementById('hasilKiri').value);
    //console.log(hasilKiri);

    if(hasilKiri <= 100 && hasilKiri >= 90){
      document.getElementById('imgKiri').innerHTML = "<img src=\"{{ asset('AdminLTE/dist/img/normal.png') }}\">";
    }
    else if(hasilKiri <= 89 && hasilKiri >= 75){
      document.getElementById('imgKiri').innerHTML = "<img src=\"{{ asset('AdminLTE/dist/img/tuliringan.png') }}\">";
    }
    else if(hasilKiri <= 74 && hasilKiri >= 60){
      document.getElementById('imgKiri').innerHTML = "<img src=\"{{ asset('AdminLTE/dist/img/tulisedang.png') }}\">";
    }
    else if(hasilKiri <= 59 && hasilKiri >= 50){
      document.getElementById('imgKiri').innerHTML = "<img src=\"{{ asset('AdminLTE/dist/img/tuliberat.png') }}\">";
    }
    else if(hasilKiri <= 49 && hasilKiri >= 0){
      document.getElementById('imgKiri').innerHTML = "<img src=\"{{ asset('AdminLTE/dist/img/gangguankomunikasi.png') }}\">";
    }

    const hasilKanan = parseInt(document.getElementById('hasilKanan').value);
    //console.log(hasilKanan);

    if(hasilKanan <= 100 && hasilKanan >= 90){
      document.getElementById('imgKanan').innerHTML = "<img src=\"{{ asset('AdminLTE/dist/img/normal.png') }}\">";
    }
    else if(hasilKanan <= 89 && hasilKanan >= 75){
      document.getElementById('imgKanan').innerHTML = "<img src=\"{{ asset('AdminLTE/dist/img/tuliringan.png') }}\">";
    }
    else if(hasilKanan <= 74 && hasilKanan >= 60){
      document.getElementById('imgKanan').innerHTML = "<img src=\"{{ asset('AdminLTE/dist/img/tulisedang.png') }}\">";
    }
    else if(hasilKanan <= 59 && hasilKanan >= 50){
      document.getElementById('imgKanan').innerHTML = "<img src=\"{{ asset('AdminLTE/dist/img/tuliberat.png') }}\">";
    }
    else if(hasilKanan <= 49 && hasilKanan >= 0){
      document.getElementById('imgKanan').innerHTML = "<img src=\"{{ asset('AdminLTE/dist/img/gangguankomunikasi.png') }}\">";
    }

    const hasil = parseInt(document.getElementById('hasil').value);
    //console.log(hasil);

    if(hasil <= 100 && hasil >= 90){
      document.getElementById('img').innerHTML = "<img src=\"{{ asset('AdminLTE/dist/img/normal.png') }}\">";
    }
    else if(hasil <= 89 && hasil >= 75){
      document.getElementById('img').innerHTML = "<img src=\"{{ asset('AdminLTE/dist/img/tuliringan.png') }}\">";
    }
    else if(hasil <= 74 && hasil >= 60){
      document.getElementById('img').innerHTML = "<img src=\"{{ asset('AdminLTE/dist/img/tulisedang.png') }}\">";
    }
    else if(hasil <= 59 && hasil >= 50){
      document.getElementById('img').innerHTML = "<img src=\"{{ asset('AdminLTE/dist/img/tuliberat.png') }}\">";
    }
    else if(hasil <= 49 && hasil >= 0){
      document.getElementById('img').innerHTML = "<img src=\"{{ asset('AdminLTE/dist/img/gangguankomunikasi.png') }}\">";
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const kiri1 = document.getElementById('kiri1').value*100;
  const kiri2 = document.getElementById('kiri2').value*100;
  const kiri3 = document.getElementById('kiri3').value*100;
  const kiri4 = document.getElementById('kiri4').value*100;
  const kiri5 = document.getElementById('kiri5').value*100;

  const ctx = document.getElementById('ChartKiri');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['1', '2', '3', '4', '5'],
      datasets: [{
        label: 'Persentase Deret',
        data: [kiri1, kiri2, kiri3, kiri4, kiri5],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  const kanan1 = document.getElementById('kanan1').value*100;
  const kanan2 = document.getElementById('kanan2').value*100;
  const kanan3 = document.getElementById('kanan3').value*100;
  const kanan4 = document.getElementById('kanan4').value*100;
  const kanan5 = document.getElementById('kanan5').value*100;

  const chart = document.getElementById('ChartKanan');

  new Chart(chart, {
    type: 'line',
    data: {
      labels: ['1', '2', '3', '4', '5'],
      datasets: [{
        label: 'Persentase Deret',
        data: [kanan1, kanan2, kanan3, kanan4, kanan5],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<!-- jQuery -->
@include('layouts.script')
</body>
</html>
