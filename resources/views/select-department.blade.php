@extends('layout')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header pb-1">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class=" text-dark ">Select Department</h4>
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
                  <th>Department name</th>
                  <th style="width: 40px">Update</th>
                  <th style="width: 40px">Delete</th>
                  <th style="width: 40px">Rights</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($departments as $department)

                    <tr class="bg-white">
                      <td>{{$i++  }}</td>
                      <td><i class="fas fa-book"></i>&nbsp;{{$department->department_name  }}</td>

                      <td>
                          <form action="/department/{{$department->id}}/edit" method="GET">
                              @method('PATCH')
                              @csrf
                                  <input type="submit" value="Update" class="btn btn-success">
                          </form>
                      </td>
                      <td>
                          <form action="/departmetn/{{$department->id}}" method="POST">
                              @method('DELETE')
                              @csrf
                                  <input type="submit" value="Delete" class="btn btn-danger">
                          </form>
                      </td>
                      <td>
                        <form action="/assignsubject/{{$department->id}}" method="POST">
                            @method('GET')
                            @csrf
                                <input type="submit" value="Assign Subject" class="btn btn-primary">
                        </form>
                    </td>
                      
                    </tr>
              @endforeach
          </tbody>
      </table>
        
 @endsection

