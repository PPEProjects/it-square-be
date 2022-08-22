<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAdvance extends Model
{
    use HasFactory;

    protected $guarded = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "skill" => "json"
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters["name"] ?? false,
            function ($query, $name) {
                $query->where("name", "like", "%" . $name . "%");
            }
        );
        
        $query->when(
            $filters["skill"] ?? false,
            function ($query, $skill) {
                $skill = implode("|", $skill);
                $query->where("skill", "REGEXP" , $skill);
            }
        );
    }
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
