@extends('layouts.app')

@section('content')

    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Lubisz Rywalizacje?</h1>
            <p class="lead text-muted">Mamy coś dla Ciebie! Miejsce w którym możesz podejmowac rywalizacje w różnych dziedzinach życia. Począwzy od rywalizacji w grach po wzięcie udziału w lokalnych zawodach sportowych!<p>
                <a href="{{route('register')}}" class="btn btn-primary my-2">Zarejestruj się Teraz!</a>
                <a href="{{route('contest.index')}}" class="btn btn-secondary my-2">Sprawdź listę dostępnych zawodów</a>
            </p>
        </div>
    </section>



    @include('compo.contest_list_thumb')


@endsection
