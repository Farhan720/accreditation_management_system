@extends('layout')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header pb-1">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class=" text-dark ">List Of Teaching Subjects</h4>
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
  

      

          <table class="table ">
              <thead class="bg-secondary">
                <tr style="width: 100%">
                  <th style="width: 5%">#</th>
                  <th style="width: 15%">Subject name</th>
                  <th style="width: 10%">Semester</th>
                  <th style="width: 60%">Section</th>
                  {{-- <th style="width: 10%">Delete</th>
                  <th style="width: 10%">Rights</th> --}}
                </tr>
              </thead>
              <tbody>
                  @foreach ($data as $detail)

                    <tr  class="bg-white">
                      <td>{{$i++  }}</td>
                      <td><i class="fas fa-book"></i>&nbsp;{{$detail->subject_name  }}</td>
                      <td>&nbsp;{{$detail->semester_name  }}</td>
                      <td>&nbsp;{{$detail->section_name  }}</td>

                      {{-- <td>
                          <form action="/assignedsubject/{{$detail->id}}/edit" method="GET">
                              @method('PATCH')
                              @csrf
                                  <input type="submit" value="Update" class="btn btn-success">
                          </form>
                      </td>
                      <td>
                          <form action="/assignedsubject/{{$detail->id}}" method="POST">
                              @method('DELETE')
                              @csrf
                                  <input type="submit" value="Delete" class="btn btn-danger">
                          </form>
                      </td> --}}
                     
                      
                    </tr>
              @endforeach
          </tbody>
      </table>
        
 @endsection

