<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
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
            'sk_cpns' => 'required|mimes:pdf|max:2048',
            'sk_pns' => 'required|mimes:pdf|max:2048',
            'sk_pangkat_terakhir' => 'required|mimes:pdf|max:2048',
            'kartu_pegawai' => 'required|mimes:pdf|max:2048',
            'ijazah_lama' => 'sometimes|required|mimes:pdf|max:2048',
            'ijazah_baru' => 'required|mimes:pdf|max:2048',
            'transkrip_lama' => 'sometimes|required|mimes:pdf|max:2048',
            'transkrip_baru' => 'required|mimes:pdf|max:2048',
            'skp_lama' => 'required|mimes:pdf|max:2048',
            'skp_baru' => 'required|mimes:pdf|max:2048',
            'sttpl' => 'nullable|mimes:pdf|max:2048',
            'sk_mutasi' => 'nullable|mimes:pdf|max:2048',
            'sk_pengalihan' => 'nullable|mimes:pdf|max:2048',
            'sk_fungsional' => 'sometimes|required|mimes:pdf|max:2048',
            'pak_asli' => 'sometimes|required|mimes:pdf|max:2048',
            'pak_lama' => 'sometimes|required|mimes:pdf|max:2048',
            'sk_penyesuaian_fungsional' => 'sometimes|required|mimes:pdf|max:2048',
            'sk_kenaikan_fungsional' => 'sometimes|required|mimes:pdf|max:2048',
            'sertifikat_pim' => 'sometimes|required|mimes:pdf|max:2048',
            'surat_pelantikan' => 'sometimes|required|mimes:pdf|max:2048',
            'surat_lowong' => 'sometimes|required|mimes:pdf|max:2048',
            'surat_tugas' => 'sometimes|required|mimes:pdf|max:2048',
            'sk_pelantikan' => 'sometimes|required|mimes:pdf|max:2048',
            'sk_jabatan' => 'sometimes|required|mimes:pdf|max:2048',
            'sk_belajar' => 'sometimes|required|mimes:pdf|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'sk_cpns.required' => 'SK CPNS Wajib Diupload',
            'sk_cpns.mimes' => 'Upload file hanya bisa pdf',
            'sk_cpns.max' => 'Upload file maksimal 2 MB',
            'sk_pns.required' => 'SK PNS Wajib Diupload',
            'sk_pns.mimes' => 'Upload file hanya bisa pdf',
            'sk_pns.max' => 'Upload file maksimal 2 MB',
            'sk_pangkat_terakhir.required' => 'SK Pangkat Terakhir Wajib Diupload',
            'sk_pangkat_terakhir.mimes' => 'Upload file hanya bisa pdf',
            'sk_pangkat_terakhir.max' => 'Upload file maksimal 2 MB',
            'kartu_pegawai.required' => 'Kartu Pegawai Wajib Diupload',
            'kartu_pegawai.mimes' => 'Upload file hanya bisa pdf',
            'kartu_pegawai.max' => 'Upload file maksimal 2 MB',
            'ijazah_lama.required' => 'Ijazah Lama Wajib Diupload',
            'ijazah_lama.mimes' => 'Upload file hanya bisa pdf',
            'ijazah_lama.max' => 'Upload file maksimal 2 MB',
            'ijazah_baru.required' => 'Ijazah Terakhir Wajib Diupload',
            'ijazah_baru.mimes' => 'Upload file hanya bisa pdf',
            'ijazah_baru.max' => 'Upload file maksimal 2 MB',
            'transkrip_lama.required' => 'Transkrip Lama Wajib Diupload',
            'transkrip_lama.mimes' => 'Upload file hanya bisa pdf',
            'transkrip_lama.max' => 'Upload file maksimal 2 MB',
            'transkrip_baru.required' => 'Transkrip Terakhir Wajib Diupload',
            'transkrip_baru.mimes' => 'Upload file hanya bisa pdf',
            'transkrip_baru.max' => 'Upload file maksimal 2 MB',
            'skp_lama.required' => 'SKP Wajib Diupload',
            'skp_lama.mimes' => 'Upload file hanya bisa pdf',
            'skp_lama.max' => 'Upload file maksimal 2 MB',
            'skp_baru.required' => 'SKP Wajib Diupload',
            'skp_baru.mimes' => 'Upload file hanya bisa pdf',
            'skp_baru.max' => 'Upload file maksimal 2 MB',
            'sttpl.mimes' => 'Upload file hanya bisa pdf',
            'sttpl.max' => 'Upload file maksimal 2 MB',
            'sk_mutasi.mimes' => 'Upload file hanya bisa pdf',
            'sk_mutasi.max' => 'Upload file maksimal 2 MB',
            'sk_pengalihan.mimes' => 'Upload file hanya bisa pdf',
            'sk_pengalihan.max' => 'Upload file maksimal 2 MB',
            'sk_fungsional.required' => 'SK Jabatan Fungsional Wajib Diupload',
            'sk_fungsional.mimes' => 'Upload file hanya bisa pdf',
            'sk_fungsional.max' => 'Upload file maksimal 2 MB',
            'pak_asli.required' => 'PAK Asli Wajib Diupload',
            'pak_asli.mimes' => 'Upload file hanya bisa pdf',
            'pak_asli.max' => 'Upload file maksimal 2 MB',
            'pak_lama.required' => 'PAK Lama Wajib Diisi',
            'pak_lama.mimes' => 'Upload file hanya bisa pdf',
            'pak_lama.max' => 'Upload file maksimal 2 MB',
            'sk_penyesuaian_fungsional.required' => 'SK Penyesuaian Fungsional Wajib Diupload',
            'sk_penyesuaian_fungsional.mimes' => 'Upload file hanya bisa pdf',
            'sk_penyesuaian_fungsional.max' => 'Upload file maksimal 2 MB',
            'sk_kenaikan_fungsional.required' => 'SK Kenaikan Fungsional Wajib Diupload',
            'sk_kenaikan_fungsional.mimes' => 'Upload file hanya bisa pdf',
            'sk_kenaikan_fungsional.max' => 'Upload file maksimal 2 MB',
            'sertifikat_pim.required' => 'Sertifikat PIM Wajib Diupload',
            'sertifikat_pim.mimes' => 'Upload file hanya bisa pdf',
            'sertifikat_pim.max' => 'Upload file maksimal 2 MB',
            'surat_pelantikan.required' => 'Surat Pernyataan Pelantikan Wajib Diupload',
            'surat_pelantikan.mimes' => 'Upload file hanya bisa pdf',
            'surat_pelantikan.max' => 'Upload file maksimal 2 MB',
            'surat_lowong.required' => 'Surat Menduduki Jabatan Lowong Wajib Diupload',
            'surat_lowong.mimes' => 'Upload file hanya bisa pdf',
            'surat_lowong.max' => 'Upload file maksimal 2 MB',
            'surat_tugas.required' => 'Surat Pernyataan Melaksanakan Tugas Wajib Diupload',
            'surat_tugas.mimes' => 'Upload file hanya bisa pdf',
            'surat_tugas.max' => 'Upload file maksimal 2 MB',
            'sk_pelantikan.required' => 'Semua SK Pelantikan Wajib Diupload',
            'sk_pelantikan.mimes' => 'Upload file hanya bisa pdf',
            'sk_pelantikan.max' => 'Upload file maksimal 2 MB',
            'sk_jabatan.required' => 'SK Jabatan Wajib Diupload',
            'sk_jabatan.mimes' => 'Upload file hanya bisa pdf',
            'sk_jabatan.max' => 'Upload file maksimal 2 MB',
            'sk_belajar.required' => 'SK Tugas/Ijin Belajar Wajib Diupload',
            'sk_belajar.mimes' => 'Upload file hanya bisa pdf',
            'sk_belajar.max' => 'Upload file maksimal 2 MB',
        ];
    }
}
