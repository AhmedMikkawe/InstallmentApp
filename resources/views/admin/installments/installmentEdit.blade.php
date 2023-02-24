@extends("admin.layout")
@section('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endsection
@section("content")
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Installments for user {{$installment->installment_request->user->username}}</h1>
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
                            <h3 class="card-title">Installment for {{$installment->installment_request->required_device}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route("adminUpdateInstallment",['id'=>$installment->installment_request->id,'id2'=>$installment->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="value">Installment Value</label>
                                    <input name="value" type="text" class="form-control" id="value" placeholder="Enter Installment Value" value="{{$installment->value}}">
                                    @error("value")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="installmentStatus">Installment Status</label>
                                    <select class="custom-select" name="installment_status" id="installmentStatus">
                                        <option value="approved" @if($installment->installment_status == 'approved') selected @endif>Approved</option>
                                        <option value="pending" @if($installment->installment_status == 'pending') selected @endif>Pending</option>
                                        <option value="rejected" @if($installment->installment_status == 'rejected') selected @endif>Rejected</option>
                                    </select>
                                    @error("installment_status")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="date">Date:</label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control"  id="date" name="date" value="{{$installment->date}}"/>
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    @error("date")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label for="receipt_photo">Receipt Photo</label>
                                    @if($installment->receipt_photo)
                                        <img class="img-thumbnail rounded w-25 d-block" src="{{asset("uploads/installment_receipt/$installment->receipt_photo")}}" alt="">
                                    @endif

                                    <input name="receipt_photo" type="file" class="form-control" id="receipt_photo" accept="image/*">
                                    @error("receipt_photo")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

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
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(function(){
            $('#date').datepicker({ dateFormat: 'yy-mm-dd' });
        })

    </script>


@endsection
