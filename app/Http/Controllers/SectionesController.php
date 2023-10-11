<?php

namespace App\Http\Controllers;

use App\Models\sectiones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SectionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $var_sectiones=Sectiones::all();
       return view('sectiones.sectiones',compact('var_sectiones'));
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
        //decaler var
        //$input= $request->all();
       // $b_exists = Sectiones::where('section_nom','=',$input['section_nom'])->exists();
        // hadii kantchke biha bach section_nom madkholch joj mrat M3Wda
        //if($b_exists)
        //{
         //   session()->flash('ERROR','Le nom du département est déjà enregistré');
            //return redirect('/sectiones');
        //}
        //else{

            $messages = [
                'section_nom.required' => 'inpute vide',
                'section_nom.unique' => 'deja dkhl section_nom en bd ',
              ];

            $request->validate([
                'section_nom' => 'required|unique:sectiones|max:255',
               
            ],$messages);

            Sectiones::create([
                'section_nom' => $request->section_nom,
                'description'  => $request->description,
                 'créé_par'  =>(Auth::user()->name),
            ]);
            session()->flash('Add', 'La section a été ajoutée avec succès ');
            return redirect('/sectiones');
        }
           
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sectiones  $sectiones
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $test = Sectiones::find($id);
        dd($test);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sectiones  $sectiones
     * @return \Illuminate\Http\Response
     */
    public function edit(sectiones $sectiones)
    {
        //


        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sectiones  $sectiones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //

        //  return $request;

        $id = $request->id;



        $this->validate($request, [

            'section_nom' => 'required|max:255|unique:sectiones,section_nom,'.$id,
            'description' => 'required',
        ],[

            'section_nom.required' =>'Veuillez saisir un nom de section',
            'section_nom.unique' =>'Le nom du Section est déjà enregistré',
            'description.required'=> 'Veuillez saisir la description ',

        ]);

        

        $sections = Sectiones::find($id); 
        //dd($sections);
         $sections->update([
            'section_nom' => $request->section_nom,
            'description' => $request->description,
         ]);

        session()->flash('EDIT','La section a été modifiée avec succès');
        return redirect('/sectiones');      
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sectiones  $sectiones
     * @return \Illuminate\Http\Response
     */
    public function  destroy(Request $request)
    {
        //dd( $id);
        $id = $request->id;
            //dd($id);
         Sectiones::find($id)->delete();
        session()->flash('supprimer', 'section supprimée avec succès');       
         return redirect('/sectiones');
      
    }
}
