<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'telephone', 'address', 'email', 'whatsapp_number'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
