<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBookingOwnership
{
    /**
     * Check if the user owns the specified reservation
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $reservationId = $request->route('reservation');
        $reservation = Reservation::findOrFail($reservationId);

        if (strtolower(auth()->user()->role->name) === "admin" || $reservation->user_id === auth()->id()) {
            return $next($request);
        }
        abort(403);
    }
}
