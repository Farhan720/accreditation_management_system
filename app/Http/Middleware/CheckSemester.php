<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class CheckSemester
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
        if(request()->semester >8){
            return back()->with('error' ,'Please enter semester between 1 to 8');
        }
        else
        {
            $check = DB::table('semesters')->where([
                    ['semester_name',request()->semester_name],
                    ['department_id',request()->department_id]

                    ])->exists();
            if($check == true)
            return back()->with('error' ,'Semester Allready existed');

        }
        return $next($request);
    }
}
