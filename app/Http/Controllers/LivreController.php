<?php

namespace App\Http\Controllers;
use App\Models\livre;
use Illuminate\Http\Request;

class LivreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return livre::all();
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
       $request->validate([
            'titre' => 'required',
            'isbn' => 'required',
            'annee_edition' => 'required',
            'resume' => 'required',
            'nbr_exemplaire' => 'required',
            'image' => 'required'   
        ]);
        $livre = new livre;
        $livre->titre = $request->titre;
        $livre->isbn = $request->isbn;
        $livre->annee_edition = $request->annee_edition;
        $livre->resume = $request->resume;
        $livre->nbr_exemplaire = $request->nbr_exemplaire;
        $livre->image = $request->image;

        return $livre->save();
        /* $request->validate([
            'titre' => 'required',
             'isbn'=>'required',
             'annee_edition'=>'required',
             'resume'=>'required',
             'nbr_exemplaire'=>'required',
             'image' =>'required'

        ]);
        return Livre::create($request->all());*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return livre::find($id);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $livre =livre::find($id);  
        $livre->titre = $request->titre;
        $livre->isbn = $request->isbn;
        $livre->annee_edition = $request->annee_edition;
        $livre->resume = $request->resume;
        $livre->nbr_exemplaire = $request->nbr_exemplaire;
        $livre->image = $request->image;
        $livre->save();
        return $livre;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return livre::destroy($id);
    }

    /**
     * Search for a name
     *
     * @param  str  $id
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        return livre::where('titre','like','%'.$name.'%')->get();
    }
}
