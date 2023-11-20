@extends('layout')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header pb-1">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0 text-dark">Add Description File</h4>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">{{$i=1}}Description File</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">

        <form method="POST" action="{{ route('descriptionfile.store') }}" enctype="multipart/form-data">
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

{{--
            @foreach ($descriptionfiles as $descriptionfile)
              <div class="col-md-3 col-sm-6 col-12 float-left mt-4">
                  <a class="pb-8" href="{{$descriptionfile->path  }} "><div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-file-download"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text mt-2">{{$descriptionfile->name  }}</span>

                    </div>
                  </div>
                </a>
              </div>
            @endforeach --}}

        </form>

        <div class="card-body pt-5 mt-5 mr-4 ml-4">
            <table class="table">
                <thead class="bg-white">
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Description Files</th>
                    <th style="width: 40px">Action</th>
                  </tr>
                </thead>
                <tbody>

                {{-- @foreach ($subjects as $subject)
                       @if($subject->descriptionFile)

                      <tr>
                        <td>{{$i++  }}</td>
                        <td><a class="pb-8 text-dark" href="{{'/'.$subject->descriptionFile->path }} " download><i class="far fa-file-word"></i>&nbsp;{{$subject->descriptionFile->name }}</a></td>

                        <td>
                            <form action="/descriptionfile/{{$subject->descriptionFile->id}}" method="POST">
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

  </section>
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
@endsection

