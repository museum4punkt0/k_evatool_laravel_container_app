<?php

namespace App\Transformers;

use App\Models\Permission;
use League\Fractal\TransformerAbstract;

class PermissionTransformer extends TransformerAbstract
{
    /**
     * Role transformer.
     *
     * @param Permission $permission
     * @return array
     */
    public function transform(Permission $permission): array
    {
        return [
            "id"                     => (int)$permission->id,
            "name"                   => (string)$permission->name,
            "displayName"            => (string)$permission->display_name,
            "description"            => (string)$permission->description,
            "createdAt"              => $permission->created_at,
            "updatedAt"              => $permission->updated_at,
        ];
    }

    public static function originalAttribute($index): ?string
    {
        $attributes = self::attributes();
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index): ?string
    {
        $attributes = array_flip(self::attributes());
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    // added
    public static function attributes(): array
    {
        return [
            "id"               => "id",
            "name"             => "name",
            "displayName"      => "display_name",
            "description"      => "description",
            "createdAt"        => "created_at",
            "updatedAt"        => "updated_at"
        ];
    }
}
