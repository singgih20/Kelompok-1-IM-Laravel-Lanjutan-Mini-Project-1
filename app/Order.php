<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    public function getRouteKeyName()
    {
        return 'invoice_number';
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function books()
    {
        return $this->belongsToMany('App\Book');
    }
}
