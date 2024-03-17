<nav class="navbar navbar-expand navbar-light bg-white shadow-sm ">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'My Learners') }}
        </a>
        
       

        <div class="collapse navbar-collapse " id="navbarSupportedContent" >
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <div class="navbar-header d-md-none">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#sbar">
                      <span class="icon-bar"></span><br>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    
                  </div>
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
                    <a id="navbarDropdown" class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <span class="avatar">
                            @if( !empty($pic) )
                                <img src="<?= url(""); ?>/uploads/{{ $pic }}" class="user-avatar img-circle">
                                @else 
                            <img src="<?= url(""); ?>/images/avatar.png" class="user-avatar img-fluid" id="avatar" >
                             @endif 
                        </span>
                        <span class="d-none d-md-inline"> {{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                       <a class="dropdown-item" href="{{ url('Settings@get') }}"> <i class="fa fa-cog" aria-hidden="true"> </i> Settings</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                           <i class="fa fa-sign-out" aria-hidden="true"> </i> {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        
                    </div>
                </li>
                
                @endguest
            </ul>
        </div>
    </div>
</nav>
@push('css') 
<link href= https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css rel="stylesheet">
@endpush