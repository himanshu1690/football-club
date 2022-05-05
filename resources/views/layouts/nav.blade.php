<!-- Left Side Of Navbar -->
<ul class="navbar-nav me-auto">
    @can('view-any', \App\Models\Club::class)
    <li class="nav-item" style="margin-right: 10px">
        <a class="nav-item text-decoration-none text-dark" href="{{ route('clubs.index') }}">Clubs</a>
    </li>
    @endcan
    @can('view-any', \App\Models\Team::class)
    <li class="nav-item" style="margin-right: 10px">
        <a class="nav-item text-decoration-none text-dark" href="{{ route('teams.index') }}">Teams</a>
    </li>
    @endcan
    @can('view-any', \App\Models\User::class)
    <li class="nav-item">
        <a class="nav-item text-decoration-none text-dark" href="{{ route('users.index') }}">Users</a>
    </li>
    @endcan
</ul>

<!-- Right Side Of Navbar -->
<ul class="navbar-nav ms-auto">
    <!-- Authentication Links -->
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item dropdown">

            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                @impersonating
                <a class="dropdown-item" href="{{ route('users.leave.impersonate') }}">
                    {{ __('Leave impersonation') }}
                </a>
                @endImpersonating

                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
</ul>
