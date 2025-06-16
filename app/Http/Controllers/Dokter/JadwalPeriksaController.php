<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwalPeriksas = JadwalPeriksa::where('id_dokter', Auth::user()->id)->paginate(10);
        return view('dokter.jadwal-periksa.index')->with([
            'jadwalPeriksas' => $jadwalPeriksas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dokter.jadwal-periksa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        JadwalPeriksa::create([
            'id_dokter' => Auth::user()->id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => false,
        ]);

        return redirect()->route('dokter.jadwal-periksa.index')->with('status', 'jadwal-created');
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
        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);

        if ($jadwalPeriksa->id_dokter != Auth::user()->id)
        return redirect()->route('dokter.jadwal-periksa.index');

        if (!$jadwalPeriksa) {
            return redirect()->route('dokter.jadwal-periksa.index')->with('error', 'Jadwal tidak ditemukan');
        }

        return view('dokter.jadwal-periksa.edit')->with([
            'jadwalPeriksa' => $jadwalPeriksa,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);
        if (!$jadwalPeriksa) {
            return redirect()->route('dokter.jadwal-periksa.index')->with('error', 'Jadwal tidak ditemukan');
        }

        $jadwalPeriksa->update([
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('dokter.jadwal-periksa.index')->with('status', 'jadwal-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);
        if (!$jadwalPeriksa) {
            return redirect()->route('dokter.jadwal-periksa.index')->with('error', 'Jadwal tidak ditemukan');
        }

        $jadwalPeriksa->delete();
        return redirect()->route('dokter.jadwal-periksa.index')->with('status', 'jadwal-deleted');
    }

    public function updateStatus(string $id)
    {
        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);
        
        if (!$jadwalPeriksa->status) {
            JadwalPeriksa::where('id_dokter', Auth::user()->id)->update(['status' => 0]);

            $jadwalPeriksa->status = true;
            $jadwalPeriksa->save();

            return redirect()->route('dokter.jadwal-periksa.index');
        }

        $jadwalPeriksa->status = false;
        $jadwalPeriksa->save();

        return redirect()->route('dokter.jadwal-periksa.index');
    }
}
