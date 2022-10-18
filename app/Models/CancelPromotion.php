<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelPromotion extends Model
{
    use HasFactory;

    protected $fillable = ['reason', 'additional_information'];
}
