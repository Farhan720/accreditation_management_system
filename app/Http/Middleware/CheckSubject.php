<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;
use Closure;

class CheckSubject
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
        $check =  DB::table('subjects')->where([
            ['subject_name',$request->subject_name],
            ['semester_id',$request->semester_id],
            ['department_id',$request->department_id],
           
        ])->exists();

        if($check == true)
        return back()->with('error' ,'Subject Allready existed');

        return $next($request);
    }
}
