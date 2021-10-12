<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

;

use App\Http\Requests\UserStoreRequest;
use App\Mail\InviteUser;
use App\Models\User;
use App\Models\UserToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return response()->json($user);
    }

    /**
     * @param UserStoreRequest $request
     * @return JsonResponse
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        $user = new User();
        $user->fill($request->all());
        $user->save();
        return response()->json($user);
    }

    /**
     * @param UserStoreRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UserStoreRequest $request, User $user): JsonResponse
    {
        $user->fill($request->all());
        $user->save();
        return response()->json($user);
    }

    public function checkLogin(Request $request): JsonResponse
    {
        if ($request->user()) {
            if (!$user = User::find($request->user()->id)) {
                return response()->json("user not found", 409);
            }
            $user->last_login = Carbon::now();
            $user->save();
            return response()->json($user);
        }
        return response()->json("login error", 409);
    }

    public function inviteUser(User $user, Request $request): JsonResponse
    {
        if (!$request->has("confirm_url")) {
            return response()->json('no confirm url provided', 409);
        }

        if ($tokens = UserToken::where("user_id", $user->id)->where("purpose", UserToken::TOKEN_PURPOSE_INVITE)->get()) {
            foreach ($tokens as $token) {
                $token->revoked_at = Carbon::now();
                $token->save();
            }
        }

        $token          = new UserToken();
        $token->purpose = UserToken::TOKEN_PURPOSE_INVITE;
        $token->user_id = $user->id;
        $token->token   = UserToken::createToken();
        $token->save();

        Mail::to($user)->send(new InviteUser($token, $request->confirm_url, $user));

        UserLogController::createLog($user->id, "invite sent");

        return response()->json($user);
    }

    public function confirmPassword(Request $request): JsonResponse
    {
        if (!$request->has("token")) {
            return response()->json('no token provided', 409);
        }

        if (!$request->has("password")) {
            return response()->json('no password provided', 409);
        }

        if (!$token = UserToken::where("token", $request->token)->whereNull("used_at")->first()) {
            return response()->json('token invalid', 409);
        }

        if (!$user = User::find($token->user_id)) {
            return response()->json('no user found', 409);
        }

        $user->password = $request->password;
        $user->save();

        $token->revoked_at = Carbon::now();
        $token->used_at    = Carbon::now();
        $token->save();

        UserLogController::createLog($user->id, "user password confirm");

        return response()->json($user);
    }


}
