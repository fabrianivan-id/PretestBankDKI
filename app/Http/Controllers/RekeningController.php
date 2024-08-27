<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Rekening;
use App\Models\Pekerjaan;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\Village;

class RekeningController extends Controller
{
    /**
     * Display a listing of the account applications.
     */
    public function index(Request $request)
    {
        $rekenings = Rekening::with(['pekerjaan', 'province', 'city', 'district', 'village'])
            ->when($request->has('status'), function($query) use ($request) {
                return $query->where('status', $request->status);
            })
            ->get();

        return view('rekening.index', compact('rekenings'));
    }

    /**
     * Show the form for creating a new account application.
     */
    public function create()
    {
        $pekerjaans = Pekerjaan::all();
        $provinces = Province::all();

        return view('rekening.create', compact('pekerjaans', 'provinces'));
    }

    /**
     * Store a newly created account application in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_ktp' => 'required|string|unique:rekenings,nama_ktp|regex:/^[a-zA-Z\s]*$/',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Wanita',
            'pekerjaan_id' => 'required|exists:pekerjaans,id',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'district_id' => 'required|exists:districts,id',
            'village_id' => 'required|exists:villages,id',
            'nama_jalan' => 'required|string',
            'rt' => 'required|string',
            'rw' => 'required|string',
            'nominal_setor' => 'required|numeric',
        ]);

        $rekening = Rekening::create([
            'nama_ktp' => $request->nama_ktp,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pekerjaan_id' => $request->pekerjaan_id,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'village_id' => $request->village_id,
            'nama_jalan' => $request->nama_jalan,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'nominal_setor' => $request->nominal_setor,
            'status' => 'Menunggu Approval',
        ]);

        return redirect()->route('rekening.index')->with('success', 'Pengajuan rekening berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified account application.
     */
    public function edit($id)
    {
        $rekening = Rekening::findOrFail($id);
        $pekerjaans = Pekerjaan::all();
        $provinces = Province::all();
        $cities = City::where('province_id', $rekening->province_id)->get();
        $districts = District::where('city_id', $rekening->city_id)->get();
        $villages = Village::where('district_id', $rekening->district_id)->get();

        return view('rekening.edit', compact('rekening', 'pekerjaans', 'provinces', 'cities', 'districts', 'villages'));
    }

    /**
     * Update the specified account application in storage.
     */
    public function update(Request $request, $id)
    {
        $rekening = Rekening::findOrFail($id);

        $request->validate([
            'nama_ktp' => 'required|string|unique:rekenings,nama_ktp,' . $rekening->id . '|regex:/^[a-zA-Z\s]*$/',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Wanita',
            'pekerjaan_id' => 'required|exists:pekerjaans,id',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'district_id' => 'required|exists:districts,id',
            'village_id' => 'required|exists:villages,id',
            'nama_jalan' => 'required|string',
            'rt' => 'required|string',
            'rw' => 'required|string',
            'nominal_setor' => 'required|numeric',
        ]);

        $rekening->update([
            'nama_ktp' => $request->nama_ktp,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pekerjaan_id' => $request->pekerjaan_id,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'village_id' => $request->village_id,
            'nama_jalan' => $request->nama_jalan,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'nominal_setor' => $request->nominal_setor,
        ]);

        return redirect()->route('rekening.index')->with('success', 'Pengajuan rekening berhasil diperbarui.');
    }

    /**
     * Approve the specified account application.
     */
    // app/Http/Controllers/RekeningController.php

public function approve($id)
{
    $rekening = Rekening::findOrFail($id);

    if (Auth::user()->role !== 'Supervisi') {
        abort(403, 'Unauthorized action.');
    }

    $rekening->status = 'Disetujui';
    $rekening->save();

    return redirect()->route('rekening.index')->with('success', 'Rekening has been approved.');
}


    /**
     * Remove the specified account application from storage.
     */
    public function destroy($id)
    {
        $rekening = Rekening::findOrFail($id);
        $rekening->delete();

        return redirect()->route('rekening.index')->with('success', 'Pengajuan rekening berhasil dihapus.');
    }
}
