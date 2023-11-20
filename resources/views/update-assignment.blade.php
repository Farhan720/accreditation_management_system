@extends('layout')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header pb-1">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class=" text-dark ">Upload/Update Marks</h4>
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
                    <th>Roll #</th>
                    <th>Student Name</th>
                    <th>Assignment Download</th>
                    
                    <th>Obtained Marks</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($assignments as $assignment)
                  <?php $student = App\Student::find($assignment->student_id); ?>
                    <tr class="bg-white">
                      <td>{{$i++  }}</td>
                      <td>{{"F17-".$student->id}}</td>
                      <td>{{$student->first_name." ".$student->last_name}}</td>
                      <td><a class='pb-8 text-dark' href='{{$assignment->path }}' download><i class='fas fa-file-download'></i>&nbsp;{{$assignment->name}}</a></td>
                      <form action="{{ route('uploadassignment.update',$assignment->id)}}" method="POST">
                        @method('PATCH')
                           @csrf
                      <td> <input  type='number' name='obtained_marks' id='obtained_marks' value="{{$assignment->obtained_marks}}" ></td>
                      <td>
                          
                          {{-- <input type="hidden" name="assignment_detail" value="{{$assignment}}"> --}}
                                  <input type="submit" value="Update" class="btn btn-success">
                          
                      </td>
                    </form>
                    </td>
                      
                    </tr>
              @endforeach
          </tbody>
      </table>
        
 @endsection

