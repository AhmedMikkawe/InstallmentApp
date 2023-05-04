@extends("admin.layout")
@section("content")
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">لوحة التحكم</h1>
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
              @if (session('success'))
              <div class="alert alert-success" role="alert">
              {{ session('success') }}
                </div>

              @endif
                  @if (session('faild'))
                      <div class="alert alert-danger" role="alert">
                          {{ session('faild') }}
                      </div>

                  @endif

              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">الكود</th>
                    <th scope="col">الحالة</th>
                    <th scope="col">الاجراءات</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($invite_codes as $invite_code)
                  <tr>
                    <th scope="row">{{ $invite_code->id }}</th>
                    <td>{{ $invite_code->code }}</td>
                    <td>{{ $invite_code->valid == 1 ? "Valid" : "Not Vaild"}}</td>
                    <td>
                        <a class="btn btn-warning" href="{{ route("invite_code.edit",$invite_code->id) }}">Edit</a>
                        <button class="btn btn-info copyCode" data-clipboard-text="{{route("auth.register")}}?code={{$invite_code->code}}">Copy</button>
                        @if($invite_code->valid == 1)
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#whatsapp-modal"
                                    data-invite-code="{{$invite_code->code}}"
                            >
                                أرسل دعوة عن طريق واتساب
                            </button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#message-modal"
                                    data-invite-code="{{$invite_code->code}}"
                            >
                                أرسل SMS
                            </button>
                        @endif


                    </td>
                  </tr>

                  @endforeach
                </tbody>
              </table>
            </div>

          </div>

        </div>
      </section>
    <div class="modal fade" id="whatsapp-modal" tabindex="-1" role="dialog" aria-labelledby="share code to whatsapp" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <h5 class="modal-title" id="whatsapp-modal-title">إرسال كود الدعوة على واتس اب</h5>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="invCode">الكود</label>
                        <input type="email" class="form-control" id="invCode" disabled>
                    </div>
                    <div class="form-group">
                        <label for="phone">رقم الهاتف</label>
                        <input type="tel" class="form-control" id="phone" >
                        <small class="form-text text-muted">
                            اكتب رقم الهاتف كامل بمفتاح الدولة ولكن بدون علامة (+)
                        </small>

                    </div>
                    <div class="form-group">
                        <label for="invText">نص الدعوة</label>
                        <textarea class="form-control" id="invText" rows="3">
                            الرجاء استخدام هذا الرابط اثناء التسجيل
                        </textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <a id="send-invite" href="#" class="btn btn-success btn-block" target="_blank">إرسال</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="message-modal" tabindex="-1" role="dialog" aria-labelledby="share code to phone number using sms" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <h5 class="modal-title" id="message-modal-title">إرسال كود الدعوة عن طريق sms</h5>
                </div>
                <form action="{{route('sendSMS')}}" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="message_invCode">الكود</label>
                        <input type="email" class="form-control" id="message_invCode" disabled>
                    </div>
                    <div class="form-group">
                        <label for="message_phone">رقم الهاتف</label>
                        <input name="phone" type="tel" class="form-control" id="message_phone" >
                        <small class="form-text text-muted">
                            اكتب رقم الهاتف كامل بمفتاح الدولة
                        </small>

                    </div>
                    <div class="form-group">
                        <label for="message_invText">نص الدعوة</label>
                        <textarea name="message" class="form-control" id="message_invText" rows="3">
                            الرجاء استخدام هذا الرابط اثناء التسجيل
                        </textarea>
                    </div>

                </div>

                <div class="modal-footer">
                        @csrf
                    <input class="btn btn-success btn-block" type="submit" value="إرسال">
                </div>
                </form>

            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
    <script>
        new ClipboardJS('.copyCode');
        $('#whatsapp-modal').on('shown.bs.modal', function (e) {
             let incode = $('#invCode').val(e.relatedTarget.attributes[4].textContent);
            let phone = $("#phone").val("");
            let tex = $("#invText").val("الرجاء استخدام هذا الرابط اثناء التسجيل:");
            $("#invText").val( tex.val() + " " + "{{url('/register?code=')}}" + incode.val());

        });
        $('#message-modal').on('shown.bs.modal', function (e) {
            let incode = $('#message_invCode').val(e.relatedTarget.attributes[4].textContent);
            let phone = $("#message_phone").val("");
            let tex = $("#message_invText").val("الرجاء استخدام هذا الرابط اثناء التسجيل:");
            $("#message_invText").val( tex.val() + " " + "{{url('/register?code=')}}" + incode.val());

        });
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
