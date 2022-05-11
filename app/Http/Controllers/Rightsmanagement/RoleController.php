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
     * Returns all Laratrust Roles
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
     * Returns single Role based on request
     * @param Role $role
     * @return JsonResponse
     */
    public function show(Role $role): JsonResponse
    {
        return response()->json($role);
    }

    /**
     * Stores a new Role
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
}
