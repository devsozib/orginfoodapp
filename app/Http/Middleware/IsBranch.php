<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Branch;


class IsBranch
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        return $next($request);


        // $role = auth()->user()->role;
        // if($role != 'super_admin' && $role != 'sr' && $role != 'account'){
        //     $branch = Branch::where('id' ,auth()->user()->id)->first();
        //     if($branch){
        //         return $next($request);
        //     }

        // }

        // return route('logout');


    }
}
