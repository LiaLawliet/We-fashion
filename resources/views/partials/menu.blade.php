<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <span class="icon-bar"><a href="{{url('/')}}">Aucceil</a></span>
            @forelse($genres as $id => $name)
            <span class="icon-bar"><a href="{{url('genre', $id)}}">{{$name}}</a></span>
            @empty 
            <li>Aucun genre pour l'instant</li>
            @endforelse
            <a class="navbar-brand" href="#">{{config('app.name')}}</a>
        </div>
    </div>
</nav>