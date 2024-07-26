<nav class="navbar navbar-expand-lg navbar-dark bg-info">
    <div class="container">
        <div class="navbar-wrapper">
        <div class="logo" style="display:flex; align-items:center;position:absolute;top:10px;left: 10px;">
    <img src="{{asset('light-bootstrap/img/logo1.png')}}" alt="logo" class="logo" style="height: 40px; width:60px;">
        </div>
            <a class="navbar-brand text-white" href="#pablo">{{ __('Mathematics National Platform') }}</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navbar">
            <ul class="navbar-nav">
                <li class="nav-item @if($activePage == 'register') active @endif">
                    <a href="{{ route('register') }}" class="nav-link text-white">
                        <i class="nc-icon nc-badge"></i> {{ __('Register') }}
                    </a>
                </li>
                <li class="nav-item @if($activePage == 'login') active @endif">
                    <a href="{{ route('login') }}" class="nav-link text-white">
                        <i class="nc-icon nc-mobile"></i> {{ __('Login') }}
                    </a>
                </li>
                <li class="nav-item @if($activePage == 'guest.welcome') active @endif">
                    <a href="{{ route('guest.welcome') }}" class="nav-link text-white">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i> {{ __('Guest View') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>