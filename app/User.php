<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "users";
    public $primaryKey = 'user_id';
    public $timestamps = true;

    public function services()
    {
        return $this->hasMany(Service::class, 'user_id','user_id');
    }

    public function feeling()
    {
        return $this->hasOne(Felling::class,'user_id','user_id');
    }
}
