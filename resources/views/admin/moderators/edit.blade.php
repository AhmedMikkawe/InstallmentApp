@extends("admin.layout")
@section("content")
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">لوحة التحكم</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">معلومات المشرف </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route("moderators.update",$mod->id)}}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="username">اسم المستخدم</label>
                                    <input name="username" type="text" class="form-control" id="username" value="{{$mod->username}}">
                                    @error("username")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="fullname">الاسم بالكامل</label>
                                    <input name="fullname" type="text" class="form-control" id="fullname" value="{{$mod->fullname}}">
                                    @error("fullname")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label for="email">البريد الإلكتروني</label>
                                    <input name="email" type="text" class="form-control" id="email" value="{{$mod->email}}">
                                    @error("email")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="role">دور المشرف</label>
                                    <select class="custom-select" name="role" id="role">
                                        @foreach($roles as $role)
                                            <option value="{{$role}}" {{$mod->getRoleNames()->first() == $role ? "selected" : ""}}>{{$role}}</option>
                                        @endforeach
                                    </select>
                                    @error("installment_status")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">تأكيد</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
