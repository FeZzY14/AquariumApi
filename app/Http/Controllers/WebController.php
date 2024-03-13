<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\RouteUrlGenerator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;

class WebController extends Controller
{
    public function index() {

        if (Session::has('token')) {
            $request = Request::create('/api/aquariums', 'GET');
            $request->headers->set('Accept', 'application/json');
            $request->headers->set('Authorization', 'Bearer '.session('token'));
            $response = app()->handle($request);


            $body = json_decode($response->getContent(), true);



            $aquariums = $body;

            return view('home',
            [
                'aquariums' => $aquariums
            ]);

        } else {
            return redirect(config('app.url').'/login')->with("error", "Please login!");
        }
    }

    public function sensors(string $id) {
        if (Session::has('token')) {
            $request = Request::create('api/sensors?filter[aquariumId]='.$id.'&include=measurements', 'GET');
            $request->headers->set('Accept', 'application/json');
            $request->headers->set('Authorization', 'Bearer '.session('token'));
            $response = app()->handle($request);


            $body = json_decode($response->getContent(), true);
            $sensors = $body;

            return view('sensors',
            [
                'sensors' => $sensors
            ]);

        } else {
            return redirect(config('app.url').'/login')->with("error", "Please login!");
        }
    }
}
