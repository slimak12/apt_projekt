<div class="album py-5 bg-light">
    <div class="container">

        <div class="row">
            @foreach($contests as $contest)
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    <a href="{{route('contest.show', $contest->id)}}"> <img class="card-img-top" src="{{$contest->photo->path }}" alt="" style="height: 225px; width: 100%; display: block;" ></a>


                    <div class="card-body">
                        <a href="{{route('contest.show', $contest->id)}}">  <h5 class="card-title">{{$contest->name}}</h5> </a>
                            <p class="card-text">{{$contest->desc}} </p>

                        <small class="text-muted"> Zawody orgaizuje: {{$contest->owner->first_name}} {{$contest->owner->last_name}}</small></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">

                                <a href="{{route('add_to_contest', $contest->id)}}" > <button type="button" class="btn btn-sm btn-outline-secondary" @if(!Auth::user()) disabled @endif >@if(!Auth::user()) Musisz się zalogować, aby dołączyć @else Dołącz @endif </button></a>
                            </div>
                            <small class="text-muted">12 hours ago</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>