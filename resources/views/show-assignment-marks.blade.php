@extends('layout')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header pb-1">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class=" text-dark ">Assignment Marks</h4>
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
  

      

          <table class="table">
              <thead class="bg-dark">
                <tr>
                    <th style="width: 10px">#</th>
                   
                 
                    <th>Assignment </th>
                    
                    <th>Obtained Marks</th>
                   
                </tr>
              </thead>
              <tbody>
                  @foreach ($data as $assignment)
                  
                    <tr class="bg-white">
                      <td>{{$i++  }}</td>
                     
                      
                      <td><a class='pb-8 text-dark'><i class='fas fa-file-download'></i>&nbsp;{{$assignment->name}}</a></td>
                     
                      <td>{{$assignment->obtained_marks}}</td>
                    
                   
                   
                      
                    </tr>
              @endforeach
          </tbody>
      </table>
        
 @endsection

