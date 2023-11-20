<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Department;
use App\Semester;
use App\Section;

class SectionController extends Controller
{
    public function __construct()
{
    $this->middleware('section', ['only' => ['store']]);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $semesters = Semester::all();
        $sections = Section::all();
        // dd($sections);
        return view('add-section',compact('departments','sections'));
    }
    public function fetch(Request $request)
    {

        $select = $request->get('select');
         $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('sections')
        ->where($select, $value)
        // ->groupBy($dependent)
        ->get();

     $output = ' ';
     $output = ' <option value = " ">-----Select Subject----</option>';
     foreach($data as $row)
     {
      $output .= '<option value="'.$row->id.'">'.$row->section_name.'</option>';
     }
     echo $output;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = request()->validate([
            'section_name' => ['required', 'min:1','max:3','regex:/^[a-zA-Z ]+$/'],
            'department_id' => ['required'],
            'semester_id' => ['required']
        ]);
        $section = new Section();
        $section->section_name = strtoupper($request->section_name);
        $section->department_id = $request->department_id;
        $section->semester_id = $request->semester_id;
        $section->save();
        return back()->with('success','Section Added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $semesters = Semester::all();
        $section = Section::find($id);
        // dd($section);
        // $subject = Subject::find($id);
        return view("update-section",compact("section","departments","semesters"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Section $section)
    {
      
        // dd($id);
        // $validate = request()->validate([
        //     'department_id' => ['required'],
        //     'semester_id' => ['required'],
        //     'section_name' => ['required','min:1','max:3'],
            
        // ]);
        $section->update();
        return back()->with('success' ,'Section Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $section->delete();
        return back()->with('success','Section Deleted successfully!');
    }
}
