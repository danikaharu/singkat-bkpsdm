<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:input periods')->only('edit', 'update');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSettingRequest  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        $attr = $request->validated();

        if ($attr['period_1'] == $attr['period_2']) {
            return redirect()->back()
                ->with('error', 'Maaf, periode tidak boleh sama');
        } else {
            $setting->update($attr);

            return redirect()->route('settings.edit', $setting->id)
                ->with('success', 'Data berhasil diedit');
        }
    }
}
