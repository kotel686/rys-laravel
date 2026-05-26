<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Gate the Lezecká stěna mini-site behind HTTP Basic Auth while it is in
 * a pre-launch / dev state.
 *
 * Credentials are read from the environment so they can be rotated without
 * a code deploy. When either env value is empty the gate is disabled and
 * requests pass straight through — this is how the lock will be lifted at
 * launch.
 */
final class ClimbingDevLock
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $expectedUser = (string) config('climbing.dev_lock.user', '');
        $expectedPass = (string) config('climbing.dev_lock.password', '');

        if ($expectedUser === '' || $expectedPass === '') {
            return $next($request);
        }

        $user = (string) ($request->getUser() ?? '');
        $pass = (string) ($request->getPassword() ?? '');

        if (hash_equals($expectedUser, $user) && hash_equals($expectedPass, $pass)) {
            return $next($request);
        }

        return response('Přístup povolen jen testerům.', Response::HTTP_UNAUTHORIZED, [
            'WWW-Authenticate' => 'Basic realm="Lezecká stěna (dev)", charset="UTF-8"',
            'Content-Type' => 'text/plain; charset=UTF-8',
        ]);
    }
}
