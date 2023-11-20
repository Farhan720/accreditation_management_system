@extends('layout')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header pb-1">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0 text-dark">View/update Assignment</h4>
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

    <form method="GET" action="{{ route('uploadassignment.edit',1)}}" >
       
          @csrf
     
        <div class="ml-4 mr-4">
           
            Select Subject
            <select class="form-control select2 dynamic1" name="assignment_detail" id="subject_id" data-dependent="assignment_number" required>
            <option value = ""  selected="selected">-----Select Subject----</option>
            @foreach ($data as $detail)
                <option value = "{{$detail->department_id}},{{$detail->teacher_id}},{{$detail->subject_id}},{{$detail->semester_id}},{{$detail->section_id}}"> 
                  {{$detail->subject_name}}&nbsp; ({{$detail->semester_name}}{{$detail->section_name}})</option>
            {{-- <input type="hidden" name="assign_subject_id" value="{{$detail->id}}"> --}}
            @endforeach
            </select>
            <div class="form-group mt-2 ">
              Assignment #
              <select class="form-control select2 dynamic2"
              name="assignment_number" id="assignment_number" data-dependent="assignment"  required>
                  <option value = "" >-----Select Assignmet Number----</option>
   

              </select>
              
              <button type="submit" class="btn btn-primary float-right mt-4 pl-5 pr-5">Update</button>
        </div>
       
          
         
    </form>
        <div class="card-body pt-5 mt-5 mr-4 ml-4">
        <table class="table">
            <thead class="bg-dark">
              <tr>
                <th style="width: 10px">#</th>
                <th>Roll #</th>
                <th>Student Name</th>
                <th>Assignment Download</th>
                
                <th>Obtained Marks</th>
               
                {{-- <th style="width: 40px">Action</th> --}}
              </tr>
            </thead>
            <tbody id="assignment">

    {{-- @foreach ($semesters as $semester)

    <tr >
        <td>{{$i++  }}</td>
        <td>&nbsp;{{"Semester ".$semester->semester_name  }}</td>
        <td></td>
        <td>
            <form action="/semester/{{$semester->id}}" method="POST">
                @method('DELETE')
                @csrf
                    <input type="submit" value="Delete" class="btn btn-danger">
            </form>
        </td>
      </tr>
      @endforeach --}}




        </tbody>
    </table>

  </section>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>
      $(document).ready(function(){

       $('.dynamic2').change(function(){
        if($(this).val() != '')
        {
      
         var value = $('.dynamic1').val();
        var a = value.split(",");
        var assignment_id = $('#assignment_number').val();
      
         var dependent = $(this).data('dependent');

         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('uploadassignment.index') }}",
          method:"GET",
          data:{_token:_token,subject_id:a[2],semester_id:a[3],section_id:a[4],assignment_id:assignment_id},
          success:function(result)
          {
           $('#'+dependent).html(result);
          }

         })
        }
       });

       $('.dynamic1').change(function(){
            if($(this).val() != '')
            {

             var value = $(this).val();
            var a = value.split(",");
            var dependent = $(this).data('dependent');
            var _token = $('input[name="_token"]').val();
            $.ajax({
            url:"{{ route('assignment.fetch') }}",
            method:"POST",
            data:{_token:_token, dependent:dependent,department_id:a[0],teacher_id:a[1],subject_id:a[2],section_id:a[4]},
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

