@extends('layouts.app')

@section('content')

<div class="container py-3">
    <div class="jumbotron jumbotron-fluid  p-3 p-md-5 text-white rounded bg-secondary">
        <div class="container">
            <h1 class="display-4">Przygoda wzywa! Na co czekasz?</h1>
            <p class="lead">Dołącz do rywalizacji</p>
        </div>
    </div>

    <div class="list-group">
        @foreach($contests as $contest)
        <a href="{{route('contest.show', $contest->id)}}" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="card flex-md-row mb-3 box-shadow h-md-250">
                <img class="card-img-right" src="{{$contest->photo->path }}" alt="" style="max-height: 400px; width: 300px; display: block;" >
                <div class="card-body d-flex flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">

                        <h5 class="mb-1">{{$contest->name}}</h5>
                        <small>Stworzono: {{ $contest->created_at->format('d-m-Y H:i') }}</small>
                    </div>


                    <p class="mb-4">{{$contest->desc}}</p>

                    <br>
                    <p class="mb-4"> Status:  @if($contest->active) <i class="alert-success"> Zawody w trakcie</i> @else <i class="alert-info"> Zawody ukończone</i> @endif
                    
                    </p>


                    <p class="mb-1">
                    <small>Liczba zarejestrowanych użytkowników: {{$contest->users_count}}</small>

                    </p>


                </div>

            </div>




        </a>
        @endforeach

    </div>

</div>


@endsection
