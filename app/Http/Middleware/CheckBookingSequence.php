<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBookingSequence
{
    // TODO: Add respective session datas
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $stages = ['search', 'create', 'confirm', 'payment', 'success'];
        $currentRouteName = $request->route()->getName();

        $currentStageIndex = array_search(explode('.', $currentRouteName)[1], $stages);

        if ($currentStageIndex > 0) {
            $previousStage = $stages[$currentStageIndex - 1];

            if (!$this->isStageCompleted($previousStage)) {
                return redirect()->route("booking.$previousStage");
            }
        }
        return $next($request);
    }

    private function isStageCompleted($stage)
    {
        return session()->has("booking.$stage");
    }
}
