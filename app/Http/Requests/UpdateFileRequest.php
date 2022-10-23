<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'sk_cpns' => 'nullable|mimes:pdf|max:2048',
            'sk_pns' => 'nullable|mimes:pdf|max:2048',
            'sk_pangkat_terakhir' => 'nullable|mimes:pdf|max:2048',
            'kartu_pegawai' => 'nullable|mimes:pdf|max:2048',
            'ijazah_lama' => 'nullable|mimes:pdf|max:2048',
            'ijazah_baru' => 'nullable|mimes:pdf|max:2048',
            'transkrip_lama' => 'nullable|mimes:pdf|max:2048',
            'transkrip_baru' => 'nullable|mimes:pdf|max:2048',
            'skp_lama' => 'nullable|mimes:pdf|max:2048',
            'skp_baru' => 'nullable|mimes:pdf|max:2048',
            'sttpl' => 'nullable|mimes:pdf|max:2048',
            'sk_mutasi' => 'nullable|mimes:pdf|max:2048',
            'sk_pengalihan' => 'nullable|mimes:pdf|max:2048',
            'sk_fungsional' => 'nullable|mimes:pdf|max:2048',
            'pak_asli' => 'nullable|mimes:pdf|max:2048',
            'pak_lama' => 'nullable|mimes:pdf|max:2048',
            'sk_penyesuaian_fungsional' => 'nullable|mimes:pdf|max:2048',
            'sk_kenaikan_fungsional' => 'nullable|mimes:pdf|max:2048',
            'sertifikat_pim' => 'nullable|mimes:pdf|max:2048',
            'surat_pelantikan' => 'nullable|mimes:pdf|max:2048',
            'surat_lowong' => 'nullable|mimes:pdf|max:2048',
            'surat_tugas' => 'nullable|mimes:pdf|max:2048',
            'sk_pelantikan' => 'nullable|mimes:pdf|max:2048',
            'sk_jabatan' => 'nullable|mimes:pdf|max:2048',
            'sk_belajar' => 'nullable|mimes:pdf|max:2048',
            'sk_lulus_ujian' => 'nullable|mimes:pdf|max:2048',
            'uraian_tugas' => 'nullable|mimes:pdf|max:2048',
            'lainnya' => 'nullable|mimes:pdf|max:2048',
        ];
    }
}
