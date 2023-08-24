<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        return view('admin.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate("admin");

        session()->regenerate();

        return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
    }

    // Handle admin logout
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect(route('admin.login'));
    }
}
