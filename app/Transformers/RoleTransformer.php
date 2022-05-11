<?php

namespace App\Transformers;

use App\Models\Role;
use League\Fractal\TransformerAbstract;

class RoleTransformer extends TransformerAbstract
{
    /**
     * Role transformer.
     *
     * @param Role $role
     * @return array
     */
    public function transform(Role $role): array
    {
        return [
            "id"                     => (int)$role->id,
            "name"                   => (string)$role->name,
            "displayName"            => (string)$role->display_name,
            "description"            => (string)$role->description,
            "createdAt"              => $role->created_at,
            "updatedAt"              => $role->updated_at,
            "power"                  => (int)$role->power,
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
            "updatedAt"        => "updated_at",
            "power"            => "power"
        ];
    }
}
