<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;
use Prometheus\Storage\InMemory;

$registry = new CollectorRegistry(new InMemory());

$counter = $registry->registerCounter('requests_total', 'count', 'type');
$gauge = $registry->registerGauge('active_users', 'now', 'type');

class Admin
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
        $user = Auth::user();

        $counter->inc();
        $gauge->set(42);

        // if ($user->access === 0) {
        //     return abort(403);
        // }

        return $next($request);
    }
}
