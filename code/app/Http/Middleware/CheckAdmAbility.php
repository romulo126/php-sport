<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmAbility
{
    private const ABILITIES = ['delete'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() ||  ! $this->hasRequiredAbilities($request)) {
            return response()->json(['message' => 'Forbidden'], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }

    /**
     * Verifica se o token possui as abilities necessárias.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    private function hasRequiredAbilities(Request $request): bool
    {
        foreach (self::ABILITIES as $ability) {
            if (!$request->user()->tokenCan($ability)) {
                return false;
            }
        }

        return true;
    }
}
