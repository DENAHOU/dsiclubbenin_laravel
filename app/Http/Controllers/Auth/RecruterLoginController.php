<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class RecruterLoginController extends Controller {
    public function create() { return view('auth.login-recruter'); }
    public function store(Request $request) {
        $credentials = $request->validate(['email' => ['required', 'email'], 'password' => ['required']]);
        if (Auth::guard('recruter')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/recruter/dashboard');
        }
        return back()->withErrors(['email' => 'Identifiants incorrects.'])->onlyInput('email');
    }
}
