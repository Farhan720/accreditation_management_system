@extends('layout')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header pb-1">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0 text-dark">Add Semester</h4>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><?php $i=1 ?>Semester</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">

    <form method="POST" action="{{ route('semester.store') }}">
        @csrf

        <div class="ml-4 mr-4">
            Select Department
            <select class="form-control select2 dynamic" style="width: 100%;" name="department_id" id="department_id" data-dependent="semester" required>
                <option value = ""  selected="selected">-----Select Department----</option>

                @foreach ($departments as $department)
                <option id="d_name" value="{{$department->id}}">{{$department->department_name}}</option>
                @endforeach

            </select>
          <div class="form-group mt-2">
           Add New Semester Number
            <input type="number" name="semester_name" class="form-control"
            placeholder="eg: 1, 2 .."  >
            {{-- <input type="hidden" id ="d_name" name="department_id" value="{{$department->demartment_name}}"> --}}
            <button type="submit" class="btn btn-primary float-right mt-2">Add</button>
        </div>
        </div>
    </form>
        <div class="card-body pt-5 mt-5 mr-4 ml-4">
        <table class="table">
            <thead class="bg-dark">
              <tr>
                <th style="width: 10px">#</th>
                <th>Semester</th>
                <th >Department</th>
                
              </tr>
            </thead>
            <tbody id="semester">



        </tbody>
    </table>

  </section>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>
      $(document).ready(function(){

       $('.dynamic').change(function(){
        if($(this).val() != '')
        {
         var select = $(this).attr("id");

         var value = $(this).val();

         var d_name=$('#d_name').text();

         var dependent = $(this).data('dependent');

         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('semester.index') }}",
          method:"GET",
          data:{select:select, value:value, _token:_token, dependent:dependent,d_name:d_name},
          success:function(result)
          {
           $('#'+dependent).html(result);
          }

         })
        }
       });
      });

      </script>
@endsection

