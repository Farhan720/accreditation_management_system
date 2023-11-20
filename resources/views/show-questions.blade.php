@extends('layout')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header pb-1">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class=" text-dark ">Quiz Started</h4>
          <div class=" float-right text-dark ">
            <b>Remaning Time<h1 id="demo" ></h1></b>
          </div>
          
         

        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"> <?php $k=0;?>  Add Subject</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
  

      
    <form method="POST" name="mcQuestion" id="mcQuestion" action="{{ route('quizanswer.store') }}" >
        @csrf
         
                  @foreach ($questions as $question)
                  <table class="table">
                    <?php $j=1; $k++?> 
                    <tbody>
                  <thead>
                    <tr class="bg-dark">
                    <th class="bg-success"  style="width: 20px">Q#{{$k}}</th>
                    <th >{{$question->question}} </th>   
                                 
                    </tr>
                  </thead>
                </tbody>
            </table>
           
            <input type="hidden" name="quiz_number" value="{{$quiz_number}}">
            <input type="hidden" name="subject_id" value="{{$subject_id}}">
            <input type="hidden" name="semester_id" value="{{$quiz->semester_id}}">
            <input type="hidden" name="section_id" value="{{$quiz->section_id}}">
          <input type="hidden" name="question{{$k}}" value="{{$question->id}}">
            <?php $option = explode(",,",$question->options);  ?>     
         
          <div class="form-check m-2 ml-5 ">
          <input type="radio" class="form-check-input" value="1" name="answer{{$k}}" >
          <label class="form-check-label" for="materialChecked2">{{$option[0]}}</label>
            </div>
            <div class="form-check m-2 ml-5 ">
              <input type="radio" class="form-check-input" value="2" name="answer{{$k}}" >
              <label class="form-check-label" for="materialChecked2">{{$option[1]}}</label>
                </div>
                <div class="form-check m-2 ml-5 ">
                  <input type="radio" class="form-check-input" value="3" name="answer{{$k}}" >
                  <label class="form-check-label" for="materialChecked2">{{$option[2]}}</label>
                    </div>
                    <div class="form-check m-2 ml-5 ">
                      <input type="radio" class="form-check-input" value="4" name="answer{{$k}}" >
                      <label class="form-check-label" for="materialChecked2">{{$option[3]}}</label>
                        </div>
          
   
              @endforeach
              <input type="hidden" name="number_of_question" value="{{$k}}">
              <button type="submit" class="btn btn-success  float-right mb-5">Submit and Save</button>
    </form>
 @endsection

 <script type="text/javascript"> 
  window.history.forward(); 
  function noBack() { 
      window.history.forward(); 
  } 
</script> 

<script>
  var end_time ="<?php echo $quiz->end_time ?>";
 
// Set the date we're counting down to
var countDownDate = new Date(end_time).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    SubmitFunction();
  }
}, 1000);


function SubmitFunction(){

document.getElementById('mcQuestion').submit();

}
</script>