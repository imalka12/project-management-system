<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'company', 'address', 'telephone', 'email', 'contact_person', 'contact_person_telephone', 'contact_person_email'];
    
    public function projects(){
        return $this->hasMany(Project::class);
    }
}
