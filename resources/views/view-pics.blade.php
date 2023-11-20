@extends('layout')

@section('content')

<div class="container">
  
       
  
    <div class="row  pl-5 p-2">
        @foreach ($exampics as $exampic)
       
      <div class="bg-danger m-4">
        <div class="img-rounded">
          <a href="{{url($exampic->path)}}" target="_blank">
            <img src="{{$exampic->path}}" alt="Lights" width="200rem" height="100rem" download>
            <div class="caption mt-1 ">
                <a class=" bg-dark p-1" href="{{$exampic->path}}" download>Donload</a>
            </div>
          </a>
        </div>
      </div>
   
      @endforeach
    </div>
    
  </div>
        
 @endsection

