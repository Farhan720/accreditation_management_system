<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Accridetation System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet"  href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}" >
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}" >
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </ul>

     <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <a class="dropdown-item" href="{{ route('changePasword') }}"
                onclick="event.preventDefault();
                                document.getElementById('change-password-form').submit();">
                {{ __('Change Password') }}
            </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <form id="change-password-form" action="{{ route('changePasword') }}" method="GET" style="display: none;">
                  @csrf
              </form>
            </div>
        </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{url('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Accridetation System</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src={{url('dist/img/user2-160x160.jpg')}} class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                 <!-- log file -->
                 <li class="nav-item bg-blue ">
                  <a href="{{ route('home') }}" class="nav-link ">
                    <i class="nav-icon fas fas fa-file"></i>
                    <p>
                      Dashboard
                      <i class=""></i>
                    </p>
                  </a>
                </li>
            <li class="nav-item  ">
              <a  href="{{ route('logfile.index') }}" class="nav-link ">
                <i class="nav-icon fas fas fa-file"></i>
                <p>
                  Log Files
                  <i class=""></i>
                </p>
              </a>
            </li>
              <!-- end log files -->

              <!-- Description Files -->
            <li class="nav-item ">
              <a href="{{ route('descriptionfile.index') }}" class="nav-link ">
                <i class="nav-icon fas fa-file"></i>
                <p>
                  Description Files
                  <i class=""></i>
                </p>
              </a>
            </li>
            <!-- end descriptin     -->

            <!-- Content  Files -->
            <li class="nav-item ">
              <a href="{{ route('contentfile.index') }}" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>
                  Content Files
                  <i class=""></i>
                </p>
              </a>
            </li>
            @if(Auth::user()->type == 'student')
            <li class="nav-item ">
              <a href="{{ route('enrollsubject.show',Auth::user()->user_id) }}" class="nav-link">
                <i class="nav-icon fas fa-folder-plus"></i>
                <p>
                 Enroll Subject
                  <i class=""></i>
                </p>
              </a>
          </li>
          <li class="nav-item ">
            <a href="{{ route('uploadassignment.show',Auth::user()->user_id) }}" class="nav-link">
              <i class="nav-icon fas fa-folder-plus"></i>
              <p>
              Upload Assignment
                <i class=""></i>
              </p>
            </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('uploadassignment.showAssignmentMarks',Auth::user()->user_id) }}" class="nav-link">
            <i class="nav-icon fas fa-folder-plus"></i>
            <p>Assignment Marks</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('quiz.showSubject',Auth::user()->user_id) }}" class="nav-link">
            <i class="nav-icon fas fa-folder-plus"></i>
            <p>Start Quiz</p>
          </a>
        </li>
          @endif
            <!-- end Content     -->
            @yield('sidebar')
            @if(Auth::user()->type == 'admin')
           {{-- admin --}}
           <li class="nav-item  ">
            <a  href="{{ route('subject.create') }}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
               Add Subject
                <i class=""></i>
              </p>
            </a>
        </li>
        <li class="nav-item  ">
            <a  href="{{ route('section.create') }}" class="nav-link ">
              <i class="nav-icon fas fa-plus-circle"></i>
              <p>
               Add Section
                <i class=""></i>
              </p>
            </a>
        </li>
        <li class="nav-item ">
            <a  href="{{ route('semester.create') }}" class="nav-link ">
              <i class="nav-icon fas fa-plus-circle"></i>
              <p>
               Add Semester
                <i class=""></i>
              </p>
            </a>
        </li>

        <li class="nav-item  ">
            <a  href="{{ route('subject.index') }}" class="nav-link">
              <i class="nav-icon fas fa-folder-plus"></i>
              <p>
               Add Files
                <i class=""></i>
              </p>
            </a>
        </li>
        <li class="nav-item  ">
            <a  href="{{ route('department.create') }}" class="nav-link">
              <i class="nav-icon fas fa-folder-plus"></i>
              <p>
               Add Department
                <i class=""></i>
              </p>
            </a>
        </li>
        <li class="nav-item ">
            <a  href="{{ route('teacher.create') }}" class="nav-link">
              <i class="nav-icon fas fa-folder-plus"></i>
              <p>
               Add Teacher
                <i class=""></i>
              </p>
            </a>
        </li>
        <li class="nav-item ">
          <a  href="{{ route('student.create') }}" class="nav-link">
            <i class="nav-icon fas fa-folder-plus"></i>
            <p>
             Add Student
              <i class=""></i>
            </p>
          </a>
      </li>
        <li class="nav-item ">
            <a  href="{{ route('assignsubject.index') }}" class="nav-link">
              <i class="nav-icon fas fa-folder-plus"></i>
              <p>
               Assign Subject
                <i class=""></i>
              </p>
            </a>
        </li>
       

        {{-- <li class="nav-item has-treeview ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Quizzes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="generatequiz" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Generate Quiz</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Quiz</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Start Quiz</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Quiz</p>
                </a>
              </li>
            </ul>
          </li>

        
          <!-- Exam Management -->

          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Mid Exam
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Upload Ppaer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Ppaer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mark & update Ppaer</p>
                </a>
              </li>

            </ul>
          </li>
           <!-- Mid Exam end -->

        <!-- Final Exam Management     -->

        <li class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Fianl Exam
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Upload Ppaer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Ppaer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mark & update Ppaer</p>
                </a>
              </li>

            </ul>
          </li> --}}

        <!-- End Final -->

            @endif

            @if(Auth::user()->type == 'teacher')




<li class="nav-item has-treeview ">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-tachometer-alt"></i>
      <p>
        Quizzes
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('quiz.show',Auth::user()->user_id) }}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Generate Quiz</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('quiz.showAssignSubject',Auth::user()->user_id) }}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Update Quiz</p>
        </a>
      </li>
     
      <li class="nav-item">
        <a href="{{ route('quizanswer.show',Auth::user()->user_id) }}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>View Quiz</p>
        </a>
      </li>
    </ul>
  </li>

 <!-- assignmnet management -->

 <li class="nav-item has-treeview ">
    <a href="#" class="nav-link ">
      <i class="nav-icon fas fa-tachometer-alt"></i>
      <p>
        Assignments
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">

      <li class="nav-item">
        <a href="{{ route('assignment.show',Auth::user()->user_id) }}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Upload Assignment</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('uploadassignment.showUploadedAssignment',Auth::user()->user_id) }}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Mark Assignment</p>
        </a>
      </li>
     
    </ul>
  </li>

 <!-- assignmnet end -->

  <!-- Exam Management -->

  <li class="nav-item has-treeview ">
    <a href="#" class="nav-link ">
      <i class="nav-icon fas fa-tachometer-alt"></i>
      <p>
        Exams
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">

      <li class="nav-item">
        <a href="{{ route('uploadexam.selectSubject',Auth::user()->user_id) }}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Upload Exam</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('uploadexam.show',Auth::user()->user_id) }}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>View/Update Exam</p>
        </a>
      </li>
      

    </ul>
  </li>
   <!-- Mid Exam end -->

<!-- Final Exam Management     -->

    
  </li>

<!-- End Final -->

            @endif

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @include('flash-message')
    @yield('content')
  </div>
  <!-- /.content-wrapper -->
  {{-- <footer class="main-footer text-center ">
    <strong>Copyright &copy; 2016-2020 <a href="https://superior.edu.pk/" target="_blank">Superior.edu</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
    </div>
  </footer> --}}

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
{{-- <script src="plugins/jquery/3.4.1jquery.min.js"></script> --}}
<!-- jQuery -->
<script href="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script href="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script href="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script href="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script href="{{asset('plugins/sparklines/sparkline.js')}}" ></script>
<!-- JQVMap -->
<script href="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script href="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script href="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script href="{{asset('plugins/moment/moment.min.js')}}" ></script>
<script href="{{asset('plugins/daterangepicker/daterangepicker.js')}}" ></script>
<!-- Tempusdominus Bootstrap 4 -->
<script href="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}" ></script>
<!-- Summernote -->
<script href="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script href="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}" ></script>
<!-- AdminLTE App -->
<script href="{{asset('dist/js/adminlte.js')}}" ></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script href="{{asset('dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script href="{{asset('dist/js/demo.js')}}" ></script>
</body>
</html>
<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/plugins/moment/moment.min.js"></script>
<script src="/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>
<script>

    $(document).ready(function(){
        $('.nav-item').click(function(){
        $(this).css('background-color','blue');
    });
    });
    </script>
</body>
</html>
