<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\User;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
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
        $departments = Department::all();
        $teachers = Teacher::all();
        return view('add-teacher',compact('teachers','departments'));
    }

    public function fetch(Request $request)
    {
        $select = $request->get('select');
         $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('teachers')
        ->where($select, $value)
        // ->groupBy($dependent)
        ->get();

     $output = ' <option value = " ">-----Select Teacher----</option>';
     foreach($data as $row)
     {
      $output .= '<option value="'.$row->id.'">'.$row->first_name. " " .$row->last_name.'</option>';
     }
     echo $output;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Teacher $teacher, Request $request)
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

        $teacher->create($validate);
        return back()->with('success','Teacher Added successfully!');
    }

    public function assignLogin(Request $request)
    {
       
      
        $data = Teacher::find( $request->id);
        
        $type='teacher';
        
        $user = User::create([
            'user_id' => $data->id,
            'name' => $data->first_name." ".$data->last_name,
            'email' => $data->email,
            'password' => bcrypt('teacher'),
            'type' => $type,
         ]);
        return back()->with('success','Rules Assign  successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
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
        return view('show-assigned-subjects',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments = Department::all();
        $teacher = Teacher::find($id);
        return view('update-teacher',compact('teacher','departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
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

        $teacher->update($validate);
        return back()->with('success','Teacher Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return back()->with('success','Teacher Deleted successfully!');
    }

    public function changePassword()
    {
        return view('change-password');
    }
    public function updatePassword(Request $request)
    {
       
        if(strlen($request->password) < 8)
        return back()->with('error' ,'Password length should minimam 8 character');
        else{
            if($request->password == $request->password_confirmation)
            {
               DB::table('users')
        ->where('user_id', Auth::user()->user_id)
        ->update(
        ['password' => bcrypt($request->password)]
        );

        return back()->with('success' ,'Password update successfully!');
            }
            else
            return back()->with('error' ,'Password doest not match');
        }
       
    }
}
