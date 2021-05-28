<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <div class="row justify-content-between align-items-center w-100 m-0">
        <a class="navbar-brand" href="" style="color:#66EB9A">WE FASHION</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">


        @if(Auth::check())
        <li nav-item>
            <a class="nav-link text-uppercase" href="{{ route('adminProduct') }}">Produits</a>
        </li>
        <li nav-item>
            <a class="nav-link text-uppercase" href="{{ route('adminCategory') }}">Catégories</a>
        </li>
        @endif

        @if(!Auth::check())

        <li class="nav-item @if(isset($active) && $active == 'discount') active @endif">
            <a class="nav-link text-uppercase" href="{{ route('discount') }}">Soldes</a>
          </li>

                @forelse($categories as $id => $name)

                <li class="nav-item @if(isset($active_category) && $active_category == $name['name']) active @endif">
                <a class="nav-link text-uppercase" href="{{route('category', $categories[$id]->id)}}">{{$name["name"]}}</a>
                
                @empty 
                <li>Aucune catégorie pour l'instant</li>
                @endforelse
            @endif
               
          
        </ul>
                

            <ul class="nav navbar-nav navbar-right">
            {{-- renvoie true si vous êtes connecté --}}
                @if(Auth::check())
                
                <li>
                    <a href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>  
                @else 
                <li><a href="{{route('login')}}">Login</a></li>   
                @endif
            </ul>

            
        </div>
    </div>
</nav>