<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>InstallmentApp | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset("assets/css/all.min.css") }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset("assets/css/adminlte.min.css") }}">

    <link rel="stylesheet" href="{{ asset("assets/css/main.css") }}">
@yield("styles")
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>


    </ul>
    @guest
    <div class="mr-auto d-flex">
      <a class="btn btn-success mr-2" href="{{ route("auth.register") }}">تسجيل</a>
      <a class="btn btn-warning" href="{{ route("auth.login") }}">دخول</a>
    </div>
    @endguest
    @auth
    <form action="{{ route('auth.logout') }}" method="POST" class="mr-auto">
        @csrf
        <input type="submit" class="btn btn-danger" value="خروج">
        </form>
    @endauth

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin')}}" class="brand-link">
      <img src="{{ asset("assets/img/AdminLTELogo.png") }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Installment App</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      @auth
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{route('profile.edit')}}" class="d-block">{{ auth()->user()->username }}</a>
        </div>
      </div>
      @endauth

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-dollar-sign"></i>
              <p>
                الأقساط
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                @hasrole('super-admin')
                <li class="nav-item">
                    <a href="{{route("allInstallmentRequests")}}" class="nav-link">
                        <i class="fas fa-money-check-alt nav-icon"></i>
                        <p>جميع الطلبات</p>
                    </a>
                </li>
                @endhasrole

                @hasanyrole('super-admin|moderator')
                <li class="nav-item">
                    <a href="{{route("allPendingInstallmentRequests")}}" class="nav-link">
                        <i class="fas fa-money-check-alt nav-icon"></i>
                        <p>الطلبات المنتظرة</p>
                    </a>
                </li>
                @endhasanyrole
                @hasrole('super-admin')
                <li class="nav-item">
                    <a href="{{route("allApprovedInstallmentRequests")}}" class="nav-link">
                        <i class="fas fa-money-check-alt nav-icon"></i>
                        <p>الطلبات الموافق عليها</p>
                    </a>
                </li>
                @endhasrole

                @hasrole('super-admin')
                <li class="nav-item">
                    <a href="{{route("allRejectedInstallmentRequests")}}" class="nav-link">
                        <i class="fas fa-money-check-alt nav-icon"></i>
                        <p>الطلبات المرفوضة</p>
                    </a>
                </li>
                @endhasrole
                @hasrole('super-admin')
                <li class="nav-item">
                    <a href="{{route("adminAddInstallmentRequest")}}" class="nav-link">
                        <i class="fas fa-money-check-alt nav-icon"></i>
                        <p>اضف طلب تقسيط</p>
                    </a>
                </li>
                @endhasrole
            </ul>
          </li>
            @hasrole('super-admin')
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-user-secret nav-icon"></i>
                    <p>
                        أكواد الدعوة
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route("invite_code.index") }}" class="nav-link">
                            <i class="fas fa-users nav-icon"></i>
                            <p>جميع الأكواد</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("invite_code.create") }}" class="nav-link">
                            <i class="fas fa-user-secret nav-icon"></i>
                            <p>كود جديد</p>
                        </a>
                    </li>
                </ul>
            </li>
            @endhasrole

            @hasrole('super-admin')
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-user-secret nav-icon"></i>
                    <p>
                        التصديرات
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route("export.users") }}" class="nav-link">
                            <i class="fas fa-users nav-icon"></i>
                            <p>تصدير المستخدمين</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("export.kafeels") }}" class="nav-link">
                            <i class="fas fa-user-secret nav-icon"></i>
                            <p>تصدير الكفلاء</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("export.installment_requests") }}" class="nav-link">
                            <i class="fas fa-user-secret nav-icon"></i>
                            <p>تصدير طلبات التقسيط</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("export.installments") }}" class="nav-link">
                            <i class="fas fa-user-secret nav-icon"></i>
                            <p>تصدير الاقساط</p>
                        </a>
                    </li>


                </ul>
            </li>
            @endhasrole()
            @hasrole('super-admin')
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-user-secret nav-icon"></i>
                    <p>
                        المشرفين
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('moderators.index')}}" class="nav-link">
                            <i class="fas fa-users nav-icon"></i>
                            <p>جميع المشرفين</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('moderators.create')}}" class="nav-link">
                            <i class="fas fa-user nav-icon"></i>
                            <p>أضف مشرف</p>
                        </a>
                    </li>


                </ul>
            </li>
            @endhasrole()


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield("content")

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2023 <a href="https://mikkawe.com">Mikkawe</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
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
@yield("scripts")
</body>
</html>
