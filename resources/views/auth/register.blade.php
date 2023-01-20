<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>InstallmentApp | Register</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset("assets/css/all.min.css") }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset("assets/css/adminlte.min.css") }}">
@yield("styles")
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div>
  <div class="container mt-5">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-6 mx-auto">
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Register</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route("auth.register") }}" method="POST">
                @if (session("status"))
                <div class="alert alert-danger" role="alert">
                  {{ session("status") }}
                </div>
                
                @endif
                <input type="hidden" value="{{ $invite_code }}" name="code">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="username">user Name</label>
                        <input name="username" type="text" class="form-control 
                        @error("username")
                            is-invalid
                        @enderror " id="username" placeholder="user name" value="{{ old("username") }}">
                        @error("username")
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input name="email" type="email" class="form-control @error("email")
                          is-invalid
                      @enderror" id="exampleInputEmail1" placeholder="Enter email" value="{{ old("email") }}">
                      @error("email")
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input name="password" type="password" class="form-control @error("password")
                      is-invalid
                      @enderror" id="exampleInputPassword1" placeholder="Password">
                      @error("password")
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword2">Password Confirmation</label>
                      <input name="password_confirmation" type="password" class="form-control @error("password")
                      is-invalid
                      @enderror" id="exampleInputPassword2" placeholder="Password Confirmation">
                      @error("password")
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="fullname">Full Name</label>
                        <input name="fullname" type="text" class="form-control @error("fullname")
                        is-invalid
                        @enderror" id="fullname" placeholder="Enter Your Full Name" value="{{ old("fullname") }}">
                        @error("fullname")
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone-number">Phone Number</label>
                        <input name="phone-number" type="text" class="form-control @error("phone-number")
                            is-invalid
                        @enderror" id="phone-number" placeholder="phone number" value="{{ old("phone-number") }}">
                        @error("phone-number")
                          <div class="text-danger">
                              {{ $message }}
                          </div>
                          @enderror
                      </div>
  
                  <div class="form-group">
                    <label for="nationalId">National ID</label>
                    <input name="nationalId" type="text" class="form-control @error("nationalId")
                    is-invalid
                    @enderror" id="nationalId" placeholder="Enter National ID" value="{{ old("nationalId") }}">
                    @error("nationalId")
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">National ID Photo</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input name="nationalId-photo" type="file" id="exampleInputFile">
                      </div>
                    </div>
                    @error("nationalId-photo")
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->


</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset("assets/js/jquery.min.js") }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset("assets/js/jquery-ui.min.js") }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset("assets/js/bootstrap.bundle.min.js") }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset("assets/js/adminlte.js") }}"></script>
</body>
</html>
