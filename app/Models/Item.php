<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function Invoice()
    {
        return $this->belongsToMany('App\Models\Invoice', 'detail_oders', 'item_id','invoice_id');
    }
}
