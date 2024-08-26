<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekening;
use App\Models\Pekerjaan;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\Village;
use Yajra\DataTables\Facades\DataTables;

class RekeningController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Rekening::with('pekerjaan', 'province', 'city', 'district', 'village')->latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return view('rekening.action', compact('row'));
                })
                ->make(true);
        }

        return view('rekening.index');
    }

    public function create()
    {
        $pekerjaan = Pekerjaan::all();
        $provinces = Province::all();
        return view('rekening.create', compact('pekerjaan', 'provinces'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_ktp' => 'required|string|unique:rekening|regex:/^[a-zA-Z\s]+$/',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'jenis_kelamin' => 'required|in:Laki-laki,Wanita',
            'pekerjaan_id' => 'required|exists:master_pekerjaan,id',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'district_id' => 'required|exists:districts,id',
            'village_id' => 'required|exists:villages,id',
            'nama_jalan' => 'required|string',
            'rt' => 'required|digits:3',
            'rw' => 'required|digits:3',
            'nominal_setor' => 'required|numeric|min:100000',
        ]);

        Rekening::create($validated);

        return redirect()->route('rekening.index')->with('success', 'Pengajuan rekening berhasil disimpan, menunggu approval.');
    }

    public function approve($id)
    {
        $rekening = Rekening::find($id);
        if ($rekening && $rekening->status == 'Menunggu Approval') {
            $rekening->status = 'Disetujui';
            $rekening->save();
        }

        return redirect()->route('rekening.index')->with('success', 'Rekening berhasil disetujui.');
    }
}
