<?php

namespace App\GraphQL\Mutations;

use App\Models\Project;
use GraphQL\Error\Error;
use Illuminate\Support\Facades\Auth;

class ProjectMutations
{
    public function __construct(){}
    public function upsertProject($_, array $args){
        $args["user_id"] = Auth::id();
        $args = array_diff_key($args, array_flip(["directive"]));
       return Project::updateOrCreate([
           "id" => @$args["id"]
       ],$args);
    }
}
