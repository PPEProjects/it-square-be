<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectMember extends Model
{
    use HasFactory, SoftDeletes;

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
    protected $casts = [];

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters["name"] ?? false,
            function ($query, $name) {
                $query->where("name", "like", "%" . $name . "%");
            }
        );
    }
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
    public function project()
    {
        return $this->belongsTo(Project::class, "project_id");
    }
    public function user_assign()
    {
        return $this->belongsTo(User::class, "user_assign_id");
    }
}
