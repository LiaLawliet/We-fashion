<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style='margin-bottom: 10px;'>
    <div class="container">
        <ul class="navbar-nav mr-auto">
            @if(Route::is('product.*') == false && Route::is('categories.*') == false)
            <li class="nav-item">
                <a class="nav-link" href="{{url('/')}}" style='color:#66EB9A'>WE FASHION</a>
            </li>
                @forelse($categories as $id => $name)
                <li class="nav-item">
                    <a class="nav-link" href="{{url('category', $id)}}">{{$name}}</a>
                </li>
                @empty
                @endforelse
                <li class="nav-item">
                    <a class="nav-link" href="{{url('sales')}}">Promos</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="" onClick="event.preventDefault();" style='color:#66EB9A'>WE FASHION</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('admin/product')}}">Produits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('admin/categories')}}"> Catégories</a>
                </li>
            @endif
        </ul>
    </div>
    <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
        <ul class="navbar-nav">
            @if(Auth::check())
            @if(Route::is('product.*') == false && Route::is('categories.*') == false)
            <li class="nav-item">
                <a class="nav-link" href="{{url('admin/product')}}" style="font-size:1.2rem;"><i class="fas fa-user-shield"></i></a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{url('/')}}" style="font-size:1.2rem;"><i class="fas fa-home"></i></a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{route('logout')}}" onClick="event.preventDefault(); document.getElementById('logout-form').submit();" style="font-size:1.2rem;">
                    <i class="fas fa-sign-out-alt"></i>
                </a>                
                <form action="{{route('logout')}}" id="logout-form" method='POST' style="display:none;">
                    {{csrf_field()}}
                </form>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{route('login')}}" style="font-size:1.2rem;"><i class="fas fa-user-shield"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('register')}}">Register</a>
            </li>
            @endif
        </ul>
    </div>
</nav>