@extends("frontend.layout")
@section("content")
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">حدث معلومات الكفيل</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            @if (session('success'))

            <div class="row mb-3">
                <div class="col-12">
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>


                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">معلومات الكفيل</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route("kafeel.update",['id'=>$kafeel->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="kafeelFullName">الاسم بالكامل</label>
                                    <input name="fullname" type="text" class="form-control" id="kafeelFullName" placeholder="Enter Full Name" value="{{$kafeel->fullname}}">
                                    @error("fullname")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="kafeelPhoneNumber">رقم المحمول</label>
                                    <input name="phone_number" type="text" class="form-control" id="kafeelPhoneNumber" placeholder="Phone Number" value="{{$kafeel->phone_number}}">
                                    @error("phone_number")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="kafeelNationalId">رقم الهوية الوطنية</label>
                                    <input name="national_id" type="text" class="form-control" id="kafeelNationalId" placeholder="National ID" value="{{$kafeel->national_id}}">
                                    @error("national_id")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label for="kafeelNationalIdPhoto">صورة الهوية الوطنية</label>
                                    @if($kafeel->national_id_photo)
                                        <img class="img-thumbnail rounded w-25 d-block" src="{{asset("uploads/kafeel_nationalId/$kafeel->national_id_photo")}}" alt="">
                                    @endif
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
