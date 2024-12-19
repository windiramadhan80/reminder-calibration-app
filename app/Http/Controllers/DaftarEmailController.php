<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\AlatUkur;
use App\Models\DaftarEmail;
use Illuminate\Http\Request;

class DaftarEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alat_ukur = AlatUkur::all();
        $event_planning = Event::select('title')
            ->distinct()
            ->where('type', 'planning')
            ->get();
        $event_actual = Event::select('title')
            ->distinct()
            ->where('type', 'actual')
            ->get();

        $data = [
            'alat_ukur' => $alat_ukur,
            'event_planning' => $event_planning,
            'event_actual' => $event_actual,
            'daftar_email' => DaftarEmail::all(),
        ];

        return view('admin.daftar_email.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alat_ukur = AlatUkur::all();
        $event_planning = Event::select('title')
            ->distinct()
            ->where('type', 'planning')
            ->get();
        $event_actual = Event::select('title')
            ->distinct()
            ->where('type', 'actual')
            ->get();

        $data = [
            'alat_ukur' => $alat_ukur,
            'event_planning' => $event_planning,
            'event_actual' => $event_actual,
        ];

        return view('admin.daftar_email.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Custom label untuk validasi
        $attributeLabels = [
            'name' => 'Nama Lengkap',
            'email' => 'Email',
        ];

        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
        ], [], $attributeLabels);

        DaftarEmail::create($validatedData);

        return redirect('/daftar-email')->with('success_message', 'Data Berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $alat_ukur = AlatUkur::all();
        $event_planning = Event::select('title')
            ->distinct()
            ->where('type', 'planning')
            ->get();
        $event_actual = Event::select('title')
            ->distinct()
            ->where('type', 'actual')
            ->get();

        $data = [
            'alat_ukur' => $alat_ukur,
            'event_planning' => $event_planning,
            'event_actual' => $event_actual,
            'daftar_email' => DaftarEmail::find($id),
        ];

        return view('admin.daftar_email.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Custom label untuk validasi
        $attributeLabels = [
            'name' => 'Nama Lengkap',
            'email' => 'Email',
        ];

        // Validasi data
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
        ], [], $attributeLabels);

        $daftar_email = DaftarEmail::find($id);
        $daftar_email->name = $request->name;
        $daftar_email->email = $request->email;
        $daftar_email->save();

        return redirect('/daftar-email')->with('success_message', 'Data Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $daftar_email = DaftarEmail::find($id);
        $daftar_email->delete();

        return redirect('/daftar-email')->with('success_message', 'Data Berhasil dihapus');
    }
}
