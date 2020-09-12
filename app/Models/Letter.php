<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    protected $fillable = ['start_date','end_date','place_duty','year','information_a','information_b','categories'];
}
