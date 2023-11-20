<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Department;

use App\AssignSubject;


class AssignSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();
        return view('select-department',compact('departments'));
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
        $assignsubject = new AssignSubject();
       
        $assignsubject->department_id =$request['department_id'];
        $assignsubject->subject_id =$request['subject_id'];
        $assignsubject->teacher_id =$request['teacher_id'];
        $assignsubject->semester_id =$request['semester_id'];
        $assignsubject->section_id = $request['section_id'];
      
        $assignsubject->save();
        return back()->with('success','Subject Assigned successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subjects = DB::table('subjects')->where('department_id',$id)->get();
        $teachers = DB::table('teachers')->where('department_id',$id)->get();
        $semesters = DB::table('semesters')->where('department_id',$id)->get();
        $sections = DB::table('sections')->where('department_id',$id)->get();
        return view('assign-subject',compact('subjects','teachers','semesters','sections','id'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('assign_subjects')
        ->join('subjects','assign_subjects.subject_id','subjects.id')
        ->join('sections','assign_subjects.section_id','sections.id')
        ->where('assign_subjects.teacher_id',2)
        ->get();
        dd($data);
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
