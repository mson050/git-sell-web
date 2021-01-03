<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public function item()
    {
        return $this->belongsToMany('App\Models\Item','detail_oders','invoice_id','item_id')->withPivot('item_quantity');
    }
}
