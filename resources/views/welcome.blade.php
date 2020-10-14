@extends('template.app-home')

@section('tab-active')
    <script>
        $(document).ready(function ()
        {
            $('#home-link').tab('show');
        })
    </script>
@endsection

@section('main')
    <div class="container">
        <div class="main-title">
            <img class="img-fluid" src="{{asset('img/logo.png')}}" alt="Tili Pet" title="Tili Pet">
        </div>
    </div>
@endsection