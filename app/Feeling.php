<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feeling extends Model
{
    protected $table = "feelings";
    public $primaryKey = 'f_id';
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
