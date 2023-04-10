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
                    <h1 class="m-0">الأقساط الخاصة بـ {{$request->user->username}}</h1>
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
                            <h3 class="card-title">قسط {{$request->required_device}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route("adminStoreInstallment",$request->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="value">قيمة القسط</label>
                                    <input name="value" type="text" class="form-control" id="value" placeholder="Enter Installment Value" value="@if(old("value") == null) {{ $request->installment_value}}@endif @if(old("value")) {{old("value")}}@endif">
                                    @error("value")
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                <label for="installmentStatus">حالة القسط</label>
                                    <select class="custom-select" name="installment_status" id="installmentStatus">
                                        <option value="approved">موافق عليه</option>
                                        <option value="pending">تحت الانتظار</option>
                                        <option value="rejected">مرفوض</option>
                                    </select>
                                @error("installment_status")
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>
                                <div class="form-group">
                                    <label for="date">التاريخ:</label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control"  id="date" name="date"/>
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
                                    <label for="receipt_photo">صورة الوصل</label>
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
                                <button type="submit" class="btn btn-primary">إرسال</button>
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
                                <th scope="col">التاريخ</th>
                                <th scope="col">الحالة</th>
                                <th scope="col">القيمة</th>
                                <th scope="col">الإجراءات</th>
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
                                    <td>{{$installment->value}}</td>
                                    <td>
                                        <form action="{{route('adminDeleteInstallment',['id'=>$installment->installment_request->id, 'id2'=>$installment->id])}}" method="post">
                                            @method('delete')
                                            @csrf
                                            <a class="btn btn-warning" href="{{route("adminEditInstallment",['id'=>$installment->installment_request->id,'id2'=>$installment->id])}}">تعديل</a>
                                            <input class="btn btn-danger" type="submit" value="حذف">
                                        </form>

                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                            <tfoot class="bg-dark">
                            <tr>
                                <th scope="row">المدفوع</th>
                                <td> {{ $request->installments->where('installment_status','approved')->sum('value') }}</td>
                                <th scope="row">المتبقي</th>
                                <td> {{ $request->total - $request->installments->where('installment_status','approved')->sum('value') }}</td>
                                <td>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#whatsapp-modal"
                                            data-remains-installment="{{ $request->total - $request->installments->where('installment_status','approved')->sum('value') }}"
                                    >
                                        أرسل تذكير بالدفع عن طريق واتساب
                                    </button>
                                </td>
                            </tr>

                            </tfoot>
                        </table>
                        <div class="modal fade" id="whatsapp-modal" tabindex="-1" role="dialog" aria-labelledby="share code to whatsapp" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>

                                        <h5 class="modal-title" id="whatsapp-modal-title">إرسال تذكير على واتس اب</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="phone">رقم الهاتف</label>
                                            <input type="tel" class="form-control" id="phone" value="{{$request->user->phone_number}}">

                                            <small class="form-text text-muted">
                                                اكتب رقم الهاتف كامل بمفتاح الدولة ولكن بدون علامة (+)
                                            </small>

                                        </div>
                                        <div class="form-group">
                                            <label for="invText">رسالة التذكير</label>
                                            <textarea class="form-control" id="invText" rows="3">
                            الرجاء دفع الاقساط المتبقية والتي تبلغ
                                                {{ $request->total - $request->installments->where('installment_status','approved')->sum('value') }}
                        </textarea>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <a id="send-invite" href="#" class="btn btn-success btn-block" target="_blank">إرسال</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(count($request->installments) == 0)
                        <div class="alert alert-warning" role="alert">
                            <p>لم تدفع اقساط حتى الآن</p>
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
        $('#whatsapp-modal').on('shown.bs.modal', function (e) {
            let remainsInstallment = e.relatedTarget.attributes[4].textContent;
            let tex = $("#invText").val("الرجاء دفع الأقساط المتبقية والتي تبلغ : ");
            $("#invText").val( tex.val() + " " + remainsInstallment );

        })
        $("#send-invite").on('click',function(e){
            e.preventDefault();
            const WHATSAPP_LINK = "https://api.whatsapp.com/send";
            let phone = $("#phone").val();
            let message = $("#invText").val();
            let newLink = WHATSAPP_LINK + `?phone=${phone}&text=${message}`;
            e.target.attributes[1].value = newLink;
            window.open(newLink,"_blank");
        });
    </script>


@endsection
