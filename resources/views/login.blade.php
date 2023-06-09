<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Informasi AudioTest Pro | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
  <style>
    .divider:after,
    .divider:before {
      content: "";
      flex: 1;
      height: 1px;
      background: #eee;
    }
    .h-custom {
      height: calc(100% - 73px);
    }
    @media (max-width: 450px) {
      .h-custom {
      height: 100%;
    }}
  </style>
</head>
<body>
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

    @if(Session::has('fail'))
    <script type="text/javascript">
        swal({
            title:'Oops!',
            text:"{{Session::get('fail')}}",
            type:'error',
            timer:5000,
            icon: 'error'
        }).then((value) => {
          //location.reload();
        }).catch(swal.noop);
    </script>
    @endif

    <section class="vh-100">
      <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-md-9 col-lg-6 col-xl-5">
            <img class="img-circle elevation-5" src="{{ asset('AdminLTE/dist/img/Picture1.png') }}"
              class="img-fluid" alt="Sample image">
          </div>
          <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form action="/login" method="post">
              @csrf
              <h4 class="mt-1 mb-3 pb-1 font-weight-bold">MASUK</h4>
              <!-- Email input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="form3Example3">Email</label>
                <input type="email" name="email" id="email" class="form-control form-control-lg"
                  placeholder="email@example.com" autofocus required/>
              </div>
    
              <!-- Password input -->
              <div class="form-outline mb-3">
                <label class="form-label" for="form3Example4">Kata Sandi</label>
                <input type="password" name="password" id="password" class="form-control form-control-lg"
                  placeholder="**********************" required/>
                
              </div>
    
              <div class="d-flex justify-content-between align-items-center">
                <!-- Checkbox -->
                
              </div>
    
              <div class="text-center text-lg-start mt-4 pt-2">
                <button type="submit" class="btn btn-primary btn-lg"
                  style="padding-left: 2.5rem; padding-right: 2.5rem;">Masuk</button>
                
              </div>
    
            </form>
          </div>
        </div>
      </div>
      <div
        class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
        <!-- Copyright -->
        <div class="text-white mb-3 mb-md-0">
          Copyright © 2023. All rights reserved.
        </div>
        <!-- Copyright -->
    
        <!-- Right -->
        <div>
          <a href="#!" class="text-white me-4">Sistem Informasi AudioTest Pro</a>
        </div>
        <!-- Right -->
      </div>
    </section>


<!-- jQuery -->
@include('layouts.script')
</body>
</html>