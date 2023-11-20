<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Exam;
use App\ExamPic;
class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     $exampics =DB::table('exam_pics')->where('exam_id',$request->exam_id)->get();
     return view('view-pics',compact('exampics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      
        $array = explode(",", $request->subject_detail);
       
        $subject_id = $array[0];
        $semester_id = $array[1];
        $section_id = $array[2];
      
        $exam_type = $request->exam_type;
        $enroll_subjects = DB::table('enroll_subjects')
        ->where([
            ['semester_id',  $semester_id],
            ['subject_id',  $subject_id],
            ['section_id', $section_id]
            ])
        ->get();
             
        return view('exam-list-of-students',compact('enroll_subjects','exam_type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        
        $allowedfileExtension=['jpg','png','jpeg','JPG','PNG','JPEG'];
            $files = $request->photos;
           
            foreach($files as $file){
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
               
                $check=in_array($extension,$allowedfileExtension);
                if(!$check )
                return back()->with('warning','Plese add file of extention jpg or png');
            }

         
            $value = DB::table('exams')
            ->where([
                ['subject_id',$request->subject_id],
                ['student_id',$request->student_id],
                ['exam_type',$request->exam_type]
                ])->exists();
            if($value == true){
                return back()->with('error','Files Allready Uploaded');
            }

            else
            {
               
               $exam = new Exam();
               $exam->student_id = $request->student_id;
               $exam->subject_id = $request->subject_id;
               $exam->semester_id = $request->semester_id;
               $exam->section_id = $request->section_id;
               $exam->exam_type = $request->exam_type; 
               $exam->obtained_marks = $request->obtained_marks;

               $exam->save();
            }

            foreach ($request->photos as $photo) {

                $photoExtention = $photo->getClientOriginalExtension();
                $fileName = rand().".".$photoExtention;
               
                if($request->exam_type == "midd")
                $photo->storeAs('public/exam/midd/',$fileName);
                else
                $photo->storeAs('public/exam/final/',$fileName);

                $examPic = new ExamPic;

                $examPic->name =  $fileName;

                if($request->exam_type == "midd")
                $examPic->path = 'storage/exam/midd/'.$fileName;
                else
                $examPic->path = 'storage/exam/final/'.$fileName;
               
                $last_row = DB::table('exams')->latest()->first();
                $examPic->exam_id = $last_row->id;
    
                $examPic->save();
               
            }
            return back()->with('success','Files Uploaded successfully!');
        
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
       
        return view('update-exam',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
      
        $array = explode(",", $request->subject_detail);
       
        $subject_id = $array[0];
        $semester_id = $array[1];
        $section_id = $array[2];
      
        $exam_type = $request->exam_type;
       $exams = DB::table('exams')
        ->where([
            ['semester_id',  $semester_id],
            ['subject_id',  $subject_id],
            ['section_id', $section_id],
            ['exam_type', $request->exam_type]
            ])
        ->get();
        
        return view('update-exam-list-of-student',compact('exams','exam_type'));
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
        DB::table('exams')
        ->where('student_id', $id)
        ->update(
        [
        'obtained_marks' => $request->obtained_marks,
        ]
        );

        return back()->with('success' ,'Exam Marks update successfully!');
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

    public function selectSubject($id)
    {
       
        $data = DB::table('assign_subjects')
        ->join('subjects','assign_subjects.subject_id','subjects.id')
        ->join('sections','assign_subjects.section_id','sections.id')
        ->join('semesters','assign_subjects.semester_id','semesters.id')
        ->where('assign_subjects.teacher_id',$id)
        ->get();
       
        return view('upload-exam',compact('data'));
    }
}
