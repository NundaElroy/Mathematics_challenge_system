<nav class="navbar navbar-expand-lg" color-on-scroll="500">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <!-- <ul class="nav navbar-nav mr-auto">
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                        <span class="notification">5</span>
                        <span class="d-lg-none">{{ __('Notification') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item" href="#">{{ __('Notification 1') }}</a>
                        <a class="dropdown-item" href="#">{{ __('Notification 2') }}</a>
                        <a class="dropdown-item" href="#">{{ __('Notification 3') }}</a>
                        <a class="dropdown-item" href="#">{{ __('Notification 4') }}</a>
                        <a class="dropdown-item" href="#">{{ __('Another notification') }}</a>
                    </ul>
                </li>
            </ul> -->
            <ul class="navbar-nav d-flex align-items-center">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display: inline-block; position: relative;">
                        <img src="{{ asset('image/Admin-photo.jpg') }}" alt="admin profile pic" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover; margin-right: 5px;">
                        <span class="no-icon" style="vertical-align: middle;">{{ __('Xwale Abdu') }}</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('My Profile') }}</a>
                        <div class="divider"></div>
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Log out') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

