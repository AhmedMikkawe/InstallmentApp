@extends("frontend.layout")
@section("content")
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">لوحة التحكم</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-secondary" role="alert">
                        مرحبا, {{auth()->user()->fullname}}
                        يجب ان تقوم بتأكيد البريد الإلكتروني من خلال الذهاب الضغط على اللينك المرسل إلى بريدك الإلكتروني
                        إن لم تجد البريد المرسل يمكنك المحاولة مرة أخرى
                        <form action="{{route("verification.send")}}" method="post">
                            @csrf
                            <input type="submit" value="إرسال" class="btn btn-success">
                        </form>
                    </div>

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
