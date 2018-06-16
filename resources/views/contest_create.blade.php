@extends('layouts.app')

@section('content')


    <div class="container py-3">



        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Dodaj nową rywazlizację</h4>
            <form action="{{ route('contest.store') }}" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name">Nazwa Zawodów</label>
                    <div class="input-group">
                        <input class="form-control" name="name" id="name" placeholder="Nazwa Zawodów" type="text">

                    </div>
                </div>



                <div class="form-group">
                    <label for="desc">Opis Rywalizacji</label>
                    <textarea class="form-control" name="desc" rows="5" id="desc"></textarea>
                </div>
                <hr class="mb-4">
                <div class="form-group">
                    <label for="exampleInputFile">Dodaj zdjecie</label>
                    <input class="form-control-file" id="exampleInputFile" name="photo" aria-describedby="fileHelp" type="file">
                    </div>

                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Utwórz rywalizację</button>
            </form>
        </div>
    </div>

@endsection
