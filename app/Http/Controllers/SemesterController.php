<?php

namespace App\Http\Controllers;

use App\Semester;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SemesterController extends Controller
{
    public function __construct()
{
    $this->middleware('semester', ['only' => ['store']]);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $d_name = $request->get('d_name');
       $dependent = $request->get('dependent');
       $semesters = DB::table('semesters')
       ->where($select, $value)
       // ->groupBy($dependent)
       ->get();
$i=1;
    $output = " ";
    foreach($semesters as $semester)
    {

        $output .= "<tr class='bg-white'>
        <td>".$i++."</td>
        <td>".'Semester '.$semester->semester_name."</td>
        <td>".$d_name."</td>
      </tr>";
    //  $output .= '<option value="'.$row->id.'">'."Semester " .$row->semester_name.'</option>';
    }
    echo $output;
    }
    public function fetch(Request $request)
    {
        $select = $request->get('select');
         $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('semesters')
        ->where($select, $value)
        // ->groupBy($dependent)
        ->get();

     $output = ' <option value = " ">-----Select Semester----</option>';
     foreach($data as $row)
     {
      $output .= '<option value="'.$row->id.'">'."Semester " .$row->semester_name.'</option>';
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
        // $semesters = DB::table('semesters')->where('department_id',request()->departmet_id);
        $semesters = Semester::all();

        return view('add-semester',compact('departments','semesters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Semester $semester)
    {
        $validate = request()->validate([
            'semester_name' =>['min:1','max:2','required'],
            'department_id' => ['required']
        ]);
        $semester->create($validate);
        return back()->with('success','Semester Added successfully!');
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
        return view('add-subject');
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
        dd("edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Semester $semester)
    {
        
        $semester->delete();
        return back()->with('success','Semester Deleted successfully!');
    }
}
