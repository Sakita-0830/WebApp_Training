<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    // protected $fillable = ['tag'];

    protected $guarded = ['id'];

    public function todos(){
        return $this->hasMany('App/Models/Todo');
    }

}
