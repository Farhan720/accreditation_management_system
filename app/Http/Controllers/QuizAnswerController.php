<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\QuizAnswer;
use App\Student;
use App\StudentQuiz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizAnswerController extends Controller
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
        $qiz_num = $request->get('quiz_number');
       
  
       $quizzes = DB::table('student_quizzes')
       ->where([
           ['semester_id',  $sem_id],
           ['subject_id',  $sub_id],
           ['section_id', $sec_id],
           ['quiz_number', $qiz_num],
           ])
       ->get();
      
$i=1;
    $output = " ";
    foreach($quizzes as $quizze)
    {
        $student = Student::find($quizze->student_id );

        $output .= "<tr class='bg-white'>
        <td>".$i++."</td>
        <td> F17-".$student->id."</td>
        <td>".$student->first_name." ".$student->last_name."</td>
        <td> Quiz# ".$quizze->quiz_number."</td>
        <td>".$quizze->marks."</td>
      
       
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
       
      
        for($i=1;$i<=$request->number_of_question;$i++)
        {
            $answer="answer".$i;
          
;            $quizanswer= new QuizAnswer();
            $quizanswer->quiz_number = $request->quiz_number;
            $quizanswer->subject_id = $request->subject_id;
            $quizanswer->semester_id = $request->semester_id;
            $quizanswer->section_id = $request->section_id;
            $quizanswer->student_id = Auth::user()->user_id;
            $quizanswer->question_id = $request->question.$i;
            $quizanswer->answer = $request->$answer;

            $questions = DB::table('questions')->find($request->question.$i);
            if($questions->correct_option == $request->$answer )
                    $quizanswer->result = 1;
            else
            $quizanswer->result = 0;

            $quizanswer->save();

            
        }
      
        $total = DB::table('quiz_answers')->where([
            ['quiz_number', $request->quiz_number],
            ['subject_id',   $request->subject_id],
            ['student_id', Auth::user()->user_id],
         
            ])->sum('result');
          
            DB::table('quizzes')
            ->where('id', $questions->quiz_id)
            ->update(
            ['allow' => 0]
            );
    
            $studentquiz= new StudentQuiz();
            $studentquiz->quiz_number = $request->quiz_number;
            $studentquiz->subject_id = $request->subject_id;
            $studentquiz->semester_id = $request->semester_id;
            $studentquiz->section_id = $request->section_id;
            $studentquiz->student_id = Auth::user()->user_id;
            $studentquiz->marks = $total;

            $studentquiz->save();
            return view('result-page',compact('total'));
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
       
        return view('view-quiz-teacher',compact('data'));
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
       
      
       $data = DB::table('quizzes')
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
      $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
     }
     echo $output;
    }
}
