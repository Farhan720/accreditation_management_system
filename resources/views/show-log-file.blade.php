@extends('layout')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header pb-1">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0 text-dark">Download Log File</h4>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Log File</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">


            @foreach ($logFiles as $logFile)
              <div class="col-md-3 col-sm-6 col-12 float-left mt-5">
                  <a class="pb-8" href="{{$logFile->path  }} " download><div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-file-download"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text mt-2">{{$logFile->name  }}</span>

                    </div>
                  </div>
                </a>
              </div>
            @endforeach


  </section>

@endsection

