@extends('layout')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header pb-1">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0 text-dark ">Add New Student</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"> <?php $i=1 ?>Add Student</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
      <form method="POST" action="{{ route('student.store') }}">
          @csrf
          <table>
              <div class="row">
                <div class="ml-4 mr-4 col-lg-5 float-left">
                    First Name
                    <input type="text" name="first_name" class="form-control mb-2" placeholder="First Name" required>
                    </div>

                    <div class="ml-4 mr-4 col-lg-5 float-left">
                    Last Name
                    <input type="text" name="last_name" class="form-control mb-2"  placeholder=" Last Name" required>
                    </div>

                    <div class="ml-4 mr-4 col-lg-5 float-left">
                    Email
                    <input type="email" name="email" class="form-control mb-2"  placeholder="Email" required>
                    </div>

                    <div class="ml-4 mr-4 col-lg-5 float-left">
                    Cell Number
                    <input type="number" name="cell" class="form-control mb-2"  placeholder="Cell Number" required>
                    </div>

                    <div class="ml-4 mr-4 col-lg-5 float-left">
                    Qualification
                    <input type="text" name="qualification" class="form-control mb-2"  placeholder="Qualification" required>
                    </div>

                    <div class="ml-4 mr-4 col-lg-5 float-left">
                     Address
                    <input type="text" name="address" class="form-control mb-2"  placeholder="Address" required>
                    </div>

                    <div class="ml-4 mr-4 col-lg-5 float-left">
                    Department
                    <select class="form-control select2" style="width: 100%;" name="department_id" required>
                        <option value = ""  selected="selected">-----Select Department----</option>

                        @foreach ($departments as $department)
                        <option value="{{$department->id}}">{{$department->department_name}}</option>
                        @endforeach

                    </select>
                    </div>

                     <div class="ml-4 mr-4 col-lg-5 float-left">
                     <button type="submit" class="btn btn-primary float-right mt-4 pl-5 pr-5">Save</button>
                    </div>

              </div>
          </table>

      </form>

      <div class="card-body pt-5 mt-5 mr-4 ml-4">

        <table class="table">
            <thead class="bg-dark">
              <tr>
                <th style="width: 10px">#</th>
                <th>Subject name</th>
                <th style="width: 40px">Update</th>
                <th style="width: 40px">Delete</th>
                <th style="width: 40px">Rights</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)

                  <tr class="bg-white">
                    <td>{{$i++  }}</td>
                    <td>{{$student->first_name  }}</td>

                    <td>
                        <form action="/student/{{$student->id}}/edit" method="GET">
                            @method('PATCH')
                            @csrf
                                <input type="submit" value="Update" class="btn btn-success">
                        </form>
                    </td>
                    <td>
                        <form action="/student/{{$student->id}}" method="POST">
                            @method('DELETE')
                            @csrf
                                <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                    <td>
                      <form  action="{{ route('student.assignLogin') }}" method="POST">
                       
                          @csrf
                              <input type="hidden" name="id" value="{{$student->id}}">
                              <input type="submit" value="Allow Login" class="btn btn-primary">
                      </form>
                  </td>
                  </tr>
            @endforeach
        </tbody>
    </table>
        </div>
  </section>

@endsection

