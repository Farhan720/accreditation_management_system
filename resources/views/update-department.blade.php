@extends('layout')

@section('content')


  <div class="content-header pb-1">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0 text-dark">Update Department</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">{{$i=1}}Department</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">

    <form method="POST" action="{{ route('department.update',$department->id) }}">
        @method('PATCH')
        @csrf
        <div class="ml-4 mr-4">
          <div class="form-group">
            <div class="custom-file">
            <label for="exampleInputEmail1">Update Department Name</label>
            <input type="text" name="department_name" class="form-control" value="{{$department->department_name}}" id="exampleInputEmail1" placeholder="Enter Department Name" required>
            <button type="submit" class="btn btn-primary float-right mt-2">Update</button>
            </div>
            </div>
        </div>
    </form>


    <div class="card-body pt-5 mt-5 mr-4 ml-4 ">
        <table class="table">
            <thead class="bg-dark">
              <tr>
                <th style="width: 10px">#</th>
                <th>Semesters of Department</th>
                <th style="width: 40px">Update</th>
                <th style="width: 40px">Delete</th>
                <th style="width: 10px">
                    <a data-toggle="collapse" href="#collapseSemesters">
                    +
                    </a>
                </th>
              </tr>
            </thead>
            <tbody class="collapse" id="collapseSemesters">

            @foreach ($semesters as $semester)

            <tr class="bg-white">
                <td>{{$i++  }}</td>
                <td>Semester # &nbsp;{{$semester->semester_name  }}</td>

                <td>
                    <form action="/semester/{{$semester->id}}/edit" method="GET">

                        @csrf
                            <input type="submit" value="Update" class="btn btn-success">
                    </form>
                </td>
                <td>
                    <form action="/semester/{{$semester->id}}" method="POST">
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
        <div class="card-body pt-5 mt-0.5 mr-4 ml-4 ">
        <table class="table">
            <thead class="bg-dark">
              <tr>
                <th style="width: 10px">#</th>
                <th>Teachers of Department</th>
                <th style="width: 40px">Update</th>
                <th style="width: 40px">Delete</th>
                <th style="width: 10px">
                    <a data-toggle="collapse" href="#collapseTeachers">
                    +
                    </a>
                </th>
              </tr>
            </thead>
            <tbody class="collapse" id="collapseTeachers">

            @foreach ($teachers as $teacher)

            <tr class="bg-white">
                <td>{{$i++  }}</td>
                <td>&nbsp;{{$teacher->first_name  }}</td>

                <td>
                    <form action="/teacher/{{$teacher->id}}" method="POST">
                        @method('DELETE')
                        @csrf
                            <input type="submit" value="Update" class="btn btn-success">
                    </form>
                </td>
                <td>
                    <form action="/teacher/{{$teacher->id}}" method="POST">
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
        <div class="card-body pt-5 mt-0.5 mr-4 ml-4 ">
            <table class="table">
                <thead class="bg-dark">
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Subjects of Department</th>
                    <th style="width: 40px">Update</th>
                    <th style="width: 40px">Delete</th>
                    <th style="width: 10px">
                        <a data-toggle="collapse" href="#collapseSubjects">
                        +
                        </a>
                    </th>
                  </tr>
                </thead>
                <tbody class="collapse" id="collapseSubjects">


                    @foreach ($subjects as $subject)
                <tr class="bg-white">
                    <td>{{$i++  }}</td>
                    <td>&nbsp;{{$subject->subject_name  }}</td>

                    <td>
                        <form action="/subject/{{$subject->id}}" method="POST">
                            @method('DELETE')
                            @csrf
                                <input type="submit" value="Update" class="btn btn-success">
                        </form>
                    </td>
                    <td>
                        <form action="/subject/{{$subject->id}}" method="POST">
                            @method('DELETE')
                            @csrf
                                <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                  </tr>

                  @endforeach
                  {{-- <tr class="col-12 float-center">
                    <td>
                        {{$subjects->links()}}
                    </td>
                </tr> --}}
            </tbody>
            </table>
            </div>
  </section>

@endsection

