<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produits = Produit::with([
            'user' => function ($q) {
                $q->select('id', 'name');
            },
            'section' => function ($q) {
                $q->select('id', 'section_nom');
            },
        ])->orderBy('id', 'Desc')->withTrashed()->get();

        $sections = Section::orderBy('id', 'Desc')->select('id','section_nom')->get();
        return view('produits.produits', \compact(['sections','produits']));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'produit_nom' => 'required',
            'section_id' => 'required|exists:sections,id',
        ]);
        Produit::create([
            'produit_nom' => $request->produit_nom,
            'note' => $request->note,
            'user_id' => Auth::user()->id,
            'section_id' => $request->section_id,
        ]);
        return redirect()->route('produits.index')->with(['success' => 'Ajou avec seccess']);
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'produit_nom' => 'required|unique:produits,produit_nom,'.$request->id,
            'section_id' => 'required|exists:sections,id',
            
        ]);
        $produit = Produit::find($request->id);
        if ($produit) {
            $produit->update([
                'produit_nom' => $request->produit_nom,
                'note' => $request->note,
                'user_id' => Auth::user()->id,
                'section_id' => $request->section_id,
            ]);
            return redirect()->route('produits.index')->with(['success' => 'Modif avec seccess']);
        } else
            return redirect()->route('produits.index')->with(['error' => 'erreur dans modif']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // $produit = Produit::find($request->id)->delete();
        $produit = Produit::find($request->id)->forceDelete();
        return redirect()->route('produits.index')->with(['success' => 'delete avec seccess']);
    }
}
