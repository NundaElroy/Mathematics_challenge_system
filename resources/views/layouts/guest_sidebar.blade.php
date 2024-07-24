

<!-- resources/views/layouts/guest_sidebar.blade.php -->
<div class="guest-sidebar" data-color="azure" data-image="{{ asset('light-bootstrap/img/Side2.jpg') }}">
    <div class="sidebar-wrapper">
        <div class="logo" style="display:flex; align-items:center;">
            <img src="{{ asset('light-bootstrap/img/logo1.png') }}" alt="Logo" style="height: 80px; width:80px;">
            <a href="http://www.creative-tim.com" class="simple-text">
                <span style="margin-left: 10px; font-size:20px;">{{ __("Guest Analytics") }}</span>
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item @if($activePage == 'analyticas') active @endif">
                <a class="nav-link" href="{{ route('analytics') }}">
                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                    <p>{{ __("Most Correct Answers") }}</p>
                </a>
            </li>
            <!-- Add more guest analytics links here -->
        </ul>
    </div>
</div>

