<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\Client;

class AppController extends Controller
{
    public function getApp(): JsonResponse
    {
        $app    = [];
        $client = Client::all()->where("password_client", true)->first()->only(["id", "secret"]);

        $app["client"] = $client;

        $packageVersion = json_decode(file_get_contents(base_path('packages/twoavy/evaluation-tool') . "/composer.json"));
        $app["packageVersion"] = $packageVersion->version;

        return response()->json($app);
    }

    public static function sendTestMail()
    {
        $email = "debug@2av.de";
        if (env('MAIL_FROM_ADDRESS', false)) {
            $email = env('MAIL_FROM_ADDRESS');
        }
        try {
            Mail::send('tests.test_email', [], function ($message) use ($email) {
                $message->to($email)->subject('Test mail from ' . env('APP_NAME'));
            });
            echo "ok";
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }


}
