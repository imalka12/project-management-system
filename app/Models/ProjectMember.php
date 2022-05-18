<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectMember extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillabel = ['member_id' , 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
