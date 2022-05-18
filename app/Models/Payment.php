<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['project_id', 'received_date', 'type', 'payment_method', 'amount', 'remarks'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
