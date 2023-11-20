<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Department;

use App\EnrollSubject;


use Illuminate\Support\Facades\DB;

class EnrollSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        // $departments = Department::all();
        // return view('enroll-subject',compact('departments'));
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
      
        $enrollsubject = new EnrollSubject();
       
        $enrollsubject->student_id =$request['student_id']; 
        $enrollsubject->subject_id =$request['subject_id'];
        $enrollsubject->semester_id =$request['semester_id'];
        $enrollsubject->section_id = $request['section_id'];
      
        $enrollsubject->save();
        return back()->with('success','Subject Enroll successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = DB::Table('students')->select('department_id')->where('id',$id)->first();
      
        $semesters = DB::table('semesters')->where('department_id',$department->department_id)->get();
       
        return view('enroll-subject',compact('semesters'));
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
