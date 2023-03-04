@extends("frontend.layout")
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
            <div class="row mb-2">
                <div class="col-12">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>

                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if(count($requests) > 0)
                        <table class="table table-responsive-md table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">المنتج</th>
                                <th scope="col">الحالة</th>
                                <th scope="col">النوع</th>
                                <th scope="col">القيمة</th>
                                <th scope="col">عدد الأقساط</th>
                                <th scope="col">المجموع</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $counter =1 @endphp
                            @foreach($requests as $request)
                                <tr>
                                    <th scope="row">{{$counter++}}</th>
                                    <td>
                                        @if($request->request_status == 'approved')
                                            <a href="{{route("installmentRequest.show",$request->id)}}">{{$request->required_device}}</a>
                                        @endif
                                        @if($request->request_status != 'approved')
                                                {{$request->required_device}}
                                        @endif

                                    </td>
                                    <td>
                                        <span class="badge
                                        @if($request->request_status == 'approved') badge-success @endif
                                        @if($request->request_status == 'rejected') badge-danger @endif
                                        @if($request->request_status == 'pending') badge-warning @endif
                                        ">{{$request->request_status}}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-pill
                                        @if($request->request_type == 'monthly') badge-primary @endif
                                        @if($request->request_type == '3 months') badge-info @endif
                                        @if($request->request_type == '6 months') badge-warning @endif
                                        @if($request->request_type == 'yearly') badge-danger @endif
                                        ">{{$request->request_type}}
                                        </span>
                                    </td>
                                    <td>{{$request->installment_value}}</td>
                                    <td>{{$request->installment_count}}</td>
                                    <td>{{$request->total}}</td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>

                    @endif
                    @if(count($requests) == 0)
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
