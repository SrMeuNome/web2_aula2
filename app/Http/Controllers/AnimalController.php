<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Especie;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animal = new Animal();
        $animais = DB::table('animal AS a')
            ->join('especie AS e', 'e.id', '=', 'a.id_especie')
            ->select('a.id', 'a.nome', 'a.idade', 'e.nome AS especie')
            ->get();
        $especies = Especie::all();
        return view("animal.index", [
            "animal" => $animal,
            "animais" => $animais,
            "especies" => $especies
        ]);
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
        if ($request->post('id') == '') {
            $animal = new Animal();
        } else {
            $animal = Animal::find($request->post('id'));
        }
        $animal->nome = $request->post('nome');
        $animal->dat_nasc = $request->post('dat_nasc');
        $animal->id_especie = $request->post('especie');
        $animal->raca = $request->post('raca');
        $animal->dono = $request->post('dono');
        $animal->idade = intval((intval(strtotime(date("Y/m/d"))) - intval(strtotime(date("Y/m/d", strtotime($animal->dat_nasc))))) / (365 * 24 * 60 * 60));
        $animal->save();
        $request->session()->flash('salvar', 'Animal salvo com sucesso!');
        return redirect('/animal');
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
        $animal = Animal::find($id);
        $animais = DB::table('animal AS a')
            ->join('especie AS e', 'e.id', '=', 'a.id_especie')
            ->select('a.id', 'a.nome', 'a.idade', 'e.nome AS especie')
            ->get();
        $especies = Especie::all();
        return view("animal.index", [
            "animal" => $animal,
            "animais" => $animais,
            "especies" => $especies
        ]);
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
    public function destroy(Request $request, $id)
    {
        Animal::destroy($id);
        $request->session()->flash('excluir', "Animal excluido com sucesso!");
        return redirect('/animal');
    }
}
