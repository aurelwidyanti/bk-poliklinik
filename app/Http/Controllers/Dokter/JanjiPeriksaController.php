<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use App\Models\JanjiPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JanjiPeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwalPeriksa = JadwalPeriksa::where('id_dokter', Auth::user()->id)->where('status', true)->first();

        if (!$jadwalPeriksa) {
            return view('dokter.janji-periksa.index', [
                'jadwalPeriksa' => null,
                'janjiPeriksa' => collect(),
            ]);
        }

        $janjiPeriksas = JanjiPeriksa::where('id_jadwal_periksa', $jadwalPeriksa->id)
            ->whereDoesntHave('periksa')
            ->with('pasien')
            ->paginate(6);

        return view('dokter.janji-periksa.index')->with([
            'janjiPeriksas' => $janjiPeriksas,
            'jadwalPeriksa' => $jadwalPeriksa
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $janjiPeriksa = JanjiPeriksa::findOrFail($id);
        $jadwalPeriksa = JadwalPeriksa::findOrFail($janjiPeriksa->id_jadwal_periksa);

        if ($jadwalPeriksa->id_dokter !== Auth::user()->id) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'required|string',
            'obat' => 'required|array',
            'obat.*' => 'required|exists:obats,id',
            'biaya_periksa' => 'required|integer'
        ]);


        $periksa = Periksa::create([
            'id_janji_periksa' => $id,
            'tgl_periksa' => $validated['tgl_periksa'],
            'catatan' => $validated['catatan'],
            'biaya_periksa' => $validated['biaya_periksa']
        ]);

        $periksa->obats()->attach($validated['obat']);

        return redirect()->route('dokter.janji-periksa.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $janjiPeriksa = JanjiPeriksa::findOrFail($id);
        $jadwalPeriksa = JadwalPeriksa::findOrFail($janjiPeriksa->id_jadwal_periksa);

        if ($jadwalPeriksa->id_dokter !== Auth::user()->id) {
            abort(403, 'Unauthorized');
        }

        $obats = Obat::all();

        return view('dokter.janji-periksa.show')->with([
            'janjiPeriksa' => $janjiPeriksa,
            'obats' => $obats
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
