@extends('layouts.app')

@section('content')

    <div class="container py-3">

        <div class="jumbotron p-4  mb-3 col-md-12 ">
            <div class="row">
                <div class="col-md-6 px-0">
                    <h1 class="display-4 font-italic">{{$contest->name}}</h1>
                    <p class="lead my-3 mb-auto">{{$contest->desc}}</p>

                    <br>
                    <br>
                    <a href="#" class="float-sm-left"><button type="button" class="btn btn-primary">Dołącz do zawodów</button></a>
                </div>
                <div class="col-md-5 px-0">
                   <img class="rounded " style="max-width: 500px;" src="{{$contest->photo->path}}">
                </div>
            </div>
        </div>


        <div class="row mb-3 p-4">
            <h2 class="mb-3">Aktualina lista zawodników</h2>


            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Imię</th>
                    <th scope="col">Nazwisko</th>
                    <th scope="col">Uczestnik</th>
                    <th scope="col">Wynik</th>
                    <th scope="col">Komentarz do wyniku</th>
                    @if(Auth::user()->id == $contest->owner->id)
                        <th scope="col">Działania na użytkowniku</th>
                        @endif

                </tr>
                </thead>
                <tbody>
                @foreach($contest->users as $user)
                <tr>



                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$user->user->first_name}}</td>
                    <td>{{$user->user->last_name}}</td>
                    <td>@if($user->accepted)
                           <i class="alert-success" > Uczestnik zaakceptowany</i>
                    @else
                            <i class="alert-info"> Uczestnik nieakwtywny</i>
                        @endif
                    </td>
                    <td>@if($user->result)
                            @if($user->result->score_result)
                            {{$user->result->score_result}} {{$user->result->unit}}
                                @endif
                    @else
                            @if(Auth::user()->id == $contest->owner->id)

                                <form action="{{ route('update_result') }}" method="POST" >
                                    @csrf

                                    <input class="form-control"  name="score_result" type="text">
                                    <input type="hidden" value="{{$contest->id}}" name="contest_id">
                                    <input type="hidden" value="{{$user->user_id}}" name="user_id">
                                    <button type="submit" class="btn btn-primary">Zapisz</button>
                                </form>
                            @else
                                -
                            @endif

                    @endif</td>
                    <td>@if($user->result){{$user->result->annotation}}
                        @else
                            @if(Auth::user()->id == $contest->owner->id)
                                <form action="{{ route('update_result') }}" method="POST" >
                                    @csrf

                                <input class="form-control"  name="annotation" type="text">
                                    <input type="hidden" value="{{$contest->id}}" name="contest_id">
                                    <input type="hidden" value="{{$user->user_id}}" name="user_id">
                                <button type="submit" class="btn btn-primary">Zapisz</button>
                                </form>
                            @else
                                -
                            @endif
                        @endif</td>

                    @if(Auth::user()->id == $contest->owner->id)
                        <td>
                            <a href="{{route('accept_user', [$contest->id, $user->user->id])}}"><button type="button" class="btn btn-primary">Zmień stan </button></a>

                        </td>
                    @endif

                </tr>
                @endforeach
                </tbody>
            </table>



    </div>
@endsection
