<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
  public function handle(Request $request, Closure $next, string ...$guards): Response
  {
    $guards = empty($guards) ? [null] : $guards;

    foreach ($guards as $guard) {
      if (auth($guard)->check()) {
        return response()->json([
          'status' => 'error',
          'message' => 'Sudah login, akses ditolak'
        ], 403);
      }
    }

    return $next($request);
  }
}
