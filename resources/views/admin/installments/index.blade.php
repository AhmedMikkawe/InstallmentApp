@extends("admin.layout")
@section("content")
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">طلبات الأقساط</h1>
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
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>

                    @endif

                @if(count($installments) > 0)
                        <table class="table table-responsive-md table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">اسم المستخدم</th>
                                <th scope="col">المنتج</th>
                                <th scope="col">الحالة</th>
                                <th scope="col">النوع</th>
                                <th scope="col">القيمة</th>
                                <th scope="col">عدد الأقساط</th>
                                <th scope="col">المجموع</th>
                                <th scope="col">الاجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($installments as $installment)
                                <tr>
                                    <th scope="row">{{$installment->id}}</th>
                                    <td>{{$installment->user->username}}</td>
                                    <td>
                                        <a href="{{route("certainRequest",$installment->id)}}">
                                            {{$installment->required_device}}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge
                                        @if($installment->request_status == 'approved') badge-success @endif
                                        @if($installment->request_status == 'rejected') badge-danger @endif
                                        @if($installment->request_status == 'pending') badge-warning @endif
                                        ">{{$installment->request_status}}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-pill
                                        @if($installment->request_type == 'monthly') badge-primary @endif
                                        @if($installment->request_type == '3 months') badge-info @endif
                                        @if($installment->request_type == '6 months') badge-warning @endif
                                        @if($installment->request_type == 'yearly') badge-danger @endif
                                        ">{{$installment->request_type}}
                                        </span>
                                    </td>
                                    <td>{{$installment->installment_value}}</td>
                                    <td>{{$installment->installment_count}}</td>
                                    <td>{{$installment->total}}</td>
                                    <td>
                                        <a class="btn btn-warning btn-sm" href="{{route("editCertainRequest",$installment->id)}}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>

                    @endif
                    @if(count($installments) == 0)
                        <div class="alert alert-warning" role="alert">
                            <p>ليس لديك طلبات حتى الآن</p>
                        </div>

                    @endif
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
