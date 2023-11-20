@extends('layout')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header pb-1">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0 text-dark">Add Files</h4>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add File</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
      <a href="{{ route('logfile.create') }}"><button type="button" class="btn btn-flat btn-primary mr-3"><i class="fas fa-plus"></i> New Log File</button></a>
      <a href="{{ route('contentfile.create') }}"><td><button type="button" class="btn btn-flat btn-primary mr-3"><i class="fas fa-plus"></i> New Content File</button></a>
      <a href="{{ route('descriptionfile.create') }}"><td><button type="button" class="btn btn-flat btn-primary mr-3"><i class="fas fa-plus"></i> New Description File</button></a>

  </section>

@endsection

