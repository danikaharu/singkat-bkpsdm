<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\{StorePromotionRequest, UpdatePromotionRequest};
use App\Models\{CancelPromotion, Employee, File, Promotion};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};
use Yajra\DataTables\Facades\DataTables;

class PromotionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view promotions')->only('index');
        $this->middleware('permission:create promotions')->only('create', 'store', 'createStep1', 'storeStep1', 'createStep2', 'storeStep2', 'createStep3', 'storeStep3');
        $this->middleware('permission:edit promotions')->only('edit', 'update');
        $this->middleware('permission:delete promotions')->only('destroy');
        $this->middleware('permission:show promotions')->only('show');
        $this->middleware('permission:choose verificator')->only('storeVerificator');
        $this->middleware('permission:approved promotions')->only('approve', 'detailApprove', 'cancel', 'detailCancel');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.promotion.index');
    }

    public function getEmployee()
    {
        $usernameAdmin = Auth::user()->username;
        $adminInfo = Employee::where('nip_baru', $usernameAdmin)->first();

        $promotionQuery = Promotion::query();

        if (!empty(request()->filter_promotion)) {
            $promotionQuery->where('promotion_type', request()->filter_promotion);
        }
        if (!empty(request()->filter_status)) {
            $promotionQuery->where('status', request()->filter_status);
        }
        if (!empty(request()->filter_name)) {
            $searchString = request()->filter_name;
            $promotionQuery->whereHas('employee', function ($query) use ($searchString) {
                $query->where('nama', 'like', '%' . $searchString . '%');
            });
        }
        if (!empty(request()->filter_nip)) {
            $searchString = request()->filter_nip;
            $promotionQuery->whereHas('employee', function ($query) use ($searchString) {
                $query->where('nip_baru', 'like', '%' . $searchString . '%');
            });
        }

        $promotions = $promotionQuery->with('employee')->latest();

        if (auth()->user()->roles->first()->id == 7) {
            $promotions->get();
        } else if (auth()->user()->roles->first()->id == 8) {
            $promotions->where('agency_id', $adminInfo->k_dinas);
        } else {
            $promotions->where('verificator_id', auth()->user()->id);
        }
        return dataTables()->of($promotions)
            ->addColumn('nip', function ($row) {
                return $row->employee ? $row->employee->nip_baru : '-';
            })
            ->addColumn('nama', function ($row) {
                return $row->employee ? $row->employee->nama : '-';
            })
            ->editColumn('promotion_type', function ($row) {
                return $row->promotion_type();
            })
            ->addColumn('created_at', function ($row) {
                return $row->created_at->isoFormat('DD-MM-YYYY');
            })
            ->editColumn('status', function ($row) {
                return $row->status();
            })
            ->addColumn('action', 'admin.promotion.include.action')
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.promotions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePromotionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePromotionRequest $request)
    {
        $promotion = $request->session()->get('promotion');

        $promotion->save();

        return redirect()
            ->route('promotions.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        $usernameAdmin = Auth::user()->username;
        $adminInfo = Employee::where('nip_baru', $usernameAdmin)->first();

        $files = File::where('promotion_id', $promotion->id)->get();

        if ($promotion->verificator_id != auth()->user()->id && auth()->user()->roles->first()->id == 9) {
            return redirect()
                ->back()
                ->with('toast_error', __('Maaf anda tidak dapat mengakses data asn tersebut.'));
        }

        if ($adminInfo->k_dinas != $promotion->employee->k_dinas && auth()->user()->roles->first()->id == 8) {
            return redirect()
                ->back()
                ->with('toast_error', __('Maaf anda tidak dapat mengakses data asn tersebut.'));
        }

        return view('admin.promotion.show', compact('promotion', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        $usernameAdmin = Auth::user()->username;
        $adminInfo = Employee::where('nip_baru', $usernameAdmin)->first();
        $employee = Employee::with('promotions.files', 'agency')->where('id_asn', $promotion->employee_id)->first();

        if ($promotion->verificator_id != auth()->user()->id && auth()->user()->roles->first()->id == 9) {
            return redirect()
                ->back()
                ->with('toast_error', __('Maaf anda tidak dapat mengakses data asn tersebut.'));
        }

        if ($adminInfo->k_dinas != $promotion->employee->k_dinas && auth()->user()->roles->first()->id == 8) {
            return redirect()
                ->back()
                ->with('toast_error', __('Maaf anda tidak dapat mengakses data asn tersebut.'));
        }

        return view('admin.promotion.edit', compact('promotion', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests  $request
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {
        $path = storage_path('app/public/upload/berkas/');

        $attr = request()->validate([
            'sk_cpns' => 'nullable', 'mimes:pdf', 'max:2048',
            'sk_pns' => 'nullable', 'mimes:pdf', 'max:2048',
            'sk_pangkat_terakhir' => 'nullable', 'mimes:pdf', 'max:2048',
            'kartu_pegawai' => 'nullable', 'mimes:pdf', 'max:2048',
            'ijazah_lama' => 'nullable', 'mimes:pdf', 'max:2048',
            'ijazah_baru' => 'nullable', 'mimes:pdf', 'max:2048',
            'transkrip_lama' => 'nullable', 'mimes:pdf', 'max:2048',
            'transkrip_baru' => 'nullable', 'mimes:pdf', 'max:2048',
            'skp_lama' => 'nullable', 'mimes:pdf', 'max:2048',
            'skp_baru' => 'nullable', 'mimes:pdf', 'max:2048',
            'sttpl' => 'nullable', 'mimes:pdf', 'max:2048',
            'sk_mutasi' => 'nullable', 'mimes:pdf', 'max:2048',
            'sk_pengalihan' => 'nullable', 'mimes:pdf', 'max:2048',
            'sk_fungsional' => 'nullable', 'mimes:pdf', 'max:2048',
            'pak_asli' => 'nullable', 'mimes:pdf', 'max:2048',
            'pak_lama' => 'nullable', 'mimes:pdf', 'max:2048',
            'sk_penyesuaian_fungsional' => 'nullable', 'mimes:pdf', 'max:2048',
            'sk_kenaikan_fungsional' => 'nullable', 'mimes:pdf', 'max:2048',
            'sertifikat_pim' => 'nullable', 'mimes:pdf', 'max:2048',
            'surat_pelantikan' => 'nullable', 'mimes:pdf', 'max:2048',
            'surat_lowong' => 'nullable', 'mimes:pdf', 'max:2048',
            'surat_tugas' => 'nullable', 'mimes:pdf', 'max:2048',
            'sk_pelantikan' => 'nullable', 'mimes:pdf', 'max:2048',
            'sk_jabatan' => 'nullable', 'mimes:pdf', 'max:2048',
            'sk_belajar' => 'nullable', 'mimes:pdf', 'max:2048'
        ]);

        if (request()->file('sk_cpns') && request()->file('sk_cpns')->isValid()) {

            foreach ($promotion->files as $file) {
                if ($file->sk_cpns != null && file_exists($path . $file->sk_cpns)) {
                    unlink($path . $file->sk_cpns);
                    $file->delete();
                }
            }

            $filename = request()->file('sk_cpns')->hashName();
            request()->file('sk_cpns')->storeAs('upload/berkas', $filename, 'public');

            $attr['sk_cpns'] = $filename;
        }
        if (request()->file('sk_pns') && request()->file('sk_pns')->isValid()) {

            foreach ($promotion->files as $file) {
                if ($file->sk_pns != null && file_exists($path . $file->sk_pns)) {
                    unlink($path . $file->sk_pns);
                    $file->delete();
                }
            }

            $filename = request()->file('sk_pns')->hashName();
            request()->file('sk_pns')->storeAs('upload/berkas', $filename, 'public');

            $attr['sk_pns'] = $filename;
        }
        if (request()->file('sk_pangkat_terakhir') && request()->file('sk_pangkat_terakhir')->isValid()) {
            foreach ($promotion->files as $file) {
                if ($file->sk_pangkat_terakhir != null && file_exists($path . $file->sk_pangkat_terakhir)) {
                    unlink($path . $file->sk_pangkat_terakhir);
                    $file->delete();
                }
            }

            $filename = request()->file('sk_pangkat_terakhir')->hashName();
            request()->file('sk_pangkat_terakhir')->storeAs('upload/berkas', $filename, 'public');

            $attr['sk_pangkat_terakhir'] = $filename;
        }
        if (request()->file('kartu_pegawai') && request()->file('kartu_pegawai')->isValid()) {
            foreach ($promotion->files as $file) {
                if ($file->kartu_pegawai != null && file_exists($path . $file->kartu_pegawai)) {
                    unlink($path . $file->kartu_pegawai);
                    $file->delete();
                }
            }

            $filename = request()->file('kartu_pegawai')->hashName();
            request()->file('kartu_pegawai')->storeAs('upload/berkas', $filename, 'public');

            $attr['kartu_pegawai'] = $filename;
        }
        if (request()->file('ijazah_lama') && request()->file('ijazah_lama')->isValid()) {
            foreach ($promotion->files as $file) {
                if ($file->ijazah_lama != null && file_exists($path . $file->ijazah_lama)) {
                    unlink($path . $file->ijazah_lama);
                    $file->delete();
                }
            }

            $filename = request()->file('ijazah_lama')->hashName();
            request()->file('ijazah_lama')->storeAs('upload/berkas', $filename, 'public');

            $attr['ijazah_lama'] = $filename;
        }
        if (request()->file('ijazah_baru') && request()->file('ijazah_baru')->isValid()) {
            foreach ($promotion->files as $file) {
                if ($file->ijazah_baru != null && file_exists($path . $file->ijazah_baru)) {
                    unlink($path . $file->ijazah_baru);
                    $file->delete();
                }
            }

            $filename = request()->file('ijazah_baru')->hashName();
            request()->file('ijazah_baru')->storeAs('upload/berkas', $filename, 'public');

            $attr['ijazah_baru'] = $filename;
        }
        if (request()->file('transkrip_lama') && request()->file('transkrip_lama')->isValid()) {
            foreach ($promotion->files as $file) {
                if ($file->transkrip_lama != null && file_exists($path . $file->transkrip_lama)) {
                    unlink($path . $file->transkrip_lama);
                    $file->delete();
                }
            }

            $filename = request()->file('transkrip_lama')->hashName();
            request()->file('transkrip_lama')->storeAs('upload/berkas', $filename, 'public');

            $attr['transkrip_lama'] = $filename;
        }
        if (request()->file('transkrip_baru') && request()->file('transkrip_baru')->isValid()) {
            foreach ($promotion->files as $file) {
                if ($file->transkrip_baru != null && file_exists($path . $file->transkrip_baru)) {
                    unlink($path . $file->transkrip_baru);
                    $file->delete();
                }
            }

            $filename = request()->file('transkrip_baru')->hashName();
            request()->file('transkrip_baru')->storeAs('upload/berkas', $filename, 'public');

            $attr['transkrip_baru'] = $filename;
        }
        if (request()->file('skp_lama') && request()->file('skp_lama')->isValid()) {
            foreach ($promotion->files as $file) {
                if ($file->skp_lama != null && file_exists($path . $file->skp_lama)) {
                    unlink($path . $file->skp_lama);
                    $file->delete();
                }
            }

            $filename = request()->file('skp_lama')->hashName();
            request()->file('skp_lama')->storeAs('upload/berkas', $filename, 'public');

            $attr['skp_lama'] = $filename;
        }
        if (request()->file('skp_baru') && request()->file('skp_baru')->isValid()) {

            foreach ($promotion->files as $file) {
                if ($file->skp_baru != null && file_exists($path . $file->skp_baru)) {
                    unlink($path . $file->skp_baru);
                    $file->delete();
                }
            }

            $filename = request()->file('skp_baru')->hashName();
            request()->file('skp_baru')->storeAs('upload/berkas', $filename, 'public');

            $attr['skp_baru'] = $filename;
        }
        if (request()->file('sttpl') && request()->file('sttpl')->isValid()) {
            foreach ($promotion->files as $file) {
                if ($file->sttpl != null && file_exists($path . $file->sttpl)) {
                    unlink($path . $file->sttpl);
                    $file->delete();
                }
            }

            $filename = request()->file('sttpl')->hashName();
            request()->file('sttpl')->storeAs('upload/berkas', $filename, 'public');

            $attr['sttpl'] = $filename;
        }
        if (request()->file('sk_mutasi') && request()->file('sk_mutasi')->isValid()) {
            foreach ($promotion->files as $file) {
                if ($file->sk_mutasi != null && file_exists($path . $file->sk_mutasi)) {
                    unlink($path . $file->sk_mutasi);
                    $file->delete();
                }
            }

            $filename = request()->file('sk_mutasi')->hashName();
            request()->file('sk_mutasi')->storeAs('upload/berkas', $filename, 'public');

            $attr['sk_mutasi'] = $filename;
        }
        if (request()->file('sk_pengalihan') && request()->file('sk_pengalihan')->isValid()) {
            foreach ($promotion->files as $file) {
                if ($file->sk_pengalihan != null && file_exists($path . $file->sk_pengalihan)) {
                    unlink($path . $file->sk_pengalihan);
                    $file->delete();
                }
            }

            $filename = request()->file('sk_pengalihan')->hashName();
            request()->file('sk_pengalihan')->storeAs('upload/berkas', $filename, 'public');

            $attr['sk_pengalihan'] = $filename;
        }
        if (request()->file('sk_fungsional') && request()->file('sk_fungsional')->isValid()) {
            foreach ($promotion->files as $file) {
                if ($file->sk_fungsional != null && file_exists($path . $file->sk_fungsional)) {
                    unlink($path . $file->sk_fungsional);
                    $file->delete();
                }
            }

            $filename = request()->file('sk_fungsional')->hashName();
            request()->file('sk_fungsional')->storeAs('upload/berkas', $filename, 'public');

            $attr['sk_fungsional'] = $filename;
        }
        if (request()->file('pak_asli') && request()->file('pak_asli')->isValid()) {
            foreach ($promotion->files as $file) {
                if ($file->pak_asli != null && file_exists($path . $file->pak_asli)) {
                    unlink($path . $file->pak_asli);
                    $file->delete();
                }
            }

            $filename = request()->file('pak_asli')->hashName();
            request()->file('pak_asli')->storeAs('upload/berkas', $filename, 'public');

            $attr['pak_asli'] = $filename;
        }
        if (request()->file('pak_lama') && request()->file('pak_lama')->isValid()) {
            foreach ($promotion->files as $file) {
                if ($file->pak_lama != null && file_exists($path . $file->pak_lama)) {
                    unlink($path . $file->pak_lama);
                    $file->delete();
                }
            }

            $filename = request()->file('pak_lama')->hashName();
            request()->file('pak_lama')->storeAs('upload/berkas', $filename, 'public');

            $attr['pak_lama'] = $filename;
        }

        if (request()->file('sk_penyesuaian_fungsional') && request()->file('sk_penyesuaian_fungsional')->isValid()) {
            foreach ($promotion->files as $file) {
                if ($file->sk_penyesuaian_fungsional != null && file_exists($path . $file->sk_penyesuaian_fungsional)) {
                    unlink($path . $file->sk_penyesuaian_fungsional);
                    $file->delete();
                }
            }

            $filename = request()->file('sk_penyesuaian_fungsional')->hashName();
            request()->file('sk_penyesuaian_fungsional')->storeAs('upload/berkas', $filename, 'public');

            $attr['sk_penyesuaian_fungsional'] = $filename;
        }
        if (request()->file('sk_kenaikan_fungsional') && request()->file('sk_kenaikan_fungsional')->isValid()) {
            foreach ($promotion->files as $file) {
                if ($file->sk_kenaikan_fungsional != null && file_exists($path . $file->sk_kenaikan_fungsional)) {
                    unlink($path . $file->sk_kenaikan_fungsional);
                    $file->delete();
                }
            }

            $filename = request()->file('sk_kenaikan_fungsional')->hashName();
            request()->file('sk_kenaikan_fungsional')->storeAs('upload/berkas', $filename, 'public');

            $attr['sk_kenaikan_fungsional'] = $filename;
        }
        if (request()->file('sertifikat_pim') && request()->file('sertifikat_pim')->isValid()) {
            foreach ($promotion->files as $file) {
                if ($file->sertifikat_pim != null && file_exists($path . $file->sertifikat_pim)) {
                    unlink($path . $file->sertifikat_pim);
                    $file->delete();
                }
            }

            $filename = request()->file('sertifikat_pim')->hashName();
            request()->file('sertifikat_pim')->storeAs('upload/berkas', $filename, 'public');

            $attr['sertifikat_pim'] = $filename;
        }
        if (request()->file('surat_pelantikan') && request()->file('surat_pelantikan')->isValid()) {
            foreach ($promotion->files as $file) {
                if ($file->surat_pelantikan != null && file_exists($path . $file->surat_pelantikan)) {
                    unlink($path . $file->surat_pelantikan);
                    $file->delete();
                }
            }

            $filename = request()->file('surat_pelantikan')->hashName();
            request()->file('surat_pelantikan')->storeAs('upload/berkas', $filename, 'public');

            $attr['surat_pelantikan'] = $filename;
        }
        if (request()->file('surat_lowong') && request()->file('surat_lowong')->isValid()) {
            foreach ($promotion->files as $file) {
                if ($file->surat_lowong != null && file_exists($path . $file->surat_lowong)) {
                    unlink($path . $file->surat_lowong);
                    $file->delete();
                }
            }

            $filename = request()->file('surat_lowong')->hashName();
            request()->file('surat_lowong')->storeAs('upload/berkas', $filename, 'public');

            $attr['surat_lowong'] = $filename;
        }
        if (request()->file('surat_tugas') && request()->file('surat_tugas')->isValid()) {
            foreach ($promotion->files as $file) {
                if ($file->surat_tugas != null && file_exists($path . $file->surat_tugas)) {
                    unlink($path . $file->surat_tugas);
                    $file->delete();
                }
            }

            $filename = request()->file('surat_tugas')->hashName();
            request()->file('surat_tugas')->storeAs('upload/berkas', $filename, 'public');

            $attr['surat_tugas'] = $filename;
        }
        if (request()->file('sk_pelantikan') && request()->file('sk_pelantikan')->isValid()) {
            foreach ($promotion->files as $file) {
                if ($file->sk_pelantikan != null && file_exists($path . $file->sk_pelantikan)) {
                    unlink($path . $file->sk_pelantikan);
                    $file->delete();
                }
            }

            $filename = request()->file('sk_pelantikan')->hashName();
            request()->file('sk_pelantikan')->storeAs('upload/berkas', $filename, 'public');

            $attr['sk_pelantikan'] = $filename;
        }
        if (request()->file('sk_jabatan') && request()->file('sk_jabatan')->isValid()) {
            foreach ($promotion->files as $file) {
                if ($file->sk_jabatan != null && file_exists($path . $file->sk_jabatan)) {
                    unlink($path . $file->sk_jabatan);
                    $file->delete();
                }
            }

            $filename = request()->file('sk_jabatan')->hashName();
            request()->file('sk_jabatan')->storeAs('upload/berkas', $filename, 'public');

            $attr['sk_jabatan'] = $filename;
        }
        if (request()->file('sk_belajar') && request()->file('sk_belajar')->isValid()) {
            foreach ($promotion->files as $file) {
                if ($file->sk_belajar != null && file_exists($path . $file->sk_belajar)) {
                    unlink($path . $file->sk_belajar);
                    $file->delete();
                }
            }

            $filename = request()->file('sk_belajar')->hashName();
            request()->file('sk_belajar')->storeAs('upload/berkas', $filename, 'public');

            $attr['sk_belajar'] = $filename;
        }

        $promotion = Promotion::find($promotion->id);
        $promotion->status = 4;
        $promotion->save();

        File::where('promotion_id', $promotion->id)->update($attr);

        return redirect()->back()->with('toast_success', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        $usernameAdmin = Auth::user()->username;
        $adminInfo = Employee::where('nip_baru', $usernameAdmin)->first();
        $path = storage_path('app/public/upload/berkas/');


        if ($adminInfo->k_dinas != $promotion->employee->k_dinas) {
            return redirect()
                ->back()
                ->with('toast_error', __('Maaf anda tidak dapat mengakses data asn tersebut.'));
        } else {
            if ($promotion) {
                foreach ($promotion->files as $file) {
                    if ($file->sk_cpns != null && file_exists($path . $file->sk_cpns)) {
                        unlink($path . $file->sk_cpns);
                        $file->delete();
                    }

                    if ($file->sk_pns != null && file_exists($path . $file->sk_pns)) {
                        unlink($path . $file->sk_pns);
                        $file->delete();
                    }

                    if ($file->sk_pangkat_terakhir != null && file_exists($path . $file->sk_pangkat_terakhir)) {
                        unlink($path . $file->sk_pangkat_terakhir);
                        $file->delete();
                    }

                    if ($file->kartu_pegawai != null && file_exists($path . $file->kartu_pegawai)) {
                        unlink($path . $file->kartu_pegawai);
                        $file->delete();
                    }

                    if ($file->ijazah_lama != null && file_exists($path . $file->ijazah_lama)) {
                        unlink($path . $file->ijazah_lama);
                        $file->delete();
                    }

                    if ($file->ijazah_baru != null && file_exists($path . $file->ijazah_baru)) {
                        unlink($path . $file->ijazah_baru);
                        $file->delete();
                    }
                    if ($file->transkrip_lama != null && file_exists($path . $file->transkrip_lama)) {
                        unlink($path . $file->transkrip_lama);
                        $file->delete();
                    }
                    if ($file->transkrip_baru != null && file_exists($path . $file->transkrip_baru)) {
                        unlink($path . $file->transkrip_baru);
                        $file->delete();
                    }
                    if ($file->skp_lama != null && file_exists($path . $file->skp_lama)) {
                        unlink($path . $file->skp_lama);
                        $file->delete();
                    }
                    if ($file->skp_baru != null && file_exists($path . $file->skp_baru)) {
                        unlink($path . $file->skp_baru);
                        $file->delete();
                    }
                    if ($file->sttpl != null && file_exists($path . $file->sttpl)) {
                        unlink($path . $file->sttpl);
                        $file->delete();
                    }
                    if ($file->sk_mutasi != null && file_exists($path . $file->sk_mutasi)) {
                        unlink($path . $file->sk_mutasi);
                        $file->delete();
                    }
                    if ($file->sk_pengalihan != null && file_exists($path . $file->sk_pengalihan)) {
                        unlink($path . $file->sk_pengalihan);
                        $file->delete();
                    }
                    if ($file->sk_fungsional != null && file_exists($path . $file->sk_fungsional)) {
                        unlink($path . $file->sk_fungsional);
                        $file->delete();
                    }
                    if ($file->pak_asli != null && file_exists($path . $file->pak_asli)) {
                        unlink($path . $file->pak_asli);
                        $file->delete();
                    }
                    if ($file->pak_lama != null && file_exists($path . $file->pak_lama)) {
                        unlink($path . $file->pak_lama);
                        $file->delete();
                    }
                    if ($file->sk_penyesuaian_fungsional != null && file_exists($path . $file->sk_penyesuaian_fungsional)) {
                        unlink($path . $file->sk_penyesuaian_fungsional);
                        $file->delete();
                    }
                    if ($file->sk_kenaikan_fungsional != null && file_exists($path . $file->sk_kenaikan_fungsional)) {
                        unlink($path . $file->sk_kenaikan_fungsional);
                        $file->delete();
                    }
                    if ($file->sertifikat_pim != null && file_exists($path . $file->sertifikat_pim)) {
                        unlink($path . $file->sertifikat_pim);
                        $file->delete();
                    }
                    if ($file->surat_pelantikan != null && file_exists($path . $file->surat_pelantikan)) {
                        unlink($path . $file->surat_pelantikan);
                        $file->delete();
                    }
                    if ($file->surat_lowong != null && file_exists($path . $file->surat_lowong)) {
                        unlink($path . $file->surat_lowong);
                        $file->delete();
                    }
                    if ($file->surat_tugas != null && file_exists($path . $file->surat_tugas)) {
                        unlink($path . $file->surat_tugas);
                        $file->delete();
                    }
                    if ($file->sk_pelantikan != null && file_exists($path . $file->sk_pelantikan)) {
                        unlink($path . $file->sk_pelantikan);
                        $file->delete();
                    }
                    if ($file->sk_jabatan != null && file_exists($path . $file->sk_jabatan)) {
                        unlink($path . $file->sk_jabatan);
                        $file->delete();
                    }
                    if ($file->sk_belajar != null && file_exists($path . $file->sk_belajar)) {
                        unlink($path . $file->sk_belajar);
                        $file->delete();
                    }
                }
                $promotion->delete();

                return redirect()->route('promotion.index')->with('toast_success', 'Data berhasil dihapus');
            }
        }
    }

    public function createStep1(Request $request)
    {
        $promotion = $request->session()->get('promotion');
        $today = Carbon::today()->isoFormat('MMMM');

        $setting = \App\Models\Setting::first();

        if ($today == $setting->period_1) {
            $setting = $setting->period_1;
            $year = Carbon::today()->isoFormat('Y');
        } else {
            $setting = $setting->period_2;
            $year = Carbon::today()->isoFormat('Y');
        }

        return view('admin.promotion.step1', compact('promotion', 'setting', 'year', 'today'));
    }

    public function storeStep1(Request $request)
    {
        $today = Carbon::now()->isoFormat('MMMM');
        $setting = \App\Models\Setting::first();

        if ($today != $setting->period_1 && $today != $setting->period_2) {
            return redirect()
                ->back()
                ->with('toast_error', __('Maaf masa input berkas telah selesai.'));
        } else {
            $validated = $request->validate([
                'procedure_type' => 'required|in:1,2,3,4',
                'promotion_type' => 'required|in:1,2,3,4',
                'job_type' => 'required|in:1,2,3',
            ]);

            if (empty($request->session()->get('promotion'))) {
                $promotion = new \App\Models\Promotion();
                $promotion->fill($validated);
                $request->session()->put('promotion', $promotion);
            } else {
                $promotion = $request->session()->get('promotion');
                $promotion->fill($validated);
                $request->session()->put('promotion', $promotion);
            }

            return redirect()
                ->route('promotion.step2');
        }
    }

    public function createStep2(Request $request)
    {
        $promotion = $request->session()->get('promotion');
        $employee = Employee::where('nip_baru', request()->nip_baru)->first();
        return view('admin.promotion.step2', compact('employee', 'promotion'));
    }

    public function storeStep2(Request $request)
    {
        $promotion = $request->session()->get('promotion');
        $usernameAdmin = Auth::user()->username;
        $adminInfo = Employee::where('nip_baru', $usernameAdmin)->first();

        $employee = Employee::when($request->nip_baru, function ($query) use ($request) {
            $query->where('nip_baru', '=', $request->nip_baru);
        })
            ->when($request->nip_lama, function ($query) use ($request) {
                $query->where('nip', '=', $request->nip_lama);
            })
            ->get();


        if ($request->nip_baru || $request->nip_lama) {
            foreach ($employee as $data) {
                if ($adminInfo->k_dinas != $data->k_dinas) {
                    return redirect()
                        ->back()
                        ->with('toast_error', __('Maaf anda tidak dapat mengakses data asn tersebut.'));
                } else {
                    $employee = Employee::where('nip_baru', $request->nip_baru)
                        ->orWhere('nip', $request->nip_lama)
                        ->get();
                    if (empty($request->session()->get('promotion'))) {
                        $validatedData = $request->validate([
                            'employee_id' => 'unique:promotions',
                        ]);
                        $promotion = new \App\Models\Promotion();
                        $promotion->fill($validatedData);
                        $request->session()->put('promotion', $promotion);
                    } else {
                        $employee = Employee::where('nip_baru', $request->nip_baru)
                            ->orWhere('nip', $request->nip_lama)
                            ->get();
                        if ($employee) {
                            foreach ($employee as $data) {
                                $promotion = $request->session()->get('promotion');
                                $promotion->employee_id = $data->id_asn;
                                $promotion->agency_id = $data->k_dinas;
                                $promotion->status = 1;
                                $request->session()->put('promotion', $promotion);
                            }
                        }
                    }
                    return view('admin.promotion.step2', compact('employee'));
                }
            }
        } else {
            return redirect()
                ->back()
                ->with('toast_error', __('Maaf anda harus pilih salah satu inputan.'));
        }
    }

    public function createStep3(Request $request)
    {
        $promotion = request()->session()->get('promotion');
        $files = File::where('promotion_id', $promotion->id)->get();

        $employee = Employee::with('promotions.files')->where('id_asn', $promotion->employee_id)->first();

        return view('admin.promotion.step3', compact('promotion', 'employee', 'files'));
    }

    public function storeStep3(Request $request)
    {
        $promotion = $request->session()->get('promotion');

        $attr = request()->validate([
            'sk_cpns' => 'required', 'mimes:pdf', 'max:2048',
            'sk_pns' => 'required', 'mimes:pdf', 'max:2048',
            'sk_pangkat_terakhir' => 'required', 'mimes:pdf', 'max:2048',
            'kartu_pegawai' => 'required', 'mimes:pdf', 'max:2048',
            'ijazah_lama' => 'nullable', 'mimes:pdf', 'max:2048',
            'ijazah_baru' => 'required', 'mimes:pdf', 'max:2048',
            'transkrip_lama' => 'nullable', 'mimes:pdf', 'max:2048',
            'transkrip_baru' => 'required', 'mimes:pdf', 'max:2048',
            'skp_lama' => 'required', 'mimes:pdf', 'max:2048',
            'skp_baru' => 'required', 'mimes:pdf', 'max:2048',
            'sttpl' => 'nullable', 'mimes:pdf', 'max:2048',
            'sk_mutasi' => 'nullable', 'mimes:pdf', 'max:2048',
            'sk_pengalihan' => 'nullable', 'mimes:pdf', 'max:2048',
            'sk_fungsional' => 'nullable', 'mimes:pdf', 'max:2048',
            'pak_asli' => 'nullable', 'mimes:pdf', 'max:2048',
            'pak_lama' => 'nullable', 'mimes:pdf', 'max:2048',
            'sk_penyesuaian_fungsional' => 'nullable', 'mimes:pdf', 'max:2048',
            'sk_kenaikan_fungsional' => 'nullable', 'mimes:pdf', 'max:2048',
            'sertifikat_pim' => 'nullable', 'mimes:pdf', 'max:2048',
            'surat_pelantikan' => 'nullable', 'mimes:pdf', 'max:2048',
            'surat_lowong' => 'nullable', 'mimes:pdf', 'max:2048',
            'surat_tugas' => 'nullable', 'mimes:pdf', 'max:2048',
            'sk_pelantikan' => 'nullable', 'mimes:pdf', 'max:2048',
            'sk_jabatan' => 'nullable', 'mimes:pdf', 'max:2048',
            'sk_belajar' => 'nullable', 'mimes:pdf', 'max:2048'
        ]);

        if (request()->file('sk_cpns') && request()->file('sk_cpns')->isValid()) {


            $filename = request()->file('sk_cpns')->hashName();
            request()->file('sk_cpns')->storeAs('upload/berkas', $filename, 'public');

            $attr['sk_cpns'] = $filename;
        }
        if (request()->file('sk_pns') && request()->file('sk_pns')->isValid()) {


            $filename = request()->file('sk_pns')->hashName();
            request()->file('sk_pns')->storeAs('upload/berkas', $filename, 'public');

            $attr['sk_pns'] = $filename;
        }
        if (request()->file('sk_pangkat_terakhir') && request()->file('sk_pangkat_terakhir')->isValid()) {

            $filename = request()->file('sk_pangkat_terakhir')->hashName();
            request()->file('sk_pangkat_terakhir')->storeAs('upload/berkas', $filename, 'public');

            $attr['sk_pangkat_terakhir'] = $filename;
        }
        if (request()->file('kartu_pegawai') && request()->file('kartu_pegawai')->isValid()) {

            $filename = request()->file('kartu_pegawai')->hashName();
            request()->file('kartu_pegawai')->storeAs('upload/berkas', $filename, 'public');

            $attr['kartu_pegawai'] = $filename;
        }
        if (request()->file('ijazah_lama') && request()->file('ijazah_lama')->isValid()) {

            $filename = request()->file('ijazah_lama')->hashName();
            request()->file('ijazah_lama')->storeAs('upload/berkas', $filename, 'public');

            $attr['ijazah_lama'] = $filename;
        }
        if (request()->file('ijazah_baru') && request()->file('ijazah_baru')->isValid()) {

            $filename = request()->file('ijazah_baru')->hashName();
            request()->file('ijazah_baru')->storeAs('upload/berkas', $filename, 'public');

            $attr['ijazah_baru'] = $filename;
        }
        if (request()->file('ijazah_baru') && request()->file('ijazah_baru')->isValid()) {

            $filename = request()->file('ijazah_baru')->hashName();
            request()->file('ijazah_baru')->storeAs('upload/berkas', $filename, 'public');

            $attr['ijazah_baru'] = $filename;
        }
        if (request()->file('transkrip_lama') && request()->file('transkrip_lama')->isValid()) {

            $filename = request()->file('transkrip_lama')->hashName();
            request()->file('transkrip_lama')->storeAs('upload/berkas', $filename, 'public');

            $attr['transkrip_lama'] = $filename;
        }
        if (request()->file('transkrip_baru') && request()->file('transkrip_baru')->isValid()) {

            $filename = request()->file('transkrip_baru')->hashName();
            request()->file('transkrip_baru')->storeAs('upload/berkas', $filename, 'public');

            $attr['transkrip_baru'] = $filename;
        }
        if (request()->file('skp_lama') && request()->file('skp_lama')->isValid()) {

            $filename = request()->file('skp_lama')->hashName();
            request()->file('skp_lama')->storeAs('upload/berkas', $filename, 'public');

            $attr['skp_lama'] = $filename;
        }
        if (request()->file('skp_baru') && request()->file('skp_baru')->isValid()) {

            $filename = request()->file('skp_baru')->hashName();
            request()->file('skp_baru')->storeAs('upload/berkas', $filename, 'public');

            $attr['skp_baru'] = $filename;
        }
        if (request()->file('sttpl') && request()->file('sttpl')->isValid()) {

            $filename = request()->file('sttpl')->hashName();
            request()->file('sttpl')->storeAs('upload/berkas', $filename, 'public');

            $attr['sttpl'] = $filename;
        }
        if (request()->file('sk_mutasi') && request()->file('sk_mutasi')->isValid()) {

            $filename = request()->file('sk_mutasi')->hashName();
            request()->file('sk_mutasi')->storeAs('upload/berkas', $filename, 'public');

            $attr['sk_mutasi'] = $filename;
        }
        if (request()->file('sk_pengalihan') && request()->file('sk_pengalihan')->isValid()) {

            $filename = request()->file('sk_pengalihan')->hashName();
            request()->file('sk_pengalihan')->storeAs('upload/berkas', $filename, 'public');

            $attr['sk_pengalihan'] = $filename;
        }
        if (request()->file('sk_fungsional') && request()->file('sk_fungsional')->isValid()) {

            $filename = request()->file('sk_fungsional')->hashName();
            request()->file('sk_fungsional')->storeAs('upload/berkas', $filename, 'public');

            $attr['sk_fungsional'] = $filename;
        }
        if (request()->file('pak_asli') && request()->file('pak_asli')->isValid()) {

            $filename = request()->file('pak_asli')->hashName();
            request()->file('pak_asli')->storeAs('upload/berkas', $filename, 'public');

            $attr['pak_asli'] = $filename;
        }
        if (request()->file('pak_lama') && request()->file('pak_lama')->isValid()) {

            $filename = request()->file('pak_lama')->hashName();
            request()->file('pak_lama')->storeAs('upload/berkas', $filename, 'public');

            $attr['pak_lama'] = $filename;
        }

        if (request()->file('sk_penyesuaian_fungsional') && request()->file('sk_penyesuaian_fungsional')->isValid()) {

            $filename = request()->file('sk_penyesuaian_fungsional')->hashName();
            request()->file('sk_penyesuaian_fungsional')->storeAs('upload/berkas', $filename, 'public');

            $attr['sk_penyesuaian_fungsional'] = $filename;
        }
        if (request()->file('sk_kenaikan_fungsional') && request()->file('sk_kenaikan_fungsional')->isValid()) {

            $filename = request()->file('sk_kenaikan_fungsional')->hashName();
            request()->file('sk_kenaikan_fungsional')->storeAs('upload/berkas', $filename, 'public');

            $attr['sk_kenaikan_fungsional'] = $filename;
        }
        if (request()->file('sertifikat_pim') && request()->file('sertifikat_pim')->isValid()) {

            $filename = request()->file('sertifikat_pim')->hashName();
            request()->file('sertifikat_pim')->storeAs('upload/berkas', $filename, 'public');

            $attr['sertifikat_pim'] = $filename;
        }
        if (request()->file('surat_pelantikan') && request()->file('surat_pelantikan')->isValid()) {

            $filename = request()->file('surat_pelantikan')->hashName();
            request()->file('surat_pelantikan')->storeAs('upload/berkas', $filename, 'public');

            $attr['surat_pelantikan'] = $filename;
        }
        if (request()->file('surat_lowong') && request()->file('surat_lowong')->isValid()) {

            $filename = request()->file('surat_lowong')->hashName();
            request()->file('surat_lowong')->storeAs('upload/berkas', $filename, 'public');

            $attr['surat_lowong'] = $filename;
        }
        if (request()->file('surat_tugas') && request()->file('surat_tugas')->isValid()) {

            $filename = request()->file('surat_tugas')->hashName();
            request()->file('surat_tugas')->storeAs('upload/berkas', $filename, 'public');

            $attr['surat_tugas'] = $filename;
        }
        if (request()->file('sk_pelantikan') && request()->file('sk_pelantikan')->isValid()) {

            $filename = request()->file('sk_pelantikan')->hashName();
            request()->file('sk_pelantikan')->storeAs('upload/berkas', $filename, 'public');

            $attr['sk_pelantikan'] = $filename;
        }
        if (request()->file('sk_jabatan') && request()->file('sk_jabatan')->isValid()) {

            $filename = request()->file('sk_jabatan')->hashName();
            request()->file('sk_jabatan')->storeAs('upload/berkas', $filename, 'public');

            $attr['sk_jabatan'] = $filename;
        }
        if (request()->file('sk_belajar') && request()->file('sk_belajar')->isValid()) {

            $filename = request()->file('sk_belajar')->hashName();
            request()->file('sk_belajar')->storeAs('upload/berkas', $filename, 'public');

            $attr['sk_belajar'] = $filename;
        }

        $data = [
            'employee_id' => $promotion->employee_id,
            'agency_id' => $promotion->agency_id,
            'procedure_type' => $promotion->procedure_type,
            'promotion_type' => $promotion->promotion_type,
            'job_type' => $promotion->job_type,
            'status' => 1,
        ];

        $submit = Promotion::create($data);

        $attr['promotion_id'] = $submit->id;

        File::create($attr);

        return redirect()->back()->with('toast_success', 'Data berhasil ditambah');
    }

    public function storeVerificator(Request $request, Promotion $promotion)
    {
        $validatedData = $request->validate([
            'verificator_id' => 'required',
        ]);

        if ($promotion) {
            $attr = [
                'verificator_id' => $validatedData['verificator_id'],
                'status' => 2
            ];
            $promotion->update($attr);

            return redirect()->route('promotion.index')->with('toast_success', 'Verifikator berhasil ditambahkan');
        }
    }

    public function detailApprove(Promotion $promotion)
    {
        return view('admin.promotion.detailApprove', compact('promotion'));
    }

    public function approve(Promotion $promotion)
    {
        if ($promotion) {
            $promotion->update(['status' => 3]);

            return redirect()->route('promotion.index')->with('toast_success', 'Usulan telah disetujui');
        }
    }

    public function detailCancel(Promotion $promotion)
    {
        return view('admin.promotion.detailCancel', compact('promotion'));
    }

    public function cancel(Promotion $promotion, Request $request)
    {

        DB::transaction(function () use ($promotion, $request) {
            $attr = $request->validate([
                'reason' => 'required',
                'additional_information' => 'required',
            ]);

            $cancel = new CancelPromotion();
            $cancel->promotion_id = $promotion->id;
            $cancel->reason = $attr['reason'];
            $cancel->additional_information = $attr['additional_information'];
            $cancel->save();

            $promotion->update(['status' => 5]);
        });

        return redirect()->route('promotion.index')->with('toast_success', 'Usulan telah ditolak');
    }
}
