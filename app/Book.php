<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = [];
    public function getRouteKeyName()
    {
        return 'id';
    }
    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }
}
