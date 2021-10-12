<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;
use Ramsey\Uuid\UuidInterface;

class UserToken extends Model
{
    use HasFactory;

    const TOKEN_PURPOSE_INVITE = "invite";

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public static function createToken(): UuidInterface
    {
        return Str::uuid();
    }
}
