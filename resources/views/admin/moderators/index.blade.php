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

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">اسم المستخدم</th>
                            <th scope="col">المهمة</th>
                            <th scope="col">الاجراءات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->username }}</td>
                                <td><span class="badge badge-warning badge-pill">{{$user->hasRole('super-admin') ? 'مدير' : 'مشرف'}}</span></td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route("moderators.edit",$user->id) }}">Edit</a>
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

@endsection
