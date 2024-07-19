<div class="sidebar" data-color="azure" data-image="{{ asset('light-bootstrap/img/Side2.jpg') }}">
    <!--
Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

Tip 2: you can also add an image using data-image tag
-->
    <div class="sidebar-wrapper">
        <div class="logo" style="display:flex; align-items:center;">
        <img src="{{asset('light-bootstrap/img/logo1.png')}}" alt="logo" alt="Logo" style="height: 80px; width:80px;">
        <a href="http://www.creative-tim.com" class="simple-text">
               <span style="margin-left: 10px; font-size:20px;"> {{ __("MATHEMATICS COMPETITION") }}</span>
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item @if($activePage == 'dashboard') active @endif">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>{{ __("Dashboard") }}</p>
                </a>
            </li>

            <li class="nav-item">

                <div class="collapse @if($activePage =='laravel') show @endif" id="laravelExamples">
                    <ul class="nav">
                        <li class="nav-item @if($activePage == 'user') active @endif">
                            <a class="nav-link" href="{{route('profile.edit')}}">
                                <i class="nc-icon nc-single-02"></i>
                                <p>{{ __("User Profile") }}</p>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="nav-item @if($activePage == 'schools') active @endif">
                <a class="nav-link" href="{{route('schools.index', 'schools')}}">
                    <i class="nc-icon nc-notes"></i>
                    <p>{{ __("Schools") }}</p>
                </a>
            </li>

            <li class="nav-item @if($activePage == 'questions&Answer') active @endif">
                <a class="nav-link" href="{{route('questions.questions-form', 'questions&Answer')}}">
            
                    <i class="nc-icon nc-atom"></i>
                    <p>{{ __("Questions & Answers") }}</p>
                </a>
            </li>

            <li class="nav-item @if($activePage == 'challenges') active @endif">
            <a class="nav-link" href="{{route('challenges.index', 'challenges')}}">
                <i class="nc-icon nc-notes"></i>
                <p>{{ __("Challenges") }}</p>
            </a>
        </li>

            <li class="nav-item @if($activePage == 'notifications') active @endif">
                <a class="nav-link" href="{{route('page.index', 'notifications')}}">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>{{ __("Notifications") }}</p>
                </a>
            </li>
      <!--added a nav link for guest view-->
      <li class="nav-item{{ $activePage == 'guest_welcome' ? ' active' : '' }}">
    <a class="nav-link" href="{{ route('guest.welcome') }}">
        <i class="nc-icon nc-layout-11"></i>
        <p>{{ __('Guest Welcome') }}</p>
    </a>
</li>
<!--stops here-->


        </ul>
    </div>
</div>
