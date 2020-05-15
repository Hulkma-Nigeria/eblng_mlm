<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Auth\LoginController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Allow
{
    private $controller;
    public function __construct(LoginController $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
//        dd($request);
        if (Auth::check()) {
            $user = Auth()->user();
            if ($user->access_type === $role) {
                return $next($request);
            }
        }
        $this->controller->logoutGet();
        return redirect()->route('user.login');
    }
}
