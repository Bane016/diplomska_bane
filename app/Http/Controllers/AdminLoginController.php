<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    use Authenticatable;

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function login()
    {
        return view('auth.admin.login');
    }

    public function login_submit(Request $request)
    {
        $this->validate($request,[
           'email' => 'required|email',
           'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password],
            $request->remember)) {
            return redirect()->intended(route('admin.home'));
        }
        $userWithEmail = Admin::where('email', $request->email)->first();
        if ($userWithEmail === null) {
            return redirect()->back()->withInput($request->only('email', 'remember'))
                ->withError("This admin account doesn't exist");
        }
        if (!Hash::check($request->password, $userWithEmail['password'])) {
            return redirect()->back()->withInput($request->only('email', 'remember'))
                ->withError('Incorrect password');
        }
        if ($userWithEmail['email'] != $request->email) {
            return redirect()->back()->withInput($request->only('email', 'remember'))
                ->withError('Incorrect email');
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();

        return redirect()->route("admin.login");
    }
}
