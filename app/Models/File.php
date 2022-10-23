<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['promotion_id', 'sk_cpns', 'sk_pns', 'sk_pangkat_terakhir', 'kartu_pegawai', 'ijazah_lama', 'ijazah_baru', 'transkrip_lama', 'transkrip_baru', 'skp_lama', 'skp_baru', 'sttpl', 'sk_mutasi', 'sk_pengalihan', 'sk_fungsional', 'pak_asli', 'pak_lama', 'sk_penyesuaian_fungsional', 'sk_penyesuaian_fungsional', 'sertifikat_pim', 'surat_pelantikan', 'surat_lowong', 'surat_tugas', 'sk_pelantikan', 'sk_jabatan', 'sk_belajar', 'uraian_tugas', 'sk_lulus_ujian', 'lainnya'];
}
