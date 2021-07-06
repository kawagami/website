<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    protected $table = 'stocks';
    protected $fillable = ['stock_code', 'purchase_price', 'purchase_date', 'amount'];
}
