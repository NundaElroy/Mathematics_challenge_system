<div class="sidebar" data-image="{{ asset('light-bootstrap/img/sidebar-5.jpg') }}">
    <!--
Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

Tip 2: you can also add an image using data-image tag
-->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="http://www.creative-tim.com" class="simple-text">
                {{ __("MATHEMATICS COMPETITION") }}
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

                <div class="collapse @if($activeButton =='laravel') show @endif" id="laravelExamples">
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

            <li class="nav-item @if($activePage == 'school') active @endif">
                <a class="nav-link" href="{{route('page.index', 'school')}}">
                    <i class="nc-icon nc-notes"></i>
                    <p>{{ __("Schools") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'questAnswer') active @endif">
                <a class="nav-link" href="{{route('page.index', 'questAnswer')}}">
                    <i class="nc-icon nc-atom"></i>
                    <p>{{ __("question & Answer") }}</p>
                </a>
            </li>
           



           
           
            <li class="nav-item @if($activePage == 'notifications') active @endif">
                <a class="nav-link" href="{{route('page.index', 'notifications')}}">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>{{ __("Notifications") }}</p>
                </a>
            </li>
           
        </ul>
    </div>
</div>
