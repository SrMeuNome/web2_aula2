@extends('template.app')

@section('nome_tela', 'Espécie')

@section('cadastro')
    <div class="container">
        <form class="row" method="POST" action="/especie">
            <div class="form-group col-12">
                <label for="especie" class="form-text">Espécie:</label>
                <input value="{{$especie->nome}}" id="especie" name="especie" class="form-control" type="text">
                <input value="{{$especie->id}}" id="id" name="id" type="hidden">
            </div>
            @csrf
            <div class="form-inline col-12 btn-custom-group">
                <button type="submit" class="btn btn-outline-success icon"><i class="material-icons">add_circle_outline</i></button>
                <button type="reset" class="btn btn-outline-warning icon"><i class="material-icons">clear</i></button>
            </div>
        </form>
    </div>
@endsection

@section('listagem')
    <div class="custom-table">
        <table class="table table-hover table-info col-7">
            <thead>
                <tr>
                    <th>Espécies</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($especies as $especie)
                    <tr>
                        <td>{{$especie->nome}}</td>

                        <td>
                            <form method="GET" action="/especie/{{$especie->id}}/edit">
                                <div class="btn-custom-group">
                                    <button class="btn btn-outline-primary icon btn-circle" type="submit"><i class="material-icons">edit</i></button>
                                </div>
                            </form>
                        </td>
                        
                        <td>
                            <div class="btn-custom-group">
                                <form method="POST" action="/especie/{{$especie->id}}">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete" />
                                    <button onclick="return confirm('Você deseja realmente deletar essa espécie?')" class="btn btn-outline-danger icon btn-circle" type="submit"><i class="material-icons">delete</i></button>
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
        $('#especie-link').tab('show');
    })
</script>
@endsection