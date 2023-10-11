<?php

namespace App\Http\Controllers;

use App\Models\Produits;
use App\Models\Sectiones;
use Illuminate\Http\Request;

class ProduitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        $var_sectiones = Sectiones::all();
        $var_produits= Produits::all();
         return view('produits.produit', compact('var_sectiones','var_produits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nom_produit' => 'required|unique:produits',
        ]);

        Produits::create([
            'nom_produit'=>$request->nom_produit,
            'section_id'=>$request->section_id,
            'description_produit'=>$request->description_produit,

        ]);
        session()->flash('Add', 'Produit ajouté avec succès');     
           return redirect('/produits');
           
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produits  $produits
     * @return \Illuminate\Http\Response
     */
    public function show(Produits $produits)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produits  $produits
     * @return \Illuminate\Http\Response
     */
    public function edit(Produits $produits)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produits  $produits
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produits $produits)
    {
        //
        $id = $request->id;



        $this->validate($request, [

            'nom_produit' => 'required|max:255|unique:produits,nom_produit,'.$id,
        ],[

            'section_nom.required' =>'Veuillez saisir un nom de section',
            'section_nom.unique' =>'Le nom du Section est déjà enregistré',
            'description.required'=> 'Veuillez saisir la description ',

        ]);
        $sections = Produits::find($id); 
        //dd($sections);
         $sections->update([
            'nom_produit' => $request->nom_produit,
            'section_id' => $request->section_id,
            'description_produit' => $request->description_produit,

         ]);

        session()->flash('EDIT','La section a été modifiée avec succès');
        return redirect('/produits');     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produits  $produits
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
          //dd($id);
        $id = $request->id;
        Produits::find($id)->delete();
        session()->flash('supprimer', 'section supprimée avec succès');       
        return redirect('/produits');
    }
}
