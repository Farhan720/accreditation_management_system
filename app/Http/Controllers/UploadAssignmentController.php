<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Assignment;
use App\UploadAssignment;
use App\Subject;
use App\Student;

class UploadAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
       
        $sem_id = $request->get('semester_id');
        $sub_id = $request->get('subject_id');
        $sec_id = $request->get('section_id');
        $ass_num = $request->get('assignment_id');
       
  
       $assignments = DB::table('upload_assignments')
       ->where([
           ['semester_id',  $sem_id],
           ['subject_id',  $sub_id],
           ['section_id', $sec_id],
           ['assignment_number', $ass_num],
           ])
       ->get();
      
$i=1;
    $output = " ";
    foreach($assignments as $assignment)
    {
        $student = Student::find($assignment->student_id );

        $output .= "<tr class='bg-white'>
        <td>".$i++."</td>
        <td> F17-".$student->id."</td>
        <td>".$student->first_name." ".$student->last_name."</td>
       
        <td><a class='pb-8 text-dark' href='{{$assignment->path }} ' download><i class='fas fa-file-download'></i>&nbsp;$assignment->name</a></td>
    <td>$assignment->obtained_marks</td>
        
       
        </form>
   </td>
       
</td>


        
       
      </tr>";
    //  $output .= '<option value="'.$row->id.'">'."Semester " .$row->semester_name.'</option>';
    }
    echo $output;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $current = new Carbon();

// get today - 2015-12-19 00:00:00
// $today =Carbon::createFromFormat('Y-m-d H:i:s.u', '2019-02-01 03:45:27.612584');
      
     
        if($request->hasFile('name')){
            $array = explode(",", $request->assignment_detail);
            $department_id = $array[0];
            $subject_id = $array[1];
            $semester_id = $array[2];
            $section_id = $array[3];
            $student_id = $array[4];
          
            $fileExtention = $request->name->getClientOriginalExtension();

            if($fileExtention != 'docx')
            return back()->with('warning','Plese add file of extention .docx');

            $value = DB::table('upload_assignments')->where('subject_id',$subject_id)
                                            ->where('assignment_number',$request->assignment_number)
                                            ->where('student_id', $student_id)->exists();
            if($value == true){
                return back()->with('error','This assignment  Allready uploaded');
            }
            
            $subject = Subject::find($subject_id );

            $fileName =$subject->subject_name." (Assignment".$request->assignment_number.")";
            $fileName = $fileName.".".$fileExtention;
            $request->name->storeAs('public/assignments/', $student_id.$fileName);


            $uploadAssignment = new UploadAssignment();
           
           // $uploadAssignment->teacher_id = $teacher_id;
            $uploadAssignment->subject_id = $subject_id;
            $uploadAssignment->semester_id = $semester_id;
            $uploadAssignment->student_id = $student_id;
            $uploadAssignment->section_id = $section_id;
    
            $uploadAssignment->assignment_number = $request->assignment_number;
            $uploadAssignment->name =  $fileName;
            $uploadAssignment->path = 'storage/assignments/'.$student_id.$fileName;
//          in thi formate   "2020-07-09 13:20"
// dd($request->all(),date("Y-m-d H:i"));
            $uploadAssignment->save();
            return back()->with('success','Assignmet Uploaded successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAssignmentMarks($id)
    {
        $data = DB::table('upload_assignments')
        ->where('student_id',$id)
        ->get();

        return view('show-assignment-marks',compact('data'));
    }

    public function show($id)
    {
        $data = DB::table('enroll_subjects')
        ->join('subjects','enroll_subjects.subject_id','subjects.id')
        ->join('sections','enroll_subjects.section_id','sections.id')
        ->join('semesters','enroll_subjects.semester_id','semesters.id')
        ->where('enroll_subjects.student_id',$id)
        ->get();
       
        return view('student-upload-assignment',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
    //  dd($request->all()); 
        $array = explode(",", $request->assignment_detail);
        $department_id = $array[0];
        $subject_id = $array[2];
        $semester_id = $array[3];
        $section_id = $array[4];
        // $student_id = $array[4];
        $assignment_number = $request->assignment_number;
        $assignments = DB::table('upload_assignments')
        ->where([
            ['semester_id',  $semester_id],
            ['subject_id',  $subject_id],
            ['section_id', $section_id],
            ['assignment_number', $assignment_number],
            ])
        ->get();
                
        return view('update-assignment',compact('assignments'));
    }
    public function showUploadedAssignment($id)
    {
       
        $data = DB::table('assign_subjects')
        ->join('subjects','assign_subjects.subject_id','subjects.id')
        ->join('sections','assign_subjects.section_id','sections.id')
        ->join('semesters','assign_subjects.semester_id','semesters.id')
        ->where('assign_subjects.teacher_id',$id)
        ->get();
       
        return view('mark-assignment',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UploadAssignment $uploadAssignment,Request $request,$id)
    {
       
        DB::table('upload_assignments')
              ->where('id', $id)
              ->update(['obtained_marks' => $request->obtained_marks]);
              return back()->with('success' ,'Marks Uploaded successfully!');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function fetch(Request $request)
    {
        $d_id = $request->get('department_id');
        $t_id = $request->get('teacher_id');
       
        $su_id = $request->get('subject_id');
        $se_id = $request->get('section_id');
       
       $dependent = $request->get('dependent');
       $data = DB::table('assignments')
       ->where([
           ['department_id',  $d_id],
           ['teacher_id',  $t_id],
           ['subject_id',  $su_id],
           ['section_id', $se_id],
           ])
       
       // ->groupBy($dependent)
       ->get();

     $output = ' <option value = " ">-----Select Assignment----</option>';
     foreach($data as $row)
     {
      $output .= '<option value="'.$row->assignment_number.'">'.$row->name.'</option>';
     }
     echo $output;
    }
}
