<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\UserLog;

class UserLogController extends Controller
{
    public static function createLog($userId, $type = "general", $data = false): UserLog
    {
        $log          = new UserLog();
        $log->user_id = $userId;
        $log->type    = $type;
        if ($data) {
            $log->data = $data;
        }
        $log->save();

        return $log;
    }
}
