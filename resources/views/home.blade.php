 
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <title>Home</title>
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
            <h1 class="m-0 font-weight-bold">DASHBOARD</h1>
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
    <div class="content">
      <div class="row">
        <div class="col">
          <div>
            <canvas id="myChart"></canvas>
          </div>
        </div>
        <div class="col">
          <table id="example2" class="table table-bordered table-striped table-hover dataTable dtr-inline" aria-describedby="example2_info">
            <thead>
              <tr>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Ruang Kerja</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Tingkat Kebisingan</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Rata-Rata Hasil Audiometri</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Rata-Rata Usia</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Rekomendasi</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <tr class="odd">
                <td>Gudang Utama</td>
                <td>90 db</td>
                <td>50%</td>
                <td>60 Tahun</td>
                <td>Pengecekan ruang kerja dan pemeriksaan pegawai usia lanjut</td>
              </tr>
              <tr class="even">
                <td>Ruang Distribusi</td>
                <td>76 db</td>
                <td>82%</td>
                <td>38 Tahun</td>
                <td>Ruang kerja sudah baik begitu pula dengan pegawainya</td>
              </tr>
              <tr class="odd">
                <td>Ruang Produksi</td>
                <td>88 db</td>
                <td>85%</td>
                <td>40 Tahun</td>
                <td>Pengecekan ruang kerja</td>
              </tr>
              <tr class="even">
                <td>Kantor Admin</td>
                <td>65 db</td>
                <td>55%</td>
                <td>45 Tahun</td>
                <td>Pemeriksaan pegawai</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col"></div>
        <div class="col-lg-3">
          <div class="small-box text-white">
            <div class="inner">
              <h3>{{ $audiometri }}</h3>
              <p>Hasil Audiometri</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-file-medical"></i>
            </div>
            <a href="{{ route('audiometri') }}" class="small-box-footer text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="small-box text-white">
            <div class="inner">
              <h3 class="h3">5</h3>
              <p>Data Master</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-table"></i>
            </div>
            <a href="{{ route('menu') }}" class="small-box-footer text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="small-box text-white">
            <div class="inner">
              <h3 class="h3">5</h3>
              <p>Hasil Rekomendasi</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-clipboard"></i>
            </div>
            <a href="#" class="small-box-footer text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col"></div>
      </div>
    </div>
      
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
    @include('layouts.footer')  
<!-- ./wrapper -->

</div>
<!-- REQUIRED SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
      datasets: [{
        label: 'Rata-Rata Tingkat Pendengaran',
        data: [65, 55, 76, 80, 60, 43],
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
