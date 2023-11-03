<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ["sell_id", "co_name", "coe_mobile", "co_city", "coe_name", "coe_add", "artc", "packages", "weight"];
}
