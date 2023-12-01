<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function item(){
        return $this->belongsTo(Menu::class, 'item_id');
    }
}
