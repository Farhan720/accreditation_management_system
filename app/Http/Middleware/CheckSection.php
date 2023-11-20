<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class CheckSection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(strlen($request->section_name) >1){
            return back()->with('error' ,'Section Name should be a single character eg: A or B');
        }
        else{
           $check =  DB::table('sections')->where([
                ['section_name',$request->section_name],
                ['semester_id',$request->semester_id],
                ['department_id',$request->department_id]
            ])->exists();

            if($check == true)
            return back()->with('error' ,'Section Allready existed');
        }

        return $next($request);
    }
}
