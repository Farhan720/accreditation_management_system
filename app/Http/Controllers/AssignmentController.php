<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Assignment;
use App\Subject;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $d_id = $request->get('department_id');
        $t_id = $request->get('teacher_id');
       
        $su_id = $request->get('subject_id');
        $se_id = $request->get('section_id');
       
       $dependent = $request->get('dependent');
       $assignments = DB::table('assignments')
       ->where([
           ['department_id',  $d_id],
           ['teacher_id',  $t_id],
           ['subject_id',  $su_id],
           ['section_id', $se_id],
           ])
       
       // ->groupBy($dependent)
       ->get();
      
$i=1;
    $output = " ";
    foreach($assignments as $assignment)
    {

        $output .= "<tr class='bg-white'>
        <td>".$i++."</td>
        <td><a class='pb-8 text-dark' href='{{$assignment->path }} ' download><i class='fas fa-file-download'></i>&nbsp;$assignment->name</a></td>

</td>
<td>".$assignment->assignment_last_date."</td>
<td>".$assignment->assignment_marks."</td>

        
       
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
            $teacher_id = $array[1];
            $subject_id = $array[2];
            $semester_id = $array[3];
            $section_id = $array[4];
          
            $fileExtention = $request->name->getClientOriginalExtension();

            if($fileExtention != 'docx')
            return back()->with('warning','Plese add file of extention .docx');

            $value = DB::table('assignments')->where('subject_id',$subject_id)
                                            ->where('assignment_number',$request->assignment_number)->exists();
            if($value == true){
                return back()->with('error','Log File Already existed of this subject');
            }
            
            $subject = Subject::find($subject_id );

            $fileName =$subject->subject_name." (Assignment".$request->assignment_number.")";
            $fileName = $fileName.".".$fileExtention;
            $request->name->storeAs('public/assignments/',$fileName);


            $assignment = new Assignment();
            $assignment->department_id = $department_id;
            $assignment->teacher_id = $teacher_id;
            $assignment->subject_id = $subject_id;
            $assignment->semester_id = $semester_id;
            $assignment->section_id = $section_id;
            $assignment->assignment_marks = $request->assignment_marks;
            $assignment->assignment_last_date = $request->date." ".$request->time;
    
            $assignment->assignment_number = $request->assignment_number;
            $assignment->name =  $fileName;
            $assignment->path = 'storage/assignments/'.$fileName;
//          in thi formate   "2020-07-09 13:20"
// dd($request->all(),date("Y-m-d H:i"));
            $assignment->save();
            return back()->with('success','Assignmet Uploaded successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $data = DB::table('assign_subjects')
        ->join('subjects','assign_subjects.subject_id','subjects.id')
        ->join('sections','assign_subjects.section_id','sections.id')
        ->join('semesters','assign_subjects.semester_id','semesters.id')
        ->where('assign_subjects.teacher_id',$id)
        ->get();
       
        return view('upload-assignment',compact('data'));
    }
    public function showAssignment(Request $request)
    {
        $data = DB::table('assign_subjects')
        ->join('subjects','assign_subjects.subject_id','subjects.id')
        ->join('sections','assign_subjects.section_id','sections.id')
        ->join('semesters','assign_subjects.semester_id','semesters.id')
        ->where('assign_subjects.teacher_id',$request->id)
        ->get();
      
        return view('show-teacher-upload-assignment',compact('data'));
      
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        dd("ddddddddd");
        Assignment::delete($assignment->path);
        $assignment->delete();
        return back()->with('success','Assignment Deleted successfully!');
    }
}
