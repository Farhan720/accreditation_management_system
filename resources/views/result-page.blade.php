@extends('layout')

@section('content')

  <!-- Content Header (Page header) -->
  
  <section class="content bg-white">
  
<div class="" style="padding:20% 0 25% 35%">
    <h1 class="text-danger " >Congartulations</h1>
    <h3 style="margin-left:3%">You Got <span class="text-success">{{$total}}</span> Marks</h3>
</div>

      
     
    
     

 @endsection

 <script type="text/javascript"> 
  window.history.forward(); 
  function noBack() { 
      window.history.forward(); 
  } 
</script> 