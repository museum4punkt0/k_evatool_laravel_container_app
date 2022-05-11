<?php

namespace App\Models;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    // date fields
    protected $dates = [
        "created_at",
        "updated_at",
    ];
}
