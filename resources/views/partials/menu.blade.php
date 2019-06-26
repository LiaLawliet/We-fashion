<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{url('/')}}">Acceuil</a>
            </li>
            @if(Route::is('product.*') == false)
                @forelse($categories as $id => $name)
                <li class="nav-item">
                    <a class="nav-link" href="{{url('category', $id)}}">{{$name}}</a>
                </li>
                @empty
                @endforelse
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{url('admin/product')}}">Produits</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" Catégories</a>
                </li> -->
            @endif
        </ul>
    </div>
    <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
        <ul class="navbar-nav">
            @if(Auth::check())
            <li class="nav-item">
                <a class="nav-link" href="{{url('admin/product')}}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('logout')}}"
                    onClick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    LogOut</a>
                
                <form action="{{route('logout')}}" id="logout-form" method='POST' 
                    style="display:none;">
                    {{csrf_field()}}
                </form>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{route('login')}}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('register')}}">Register</a>
            </li>
            @endif
        </ul>
    </div>
</nav>