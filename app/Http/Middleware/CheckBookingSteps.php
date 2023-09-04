<?php

namespace App\Http\Middleware;

use Closure;

class CheckBookingSteps
{
    public function handle($request, Closure $next)
    {
        $routeName = $request->route()->getName();

        $steps = [
            'booking.search',
            'booking.create',
            'booking.confirm',
        ];

        $currentStepIndex = array_search($routeName, $steps);

        if ($currentStepIndex === false) {
            // Route is not part of the booking process
            return $next($request);
        }

        // Check if the previous steps are completed
        for ($i = 0; $i < $currentStepIndex; $i++) {
            if (!session()->has($steps[$i])) {
                return redirect()->route($steps[$i])->with('error', 'Please complete the previous step first.');
            }
        }

        return $next($request);
    }
}
