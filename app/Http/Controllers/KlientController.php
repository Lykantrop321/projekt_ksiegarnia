<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Klient; // Upewnij się, że masz odpowiedni model Klient

class KlientController extends Controller
{
    public function index()
    {
        $klienci = Klient::all();
        return view('klienci.index', compact('klienci'));
    }

    public function create()
    {
        return view('klienci.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'imie' => 'required',
            'nazwisko' => 'required',
            'dzien_tygodnia' => 'required',
        ]);

        $klient = new Klient([
            'imie' => $request->get('imie'),
            'nazwisko' => $request->get('nazwisko'),
            'dzien_tygodnia' => $request->get('dzien_tygodnia'),
            'pracownik_id' => $request->get('pracownik_id'), // Upewnij się, że pracownik_id jest przekazywane
        ]);
        $klient->save();

        return redirect('/klienci')->with('success', 'Klient został dodany.');
    }

    public function show($id)
    {
        $klient = Klient::findOrFail($id);
        return view('klienci.show', compact('klient'));
    }

    public function edit($id)
    {
        $klient = Klient::findOrFail($id);
        return view('klienci.edit', compact('klient'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'imie' => 'required',
            'nazwisko' => 'required',
            'dzien_tygodnia' => 'required',
        ]);

        $klient = Klient::findOrFail($id);
        $klient->fill([
            'imie' => $request->get('imie'),
            'nazwisko' => $request->get('nazwisko'),
            'dzien_tygodnia' => $request->get('dzien_tygodnia'),
        ]);
        $klient->save();

        return redirect('/klienci')->with('success', 'Klient został zaktualizowany.');
    }

    public function destroy($id)
    {
        $klient = Klient::findOrFail($id);
        $klient->delete();

        return redirect('/klienci')->with('success', 'Klient został usunięty.');
    }
}
