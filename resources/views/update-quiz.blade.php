@extends('layout')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header pb-1">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class=" text-dark ">Update Quiz</h4>
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
  

    <div class="ml-4 mr-4 ">
     
           Select Subject    
      

        @foreach ($quizzes as $quiz)
        <form action="{{ route('quiz.update',$quiz->id)}}" method="POST">
          @method('PATCH')
             @csrf     
        <?php $subject = App\Subject::find($quiz->subject_id); ?>
       
        <input class="form-group form-control mt-2" value="{{$subject->subject_name}}" tpe ="text" value = "{{$quiz->department_id}},{{$quiz->teacher_id}},{{$quiz->subject_id}},{{$quiz->semester_id}},{{$quiz->section_id}}" disabled> 
       
        
        <input class="form-group form-control mt-2" type="text" value ="{{"Quiz #".$quiz->quiz_number}}" id="" disabled>
        
        @endforeach
     
      
      
        Quiz (Allow/Not)
         <select class="form-group form-control select2 "
         name="allow" id="allow"  required>
             <option value = "" >----- Chose ----</option>
 
             <option value="1">Yes</option>
             <option value="0">No</option>           
 
         </select>
         <div class="form-group mt-2 ">
         <label class="ml-2" >End Date and Time</label> 
         <input class=" mr-5" type="date" name="end_date" id=""  required>
         <input  type="time" name="end_time" id=""  required>
      
         </div>
         <div class="form-group mt-2 ">
          <button type="submit" class="btn btn-primary float-right mt-2">Submit</button>
         </div>
        </form>
         </div>
    

       
         
           
           
           
         
       
     
    </div>
             
        
 @endsection

