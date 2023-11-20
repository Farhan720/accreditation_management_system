<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Question;
use Illuminate\Support\Facades\DB;


class QuestionController extends Controller
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
        $last_row = DB::table('quizzes')->latest()->first();
            $quiz_id = $last_row->id;
            $quiz_number = $last_row->quiz_number;
            $subject_id = $last_row->subject_id;
            return view('generate-question',compact('quiz_id','subject_id','quiz_number'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
   
        $options = implode(",,",$request->option);
        $question = new Question();
        
        $question->quiz_id = $request->quiz_id;
        $question->subject_id = $request->subject_id;
        $question->quiz_number = $request->quiz_number;
        $question->question = $request->question;
        $question->options = $options;
        $question->correct_option = $request->correct_option;
        $question->save();

        return back()->with('success' ,'Question Added successfully, Enter new question');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
       
        $array = explode(",", $request->quiz_detail);
      
        $subject_id = $array[1];
        $quiz_number = $request->quiz_number;
      
        
        $questions = DB::table('questions')->where('subject_id',$subject_id)
                ->where('quiz_number',$quiz_number)->get();

                $quiz_id = DB::table('questions')->where('subject_id',$subject_id)
                ->where('quiz_number',$quiz_number)->first();

               $quiz = DB::table('quizzes')->where('id',$quiz_id->quiz_id)->first();
               
                return view('show-questions',compact('questions','subject_id','quiz_number','quiz'));
                                        

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
}
