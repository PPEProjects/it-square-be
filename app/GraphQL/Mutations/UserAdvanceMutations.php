<?php

namespace App\GraphQL\Mutations;

use App\Models\Project;
use App\Models\UserAdvance;
use GraphQL\Error\Error;
use Illuminate\Support\Facades\Auth;

class UserAdvanceMutations
{
    public function __construct(){}

    public function upsertUserAdvance($_, array $args){
        $args["user_id"] = Auth::id();
        $args = array_diff_key($args, array_flip(["directive"]));
       return UserAdvance::updateOrCreate([
           "user_id" => @$args["user_id"]
       ],$args);
    }

    public function deleteUserAdvance($_, array $args){
        return  UserAdvance::where("user_id", $args["user_id"])->delete();
    }
}
