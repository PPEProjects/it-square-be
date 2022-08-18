<?php

namespace App\GraphQL\Mutations;

use GraphQL\Error\Error;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthMutations
{   
    public function __construct(){}

    public function signUp($_, array $args){
        if($args['password'] !== $args["password_confirmation"] ){
            throw new Error("password doesn't match");
        }
        $checkEmail = User::where("email", $args['email'])->first();
        if(isset($checkEmail)){
            throw new Error("email already exits");
        }
        $password = Hash::make($args['password']);
        $user = User::create([
            "name" =>  $args["name"],
            "email" => $args["email"],
            "phone_number" => $args["phone_number"],
            "password" => $password
        ]);
        $access_token = $user->createToken('authToken')->accessToken;
        return ["user" => $user, "token" => $access_token];
    }

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