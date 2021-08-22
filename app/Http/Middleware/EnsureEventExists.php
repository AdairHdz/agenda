<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Event;

class EnsureEventExists
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
        $eventId = $request->segment(2);        
        $eventToBeEdited = Event::find($eventId);
        if($eventToBeEdited == null)
        {
            return redirect()->route("events.index");
        }

        return $next($request);
    }
}
