<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UpdateLastSeenAt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            // Update jika belum pernah dicatat atau jika sudah lebih dari 1 menit berlalu
            if (!$user->last_seen_at || Carbon::parse($user->last_seen_at)->diffInMinutes(now()) >= 1) {
                // Gunakan query builder agar tidak mentrigger event model (seperti activity log)
                DB::table('users')->where('id', $user->id)->update(['last_seen_at' => now()]);
            }
        }

        return $next($request);
    }
}
