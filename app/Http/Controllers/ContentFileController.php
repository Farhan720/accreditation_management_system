<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Subject;
use App\Department;
use App\ContentFile;

class ContentFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contentfiles = ContentFile::all();
        return view('show-content-file',compact('contentfiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        return view('add-content-file',compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('name')){

            $fileExtention = $request->name->getClientOriginalExtension();

            if($fileExtention != 'docx')
            return back()->with('warning','Plese add file of extention .docx');

            $value = DB::table('content_files')->where('subject_id',$request->subject_id)->exists();
            if($value == true){
                return back()->with('error','Content File Already existed of this subject');
            }

            $subject = Subject::find($request->subject_id );
            $fileName =$subject->subject_name;

            $fileName = $fileName.".".$fileExtention;
            $request->name->storeAs('public/files/contentfiles/',$fileName);

            $contentfile = new ContentFile;

            $contentfile->name =  $fileName;
            $contentfile->path = 'storage/files/contentfiles/'.$fileName;
            $contentfile->subject_id = $request->subject_id;

            $contentfile->save();

            return back()->with('success','File Uploaded successfully!');
        }


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
    public function destroy(ContentFile $contentfile)
    {
        File::delete($contentfile->path);
        $contentfile->delete();
        return back()->with('success','File Deleted successfully!');
    }
}
