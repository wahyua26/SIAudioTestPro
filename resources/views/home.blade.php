 
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
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">Nama Lengkap</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Usia</th>
                <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column descending" aria-sort="ascending">Hasil Tes</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Ruang Kerja</th>
                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Rekomendasi</th>
              </tr>
            </thead>
            <tbody>
              <tr class="odd">
                <td class="dtr-control">Budi Pratama</td>
                <td>58 Tahun</td>
                <td class="sorting_1">Tuli Konduktif</td>
                <td>Ruang Produksi</td>
                <td>Perlu Pemeriksaan Lebih Lanjut</td>
              </tr>
              <tr class="even">
                <td class="dtr-control">Misc</td>
                <td>NetFront 3.1</td>
                <td class="sorting_1">Embedded devices</td>
                <td>-</td>
                <td>C</td>
              </tr>
              <tr class="odd">
                <td class="dtr-control">Misc</td>
                <td>NetFront 3.4</td>
                <td class="sorting_1">Embedded devices</td>
                <td>-</td>
                <td>A</td>
              </tr>
              <tr class="even">
                <td class="dtr-control">Misc</td>
                <td>Dillo 0.8</td>
                <td class="sorting_1">Embedded devices</td>
                <td>-</td>
                <td>X</td>
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
              <h3>5</h3>
              <p>Hasil Audiometri</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-scroll"></i>
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
        label: '90%',
        data: [12, 19, 3, 5, 2, 3],
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
