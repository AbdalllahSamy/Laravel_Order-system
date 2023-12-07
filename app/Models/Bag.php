<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bag extends Model
{
    use HasFactory;
    public function menu(){
        return $this->belongsTo(Menu::class, 'order_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'customer_id');
    }
}
