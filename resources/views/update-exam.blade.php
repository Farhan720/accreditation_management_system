@extends('layout')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header pb-1">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0 text-dark">Update Exam Marks</h4>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><?php $i=1 ?>Exam</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">

    <form method="GET" action="{{ route('uploadexam.edit',1)}}" >
       
          @csrf
     
        <div class="ml-4 mr-4">
           
            Select Subject
            <select class="form-control select2 dynamic1" name="subject_detail" id="subject_id"  required>
            <option value = ""  selected="selected">-----Select Subject----</option>
            @foreach ($data as $detail)
                <option value = "{{$detail->subject_id}},{{$detail->semester_id}},{{$detail->section_id}}"> 
                  {{$detail->subject_name}}&nbsp; ({{$detail->semester_name}}{{$detail->section_name}})</option>
            {{-- <input type="hidden" name="assign_subject_id" value="{{$detail->id}}"> --}}
            @endforeach
            </select>
            <div class="form-group mt-2 ">
              Exam type
              <select class="form-control select2 "
              name="exam_type" id="exam_type"  required>
                  <option value = "" >----- Select ----</option>
                  <option value = "midd" >Midd Exam</option>
                  <option value = "final" >Final Exam</option>
   

              </select>
              
              <button type="submit" class="btn btn-primary float-right mt-4 pl-5 pr-5">Next</button>
        </div>
       
          
         
    </form>
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
          data:{_token:_token,subject_id:a[1],semester_id:a[2],section_id:a[3],assignment_id:assignment_id},
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

