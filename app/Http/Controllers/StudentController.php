<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Department;

use App\Student;

use App\User;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $d_id = $request->get('department_id');
       
       
        $su_id = $request->get('subject_id');
        $se_id = $request->get('section_id');
       
       $dependent = $request->get('dependent');
       $assignments = DB::table('assignments')
       ->where([
           ['department_id',  $d_id],
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
        $departments = Department::all();
        $students = Student::all();
       
        return view('add-student',compact('departments','students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Student $student)
    {
        $validate = request()->validate([
            "department_id" => ['required','min:1'],
            "first_name" => ['required','min:3'],
            "last_name" => ['required','min:3'],
            "email" => ['required'],
            "cell" => ['required'],
            "qualification" => ['required'],
            "address" => ['required']
        ]);

        $student->create($validate);
        return back()->with('success','Student Added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('enroll_subjects')
        ->join('subjects','enroll_subjects.subject_id','subjects.id')
        ->join('sections','enroll_subjects.section_id','sections.id')
        ->join('semesters','enroll_subjects.semester_id','semesters.id')
        ->where('enroll_subjects.student_id',$id)
        ->get();
       
        return view('show-enroll-subjects',compact('data'));
    }

    public function showSubject($id)
    {
        $data = DB::table('enroll_subjects')
        ->join('subjects','enroll_subjects.subject_id','subjects.id')
        ->join('sections','enroll_subjects.section_id','sections.id')
        ->join('semesters','enroll_subjects.semester_id','semesters.id')
        ->where('enroll_subjects.student_id',$id)
        ->get();
       
        return view('show-student-assign-assignment',compact('data'));
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments = Department::all();
        $student = Student::find($id);
        return view('update-student',compact('student','departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $validate = request()->validate([
            "department_id" => ['required','min:1'],
            "first_name" => ['required','min:3'],
            "last_name" => ['required','min:3'],
            "email" => ['required'],
            "cell" => ['required'],
            "qualification" => ['required'],
            "address" => ['required']
        ]);

        $student->update($validate);
        return back()->with('success','Student Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return back()->with('success','Student Deleted successfully!');
    }
    public function assignLogin(Request $request)
    {
       
      
        $data = Student::find( $request->id);
        
        $type='student';
        
        $user = User::create([
            'user_id' => $data->id,
            'name' => $data->first_name." ".$data->last_name,
            'email' => $data->email,
            'password' => bcrypt('student'),
            'type' => $type,
         ]);
        return back()->with('success','Rules Assign  successfully!');
    }
    public function assignAssignment()
    {

    }

    public function fetch(Request $request)
    {
        $d_id = $request->get('department_id');
        $su_id = $request->get('subject_id');
        $se_id = $request->get('section_id');
       
       $dependent = $request->get('dependent');
       $data = DB::table('quizzes')
       ->where([
           ['department_id',  $d_id],
           ['subject_id',  $su_id],
           ['section_id', $se_id],
           ])
       
       // ->groupBy($dependent)
       ->get();

     $output = ' <option value = " ">-----Select Quiz----</option>';
     foreach($data as $row)
     {
         if( $row->allow == 0)
         continue;
      $output .= '<option value="'.$row->quiz_number.'">'."Quiz # ".$row->quiz_number.'</option>';
     }
     echo $output;
    }
}
