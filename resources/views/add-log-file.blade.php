@extends('layout')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header pb-1">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0 text-dark">Add Log File</h4>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">{{$i=1}}Log File</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">

        <form method="POST" action="{{ route('logfile.store') }}" enctype="multipart/form-data">
          @csrf
            <div class="ml-4 mr-4 ">
              Select Department
              <select class="form-control select2 dynamic"
              name="department_id" id="department_id" data-dependent="subject_id" required>
                  <option value = "" >-----Select Department----</option>

                  @foreach ($departments as $department)
                  <option value="{{$department->id}}">{{$department->department_name}}</option>
                  @endforeach

              </select>
              <div class="form-group mt-2">
                Select Subject
                <select class="form-control select2" name="subject_id" id="subject_id" required>
                <option value = ""  selected="selected">-----Select Subject----</option>

                
                </select>
              </div>
                <div class="form-group ">
                   Select file
                    <div class="custom-file">
                    <input type="file" name="name" class="custom-file-input" id="customFile" required>
                    <label class="custom-file-label" for="customFile">Choose file</label>
                    <button type="submit" class="btn btn-primary float-right mt-2">Submit</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="card-body pt-5 mt-5 mr-4 ml-4">
        <table class="table">
            <thead class="bg-white">
              <tr>
                <th style="width: 10px">#</th>
                <th>Log Files</th>
                <th style="width: 40px">Action</th>
              </tr>
            </thead>
            <tbody>

            {{-- @foreach ($subjects as $subject)
            @if($subject->logFile)
                  <tr>
                    <td>{{$i++  }}</td>
                    <td><a class="pb-8 text-dark" href="{{'/'.$subject->logFile->path  }} " download><i class="far fa-file-word"></i>&nbsp;{{$subject->logFile->name  }}</a></td>

                    <td>
                        <form action="/logfile/{{$subject->logFile->id}}" method="POST">
                            @method('DELETE')
                            @csrf
                                <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                  </tr>
                  @endif
            @endforeach --}}
        </tbody>
    </table>
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
            url:"{{ route('subject.fetch') }}",
            method:"POST",
            data:{select:select, value:value, _token:_token},
            success:function(result)
            {
                $('#'+dependent).html(result);
            }

            })
            }
            });

        });

    </script>
  </section>
 
@endsection

