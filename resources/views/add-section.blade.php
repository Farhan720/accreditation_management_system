@extends('layout')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header pb-1">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0 text-dark ">Add New Section</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Section</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
      <form method="POST" action="{{ route('section.store') }}">
          @csrf
        <div class="ml-4 mr-4">
                Select Department
                <select class="form-control select2 dynamic" style="width: 100%;"
                name="department_id" id="department_id" value="" data-dependent="semester" required>
                    <option value = "" >-----Select Department----</option>

                    @foreach ($departments as $department)
                    <option value="{{$department->id}}">{{$department->department_name}}</option>
                    @endforeach

                </select>
                
            <div class="form-group mt-2">
                Select Semester
                <select class="form-control select2" name="semester_id" id="semester" style="width: 100%;" required>
                    <option value = " ">-----Select Semester----</option>

                </select>
            </div>

            <div class="form-group ">
                    Enter Section Name
                    <input type="text" name="section_name" class="form-control"  placeholder="Enter Section Name" >
                    <button type="submit" class="btn btn-primary float-right mt-2" >Submit</button>
            </div>
        </div>

      </form>
      <div class="card-body pt-5 mt-5 mr-4 ml-4">

        <table class="table">
            <thead class="bg-dark">
              <tr>
                <th style="width: 10px">#</th>
                <th>Section name</th>
                <th>Department name</th>
                <th style="width: 40px">Update</th>
                <th style="width: 40px">Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>
                @foreach ($sections as $section)

                  <tr>
                    <td>{{$i++  }}</td>
                    <td></i>&nbsp;{{$section->section_name  }}</td>
                    <td></i>&nbsp;{{ \App\Department::where(['id' => $section->department_id])->pluck('department_name')->first()  }}</td>
                    <td class="bg-white">
                        <form action="/section/{{$section->id}}/edit" method="GET">
                            @method('PATCH')
                            @csrf
                                <input type="submit" value="Update" class="btn btn-success">
                        </form>
                    </td>
                    <td>
                        <form action="/section/{{$section->id}}" method="POST">
                            @method('DELETE')
                            @csrf
                                <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                  </tr>
            @endforeach
        </tbody>
    </table>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){

             $('.dynamic').change(function(){
              if($(this).val() != '')
              {

               var select = $(this).attr("id");

               var value = $(this).val();

               var dependent = $(this).data('dependent');

               var _token = $('input[name="_token"]').val();
               $.ajax({
                url:"{{ route('semester.fetch') }}",
                method:"POST",
                data:{select:select, value:value, _token:_token, dependent:dependent},
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

