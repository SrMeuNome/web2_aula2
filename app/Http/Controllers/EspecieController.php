<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especie;

class EspecieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $especie = new especie();
        $especies = Especie::all();
        return view("especie.index", [
            "especies" => $especies,
            "especie" => $especie,
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
            $especie = new Especie();
        } else {
            $especie = Especie::find($request->post("id"));
        }
        $especie->nome = $request->post('especie');
        $especie->save();
        $request->session()->flash('salvar', 'Espécie salva com sucesso!');
        return redirect('/especie');
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
        $especies = Especie::all();
        $especie = Especie::find($id);
        return view('especie.index', [
            "especies" => $especies,
            "especie" => $especie
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
        Especie::destroy($id);
        $request->session()->flash('excluir', 'Espécie excluida com sucesso!');
        return redirect('/especie');
    }
}
