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

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'k_dinas', 'k_dinas');
    }

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }
}
