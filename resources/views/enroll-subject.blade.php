@extends('layout')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header pb-1">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0 text-dark ">Enroll Subject</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"> Assign Subject</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
      <form method="POST" action="{{ route('enrollsubject.store') }}">
          @csrf
        <div class="ml-4 mr-4">
                Select Semester
                <select class="form-control select2 dynamic " style="width: 100%;"
                name="semester_id" id="semester_id" value="section_id" data-dependent="section_id" required>
                    <option value = "" >-----Select Semester----</option>

                    @foreach ($semesters as $semester)
                    <option value="{{$semester->id}}">{{"Semester ".$semester->semester_name}}</option>
                    @endforeach

                </select>
            <div class="form-group mt-2">
                Select Section
                <select class="form-control select2 dynamic1" style="width: 100%;"
                name="section_id" id="section_id" value=""  required>
                    <option value = "" >-----Select Section----</option>
                    
                </select>
            </div>
            <div class="form-group mt-2">
                Select Subject
                <select class="form-control select2 " style="width: 100%;"
                name="subject_id" id="subject_id" value=""  required>
                    <option value = "" >-----Select Subject----</option>
                </select>
            </div>
            

            <div class="form-group ">
                <input type="hidden" name="student_id" value=" {{ Auth::user()->user_id }}">
                    <button type="submit" class="btn btn-primary float-right mt-2" >Submit</button>
            </div>
        </div>

      </form>
      
   
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){

            $('.dynamic').change(function(){
            if($(this).val() != '')
            {

            var select = $(this).attr("id");

            var value = $(this).val();

            var dependent = $(this).data('dependent');

            var _token = $('input[name="_token"]').val();
            $.ajax({
            url:"{{ route('section.fetch') }}",
            method:"POST",
            data:{select:select, value:value, _token:_token, dependent:dependent},
            success:function(result)
            {
                $('#'+dependent).html(result);
            }

            })
            
            }
            });
            // for subjects
            $('.dynamic1').change(function(){
            if($(this).val() != '')
            {

            var select = "semester_id";

            var value = $('#semester_id').val();

            
            var _token = $('input[name="_token"]').val();
            $.ajax({
            url:"{{ route('subject.fetch') }}",
            method:"POST",
            data:{select:select, value:value, _token:_token},
            success:function(result)
            {
              $('#subject_id').html(result);
            }

            })
            
            }
            });

        });

    </script>
               @endsection

