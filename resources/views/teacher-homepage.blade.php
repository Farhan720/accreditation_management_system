
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1 class="m-0 text-dark">Teacher Dashboard</h1>


          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

          <!-- ./col -->
           <!-- ./col -->
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>Subjects</h3>

                {{-- <p>Subjects</p> --}}
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              
              <a href="{{ route('teacher.show',Auth::user()->user_id) }}" class="bg-primary small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
           <!-- ./col -->
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>Assignments</h3>

                {{-- <p>Final Exam</p> --}}
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ route('assignment.showAssignment',Auth::user()->user_id) }}" class=" bg-primary small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>Quizzes</h3>

                {{-- <p>Final Exam</p> --}}
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              

              <a href="{{ route('quizanswer.show',Auth::user()->user_id) }}" class=" bg-primary small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>





