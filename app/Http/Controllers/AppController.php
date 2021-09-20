<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Laravel\Passport\Client;

class AppController extends Controller
{
    public function getApp(): JsonResponse
    {
        $app = [];
        $client = Client::all()->where("password_client", true)->first()->only(["id","secret"]);

        $app["client"] = $client;

        return response()->json($app);
    }
}
