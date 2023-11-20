  @extends('layout')

  @section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header pb-1">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class=" text-dark ">Add New Subject</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"> <?php $i=1 ?>  Add Subject</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
            <form method="POST" action="{{ route('subject.store') }}">
                @csrf
                <div class="ml-4 mr-4">
                    Select Department
                    <select class="form-control select2 dynamic"
                    name="department_id" id="department_id" value="" data-dependent="semester_id" required>
                        <option value = "" >-----Select Department----</option>

                        @foreach ($departments as $department)
                        <option value="{{$department->id}}">{{$department->department_name}}</option>
                        @endforeach

                    </select>
                <div class="form-group mt-2">
                    Select Semester
                    <select class="form-control select2 "
                     name="semester_id" id="semester_id"  required>
                        <option value = " ">-----Select Semester----</option>

                    </select>
                </div>



                  <div class="form-group">
                    <div class="custom-file">
                    Enter Subject Name
                    <input type="text" name="subject_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Subject" required>

                    </div>

                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary float-right mt-2">Submit</button>
                </div>

           

      

        {{-- <div class="col-sm-6">
            <h4 class="mt-0 text-dark ">Assign Teacher</h4>

                <div class="ml-4 mr-4">
                    Select Department
                    <select class="form-control select2 dynamic3"
                    name="department_id" id="department_id" value="" data-dependent="teacher_id" required>
                        <option value = "" >-----Select Department----</option>

                        @foreach ($departments as $department)
                        <option value="{{$department->id}}">{{$department->department_name}}</option>
                        @endforeach

                    </select>
                    <div class="form-group mt-2">
                        <div class="form-group mt-2">
                            Select Teacher
                            <select class="form-control select2" name="teacher_id" id="teacher_id"  required>
                                <option value = " ">-----Select Teacher----</option>

                            </select>
                            <button type="submit" class="btn btn-primary float-right mt-2">Submit</button>
                        </div>
                </div>


        </div> --}}
    </form>
    </div>

        <div class="card-body pt-5 mt-5 mr-4 ml-4">

            <table class="table">
                <thead class="bg-dark">
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Subject name</th>
                    <th style="width: 40px">Update</th>
                    <th style="width: 40px">Delete</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($subjects as $subject)

                      <tr>
                        <td>{{$i++  }}</td>
                        <td><i class="fas fa-book"></i>&nbsp;{{$subject->subject_name  }}</td>

                        <td class="bg-white">
                            <form action="/subject/{{$subject->id}}/edit" method="GET">
                                @method('PATCH')
                                @csrf
                                    <input type="submit" value="Update" class="btn btn-success">
                            </form>
                        </td>
                        <td>
                            <form action="/subject/{{$subject->id}}" method="POST">
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

