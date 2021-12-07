<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\livre;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmpruntController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emprunts = Emprunt::where('updated_at',null)->get();
        foreach ($emprunts as $i => $e) {
            $e->user= User::where('id',$e->user)->get()->first();
            $e->livre= livre::where('id',$e->livre)->get()->first();
            $e->created_at =Carbon::parse($e->created_at)->format('d-m-Y');;
        }

        return $emprunts;
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
        if ($livre->nbr_exemplaire==0) {
           return 'Hors Stock';
        }
        else {
        $emprunt = new Emprunt;
        $emprunt->livre = $request->livre;
        $emprunt->user = $request->user;
        $emprunt->created_at =$dt->toDateString();
        $emprunt->updated_at =null;
        $livre->nbr_exemplaire-=1;
        $emprunt->save();
        $livre->save();
        return 'Le livre a été emprunté';
    }
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
        $emprunt = Emprunt::find($id);
        $dt = Carbon::now();
        $emprunt = new Emprunt;
        $emprunt->updated_at =$dt->toDateString();
        return $emprunt->save();
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
