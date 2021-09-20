<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersController extends Controller
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

    public function checkLogin(Request $request)
    {

        if ($request->user()) {

//            return response()->json($request->user());
        }
    }
}
