@extends("frontend.layout")
@section("content")
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">أضف معلومات الكفيل</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">معلومات الكفيل</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route("kafeel.create")}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$user_id}}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="kafeelFullName">الاسم بالكامل</label>
                                    <input name="fullname" type="text" class="form-control" id="kafeelFullName" placeholder="Enter Full Name" value="{{old("fullname")}}">
                                    @error("fullname")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="kafeelPhoneNumber">رقم المحمول</label>
                                    <input name="phone_number" type="text" class="form-control" id="kafeelPhoneNumber" placeholder="Phone Number" value="{{old("phone_number")}}">
                                    @error("phone_number")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="kafeelNationalId">رقم الهوية الوطنية</label>
                                    <input name="national_id" type="text" class="form-control" id="kafeelNationalId" placeholder="National ID" value="{{old("national_id")}}">
                                    @error("national_id")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label for="kafeelNationalIdPhoto">صورة الهوية الوطنية</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="national_id_photo" type="file" id="kafeelNationalIdPhoto">
                                        </div>
                                    </div>
                                    @error("national_id_photo")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">إرسال</button>
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
