@extends('layout')

@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header pb-1">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0 text-dark">Add Assignment </h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">{{$i=1}}Add contetn file</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">

        <form method="POST" action="{{ route('assignment.store') }}" enctype="multipart/form-data">
          @csrf
            <div class="ml-4 mr-4 ">
             
              <div class="form-group mt-2">
                Select Subject
                <select class="form-control select2" name="assignment_detail" id="subject_id" required>
                <option value = ""  selected="selected">-----Select Subject----</option>
                @foreach ($data as $detail)
                <option value = "{{$detail->department_id}},{{$detail->teacher_id}},{{$detail->subject_id}},{{$detail->semester_id}},{{$detail->section_id}}"> 
                  {{$detail->subject_name}}&nbsp; ({{$detail->semester_name}}{{$detail->section_name}})</option>
                {{-- <input type="hidden" name="assign_subject_id" value="{{$detail->id}}"> --}}
                @endforeach
                </select>
              </div>
              <div class="form-group ">
              Assignment #
              <select class="form-control select2 dynamic"
              name="assignment_number" id="assignment_number"  required>
                  <option value = "" >-----Select Assignmet Number----</option>

                  <option value="1">Assignment # 1</option>
                  <option value="2">Assignment # 2</option>
                  <option value="3">Assignment # 3</option>
                  <option value="4">Assignment # 4</option>
                 

              </select>
              </div>
                <div class="form-group ">
                   Select file
                    <div class="custom-file">
                    <input type="file" name="name" class="custom-file-input" id="customFile" required>
                    <label class="custom-file-label" for="customFile">Choose file</label>
                    <div class="form-group mt-4 w-100">
                      <label class="mr-5" >Last Date</label> 
                      <input class=" mr-5" type="date" name="date" id=""  required>
                      <label class="mr-5" >Time</label>
                      <input  type="time" name="time" id=""  required>
                      <label class="ml-5" >Total Marks</label>   
                      <input class="ml-5" type="number" name="assignment_marks" id=""  required>
                     </div>
                     <div class="form-group mt-2 ">
                      <button type="submit" class="btn btn-primary float-right mt-2">Submit</button>
                     </div>
                    
                    </div>
                </div>
            </div>

        </form>
        {{-- <div class="card-body pt-5 mt-5 mr-4 ml-4">
            <table class="table">
                <thead class="bg-white">
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Content Files</th>
                    <th style="width: 40px">Action</th>
                  </tr>
                </thead>
                <tbody> --}}
                {{-- @foreach ($subjects as $subject)
                    @if ($subject->contentFile)

                      <tr>
                        <td>{{$i++  }}</td>
                        <td><a class="pb-8 text-dark" href="{{'/'.$subject->contentfile->path  }} " download><i class="far fa-file-word"></i>&nbsp;{{$subject->contentfile->name  }}</a></td>

                        <td>
                            <form action="/contentfile/{{$subject->contentfile->id}}" method="POST">
                                @method('DELETE')
                                @csrf
                                    <input type="submit" value="Delete" class="btn btn-danger">
                            </form>
                        </td>
                      </tr>

                      @endif

                @endforeach --}}
            {{-- </tbody>
        </table>
            </div> --}}

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

