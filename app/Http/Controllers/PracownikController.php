<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pracownik;
use Illuminate\Support\Facades\Hash;

class PracownikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pracownicy = Pracownik::all();
        return view('pracownicy.index', compact('pracownicy'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pracownicy.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'imie' => 'required|max:255',
            'nazwisko' => 'required|max:255',
            'login' => 'required|unique:pracownicy,login',
            'haslo' => 'required|min:6',
        ]);

        $pracownik = new Pracownik([
            'imie' => $validatedData['imie'],
            'nazwisko' => $validatedData['nazwisko'],
            'login' => $validatedData['login'],
            'haslo' => Hash::make($validatedData['haslo']),
        ]);

        $pracownik->save();

        return redirect('/pracownicy')->with('success', 'Pracownik został dodany.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pracownik = Pracownik::findOrFail($id);
        return view('pracownicy.show', compact('pracownik'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pracownik = Pracownik::findOrFail($id);
        return view('pracownicy.edit', compact('pracownik'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'imie' => 'required|max:255',
            'nazwisko' => 'required|max:255',
            'login' => 'required|unique:pracownicy,login,' . $id,
            'haslo' => 'sometimes|required|min:6',
        ]);

        $pracownik = Pracownik::findOrFail($id);
        $pracownik->update([
            'imie' => $validatedData['imie'],
            'nazwisko' => $validatedData['nazwisko'],
            'login' => $validatedData['login'],
            'haslo' => isset($validatedData['haslo']) ? Hash::make($validatedData['haslo']) : $pracownik->haslo,
        ]);

        return redirect('/pracownicy')->with('success', 'Pracownik został zaktualizowany.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pracownik = Pracownik::findOrFail($id);
        $pracownik->delete();

        return redirect('/pracownicy')->with('success', 'Pracownik został usunięty.');
    }
}
