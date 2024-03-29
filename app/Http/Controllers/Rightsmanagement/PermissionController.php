<?php

namespace App\Http\Controllers\Rightsmanagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionStoreRequest;
use App\Models\Permission;
use App\Transformers\PermissionTransformer;
use Illuminate\Http\JsonResponse;

class PermissionController extends Controller
{
    /**
     * Returns all available Laratrust permissions
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $permissions = Permission::all();
        $permissions->transform(function ($permissions) {
            return (new PermissionTransformer())->transform($permissions);
        });
        return response()->json($permissions);
    }

    /**
     * Returns single permission based on request
     * @param Permission $permissions
     * @return JsonResponse
     */
    public function show(Permission $permissions): JsonResponse
    {
        return response()->json($permissions);
    }

    /**
     * Stores a new permission
     *
     * @param PermissionStoreRequest $request
     * @return JsonResponse
     */
    public function store(PermissionStoreRequest $request): JsonResponse
    {
        $permissions = new Permission();
        $permissions->fill($request->all());
        $permissions->save();

        return response()->json($permissions);
    }
}
