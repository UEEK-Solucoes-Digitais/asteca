<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Admin\Si9Controller;
use App\Models\ApiConfig;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class ApiToken
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
        $config = ApiConfig::first();

        if(!$config || !$config->last_retrieved){
            Si9Controller::refreshToken();
        } else {
            $lastRetrieved = Carbon::parse($config->last_retrieved);
            $diff = Carbon::now()->diffInMinutes($lastRetrieved);

            if($diff > 55){
                Si9Controller::refreshToken();
            }
        }

        return $next($request);
    }
}
