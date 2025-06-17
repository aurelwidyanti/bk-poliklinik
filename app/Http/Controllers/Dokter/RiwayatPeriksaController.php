<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwalPeriksa = JadwalPeriksa::where('id_dokter', Auth::user()->id)->where('status', true)->first();
        $periksas = Periksa::with([
            'janjiPeriksa' => function ($query) use ($jadwalPeriksa) {
                $query->where('id_jadwal_periksa', $jadwalPeriksa->id);
            }
        ])->paginate(10);

        return view('dokter.riwayat-periksa.index')->with([
            'periksas' => $periksas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $periksa = Periksa::with(relations: ['janjiPeriksa.pasien', 'obats'])->findOrFail($id);

        if ($periksa->janjiPeriksa->jadwalPeriksa->id_dokter !== Auth::user()->id) {
            abort(403, 'Unauthorized');
        }

        $obats = Obat::all();

        return view('dokter.riwayat-periksa.edit')->with([
            'periksa' => $periksa,
            'obats' => $obats
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $periksa = Periksa::with(relations: ['janjiPeriksa.pasien', 'obats'])->findOrFail($id);

        if ($periksa->janjiPeriksa->jadwalPeriksa->id_dokter !== Auth::user()->id) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'required|string|max:255',
            'obat' => 'required|array',
            'obat.*' => 'required|exists:obats,id',
            'biaya_periksa' => 'required|integer'
        ]);

        $periksa->update([
            'tgl_periksa' => $validated['tgl_periksa'],
            'catatan' => $validated['catatan'],
            'biaya_periksa' => $validated['biaya_periksa']
        ]);

        $periksa->obats()->sync($validated['obat']);

        return redirect()->route('dokter.riwayat-periksa.index')->with('success', 'Riwayat periksa berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
