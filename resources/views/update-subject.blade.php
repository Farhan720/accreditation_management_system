@extends('layout')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header pb-1">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0 text-dark ">Update Subject</h4>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"> <?php $i=1 ?>Update Subject</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
      <form method="POST" action="{{ route('subject.update',$subject->id) }}">
        @method('PATCH')
        @csrf
          <div class="ml-4 mr-4">
              <label>Change Department</label>
              <select class="form-control select2"  name="department_id" required>
              <option value = ""  selected="selected">-----Select Subject----</option>

              @foreach ($departments as $department)
              <option value="{{$department->id}}" {{$subject->department_id == $department->id ? "selected":''}}>{{$department->department_name}}</option>
              @endforeach
              <input type="hidden" value="{{$department->name}}" name="book_name">
              </select>
              <label>Change Semester</label>
              <select class="form-control select2"  name="semester_id" required>
              <option value = ""  selected="selected">-----Select Semester----</option>

              @foreach ($semesters as $semester)
              <option value="{{$semester->id}}" {{$subject->semester_id == $semester->id ? "selected":''}}>Semester {{$semester->semester_name}}</option>
              @endforeach
              <input type="hidden" value="{{$department->name}}" name="book_name">
              </select>
              {{-- <label>Change Section</label>
              <select class="form-control select2"  name="section_id" required>
              <option value = ""  selected="selected">-----Select Subject----</option>

              @foreach ($sections as $section)
              <option value="{{$section->id}}" {{$subject->section_id == $section->id ? "selected":''}}>{{$section->section_name}}</option>
              @endforeach --}}
              {{-- <input type="hidden" value="{{$department->name}}" name="book_name"> --}}
              {{-- </select> --}}

            <div class="form-group">
              <div class="custom-file">
              <label for="exampleInputEmail1">Change Subject Name</label>
              <input type="text" name="subject_name" value="{{$subject->subject_name}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Subject" required>
              <button type="submit" class="btn btn-primary float-right mt-2">Update</button>
              </div>
          </div>
          </div>
      </form>




@endsection

