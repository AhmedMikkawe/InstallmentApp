@extends("admin.layout")
@section("content")
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
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
                            <h3 class="card-title">Installment Request Information</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route("updateCertainRequest", $request->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="requiredDevice">Product Name</label>
                                    <input name="required_device" type="text" class="form-control" id="requiredDevice" placeholder="Enter Required Device" value="{{$request->required_device}}">
                                    @error("required_device")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="requestType">Request Type</label>
                                    <select class="custom-select" name="request_type" id="requestType">
                                        <option value="monthly" @if($request->request_type == 'monthly') selected @endif>monthly</option>
                                        <option value="3 months" @if($request->request_type == '3 months') selected @endif>3 months</option>
                                        <option value="6 months" @if($request->request_type == '6 months') selected @endif>6 months</option>
                                        <option value="yearly" @if($request->request_type == 'yearly') selected @endif>yearly</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="requestStatus">Request Status</label>
                                    <select class="custom-select" name="request_status" id="requestStatus">
                                        <option value="pending" @if($request->request_status == 'pending') selected @endif>pending</option>
                                        <option value="approved" @if($request->request_status == 'approved') selected @endif>approved</option>
                                        <option value="rejected" @if($request->request_status == 'rejected') selected @endif>rejected</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="installmentValue">Installment Value</label>
                                    <input name="installment_value" type="text" class="form-control" id="installmentValue" placeholder="Enter Value" value="{{$request->installment_value}}">
                                    @error("installment_value")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="installmentCount">Installment Count</label>
                                    <input name="installment_count" type="text" class="form-control" id="installmentCount" placeholder="Enter Count" value="{{$request->installment_count}}">
                                    @error("installment_count")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="total">Total</label>
                                    <input name="total" type="text" class="form-control" id="total" placeholder="" value="{{$request->total}}">
                                    @error("total")
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
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
    <script>
    $(document).ready(function(){
        $("#installmentValue").on('keyup',function(){
            $("#total").val($(this).val() * $("#installmentCount").val());
        });
        $("#installmentCount").on('keyup',function(){
            $("#total").val($(this).val() * $("#installmentValue").val());
        });
    });
    </script>
@endsection
