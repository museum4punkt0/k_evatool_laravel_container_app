<?php

namespace App\Http\Controllers\Rightsmanagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;
use App\Models\User;
use App\Transformers\RoleTransformer;
use Illuminate\Http\JsonResponse;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {

        $roles = Role::all();
        $roles->transform(function ($role) {
            return (new RoleTransformer())->transform($role);
        });
        logger($roles);
        return response()->json($roles);
    }

    /**
     * @param Role $role
     * @return JsonResponse
     */
    public function show(Role $role): JsonResponse
    {
        return response()->json($role);
    }

    /**
     * Stores a survey record
     *
     * @param RoleStoreRequest $request
     * @return JsonResponse
     */
    public function store(RoleStoreRequest $request): JsonResponse
    {
        $role = new Role();
        $role->fill($request->all());
        $role->save();

        return response()->json($role);
    }

    public function getRolesForRequestingUser(User $user): JsonResponse
    {
        $roles = Role::where('power', '<=', $user->roles->power);
        $roles->transform(function ($role) {
            return (new RoleTransformer())->transform($role);
        });
        return response()->json($roles);
    }
}
