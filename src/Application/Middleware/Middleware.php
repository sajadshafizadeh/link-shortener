<?php

namespace Application\Middleware;


/**
 * Handle an incoming request.
 *
 * @param \Illuminate\Http\Request $request
 * @return mixed
*/
interface Middleware {
	
  public function handle();
  
}