<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Quiz;
use App\Subject;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
       
            $array = explode(",", $request->quiz_detail);
            $department_id = $array[0];
            $teacher_id = $array[1];
            $subject_id = $array[2];
            $semester_id = $array[3];
            $section_id = $array[4];
          
        

            $value = DB::table('quizzes')->where('subject_id',$subject_id)
                                            ->where('quiz_number',$request->quiz_number)->exists();
            if($value == true){
                return back()->with('error','Quiz Already existed of this subject');
            }

            $quiz = new Quiz();
            $quiz->department_id = $department_id;
            $quiz->teacher_id = $teacher_id;
            $quiz->subject_id = $subject_id;
            $quiz->semester_id = $semester_id;
            $quiz->section_id = $section_id;
            $quiz->quiz_marks = $request->quiz_marks;
            $quiz->quiz_number = $request->quiz_number;
            $quiz->save();
            return back()->with('success' ,'Quiz Added successfully, Click On Add Questions');
            
        
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

        return view('upload-quiz',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
      
        $array = explode(",", $request->quiz_detail);
        $department_id = $array[0];
        $subject_id = $array[2];
        $semester_id = $array[3];
        $section_id = $array[4];
      
        $quiz_number = $request->quiz_number;
        $quizzes = DB::table('quizzes')
        ->where([
            ['semester_id',  $semester_id],
            ['subject_id',  $subject_id],
            ['section_id', $section_id],
            ['quiz_number', $quiz_number],
            ])
        ->get();
               
        return view('update-quiz',compact('quizzes'));
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
        
    
        DB::table('quizzes')
        ->where('id', $id)
        ->update(
        ['allow' => $request->allow,
        'start_time' => $request->start_date." ".$request->start_time,
        'end_time' => $request->end_date." ".$request->end_time]
        );

        return back()->with('success' ,'Quiz update successfully!');
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
       $data = DB::table('quizzes')
       ->where([
           ['department_id',  $d_id],
           ['teacher_id',  $t_id],
           ['subject_id',  $su_id],
           ['section_id', $se_id],
           ])
       
       // ->groupBy($dependent)
       ->get();

     $output = ' <option value = " ">-----Select Quiz----</option>';
     foreach($data as $row)
     {
      $output .= '<option value="'.$row->quiz_number.'">'."Quiz # ".$row->quiz_number.'</option>';
     }
     echo $output;
    }
    public function showAssignSubject($id)
    {
       
        $data = DB::table('assign_subjects')
        ->join('subjects','assign_subjects.subject_id','subjects.id')
        ->join('sections','assign_subjects.section_id','sections.id')
        ->join('semesters','assign_subjects.semester_id','semesters.id')
        ->where('assign_subjects.teacher_id',$id)
        ->get();
       
        return view('allow-quiz',compact('data'));
    }

    public function showSubject($id)
    {
       
        $data = DB::table('enroll_subjects')
        ->join('subjects','enroll_subjects.subject_id','subjects.id')
        ->join('sections','enroll_subjects.section_id','sections.id')
        ->join('semesters','enroll_subjects.semester_id','semesters.id')
        ->where('enroll_subjects.student_id',$id)
        ->get();
       
        return view('show-student-assign-quiz',compact('data'));
    }
}
