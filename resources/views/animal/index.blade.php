@extends('template.app')

@section('nome_tela', 'Animal')

@section('cadastro')
    <div class="container">
        <form class="row" method="POST" action="/animal">
            <div class="form-group col-9">
                <label for="nome" class="form-text">Nome do animal:</label>
                <input value="{{$animal->nome}}" id="nome" name="nome" class="form-control" type="text">
            </div>
            <div class="form-group col-3">
                <label for="dat_nasc" class="form-text">Data de Nascimento:</label>
                <input value="{{$animal->dat_nasc}}" id="dat_nasc" name="dat_nasc" class="form-control" type="date">
            </div>
            <div class="form-group col-6">
                <label for="especie" class="form-text">Espécie:</label>
                <select id="especie" name="especie" class="custom-select">
                    <option></option>
                    @foreach ($especies as $especie)
                        @if ($especie->id == $animal->id_especie)
                            <option selected value="{{$especie->id}}">{{$especie->nome}}</option>                            
                        @endif
                        <option value="{{$especie->id}}">{{$especie->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-6">
                <label for="raca" class="form-text">Raça:</label>
                <input value="{{$animal->raca}}" id="raca" name="raca" class="form-control" type="text">
            </div>
            <div class="form-group col-12">
                <label for="dono" class="form-text">Nome do Dono:</label>
                <select id="dono" name="dono[]" class="form-control" required multiple>
                    @foreach ($donos as $dono)
                        @if ($animal->listaDonos()->where("id", $dono->id)->count() > 0)
                            <option value="{{$dono->id}}" selected>{{$dono->nome}}</option>
                        @else
                            <option value="{{$dono->id}}">{{$dono->nome}}</option>
                        @endif
                    @endforeach
                </select>
                <input value="{{$animal->id}}" id="id" name="id" type="hidden">
            </div>
            @csrf
            <div class="form-inline col-12 btn-custom-group">
                <button type="submit" class="btn btn-outline-success icon"><i class="material-icons">add_circle_outline</i></button>
                <button type="reset" class="btn btn-outline-warning icon"><i class="material-icons">clear</i></button>
            </div>
        </form>
        <script>
            $(document).ready(function() {
                $("#dono").selectpicker("refresh")
            });
        </script>
    </div>
@endsection

@section('listagem')
    <div class="custom-table">
        <table class="table table-hover table-info col-9">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Idade</th>
                    <th>Espécies</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($animais as $animal)
                    <tr> 
                        <td>{{$animal->nome}}</td>
                        <td>{{$animal->idade}}</td>
                        <td>{{$animal->objEspecie->nome}}</td>
                        <td>
                            <form method="GET" action="/animal/{{$animal->id}}/edit">
                                <div class="btn-custom-group">
                                    <button class="btn btn-outline-primary icon btn-circle" type="submit"><i class="material-icons">edit</i></button>
                                </div>
                            </form>
                        </td>
                        
                        <td>
                            <div class="btn-custom-group">
                                <form method="POST" action="/animal/{{$animal->id}}">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete" />
                                    <button onclick="return confirm('Você deseja realmente deletar esse animal?')" class="btn btn-outline-danger icon btn-circle" type="submit"><i class="material-icons">delete</i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
@endsection

@section('tab-active')
<script>
    $(document).ready(function() {
        $('#animal-link').tab('show');
    })
</script>
@endsection

