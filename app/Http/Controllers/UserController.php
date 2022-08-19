<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getUser(Request $request){
        $userId = $this->getUserIdByToken($request["token"]);
        return User::find($userId);
    }

    function getUserIdByToken($token){
        $token_parts = explode('.', $token);
        $token_header = $token_parts[1];
        $token_header_json = base64_decode($token_header);
        $token_header_array = json_decode($token_header_json, true);
        $token_id = $token_header_array['jti'];
        $userToken = DB::table("oauth_access_tokens")
            ->where("id", $token_id)
            ->first();
        return @$userToken->user_id;
    }
}
