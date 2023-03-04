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
                    </td>
                  </tr>

                  @endforeach
                </tbody>
              </table>
            </div>

          </div>

        </div>
      </section>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
    <script>
        new ClipboardJS('.copyCode');
    </script>


@endsection
