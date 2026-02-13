<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CandidatLoginController extends Controller
{
    public function create(): View { return view('auth.login-candidat'); }

    public function store(Request $request): RedirectResponse {
        $credentials = $request->validate(['email' => ['required', 'email'], 'password' => ['required']]);
        if (Auth::guard('candidat')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/candidat/dashboard');
        }
        return back()->withErrors(['email' => 'Identifiants incorrects.'])->onlyInput('email');
    }
}
