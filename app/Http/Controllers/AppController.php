<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\Client;
use Twoavy\EvaluationTool\Models\EvaluationToolSurveyLanguage;

class AppController extends Controller
{
    public function getApp(): JsonResponse
    {
        // check for clients
        if (!Client::all()->where("password_client", true)->first()) {
            return response()->json(["message" => "no oauth clients present. please create one", "status" => "warning"]);
        }

        // check for languages
        if (EvaluationToolSurveyLanguage::all()->count() === 0) {
            return response()->json(["message" => "no languages present. please create one", "status" => "warning"]);
        }

        // check for users
        if (User::whereRoleIs('admin')->count() === 0) {
            return response()->json(["message" => "no admin users present. please create one", "status" => "warning"]);
        }

        $app    = [];
        $client = Client::all()->where("password_client", true)->first()->only(["id", "secret"]);

        $app["client"] = $client;

        $packageVersion        = json_decode(file_get_contents(base_path('packages/twoavy/evaluation-tool') . "/composer.json"));
        $app["packageVersion"] = $packageVersion->version;

        if (env('SPEECH_TO_TEXT_SERVICE', false)) {
            $app["speechToTextServiceEnabled"] = true;
        }
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
