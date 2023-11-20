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
                  <th style="width: 10%">Log</th>
                  <th style="width: 10%">Description</th>
                  <th style="width: 10%">Content</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($data as $detail)

                    <tr  class="bg-white">
                      <td>{{$i++  }}</td>
                      <td><i class="fas fa-book "></i>&nbsp;{{$detail->subject_name  }}</td>
                      <td>&nbsp;{{$detail->semester_name  }}</td>
                      <td>&nbsp;{{$detail->section_name  }}</td>

                      <td>
                          <form action="{{ route('logfile.index') }}" method="GET">
                              @method('PATCH')
                              @csrf
                                  <input type="submit" value="Log File" class="btn btn-success">
                          </form>
                      </td>
                      <td>
                        <form action="{{ route('descriptionfile.index') }}" method="GET">
                            @method('PATCH')
                              @csrf
                                  <input type="submit" value="Description File" class="btn btn-danger">
                          </form>
                      </td>
                      <td>
                        <form action="{{ route('contentfile.index') }}" method="GET">
                            @method('PATCH')
                            @csrf
                                <input type="submit" value="Content File" class="btn btn-primary">
                        </form>
                    </td>
                      <td>
                       
                    </td>
                      
                    </tr>
              @endforeach
          </tbody>
      </table>
        
 @endsection

