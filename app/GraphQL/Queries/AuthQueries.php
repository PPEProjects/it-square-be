<?php

namespace App\GraphQL\Queries;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use GraphQL\Error\Error;
use Illuminate\Support\Facades\Hash;

class AuthQueries
{
    public function __construct(){}
    public function logIn($_, array $args){
        $user = User::where("email", $args["email"])
                    ->first();
        if($user){
            if(Hash::check($args["password"], $user->password)){
                $token = $user->createToken('authToken')->accessToken;
                return [
                    "user" => $user,
                    "token" => $token
                ];
            }
        }           
        throw new Error("Wrong email or password!");
    }
}