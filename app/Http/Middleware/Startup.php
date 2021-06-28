<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
class Startup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
	   $currentbaseurl = $request->server('HTTP_HOST');	 	   
       if (file_exists(public_path('installer/nut.txt'))){
       		$stored = public_path('installer/nutstore.txt');
       		$file_w = fopen($stored, "w") or die("Unable to open file!");
			fwrite($file_w, $currentbaseurl);
			fclose($file_w);			
       		return redirect('/startup');
       }else{
       		//read       		
       		$stored = public_path('installer/nutstore.txt');
       		$file_r = fopen($stored, "r") or die("Unable to open file!");
       		$oldstoredbaseurl = fread($file_r, filesize($stored));
       		if ($currentbaseurl==$currentbaseurl) {
       			return $next($request);    
       		}else{
       			return redirect('/startup');
       		}
       }   
    }
  
}
