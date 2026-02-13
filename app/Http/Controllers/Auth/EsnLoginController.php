<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EsnLoginController extends Controller {
    public function create() { return view('auth.login-esn'); }
    public function store(Request $request) {
        $credentials = $request->validate(['email' => ['required', 'email'], 'password' => ['required']]);
        if (Auth::guard('esn')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/esn/dashboard');
        }
        return back()->withErrors(['email' => 'Identifiants incorrects.'])->onlyInput('email');
    }
}
