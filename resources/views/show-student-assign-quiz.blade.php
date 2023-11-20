@extends('layout')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header pb-1">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0 text-dark">Select Quiz</h4>
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

    <form method="GET" action="{{ route('question.show',1)}}" >
       
          @csrf
     
        <div class="ml-4 mr-4">
           
            Select Subject
            <select class="form-control select2 dynamic1" name="quiz_detail" id="subject_id" data-dependent="quiz_number" required>
            <option value = ""  selected="selected">-----Select Subject----</option>
            @foreach ($data as $detail)
                <option value = "{{$detail->department_id}},{{$detail->subject_id}},{{$detail->semester_id}},{{$detail->section_id}}"> 
                  {{$detail->subject_name}}&nbsp; ({{$detail->semester_name}}{{$detail->section_name}})</option>
            {{-- <input type="hidden" name="assign_subject_id" value="{{$detail->id}}"> --}}
            @endforeach
            </select>
            <div class="form-group mt-2 ">
              Quiz #
              <select class="form-control select2 "
              name="quiz_number" id="quiz_number"   required>
                  <option value = "" >-----Select Quiz Number----</option>
   

              </select>
              
              <button type="submit" class="btn btn-primary float-right mt-4 pl-5 pr-5">Start Quiz</button>
        </div>
       
          
         
    </form>
  </section>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>
      $(document).ready(function(){


       $('.dynamic1').change(function(){
            if($(this).val() != '')
            {

             var value = $(this).val();
            var a = value.split(",");
            var dependent = $(this).data('dependent');
            var _token = $('input[name="_token"]').val();
            $.ajax({
            url:"{{ route('student.fetch') }}",
            method:"POST",
            data:{_token:_token,department_id:a[0],subject_id:a[1],section_id:a[3]},
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

