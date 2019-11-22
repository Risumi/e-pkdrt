<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsLogin {
	public function handle($req, Closure $next){
		// date_default_timezone_set("Asia/Jakarta");

		if(Auth::user())
			return $next($req);
		return redirect('/');
	}
}