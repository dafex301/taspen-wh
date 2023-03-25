<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Handle account login request
     *
     * @param LoginRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();
        try {
            $user = Auth::getProvider()->retrieveByCredentials($credentials);
            Auth::login($user);
            return $this->authenticated($request, $user);
        } catch (Throwable $e) {
            return redirect()->to('login')
                ->withErrors(trans('auth.failed'));
        }
    }

    /**
     * Handle response after user authenticated
     *
     * @param Request $request
     * @param Auth $user
     *
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended();
    }
}
