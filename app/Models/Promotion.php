<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'verificator_id', 'admin_id' , 'agency_id', 'procedure_type', 'promotion_type', 'job_type', 'status'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id_asn');
    }

    public function verificator()
    {
        return $this->belongsTo(User::class, 'verificator_id', 'id')->withDefault();
    }
  
  	public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id')->withDefault();
    }

    public function cancel_promotion()
    {
        return $this->hasOne(CancelPromotion::class)->withDefault(['reason' => '', 'additional_information' => '']);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function promotion_type()
    {
        if ($this->promotion_type == 1) {
            return 'Reguler';
        } elseif ($this->promotion_type == 2) {
            return 'Memperoleh Ijazah/Penyesuaian Ijazah';
        } elseif ($this->promotion_type == 3) {
            return 'Struktural';
        } else {
            return 'Jabatan Fungsional Tertentu';
        }
    }

    public function status()
    {
        if ($this->status == 1) {
            return 'Input Berkas';
        } elseif ($this->status == 2) {
            return 'Berkas Disimpan (Terverifikasi)';
        } elseif ($this->status == 3) {
            return 'Approval Surat Usulan';
        } elseif ($this->status == 4) {
            return 'Perbaikan Dokumen';
        } elseif ($this->status == 5) {
            return 'Usulan Ditolak';
        } elseif ($this->status == 6) {
          	return 'Usulan Diremajakan';
        } else {
          	return 'Menunggu Peremajaan';
        }
    }
}
