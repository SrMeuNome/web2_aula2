@extends('template.app')

@section('nome_tela', 'Dono')

@section('cadastro')
    <div class="container">
        <form class="row" method="POST" action="/dono">
            <div class="form-group col-8">
                <label for="nome" class="form-text">Nome:</label>
                <input value="{{$dono->nome}}" id="nome" name="nome" class="form-control" type="text">
            </div>
            <div class="form-group col-4">
                <label for="cpf" class="form-text">CPF:</label>
                <input value="{{$dono->cpf}}" id="cpf" name="cpf" class="form-control" type="text">
                <input value="{{$dono->id}}" id="id" name="id" type="hidden">
            </div>
            @csrf
            <div class="form-inline col-12 btn-custom-group">
                <button type="submit" class="btn btn-outline-success icon"><i class="material-icons">add_circle_outline</i></button>
                <button type="reset" class="btn btn-outline-warning icon"><i class="material-icons">clear</i></button>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function(){
            var maskFunc = function (val) {
                let text = val.replace(/\D/g, '').length >= 12 ? 'CNPJ:' : 'CPF:'
                $('label[for="cpf"]').text(text)
                return val.replace(/\D/g, '').length >= 12 ? '00.000.000/0000-00' : '000.000.000-009';
            },
                maskFuncOptions = {
                    onKeyPress: function (val, e, field, options) {
                        field.mask(maskFunc.apply({}, arguments), options);
                    }
                };

            $('#cpf').mask(maskFunc, maskFuncOptions)
        })
    </script>
@endsection

@section('listagem')
    <div class="custom-table">
        <table class="table table-hover table-info col-12">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF/CNPJ</th>
                    <th>Animais</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($donos as $dono)
                    <tr>
                        <td>{{$dono->nome}}</td>
                        <td>{{$dono->cpf}}</td>
                        <td>
                            <ul>
                                @foreach ($dono->listaAnimais as $animal)
                                    <li>{{$animal->nome}}</li>
                                @endforeach
                            </ul>
                        </td>

                        <td>
                            <form method="GET" action="/dono/{{$dono->id}}/edit">
                                <div class="btn-custom-group">
                                    <button class="btn btn-outline-primary icon btn-circle" type="submit"><i class="material-icons">edit</i></button>
                                </div>
                            </form>
                        </td>
                        
                        <td>
                            @if ($dono->listaAnimais->count() == 0)
                                <div class="btn-custom-group">
                                    <form method="POST" action="/dono/{{$dono->id}}">
                                        @csrf
                                        <input type="hidden" name="_method" value="delete" />
                                        <button onclick="return confirm('Você deseja realmente deletar esse dono?')" class="btn btn-outline-danger icon btn-circle" type="submit"><i class="material-icons">delete</i></button>
                                    </form>
                                </div> 
                            @else
                                Existe animais cadastrados
                            @endif
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
        $('#dono-link').tab('show');
    })
</script>
@endsection