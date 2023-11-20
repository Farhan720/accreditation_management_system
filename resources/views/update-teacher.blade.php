@extends('layout')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header pb-1">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0 text-dark ">Update Teacher</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"> {{$i=1}}Update Teacher</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
      <form method="POST" action="{{ route('teacher.update',$teacher->id) }}">
        @method('PATCH')
          @csrf
          <table>
              <div class="row">
                <div class="ml-4 mr-4 col-lg-5 float-left">
                    First Name
                <input type="text" name="first_name" value="{{$teacher->first_name}}" class="form-control mb-2" placeholder="First Name" required>
                    </div>

                    <div class="ml-4 mr-4 col-lg-5 float-left">
                    Last Name
                    <input type="text" name="last_name" value="{{$teacher->last_name}}" class="form-control mb-2"  placeholder=" Last Name" required>
                    </div>

                    <div class="ml-4 mr-4 col-lg-5 float-left">
                    Email
                    <input type="email" name="email" value="{{$teacher->email}}" class="form-control mb-2"  placeholder="Email" required>
                    </div>

                    <div class="ml-4 mr-4 col-lg-5 float-left">
                    Cell Number
                    <input type="number" name="cell" value="{{$teacher->cell}}" class="form-control mb-2"  placeholder="Cell Number" required>
                    </div>

                    <div class="ml-4 mr-4 col-lg-5 float-left">
                    Qualification
                    <input type="text" name="qualification" value="{{$teacher->qualification}}" class="form-control mb-2"  placeholder="Qualification" required>
                    </div>

                    <div class="ml-4 mr-4 col-lg-5 float-left">
                     Address
                    <input type="text" name="address" value="{{$teacher->address}}" class="form-control mb-2"  placeholder="Address" required>
                    </div>

                    <div class="ml-4 mr-4 col-lg-5 float-left">
                    Department
                    <select class="form-control select2" style="width: 100%;" name="department_id" required>
                        <option value = ""  selected="selected">-----Select Subject----</option>

                        @foreach ($departments as $department)
                        <option value="{{$department->id}}" {{$teacher->department_id == $department->id ? 'selected': ''}}>{{$department->department_name}}</option>
                        @endforeach

                    </select>
                    </div>

                     <div class="ml-4 mr-4 col-lg-5 float-left">
                     <button type="submit" class="btn btn-primary float-right mt-4 pl-5 pr-5">Update</button>
                    </div>

              </div>
          </table>

      </form>

  </section>

@endsection

