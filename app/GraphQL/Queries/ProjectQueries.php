<?php

namespace App\GraphQL\Queries;

use App\Models\Project;
use GraphQL\Error\Error;
use Illuminate\Support\Facades\Auth;

class ProjectQueries
{
    public function __construct(){}

    public function listProject($_, array $args){
       return Project::filter($args)
                        ->orderBy("created_at", "DESC")
                        ->get();
    }

    public function detailProject($_, array $args){
        return Project::find($args["id"]);
     }
}
