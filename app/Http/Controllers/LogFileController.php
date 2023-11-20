<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\LogFile;
use App\Subject;
use App\Department;

class LogFileController extends Controller
{
    public function subjects(){

    }
    public function index()
    {
        $logFiles = LogFile::all();
        return view('show-log-file',compact('logFiles'));
    }

    public function create(Subject $subjects )
    {
      
        $departments = Department::all();
        // foreach($subjects as $file){
        //     dd($file->logFile->path);
        // }
        return view('add-log-file',compact('departments'));
    }

    public function store(Request $request)
    {

        if($request->hasFile('name')){
            $fileExtention = $request->name->getClientOriginalExtension();

            if($fileExtention != 'docx')
            return back()->with('warning','Plese add file of extention .docx');

            $value = DB::table('log_files')->where('subject_id',$request->subject_id)->exists();
            if($value == true){
                return back()->with('error','Log File Already existed of this subject');
            }

            $subject = Subject::find($request->subject_id );

            $fileName =$subject->subject_name;
            $fileName = $fileName.".".$fileExtention;
            $request->name->storeAs('public/files/logfiles/',$fileName);


            $logfile = new LogFile;

            $logfile->name =  $fileName;
            $logfile->path = 'storage/files/logfiles/'.$fileName;
            $logfile->subject_id = $request->subject_id;

            $logfile->save();
            return back()->with('success','File Uploaded successfully!');
        }

    }
    
    public function show(LogFile $logfile)
    {

    }

    public function destroy(LogFile $logfile)
    {
        File::delete($logfile->path);
        $logfile->delete();
        return back()->with('success','File Deleted successfully!');
    }
}
