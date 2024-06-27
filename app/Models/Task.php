<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ["title"];


    // Accessor for created_at attribute
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    // Accessor for updated_at attribute
    public function getUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    // Mutator for created_at attribute
    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    // Mutator for updated_at attribute
    public function setUpdatedAtAttribute($value)
    {
        $this->attributes['updated_at'] = \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
