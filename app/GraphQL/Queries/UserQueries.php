<?php

namespace App\GraphQL\Queries;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use GraphQL\Error\Error;
use Illuminate\Support\Facades\Hash;

class UserQueries
{
    public function __construct(){}
    public function me($_, array $args){
        return Auth::user();
    }
}