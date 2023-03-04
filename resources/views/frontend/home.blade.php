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
                        في هذه الصفحة تجد التنبيهات المهمة,
                        من فضلك اذهب الى البار الجانبي لإضافة طلب جديد, أو دفع قسط جديد أو تحديث معلومات الكفيل
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
