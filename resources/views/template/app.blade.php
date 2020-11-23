<!DOCTYPE html>
<html>

<head>
    <meta charset="utf8">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.js')}}"></script>
    <script src="{{asset('js/jquery.mask.js')}}"></script>
    <title>@yield('nome_tela')</title>
</head>

<body>
    <nav class="nav nav-pills nav-fill bg-info ">
        <div class="nav-item"><a id="home-link" class="nav-link text-light" href="/">Home</a></div>
        <div class="nav-item"><a id="animal-link" class="nav-link text-light" href="/animal">Animais</a></div>
        <div class="nav-item active"><a id="especie-link" class="nav-link text-light" href="/especie">Espécies</a></div>
        <div class="nav-item active"><a id="dono-link" class="nav-link text-light" href="/dono">Dono</a></div>
    </nav>

    @if (Session::has('salvar'))
        <div class="alert alert-success">
            {{Session::get('salvar')}}
        </div>
    @endif
    @if (Session::has('excluir'))
        <div class="alert alert-danger">
            {{Session::get('excluir')}}
        </div>
    @endif

    @if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $e)
						<li>{{ $e }}</li>
					@endforeach
				</ul>
			</div>
		@endif

    <div class="container">
        <fieldset>
            <legend class="title">Cadastro - @yield('nome_tela')</legend>
            <div class="cadastro">
                @yield('cadastro')
            </div>
        </fieldset>

        <fieldset>
            <legend class="title">Listagem - @yield('nome_tela')</legend>
            <div>
                @yield('listagem')
            </div>
        </fieldset>
    </div>
    
    @yield('tab-active')
</body>

</html>