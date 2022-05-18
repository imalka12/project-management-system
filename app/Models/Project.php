<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = ['name' , 'amount' , 'status' ,'client_id', 'start_date' , 'end_date'];

    public function client(){
        return $this->belongsTo(Client::class);
    }
     public function members()
     {
         return $this->hasMany(Member::class);
     }

     public function payments()
     {
         return $this->hasMany(Payment::class);
     }

}
