<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\helpers;
use Illuminate\Support\Facades\Session;
USE Illuminate\Http\RedirectResponse;
use App\Http\Controllers\WebAuthController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\RouteUrlGenerator;

class WebAuthController extends Controller
{
    public function login() {
        if (Session::has('token')) {
            return redirect('/home');
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
            return redirect('/login')->with("error", $body['message']);
        }

        session(['token' => $body['access_token']]);
        return redirect('139.59.142.67/home')->with("success", "Successfully logged in");
    }

    public function logout() {
        $apiRequest = Request::create('/api/logout', 'POST');
        $apiRequest->headers->set('Accept', 'application/json');
        $apiRequest->headers->set('Authorization', 'Bearer '.session('token'));
        $response = app()->handle($apiRequest);

        $body = json_decode($response->getContent(), true);
        session()->flush();

        return redirect('139.59.142.67/login')->with("error", $body['message']);
    }

    public function register() {
        if (Session::has('token')) {
            return redirect('/home');
        }

        return view('register');
    }

    public function registerPost(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password2' => 'required'
        ]);

        $apiRequest = Request::create('/api/register', 'POST', $validated);
        $apiRequest->headers->set('Accept', 'application/json');
        $response = app()->handle($apiRequest);


        $body = json_decode($response->getContent(), true);

        if ($response->status() != 200) {
            return redirect('/register')->with("error", $body['message']);
        }

        session(['token' => $body['access_token']]);
        return redirect('139.59.142.67/home')->with("success", "Successfully logged in");
    }
}
