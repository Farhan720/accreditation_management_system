<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Department;
use App\Subject;
use App\Teacher;
class DepartmentController extends Controller
{
    public function create()
    {
        $departments = Department::all();
        return view('add-department',compact('departments'));
    }

    public function store(Request $request)
    {
        $validate = request()->validate([
            'department_name' => ['required','min:3']
        ]);
      $department = new  Department();
      $department->department_name = ucwords($request->department_name);
      $department->save();
      return back()->with('success','Section Added successfully!');
    }
    public function show()
    {

;    }

    public function edit(Department $department)
    {
      $semesters =DB::table('semesters')->where('department_id',   $department->id)->get();
      $teachers =DB::table('teachers')->where('department_id',   $department->id)->get();
      $subjects =DB::table('subjects')->where('department_id', $department->id)->get();


         return view('update-department',compact('department','teachers','subjects','semesters'));
    }

    public function update(Department $department){

        $validate = request()->validate([
            'department_name' => ['required','min:3']
        ]);

        $department->update($validate);
        return back()->with('success','Department Updated successfully!');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return back()->with('success','Section Deleted successfully!');
    }
}
