@extends('layout')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header pb-1">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class=" text-dark ">Upload Exam Marks and file</h4>
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
                    <th>Enter Obtained Marks</th>
                    
                    <th>Chose Exame Files</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($enroll_subjects as $enroll_subject)
                  <?php $student = App\Student::find($enroll_subject->student_id); ?>
                    <tr class="bg-white">
                      <td>{{$i++  }}</td>
                      <td>{{"F17-".$student->id}}</td>
                      <td>{{$student->first_name." ".$student->last_name}}</td>
                      {{-- <td><a class='pb-8 text-dark' href='{{$assignment->path }}' download><i class='fas fa-file-download'></i>&nbsp;{{$assignment->name}}</a></td> --}}
                      <form action="{{ route('uploadexam.store')}}" method="POST" enctype="multipart/form-data">
                       
                           @csrf
                      <td> <input  type='number' name='obtained_marks' id='obtained_marks' required ></td>
                      <td> <input  type='file' name='photos[]' id='photos' multiple ></td>
                      <td>
                          
                          <input type="hidden" name="student_id" value="{{$enroll_subject->student_id}}">
                          <input type="hidden" name="subject_id" value="{{$enroll_subject->subject_id}}">
                          <input type="hidden" name="semester_id" value="{{$enroll_subject->semester_id}}">
                          <input type="hidden" name="section_id" value="{{$enroll_subject->section_id}}">
                          <input type="hidden" name="exam_type" value="{{$exam_type}}">
                                  <input type="submit" value="Submit Result" class="btn btn-success">
                          
                      </td>
                    </form>
                    </td>
                      
                    </tr>
              @endforeach
          </tbody>
      </table>
        
 @endsection

