@extends('layout')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header pb-1">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0 text-dark">Add Department</h4>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">{{$i=1}}Department</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">

    <form method="POST" action="{{ route('department.store') }}">
        @csrf
        <div class="ml-4 mr-4">
          <div class="form-group">
            <div class="custom-file">
            <label for="exampleInputEmail1">Enter Department Name</label>
            <input type="text" name="department_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Department Name" required>
            <button type="submit" class="btn btn-primary float-right mt-2">Add</button>
            </div>
        </div>
        </div>
    </form>
        <div class="card-body pt-5 mt-5 mr-4 ml-4">
        <table class="table">
            <thead class="bg-dark  ">
              <tr>
                <th style="width: 10px">#</th>
                <th>Department</th>
                <th style="width: 40px">Update</th>
                <th style="width: 40px">Delete</th>
              </tr>
            </thead>
            <tbody>

            @foreach ($departments as $department)

            <tr class="bg-white">
                <td>{{$i++  }}</td>
                <td>&nbsp;{{$department->department_name }}</td>

                <td>
                    <form action="/department/{{$department->id}}/edit" method="GET">

                        @csrf
                            <input type="submit" value="Update" class="btn btn-success">
                    </form>
                </td>
                <td>
                    <form action="/department/{{$department->id}}" method="POST">
                        @method('DELETE')
                        @csrf
                            <input type="submit" value="Delete" class="btn btn-danger">
                    </form>
                </td>
              </tr>

            @endforeach
        </tbody>
    </table>
        </div>
  </section>

@endsection

