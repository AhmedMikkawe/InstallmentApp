@extends("admin.layout")
@section("styles")
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

@endsection
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
                        <form action="{{route("adminStoreInstallmentRequest")}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="user">User</label>
                                    <select class="select2 form-control" name="user" id="user" style="width: 100%">
                                        <option></option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" @if(old("user") == $user->id) selected @endif>
                                                {{$user->fullname}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="requiredDevice">Product Name</label>
                                    <input name="required_device" type="text" class="form-control" id="requiredDevice" placeholder="Enter Required Device" value="{{old("required_device")}}">
                                    @error("required_device")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="requestType">Request Type</label>
                                    <select class="custom-select" name="request_type" id="requestType">
                                        <option value="monthly" @if(old("request_type") == 'monthly') selected @endif>monthly</option>
                                        <option value="3 months" @if(old("request_type") == '3 months') selected @endif>3 months</option>
                                        <option value="6 months" @if(old("request_type") == '6 months') selected @endif>6 months</option>
                                        <option value="yearly" @if(old("request_type") == 'yearly') selected @endif>yearly</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="requestStatus">Request Status</label>
                                    <select class="custom-select" name="request_status" id="requestStatus">
                                        <option value="pending" @if(old("request_status") == 'pending') selected @endif>pending</option>
                                        <option value="approved" @if(old("request_status") == 'approved') selected @endif>approved</option>
                                        <option value="rejected" @if(old("request_status") == 'rejected') selected @endif>rejected</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="installmentValue">Installment Value</label>
                                    <input name="installment_value" type="text" class="form-control" id="installmentValue" placeholder="Enter Value" value="{{old("installment_value")}}">
                                    @error("installment_value")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="installmentCount">Installment Count</label>
                                    <input name="installment_count" type="text" class="form-control" id="installmentCount" placeholder="Enter Count" value="{{old("installment_count")}}">
                                    @error("installment_count")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="total">Total</label>
                                    <input name="total" type="text" class="form-control" id="total" placeholder="" value="{{old("total")}}">
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#user').select2({
                placeholder: "Select a user",
                width:"style",
                theme: 'bootstrap4',
            });
            $("#installmentValue").on('keyup',function(){
                $("#total").val($(this).val() * $("#installmentCount").val());
            });
            $("#installmentCount").on('keyup',function(){
                $("#total").val($(this).val() * $("#installmentValue").val());
            });
        });
    </script>
@endsection
