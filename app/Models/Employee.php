<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'tcpns';

    protected $primaryKey = 'nip';

    public $timestamps = false;

    protected $fillable = ['k_dinas', 'k_unor'];

    public function getRouteKeyName()
    {
        return 'nip';
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'k_dinas', 'k_dinas')->withDefault();
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'k_unor', 'k_unor')->withDefault();
    }

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }
}
