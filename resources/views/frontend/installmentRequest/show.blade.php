@extends("frontend.layout")
@section("content")
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Installment Requests</h1>
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
                            <h3 class="card-title">Installment for {{$request->required_device}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route("installment.store",$request->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="value">Installment Value</label>
                                    <input name="value" type="text" class="form-control" id="value" placeholder="Enter Installment Value" value="@if(old("value") == null) {{ $request->installment_value}}@endif @if(old("value")) {{old("value")}}@endif">
                                    @error("value")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="receipt_photo">Receipt Photo</label>
                                    <input name="receipt_photo" type="file" class="form-control" id="receipt_photo" accept="image/*">
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

            <!-- Small boxes (Stat box) -->
            <div class="row mb-2">
                <div class="col-12">
                    @if (session('faild'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('faild') }}
                        </div>

                    @endif
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>

                        @endif

                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if(count($request->installments) > 0)
                        <table class="table table-responsive-md table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($request->installments as $installment)
                                <tr>
                                    <th scope="row">{{$installment->id}}</th>
                                    <td> {{date('d-m-Y', strtotime($installment->date))}}</td>
                                    <td>
                                        <span class="badge
                                        @if($installment->installment_status == 'approved') badge-success @endif
                                        @if($installment->installment_status == 'rejected') badge-danger @endif
                                        @if($installment->installment_status == 'pending') badge-warning @endif
                                        ">{{$installment->installment_status}}
                                        </span>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>

                    @endif
                    @if(count($request->installments) == 0)
                        <div class="alert alert-warning" role="alert">
                            <p>you didn't pay installments yet</p>
                        </div>

                    @endif
                </div>


            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
