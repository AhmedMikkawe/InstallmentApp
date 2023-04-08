@extends("admin.layout")
@section("content")
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">الملف الشخصي</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-12">
                    @if (session('updated'))
                        <div class="alert alert-success" role="alert">
                            {{ session('updated') }}
                        </div>

                    @endif
                        @if (session('wrong password'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('wrong password') }}
                            </div>

                        @endif

                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">تعديل معلومات الملف الشخصي</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route("profile.update")}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="email">البريد الإلكتروني</label>
                                    <input name="email" type="text" class="form-control" id="email" value="{{auth()->user()->email}}">
                                    @error("email")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="password">كلمة السر الحالية</label>
                                    <input name="password" type="password" class="form-control" id="passward">
                                    @error("password")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">تحديث</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
