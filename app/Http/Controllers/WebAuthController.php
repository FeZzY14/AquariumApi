<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\helpers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\WebAuthController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\RouteUrlGenerator;
use Illuminate\Support\Facades\Config;

class WebAuthController extends Controller
{
    public function login() {
        if (Session::has('token')) {
            return redirect(config('app.url').'/home');
        }

        return view('login');
    }

    public function loginPost(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $apiRequest = Request::create('/api/login', 'POST', [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);
        $apiRequest->headers->set('Accept', 'application/json');
        $response = app()->handle($apiRequest);


        $body = json_decode($response->getContent(), true);

        if ($response->status() != 200) {
            return redirect(config('app.url').'/login')->with("error", $body['message']);
        }

        session(['token' => $body['access_token']]);
        return redirect(config('app.url').'/home')->with("success", "Successfully logged in");
    }

    public function logout() {
        $apiRequest = Request::create('/api/logout', 'POST');
        $apiRequest->headers->set('Accept', 'application/json');
        $apiRequest->headers->set('Authorization', 'Bearer '.session('token'));
        $response = app()->handle($apiRequest);

        $body = json_decode($response->getContent(), true);
        session()->flush();

        return redirect(config('app.url').'/login')->with("error", $body['message']);
    }

    public function register() {
        if (Session::has('token')) {
            return redirect(config('app.url').'/home');
        }

        return view('register');
    }

    public function registerPost(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'required'
        ]);

        $apiRequest = Request::create('/api/register', 'POST', [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'password_confirmation' => $validated['password_confirmation']
        ]);
        $apiRequest->headers->set('Accept', 'application/json');
        $response = app()->handle($apiRequest);


        $body = json_decode($response->getContent(), true);

        if ($response->status() != 201) {
            return redirect(config('app.url').'/register')->with("error", $body['message']);
        }

        session(['token' => $body['access_token']]);
        return redirect(config('app.url').'/home')->with("success", "Successfully logged in");
    }
}
