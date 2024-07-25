<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('light-bootstrap/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('light-bootstrap/img/favicon.ico') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{ $title }}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link href="{{ asset('light-bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('light-bootstrap/css/light-bootstrap-dashboard.css?v=2.0.0') }}" rel="stylesheet" />
    <link href="{{ asset('light-bootstrap/css/demo.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .guest-sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            right: 0;
            top: 0;
            background-color: #f4f4f4;
            padding: 20px;
            box-shadow: -2px 0 5px rgba(0,0,0,0.1);
        }
        .main-content {
            margin-left: 270px; /* Adjust based on admin sidebar width */
            margin-right: 270px; /* Adjust based on guest sidebar width */
            padding: 20px;
            width: calc(100% - 540px); /* Adjust based on sidebar widths */
        }
    </style>
</head>
<body>
    <div class="wrapper @if (!auth()->check() || request()->route()->getName() == "") wrapper-full-page @endif">

        @if (auth()->check() && request()->route()->getName() != "")
            @include('layouts.navbars.sidebar')
            @include('pages/sidebarstyle')
        @endif

        

        <div class="@if (auth()->check() && request()->route()->getName() != "") main-panel @endif">
            @include('layouts.navbars.navbar')
            @yield('content')
            @include('layouts.footer.nav')
        </div>
      </body>  

    </div>
    <!-- Core JS Files -->
    <script src="{{ asset('light-bootstrap/js/core/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('light-bootstrap/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('light-bootstrap/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('light-bootstrap/js/plugins/jquery.sharrre.js') }}"></script>
    <script src="{{ asset('light-bootstrap/js/plugins/bootstrap-switch.js') }}"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <script src="{{ asset('light-bootstrap/js/plugins/chartist.min.js') }}"></script>
    <script src="{{ asset('light-bootstrap/js/plugins/bootstrap-notify.js') }}"></script>
    <script src="{{ asset('light-bootstrap/js/light-bootstrap-dashboard.js?v=2.0.0') }}" type="text/javascript"></script>
    <script src="{{ asset('light-bootstrap/js/demo.js') }}"></script>
    @stack('js')
    <script>
      $(document).ready(function () {
        $('#facebook').sharrre({
          share: { facebook: true },
          enableHover: false,
          enableTracking: false,
          enableCounter: false,
          click: function(api, options) { api.simulateClick(); api.openPopup('facebook'); },
          template: '<i class="fab fa-facebook-f"></i> Facebook',
          url: 'https://light-bootstrap-dashboard-laravel.creative-tim.com/login'
        });
        $('#google').sharrre({
          share: { googlePlus: true },
          enableCounter: false,
          enableHover: false,
          enableTracking: true,
          click: function(api, options) { api.simulateClick(); api.openPopup('googlePlus'); },
          template: '<i class="fab fa-google-plus"></i> Google',
          url: 'https://light-bootstrap-dashboard-laravel.creative-tim.com/login'
        });
        $('#twitter').sharrre({
          share: { twitter: true },
          enableHover: false,
          enableTracking: false,
          enableCounter: false,
          buttons: { twitter: { via: 'CreativeTim' } },
          click: function(api, options) { api.simulateClick(); api.openPopup('twitter'); },
          template: '<i class="fab fa-twitter"></i> Twitter',
          url: 'https://light-bootstrap-dashboard-laravel.creative-tim.com/login'
        });
      });
    </script>

</html>
