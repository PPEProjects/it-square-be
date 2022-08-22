<?php

namespace App\GraphQL\Mutations;

use App\Models\ProjectMember;
use GraphQL\Error\Error;
use Illuminate\Support\Facades\Auth;

class ProjectMemberMutations
{
    public function __construct(){}

    public function upsertProjectMember($_, array $args){
        $args["user_id"] = Auth::id();
        $args = array_diff_key($args, array_flip(["directive"]));
       return ProjectMember::updateOrCreate([
           "id" => @$args["id"]
       ],$args);
    }

    public function deleteProjectMember($_, array $args){
       return ProjectMember::find($args["id"])->delete();
    }
}
