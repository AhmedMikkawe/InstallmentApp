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
          <div class="row">
            <div class="col-12">
                <form action="{{ route("invite_code.update",$inviteCode->id) }}" method="POST">
                @csrf
                <div class="form-row align-items-center">
                    <div class="col-lg-9 my-1">
                      <label class="sr-only" for="inlineFormInputName">Code Status</label>
                      <select class="custom-select" name="valid">
                        <option value="1">Valid</option>
                        <option value="0">Not Valid</option>
                      </select>
                    </div>
                    <div class="col-auto my-1">
                      <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                  </div>
                </form>
            </div>
            
          </div>
          
        </div>
      </section>
@endsection