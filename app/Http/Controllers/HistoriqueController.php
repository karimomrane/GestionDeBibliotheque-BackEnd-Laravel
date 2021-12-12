<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Historique;
use App\Models\livre;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HistoriqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $historique = Historique::all();
        foreach ($historique as $i => $e) {
            $e->user= User::where('id',$e->user)->get()->first();
            $e->livre= livre::where('id',$e->livre)->get()->first();
            $e->created_at =Carbon::parse($e->created_at)->format('d-m-Y');
            $e->updated_at =Carbon::parse($e->updated_at)->format('d-m-Y');
        }

        return $historique;
    }
    public function index1($id)
    {
        
        $historique = Historique::where('user',$id)->get();
        foreach ($historique as $i => $e) {
            $e->user= User::where('id',$e->user)->get()->first();
            $e->livre= livre::where('id',$e->livre)->get()->first();
            $e->created_at =Carbon::parse($e->created_at)->format('d-m-Y');
            $e->updated_at =Carbon::parse($e->updated_at)->format('d-m-Y');
        }

        return $historique;
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
            'livre' => 'required',
            'user' => 'required', 
        ]);
        $dt = Carbon::now();
        $livre = livre::find($request->livre);
        $historique = new Historique();
        $historique->livre = $request->livre;
        $historique->user = $request->user;
        $historique->emprunt = $request->emprunt;
        $historique->created_at = $request->created_at;
        $historique->updated_at = $dt->toDateString();
        $livre->nbr_exemplaire+=1;
        $livre->save();
        $historique->save();
        Emprunt::destroy($request->emprunt);
        return 'Le livre a été rendu';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
