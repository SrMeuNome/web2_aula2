<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Especie;
use App\Models\Dono;
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
        $animais = Animal::all();
        $especies = Especie::all();
        $donos = Dono::all();
        return view("animal.index", [
            "animal" => $animal,
            "animais" => $animais,
            "especies" => $especies,
            "donos" => $donos
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
        $validacao = $request->validate([
            "nome" => "required",
            "dat_nasc" => "required|date|before:now",
            "especie" => "required",
            "raca" => "required",
            "dono" => "required"
        ], [
            "*.required" => "O [:attribute] é obrigatório.",
            "*.before" => "A [:attribute] é menor que a data atual."
        ]);

        if ($request->post('id') == '') {
            $animal = new Animal();
        } else {
            $animal = Animal::find($request->post('id'));
        }
        $animal->nome = $request->post('nome');
        $animal->dat_nasc = $request->post('dat_nasc');
        $animal->id_especie = $request->post('especie');
        $animal->raca = $request->post('raca');
        $animal->idade = intval((intval(strtotime(date("Y/m/d"))) - intval(strtotime(date("Y/m/d", strtotime($animal->dat_nasc))))) / (365 * 24 * 60 * 60));
        $animal->save();

        $animal->listaDonos()->detach();

        foreach ($request->post("dono") as $dono) {
            $animal->listaDonos()->attach($dono);
        }

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
        $animais = Animal::all();
        $especies = Especie::all();
        $donos = Dono::all();
        return view("animal.index", [
            "animal" => $animal,
            "animais" => $animais,
            "especies" => $especies,
            "donos" => $donos
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
        $animal = Animal::Find($id);
        $animal->listaDonos()->detach();
        Animal::destroy($id);
        $request->session()->flash('excluir', "Animal excluido com sucesso!");
        return redirect('/animal');
    }
}
