<?php

namespace App\Http\Controllers;

use App\Models\Dono;
use App\Models\Animal;
use Illuminate\Http\Request;

class DonoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dono = new Dono();
        $donos = Dono::all();
        $animais = Animal::all();
        return view("dono.index", [
            "dono" => $dono,
            "donos" => $donos,
            "animais" => $animais
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
            "cpf" => "required"
        ], [
            "*.required" => "O [:attribute] é obrigatório."
        ]);

        if ($request->post("id") == '') {
            $dono = new Dono();
        } else {
            $dono = Dono::Find($request->post("id"));
        }

        $dono->nome = $request->post("nome");
        $dono->cpf = $request->post("cpf");

        $dono->save();

        $request->session()->flash('salvar', 'Dono salvo com sucesso!');
        return redirect('/dono');
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
        $dono = Dono::find($id);
        $donos = Dono::all();
        $animais = Animal::all();
        return view("dono.index", [
            "dono" => $dono,
            "donos" => $donos,
            "animais" => $animais
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
        Dono::destroy($id);
        $request->session()->flash('excluir', "Dono excluido com sucesso!");
        return redirect('/dono');
    }
}
