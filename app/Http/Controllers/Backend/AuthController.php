<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
            
            $credentials['role'] = 'admin';

            if (Auth::attempt($credentials)) {
                if (Auth::user()->status == 'active') {
                    $request->session()->regenerate();
     
                    return redirect()->intended(baseURL('customer'));
                } else {
                    Auth::logout();

                    return back()->with('danger', 'Your account is not active.');
                }
            }
     
            return back()->with('danger', 'Invalid Credentials.');
        }

        return view('backend.auth.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
     
        return redirect(baseURL());
    }
}
