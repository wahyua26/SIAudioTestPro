 
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <title>{{ GoogleTranslate::trans('Data Ruang Kerja', app()->getLocale()) }}</title>
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
            <h1 class="m-0 font-weight-bold">{{ GoogleTranslate::trans('DATA RUANG KERJA', app()->getLocale()) }}</h1>
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
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col">
          <div class="card">
            <a href="{{ route('tambah-ruang') }}" class="btn btn-primary"><i class="fas fa-plus"></i> {{ GoogleTranslate::trans('Tambah Ruang Kerja', app()->getLocale()) }}</a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <table class="table table-striped projects text-center">
            <tr>
                <th>ID</th>
                <th>{{ GoogleTranslate::trans('Nama Ruangan', app()->getLocale()) }}</th>
                <th>{{ GoogleTranslate::trans('Lokasi', app()->getLocale()) }}</th>
                <th>{{ GoogleTranslate::trans('Tingkat Kebisingan', app()->getLocale()) }}</th>
                <th>{{ GoogleTranslate::trans('Aksi', app()->getLocale()) }}</th>
            </tr> 
            @foreach ($ruang as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->lokasi }}</td>
                <td>{{ $item->bising }} dB</td>
                <td class="project-actions text-center">
                  <a href="/edit-ruang/{{ $item->id }}" class="btn btn-info btn-sm">
                      <i class="fas fa-pencil-alt">
                      </i>
                      {{ GoogleTranslate::trans('Ubah', app()->getLocale()) }}
                  </a>
                  <a onclick="return confirm('Apakah anda yakin?')" href="/hapus-ruang/{{ $item->id }}" class="btn btn-danger btn-sm">
                      <i class="fas fa-trash">
                      </i>
                      {{ GoogleTranslate::trans('Delete', app()->getLocale()) }}
                  </a>
              </td>
            </tr> 
            @endforeach 
        </table>
        </div>
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

<!-- jQuery -->
@include('layouts.script')
</body>
</html>
