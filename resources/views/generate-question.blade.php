

@extends('layout')


<!-- Main Sidebar Container -->


@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Generate Question</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Generate Question</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6 col-md-12 ">
          <!-- general form elements -->
          <div class="card card-primary ">
            <div class="card-header">
              <h3 class="card-title">Fill detail</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('question.store') }}" >
              @csrf
              <div class="card-body">
                    <div class="form-group">
                        <label>Enter Question</label>
                        <textarea class="form-control" rows="3" name="question" placeholder="Enter Question ...."></textarea>
                    </div>

                     <div class="form-group">
                        <label>Option (1)</label>
                        <input type="text" class="form-control"  name="option[]" placeholder="Enter Option ...">
                      </div>

                      <div class="form-group">
                        <label>Option (2)</label>
                        <input type="text" class="form-control"  name="option[]" placeholder="Enter Option ...">
                      </div>

                      <div class="form-group">
                        <label>Option (3)</label>
                        <input type="text" class="form-control"  name="option[]" placeholder="Enter Option ...">
                      </div>

                      <div class="form-group">
                        <label>Option (4)</label>
                        <input type="text" class="form-control"  name="option[]" placeholder="Enter Option ...">
                      </div>

                      <div class="form-group">
                        <label>Enter True Option (1,2,4 or 4)</label>
                        <input type="text" class="form-control" name="correct_option" placeholder="Enter True Option ..." required>
                      </div>
                      <input type="hidden" name="quiz_id" value="{{$quiz_id}}">
                      <input type="hidden" name="subject_id" value="{{$subject_id}}">
                      <input type="hidden" name="quiz_number" value="{{$quiz_number}}">
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary" id = "save">Save & Next</button>
                {{-- <button type="submit" class="btn btn-primary" id = "next" disabled="enabled">Next</button> --}}
              </div>
            </form>
          </div>
          <!-- /.card -->

          <!-- Form Element sizes -->

          <!-- /.card -->

        </div>

        <!-- right column -->


        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>


  @endsection


